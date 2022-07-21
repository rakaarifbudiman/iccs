<?php

namespace App\Http\Controllers\LUP;

use Mail;
use App\Models\User;
use App\Models\LUP\LUPFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Mail\LUP\LUPEvidenceHasReject;
use Illuminate\Support\Facades\Schema;
use App\Mail\LUP\LUPActionHasExtension;
use App\Mail\LUP\LUPExtensionHasReject;
use App\Mail\LUP\LUPActionRequestCancel;
use App\Mail\LUP\LUPActionNotif;
use App\Http\Requests\LUP\StoreLUPActionRequest;

class LUPActionController extends Controller
{
    public function store(StoreLUPActionRequest $request)
    {               
        $lastid = LUPAction::where('code',$request->modalhidecodelup)->max('noaction');
        $lastno = intval(substr($lastid,-2));       
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $request->modalhidecodelup.'-ACT-'. sprintf("%02s", $newid);      
        
        $store = LUPAction::create([    
            'code' => $request->modalhidecodelup,
            'noaction'=>$code,
            'action' => $request->action,        
            'pic_action' => str::lower($request->pic_action),
            'duedate_action' => $request->duedate_action,                   
        ]);                 
        return back();       
    }
    public function update(StoreLUPActionRequest $request,$id,LUPAction $lupaction)
    {   
        $decrypted = Crypt::decryptString($id);       
        $lupaction = LUPAction::find($decrypted);      
        $this->authorize('update',$lupaction);          
        $old = getoldvalues('mysql','lup_actions',$lupaction);   
        $lupaction->action = $request->action; 
        $lupaction->pic_action = str::lower($request->pic_action);
        $lupaction->duedate_action = $request->duedate_action . ' 00:00:00';                         
        $lupaction->save();  
         
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','Edited Action LUP ','edited');  

        return back();           
    }

    public function destroy($id)
    {        
        $decrypted = Crypt::decryptString($id);
        $lupaction = LUPAction::find($decrypted);   
        $this->authorize('update',$lupaction);     
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('deleted')->log('deleted Action LUP  '.$lupaction->code.'-'.$lupaction->action);     
        auditlups($lupaction,Auth::user()->username,'Delete Action',$lupaction->code,
                        'lup_actions','all fields',$lupaction->action . ' | '.$lupaction->pic_action,'' );
        $lupaction->delete();                 

        return back()->with('success','Success...Action has been deleted!');               

    }
    public function sign($id)
    {        
        $decrypted = Crypt::decryptString($id);
        $lupaction = LUPAction::find($decrypted);   
        $this->authorize('sign',$lupaction);          
        $lupaction->signdate_action=now();
        $lupaction->sign_type='User';
        $lupaction->save();           
        
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('sign')->log('sign Action LUP  '.$lupaction->code.'-'.$lupaction->action);
        return back()->with('success','Success...Action has been signed!');        

    }
    public function cancelsign($id)
    {        
        $decrypted = Crypt::decryptString($id);
        $lupaction = LUPAction::find($decrypted);   
        $this->authorize('cancelsign',$lupaction); 
        $old = getoldvalues('mysql','lup_actions',$lupaction);     
        $lupaction->signdate_action=null;
        $lupaction->sign_type=null;
        $lupaction->save();                
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','Cancel Sign Action LUP ','rollback'); 
        
        return back();               

    }

    //download evidence FLP
    public function downloadevidence(Request $request,$id)
    {        
        $decrypted = Crypt::decryptString($id);
        $file = LUPAction::find($decrypted);
        $paths = '/app/'.$file->evidence_filename;  
        $url = storage_path($paths);       
        
     return Response()->download($url);
     
    }

    //upload closing evidence
    public function uploadevidence(Request $request,$id)
    {
        //get data lupaction
        $lupaction = LUPAction::find(Crypt::decryptString($id));      
        $this->authorize('upload',$lupaction);            
        $paths = DB::table('iccsfilepaths')
        ->where('description','Bukti Close LUP')
        ->first()->filepath;        
        $code = 'EVD-'.$lupaction->noaction;        
        $old = getoldvalues('mysql','lup_actions',$lupaction);    

        $validatedData = $request->validate([
            'evidence_filename' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',    
        ]);    
           $name = $request->file('evidence_filename')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('evidence_filename')->storeAs($paths,$code.'.'.$ext);          
            $lupaction->evidence_filename = $path;            
            $lupaction->evidence_uploader = Auth::User()->username;
            $lupaction->dateupload_evidence = \Carbon\Carbon::now();
            $lupaction->save(); 
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','upload evidence Action LUP ','sign');          

        return back()->with('info', 'File Has been uploaded successfully');           
    }

