<?php

namespace App\Http\Controllers\LUP;

use Mail;
use App\Models\User;
use App\Models\LUP\LUPFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FLP\FLPAction;
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
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_actions'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $lupaction->$field;
        }
        $lupaction->action = $request->action; 
        $lupaction->pic_action = str::lower($request->pic_action);
        $lupaction->duedate_action = $request->duedate_action . ' 00:00:00';                         
        $lupaction->save();   

        //check audit change     
        if($lupaction->wasChanged()==TRUE){
            foreach($fields as $field){
                if($lupaction->wasChanged($field)){
                    if($old[$field]!=$lupaction->$field ){
                        auditlups($lupaction,Auth::user()->username,'Audit Change',$lupaction->code,
                        'lup_actions',$field,$old[$field],$lupaction->$field );
                    }
                }
            }            
            return back()->with('success','Success... Data was Saved !');
        }else{  

            return back()->with('info','Nothing Changed!');            
        }     
             
    }

    public function destroy($id)
    {        
        $decrypted = Crypt::decryptString($id);
        $lupaction = LUPAction::find($decrypted);   
        $this->authorize('update',$lupaction);          
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
        return back()->with('success','Success...Action has been signed!');        

    }
    public function cancelsign($id)
    {        
        $decrypted = Crypt::decryptString($id);
        $lupaction = LUPAction::find($decrypted);   
        $this->authorize('cancelsign',$lupaction); 
        auditlups($lupaction,Auth::user()->username,'Cancel Sign Action',$lupaction->code,
                        'lup_actions','signdate_action',$lupaction->action . ' | '.$lupaction->signdate_action,'' );         
        $lupaction->signdate_action=null;
        $lupaction->sign_type=null;
        $lupaction->save();                   
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
        $lupactions = LUPAction::find(Crypt::decryptString($id));      
        $this->authorize('upload',$lupactions);            
        $paths = DB::table('iccsfilepaths')
        ->where('description','Bukti Close LUP')
        ->first()->filepath;        
        $code = 'EVD-'.$lupactions->noaction;        
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_actions'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $lupactions->$field;
        }

        $validatedData = $request->validate([
            'evidence_filename' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',    
        ]);    
           $name = $request->file('evidence_filename')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('evidence_filename')->storeAs($paths,$code.'.'.$ext);          
            $lupactions->evidence_filename = $path;            
            $lupactions->evidence_uploader = Auth::User()->username;
            $lupactions->dateupload_evidence = \Carbon\Carbon::now();
            $lupactions->save(); 

            foreach($fields as $field){
                if($lupactions->wasChanged($field)){
                    if($old[$field]!=$lupactions->$field ){
                        auditlups($lupactions,Auth::user()->username,'Upload Closing Evidence-'.$lupactions->action,$lupactions->code,
                        'lup_actions',$field,$old[$field],$lupactions->$field );
                    }
                }
            }          
        return back()->with('info', 'File Has been uploaded successfully');           
    }

    //Approved Closing Evidence
    public function approvedevidence($id, LUPAction $lupactions,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupactions = LUPAction::find($decrypted);          
        $this->authorize('approvedevidence',$lupactions);                     
        $cekreferaction = DB::table('lup_actions')->where('code',$lupactions->code)->where('action',$request->referaction)->exists();
        $referaction=DB::table('lup_actions')->where('code',$lupactions->code)->where('action',$request->referaction)->first();
        if($cekreferaction){           
            $lupactions->evidence_filename = $referaction->evidence_filename;
            $lupactions->notes = 'Approved Evidence with refer action to  '.$request->referaction;
        }
            $lupactions->dateapproved_evidence =\Carbon\Carbon::now();
            $lupactions->actionstatus='CLOSED';
            $lupactions->save();            
        return back()->with('success','Approved Closing Evidence Success...');       
    }

    //Approved Closing Evidence
    public function rejectevidence($id, LUPAction $lupactions, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction    
        $lupactions = LUPAction::find($decrypted);        
        $this->authorize('approvedevidence',$lupactions);            
            $email_uploader =$lupactions->evidence_uploaders->email;
            $lupactions->evidence_filename = null;           
            $lupactions->evidence_uploader = null;
            $lupactions->dateupload_evidence = null;
            $lupactions->save();

            //Send Notif to PIC Action & Uploader
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupactions->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupactions->lupparent->nolup,
            'action' => $lupactions->action,    
            'note'=>$request->note,        
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupactions->pic->email;  
        $emailcc= $email_uploader;       
        Mail::to($emailto)  
            ->cc($emailcc)   
            ->send(new LUPEvidenceHasReject($mailData,$lupactions));    
            
        return back()->with('success','Reject Closing Evidence Success...');             
       
    }

    //Store Due Date Extension
    public function storeextension($id, LUPAction $lupactions, Request $request)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupactions = LUPAction::find($decrypted);     
        $this->authorize('extended',$lupactions);        

        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',    
            'extension_notes'=>'min:10',
        ]);    
            $lupactions->actionstatus='ON EXTENSION';         
            if(!$lupactions->old_duedate ){
                $lupactions->old_duedate = $lupactions->duedate_action;
            }else{
                $lupactions->old_duedate2 = $lupactions->duedate_action;
            }               
            $lupactions->duedate_action = $request->duedate_action;  
            $lupactions->extension_notes = $request->extension_notes;          
            $lupactions->pic_extension = Auth::User()->username;
            $lupactions->signdate_extension = \Carbon\Carbon::now();
            $lupactions->save();  

            //Send Notif to Reviewer
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupactions->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupactions->lupparent->nolup,
            'action' => $lupactions->action, 
            'old_duedate'   =>$lupactions->old_duedate,
            'duedate'=>$lupactions->duedate_action,
            'note'=>$request->extension_notes, 
            'pic'=> $lupactions->pic_extension,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupactions->lupparent->reviewers->email;              

        Mail::to($emailto)     
            ->send(new LUPActionHasExtension($mailData,$lupactions));    
            
        return back()->with('success','Submit Due Date Extension Success...');             
       
    }

    //Review Due Date Extension
    public function reviewextension($id, LUPAction $lupactions, Request $request)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction           
        $lupactions = LUPAction::find($decrypted);       
        $this->authorize('reviewextended',$lupactions);      

        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',            
        ]);    
            $lupactions->actionstatus='ON EXTENSION APPROVAL';               
            $lupactions->duedate_action = $request->duedate_action;                     
            $lupactions->reviewer_extension = Auth::User()->username;
            $lupactions->datereview_extension = \Carbon\Carbon::now();
            $lupactions->save();  

            //Send Notif to Approver
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupactions->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupactions->lupparent->nolup,
            'action' => $lupactions->action, 
            'old_duedate'   =>$lupactions->old_duedate,
            'duedate'=>$lupactions->duedate_action,
            'note'=>$request->extension_notes, 
            'pic'=> $lupactions->pic_extension,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupactions->lupparent->approvers->email;              

        Mail::to($emailto)     
            ->send(new LUPActionHasExtension($mailData,$lupactions));    
            
        return back()->with('success','Submit Due Date Extension Success...');       
    }

    //Approved Due Date Extension
    public function approvedextension($id, LUPAction $lupactions, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupactions = LUPAction::find($decrypted);     
        $this->authorize('approvedextended',$lupactions);         
        
        $validatedData = $request->validate([
            'duedate_action' => 'required|after:tomorrow',           
        ]);    
            $lupactions->actionstatus='OPEN';               
            $lupactions->duedate_action = $request->duedate_action;   
            $lupactions->extension_count = $lupactions->extension_count + 1;                   
            $lupactions->approver_extension = Auth::User()->username;
            $lupactions->dateapproved_extension = \Carbon\Carbon::now();
            $lupactions->save();                      
        return back()->with('success','Approved Due Date Extension Success...');        
       
    }

    //Reject Due Date Extension
    public function rejectextension($id, LUPAction $lupactions, Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction        
        $lupactions = LUPAction::find($decrypted);
        $email_extender = $lupactions->pic_extensions->email;        
        $this->authorize('rejectextended',$lupactions);     
        
        $validatedData = $request->validate([
            'cancel_extension_notes' => 'required|min:10',           
        ]);    
            $lupactions->actionstatus='OPEN';               
            $lupactions->extension_notes = null;             
            $lupactions->pic_extension = null;
            $lupactions->signdate_extension = null;
            $lupactions->duedate_action = $lupactions->old_duedate;  
            $lupactions->old_duedate = null; 
            $lupactions->reviewer_extension = null;
            $lupactions->datereview_extension = null; 
            $lupactions->approver_extension = null;
            $lupactions->dateapproved_extension = null;                             
            $lupactions->cancel_extension_notes =$request->cancel_extension_notes;       
            $lupactions->save();      
            
            //Send Notif to PIC Action & PIC Extension
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupactions->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupactions->lupparent->nolup,
            'action' => $lupactions->action,    
            'note'=>$request->cancel_extension_notes,        
            'urllup'=>$urllup,            
        ];                    
        $emailto = $lupactions->pic->email;  
        $emailcc = $email_extender;
        Mail::to($emailto)    
            ->cc($emailcc) 
            ->send(new LUPExtensionHasReject($mailData,$lupactions));    
            
        return back()->with('success','Success...Due Date Extension Has Been Rejected...');        
    }

    //request Cancel Action
    public function requestcancelaction($id, LUPAction $lupactions,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupactions = LUPAction::find($decrypted);          
        $this->authorize('requestcancelaction',$lupactions);        
        $validatedData = $request->validate([
            'cancel_duedate_notes' => 'required|min:10',    
        ]);                  
            $lupactions->cancel_duedate_notes = $request->cancel_duedate_notes .' (by: '.Auth::user()->username .')';   
            $lupactions->actionstatus='ON CANCEL';         
            $lupactions->save();         
            
            //Send Notif to Reviewer
             
        $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lupactions->lupparent->id).'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';                  
        $mailData = [            
            'nolup' => $lupactions->lupparent->nolup,
            'action' => $lupactions->action,             
            'note'=>$request->cancel_duedate_notes, 
            'pic'=> Auth::user()->username,    
            'urllup'=>$urllup,            
        ];                    
          
        $emailto = $lupactions->lupparent->reviewers->email;              

        Mail::to($emailto)     
            ->send(new LUPActionRequestCancel($mailData,$lupactions));    
        return back()->with('success','Success...Request Cancel Action Has Been Submitted ');       
    }

    //Approved Cancel Action
    public function approvedcancelaction($id, LUPAction $lupactions,Request $request)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lupaction
        $lupactions = LUPAction::find($decrypted);          
        $this->authorize('approvedcancelaction',$lupactions);                 
            $lupactions->notes = 'Approved Cancellation by : '. Auth::user()->username;
            $lupactions->deleted_at =\Carbon\Carbon::now();
            $lupactions->actionstatus='CANCEL';
            $lupactions->save();            
        return back()->with('success','Success...Action Has Been CANCEL ');       
    }
}