    //Approved Closing Evidence
    public function approvedevidence($id, LUPAction $lupaction,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupaction = LUPAction::find($decrypted);          
        $this->authorize('approvedevidence',$lupaction);                     
        $cekreferaction = DB::table('lup_actions')->where('code',$lupaction->code)->where('action',$request->referaction)->exists();
        $referaction=DB::table('lup_actions')->where('code',$lupaction->code)->where('action',$request->referaction)->first();
        if($cekreferaction){           
            $lupaction->evidence_filename = $referaction->evidence_filename;
            $lupaction->notes = 'Approved Evidence with refer action to  '.$request->referaction;
        }
            $lupaction->dateapproved_evidence =\Carbon\Carbon::now();
            $lupaction->actionstatus='CLOSED';
            $lupaction->save();            
        
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('sign')->log('approved Action LUP  '.$lupaction->code.'-'.$lupaction->action);
        return back()->with('success','Approved Closing Evidence Success...');       
    }

    //Approved Closing Evidence
    public function rejectevidence($id, LUPAction $lupaction, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction    
        $lupaction = LUPAction::find($decrypted);        
        $this->authorize('approvedevidence',$lupaction);      
        $old = getoldvalues('mysql','lup_actions',$lupaction);          
            $email_uploader =$lupaction->evidence_uploaders->email;
            $lupaction->evidence_filename = null;           
            $lupaction->evidence_uploader = null;
            $lupaction->dateupload_evidence = null;
            $lupaction->save();

            //Send Notif to PIC Action & Uploader
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupaction->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupaction->lupparent->nolup,
            'action' => $lupaction->action,    
            'note'=>$request->note,        
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupaction->pic->email;  
        $emailcc= $email_uploader;       
        Mail::to(env('MAIL_TO_TESTING'))  
            ->cc(env('MAIL_TO_TESTING'))   
            ->send(new LUPEvidenceHasReject($mailData,$lupaction));    
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','reject evidence Action LUP','rollback');  
        
        return back()->with('success','Reject Closing Evidence Success...');             
       
    }

    //Store Due Date Extension
    public function storeextension($id, LUPAction $lupaction, Request $request)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupaction = LUPAction::find($decrypted);     
        $this->authorize('extended',$lupaction);        

        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',    
            'extension_notes'=>'min:10',
        ]);    
            $lupaction->actionstatus='ON EXTENSION';         
            if(!$lupaction->old_duedate ){
                $lupaction->old_duedate = $lupaction->duedate_action;
            }else{
                $lupaction->old_duedate2 = $lupaction->duedate_action;
            }               
            $lupaction->duedate_action = $request->duedate_action;  
            $lupaction->extension_notes = $request->extension_notes;          
            $lupaction->pic_extension = Auth::User()->username;
            $lupaction->signdate_extension = \Carbon\Carbon::now();
            $lupaction->save();  

            //Send Notif to Reviewer
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupaction->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupaction->lupparent->nolup,
            'action' => $lupaction->action, 
            'old_duedate'   =>$lupaction->old_duedate,
            'duedate'=>$lupaction->duedate_action,
            'note'=>$request->extension_notes, 
            'pic'=> $lupaction->pic_extension,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupaction->lupparent->reviewers->email;              

        Mail::to(env('MAIL_TO_TESTING'))     
            ->send(new LUPActionHasExtension($mailData,$lupaction));    
        
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('edited')->log('submit extension Action LUP  '.$lupaction->code.'-'.$lupaction->action);    
        return back()->with('success','Submit Due Date Extension Success...');             
       
    }

    //Review Due Date Extension
    public function reviewextension($id, LUPAction $lupaction, Request $request)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction           
        $lupaction = LUPAction::find($decrypted);       
        $this->authorize('reviewextended',$lupaction);      

        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',            
        ]);    
            $lupaction->actionstatus='ON EXTENSION APPROVAL';               
            $lupaction->duedate_action = $request->duedate_action;                     
            $lupaction->reviewer_extension = Auth::User()->username;
            $lupaction->datereview_extension = \Carbon\Carbon::now();
            $lupaction->save();  

            //Send Notif to Approver
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupaction->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupaction->lupparent->nolup,
            'action' => $lupaction->action, 
            'old_duedate'   =>$lupaction->old_duedate,
            'duedate'=>$lupaction->duedate_action,
            'note'=>$request->extension_notes, 
            'pic'=> $lupaction->pic_extension,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupaction->lupparent->approvers->email;              

        Mail::to(env('MAIL_TO_TESTING'))     
            ->send(new LUPActionHasExtension($mailData,$lupaction));    
        
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('sign')->log('Review extension Action LUP  '.$lupaction->code.'-'.$lupaction->action);    
        return back()->with('success','Submit Due Date Extension Success...');       
    }

    //Approved Due Date Extension
    public function approvedextension($id, LUPAction $lupaction, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupaction = LUPAction::find($decrypted);     
        $this->authorize('approvedextended',$lupaction);         
        $old = getoldvalues('mysql','lup_actions',$lupaction);  
        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',           
        ]);    
            $lupaction->actionstatus='OPEN';               
            $lupaction->duedate_action = $request->duedate_action;   
            $lupaction->extension_count = $lupaction->extension_count + 1;                   
            $lupaction->approver_extension = Auth::User()->username;
            $lupaction->dateapproved_extension = \Carbon\Carbon::now();
            $lupaction->save();                      
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','Approved extension Action LUP ','sign');    
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('sign')->log('approved extension Action LUP  '.$lupaction->code.'-'.$lupaction->action);
        return back()->with('success','Approved Due Date Extension Success...');        
       
    }

    //Reject Due Date Extension
    public function rejectextension($id, LUPAction $lupaction, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupaction = LUPAction::find($decrypted);
        $email_extender = $lupaction->pic_extensions->email;        
        $this->authorize('rejectextended',$lupaction);     
        $old = getoldvalues('mysql','lup_actions',$lupaction);  
        $validatedData = $request->validate([
            'cancel_extension_notes' => 'required|min:10',           
        ]);    
            $lupaction->actionstatus='OPEN';               
            $lupaction->extension_notes = null;             
            $lupaction->pic_extension = null;
            $lupaction->signdate_extension = null;
            $lupaction->duedate_action = $lupaction->old_duedate;  
            $lupaction->old_duedate = null; 
            $lupaction->reviewer_extension = null;
            $lupaction->datereview_extension = null; 
            $lupaction->approver_extension = null;
            $lupaction->dateapproved_extension = null;                             
            $lupaction->cancel_extension_notes =$request->cancel_extension_notes;       
            $lupaction->save();      
            
            //Send Notif to PIC Action & PIC Extension
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupaction->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupaction->lupparent->nolup,
            'action' => $lupaction->action,    
            'note'=>$request->cancel_extension_notes,        
            'urllup'=>$urllup,            
        ];                    
        $emailto = $lupaction->pic->email;  
        $emailcc = $email_extender;
        Mail::to(env('MAIL_TO_TESTING'))    
            ->cc(env('MAIL_TO_TESTING')) 
            ->send(new LUPExtensionHasReject($mailData,$lupaction));    
        //check audit change     
        startaudit($lupaction,$old['fields'],$old['old'],$old['table'],'LUP','Reject extension Action LUP ','rollback');   
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('rollback')->log('reject extension Action LUP  '.$lupaction->code.'-'.$lupaction->action);    
        return back()->with('success','Success...Due Date Extension Has Been Rejected...');        
    }

    //request Cancel Action
    public function requestcancelaction($id, LUPAction $lupaction,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupaction = LUPAction::find($decrypted);          
        $this->authorize('requestcancelaction',$lupaction);        
        $validatedData = $request->validate([
            'cancel_duedate_notes' => 'required|min:10',    
        ]);                  
            $lupaction->cancel_duedate_notes = $request->cancel_duedate_notes .' (by: '.Auth::user()->username .')';   
            $lupaction->actionstatus='ON CANCEL';         
            $lupaction->save();         
            
            //Send Notif to Reviewer
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupaction->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupaction->lupparent->nolup,
            'action' => $lupaction->action,             
            'note'=>$request->cancel_duedate_notes, 
            'pic'=> Auth::user()->username,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupaction->lupparent->reviewers->email;              

        Mail::to(env('MAIL_TO_TESTING'))     
            ->send(new LUPActionRequestCancel($mailData,$lupaction));  
            
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('rollback')->log('request cancel Action LUP  '.$lupaction->code.'-'.$lupaction->action);
        return back()->with('success','Success...Request Cancel Action Has Been Submitted ');       
    }

    //Approved Cancel Action
    public function approvedcancelaction($id, LUPAction $lupaction,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupaction = LUPAction::find($decrypted);          
        $this->authorize('approvedcancelaction',$lupaction);                 
            $lupaction->notes = 'Approved Cancellation by : '. Auth::user()->username;
            $lupaction->deleted_at =\Carbon\Carbon::now();
            $lupaction->actionstatus='CANCEL';
            $lupaction->save();            
        
        activity()->causedBy(Auth::user()->id)->performedOn($lupaction)->event('sign')->log('approved cancel Action LUP  '.$lupaction->code.'-'.$lupaction->action);
        return back()->with('success','Success...Action Has Been CANCEL ');       
    }

    //Send Notif to PIC Action
    public function sendnotif($id)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction   
        $lup = LUPParent::find($decrypted);        
        $lupactions = $lup->lupaction->where('signdate_action',null)->where('actionstatus',null);
        $this->authorize('sendnotif',$lup); 
        foreach ($lupactions as $lupaction){
            $email[] = $lupaction->pic->email;
        }       
            
            //Send Notif to PIC Action       
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [          
            'title'=>$lup->documentname, 
            'proposed'=>$lup->lup_proposed, 
            'nolup' => $lup->nolup,            
            'lupactions'=>$lupactions,       
            'urllup'=>$urllup,            
        ];                    
        $emailto = $email;          
        Mail::to(env('MAIL_TO_TESTING'))          
            ->send(new LUPActionNotif($mailData,$lupactions));    
        
        activity()->causedBy(Auth::user()->id)->performedOn($lup)->event('notif')->log('send notif to PIC Action LUP  '.$lup->code);
        return back()->with('success','Success...Notification has been sent...');        
    }
}
