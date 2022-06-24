<?php

namespace App\Http\Controllers\FLP;

use PDF;
use Mail;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FLP\FLPAction;
use App\Models\FLP\FLPParent;
use App\Models\FLP\FLPFile;
use App\Mail\FLP\FLPNotifToLeader;
use App\Mail\FLP\FLPNotifToApprover;
use App\Mail\FLP\FLPNotifToReviewer;
use App\Mail\FLP\FLPNotifHasApproved;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\DatabaseRule;
use Illuminate\Validation\Rule;
Use IlluminateDatabase\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;


class FLPParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    

    public function index()
    {
        $date1 = strtotime(now());
        $flpparents = DB::table('flpparents')
            ->leftjoin('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*','flpparents.id as flp_id', 'flpparents.code as flp_code','flpactions.*')                     
            ->orderBy('flpparents.id','desc')
            ->get(); 
          
        $count=$flpparents->count();
        if(!$count){
            $statusaction="";
        }else{
            for ($i=0; $i < $count ; $i++) {
                // get status action                
                    $date2 = strtotime($flpparents[$i]->duedate_action,null);
                    $datediff =round(($date2-$date1)/(60*60*24),0);
                    
                    if($datediff<8 AND !$flpparents[$i]->dateapproved_evidence AND $flpparents[$i]->noflp){
                            $statusaction[] = "OVERDUE";
                    }else{
                        $statusaction []= $flpparents[$i]->actionstatus;
                    }                            
                  
            }
        }
        
        
	    return view('flp.masterlistflp', ['flpparents' => $flpparents,
        'statusaction'=>$statusaction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $flpparents = DB::table('flpparents')
            ->join('flpactions', 'flpparents.code', '=', 'flpactions.code')            
            ->select('flpparents.*', 'flpactions.*')
            ->get();
        
            return view('flp.newflp',['flpparents' => $flpparents]);
        
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'documentname' => ['required'],
            'ingredients' => ['required'],
            'dosageform' => ['required'],            
            'packaging' => ['required'],
            'regno' => ['required'],
            'het' => ['required'],
            'launch' => ['required','after:tomorrow']
            
        ]);
        
        //get code           
        $lastid = FLPParent::where('year',date('y'))->max('code');
        $lastno = intval(substr($lastid,-5));
        
        if($lastno==0 or $lastno==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = "F". date('y'). sprintf("%05s", $newid);        
        //save process
        $store = FLPParent::create([
            'year'=> date('y'),     
            'code' => $code,
            'documentname' => $request->documentname,        
            'ingredients' => $request->ingredients,
            'dosageform' => $request->dosageform,
            'bussinessunit' => $request->bussinessunit,
            'packaging' => $request->packaging,
            'inisiator' => Auth::user()->username,
            'regno' => $request->regno,
            'het' => $request->het,
            'launch' => $request->launch,
            'notes' => $request->notes,
            'flpstatus'=> "CREATE",
            "date_input" =>  \Carbon\Carbon::now(), 
        ]);
        $encrypted = Crypt::encryptString($store->id);
        
        return redirect('/flp/'.$encrypted.'/edit')->with('success','FLP has been created with following code : '.$code);           
        
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FLPParent  $fLPParent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       

        //get data
        $date1 = strtotime(\Carbon\Carbon::now());
        $decrypted = Crypt::decryptString($id);
        //get data flpparent
        $flp = DB::table('flpparents')->where('flpparents.id',$decrypted)
                ->leftjoin('users as A', 'A.username','=','flpparents.inisiator')
                ->leftjoin('users as B', 'B.username','=','flpparents.leader')
                ->leftjoin('users as C', 'C.username','=','flpparents.reviewer')
                ->leftjoin('users as D', 'D.username','=','flpparents.approver')
                ->select('flpparents.*','A.department as deptinisiator','A.email as emailinisiator',
                'B.department as deptleader','B.email as emailleader','C.department as deptreviewer',
                'C.email as emailreviewer','D.department as deptapprover','D.email as emailapprover')
                ->first();          
        
                //get data action
                $flpactions = DB::table('flpactions')
                ->leftjoin('users', 'users.username', '=', 'flpactions.pic_action')
                ->select('flpactions.*','users.department as pic_dept','flpactions.id as action_id','users.*')
                ->where('code',$flp->code)
                ->get();
        
                $flpfiles = flpfile::where('code',$flp->code)
                ->get();
               
        

                
        
        //get data user active for datalist
        $listusers = User::where([['active',1]])         
        ->get();
        $listapprovers = $listusers->where('level',3);
        $listleaders = $listusers->where('department',$flp->deptinisiator);
       
        //get audittrail data       
        $auditflps = DB::table('audits')
                    ->leftjoin('users', 'users.id', '=', 'audits.user_id')
                    ->select('audits.*','users.username')
                    ->where('tags',$flp->code)->orderBy('created_at','desc')->get();
        
        
        //check completeness 
        if (!$flp->datesign_inisiator  || !$flp->datesign_leader){
            $inisiatorcomplete="Incomplete";
        }else{
            $inisiatorcomplete="Complete";
        }        
        $count = $flpactions->count();         
        $countactionincomplete = $flpactions->where('signdate_action',null)->count();       
        
        
        if($count>0 && $countactionincomplete==0){
            $actioncomplete = "Complete";            
        }else{
            $actioncomplete = "Incomplete";
        }
        
        if($inisiatorcomplete=="Complete" && $actioncomplete == "Complete"){
            $btnsubmitreviewer = "";
        }else{
            $btnsubmitreviewer = "hidden";
        }


        
            
            for ($i=0; $i < $count ; $i++) {                                              
                // get status action      
                $date2 = strtotime($flpactions[$i]->duedate_action);
                $datediff =round(($date2-$date1)/(60*60*24),0);
            
                if($datediff<8 AND !$flpactions[$i]->dateapproved_evidence AND $flp->noflp){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction[] = $flpactions[$i]->actionstatus;
     
                }  
            }
                
            if(!$count){               
                    $statusaction="";
                   
            }
                    
            return view('flp.reviewflp',['flp'=>$flp,                    
            'flpactions'=>$flpactions,                    
            'actioncomplete'=>$actioncomplete,
            'inisiatorcomplete'=>$inisiatorcomplete,
            'btnsubmitreviewer'=>$btnsubmitreviewer,                                                       
            'listusers'=>$listusers,
            'listleaders'=>$listleaders,
            'listapprovers'=>$listapprovers,
            'i'=>$i,                   
            'statusaction'=>$statusaction,
            'flpfiles'=>$flpfiles,                   
            'auditflps'=>$auditflps,
            ]);
            
}
                        
                    
                 
                        
            
                  
                                    
                
        

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FLPParent  $fLPParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flp = FLPParent::find($id);
        //get old value
        $olddocumentname = $flp->documentname;
        $oldingredients = $flp->ingredients;
        $olddosageform = $flp->dosageform;
        $oldregno = $flp->regno;
        $oldpackaging = $flp->packaging;
        $oldhet = $flp->het;
        $oldbussinessunit = $flp->bussinessunit;
        $oldlaunch = $flp->launch;
        $oldnotes = $flp->notes;
        $this->authorize('flpstatus_approved', $flp);

        //validation
        $request->validate([
            'documentname' => ['required'],
            'ingredients' => ['required'],
            'dosageform' => ['required'],
            
            'packaging' => ['required'],
            'regno' => ['required'],
            'het' => ['required'],
            'launch' => ['required','after:tomorrow']
            
        ]);
        //get value to update
        $flp->documentname = $request->documentname;
        $flp->ingredients = $request->ingredients;
        $flp->dosageform = $request->dosageform;
        $flp->regno = $request->regno;
        $flp->packaging = $request->packaging;
        $flp->het = $request->het;
        $flp->bussinessunit = $request->bussinessunit;
        $flp->launch = $request->launch." 00:00:00";
        $flp->notes = $request->notes;
        $flp->save();
        $check = $flp->wasChanged(); 

        if($check==TRUE){
            
            return back()->with('success','Data edited successfully!');
        }else{
            return back()->with('info','Nothing Changed!');
            
        }
            
   
    }


    public function upload(Request $request,$id)
    {
        
        //get data flpparent
        $flp = flpparent::find($id);
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran FLP')
        ->first()->filepath;        
        $id= Crypt::encryptString($flp->id);

        //get code attachment
        $lastid = FLPFile::where('code',$flp->code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $flp->code.'-ATT-'. sprintf("%02s", $newid);        
        
        
        $validatedData = $request->validate([
            'attachment_file' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',
    
           ]);
    
           $name = $request->file('attachment_file')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('attachment_file')->storeAs($paths,$code.'.'.$ext);
    
           
            $save = FLPFile::create([
            'code' => $flp->code,    
            'nofile'=>$code,
            'org_file_name'=>$name,
            'document_name'=>$request->modaltxtadddocname, 
            'uploader'=>Auth::user()->username,
            'date_upload'=> \Carbon\Carbon::now(),  
            'file_path' => $path,
            
            
        ]); 
           
        return redirect('/flp/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }

    
    //download attachment FLP
    public function download($id)
    {
        
        $decrypted = Crypt::decryptString($id);        
        $file = FLPFile::find($decrypted);
        $paths = '/app/'.$file->file_path;  
        $url = storage_path($paths);       
        
     return Response()->download($url);
     
    }

    //change attachment FLP
    public function reupload(Request $request,$id)
    {
        //get data flpparent
        $flp = flpparent::where('code',$request->modalhidecodeflp)->first()->id;
        $code = $request->modalhidecodeflp;
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran FLP')
        ->first()->filepath;       
        $id= Crypt::encryptString($flp);
        
        //get code attachment
        $file_id = $request->modalhidefileid;
        $file = FLPFile::find($file_id);
        $oldname = $file->org_file_name;  
        
        //get code attachment
        $lastid = FLPFile::where('code',$code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $code.'-ATT-'. sprintf("%02s", $newid);          
              
        $validatedData = $request->validate([
            'attachment_file' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',
    
           ]);
    
           $name = $request->file('attachment_file')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('attachment_file')->storeAs($paths,$code.'.'.$ext);
           
           //get value to update        
        $file->document_name = $request->modaltxteditdocname;
        $file->org_file_name = $name;
        $file->uploader = Auth::user()->username;
        $file->date_upload = \Carbon\Carbon::now();
        $file->file_path = $path;        
        $file->save();
         
                                          
        return redirect('/flp/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }

    //delete attachment FLP
    public function destroy_attachment(FLPFile $file,$id)
    {
        $decrypted = Crypt::decryptString($id);
        $file = FLPFile::find($decrypted);
        $file->delete();        
        return back()->with('success','Attachment has been deleted!');
    }

    //sign inisiator
    public function signinisiator($id, FLPParent $flp)
    {
        $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($decrypted); 
        $this->authorize('signflpstatus_user', $flp);
        $this->authorize('signinisiator', $flp);
        
        $leader = User::where('username',$flp->inisiator)->first()->leader;  
        $nameleader = User::where('username',$leader)->first()->name;                  
        $emailleader = User::where('username',$leader)->first()->email;             

            $flp->datesign_inisiator =\Carbon\Carbon::now();    
            if (!$flp->datesign_leader || !$flp->leader){
                $flp->leader =$leader;
            }                    
            $flp->save();
            
            
             //Send Notif to Leader   
                $urlsign = '<a href="'.env('APP_URL').'/flp/'.$id.'/signleader"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Sign Here</a>';
                $urlflp = '<a href="'.env('APP_URL').'/flp/'.$id.'/edit/details"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to FLP</a>';    
                $flplaunch = date('d-M-Y',strtotime($flp->launch));            
                $mailData = [
                    'code' => $flp->code,
                    'productname' => $flp->documentname,
                    'ingredient' => $flp->ingredients,
                    'urlsign'=>$urlsign,
                    'urlflp'=>$urlflp,
                    'flplaunch'=>$flplaunch,
                    'nameleader'=>$nameleader,
                ];    
                $emailto = $emailleader;         
                Mail::to(env('MAIL_TO_TESTING'))   //$emailleader         
                ->send(new FLPNotifToLeader($mailData,$flp));                
                

            return redirect('/flp/'.$id.'/edit')->with('success','Sign Inisiator success...');

    }

    //cancel sign inisiator
    public function cancelsigninisiator($id, FLPParent $flp)
    {
        
        $decrypted = Crypt::decryptString($id);
        
        //get data flp
        $flp = FLPParent::find($decrypted); 
        $this->authorize('signflpstatus_user', $flp);
        $this->authorize('signinisiator', $flp);

        $old_datesign_inisiator= $flp->datesign_inisiator;           
                  
                                    
        
            $flp->datesign_inisiator =null;                        
            $flp->save();
            
            return redirect('/flp/'.$id.'/edit')->with('success','Cancel Sign Inisiator success...');

    }

    //sign leader
    public function signleader($id, FLPParent $flp)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($decrypted);
        $this->authorize('signflpstatus_user', $flp);
        $this->authorize('signleader_complete', $flp);
        $this->authorize('signleader', $flp);

        $old_datesign_leader= $flp->datesign_leader;            
               
        $flp->datesign_leader =\Carbon\Carbon::now();  
        if ($flp->flpstatus == "CREATE"){
            $flp->flpstatus = "ON PROCESS";
            
        }         
        $flp->save();

        
        return redirect('/flp/'.$id.'/edit')->with('success','Sign Leader success...');

    }
       
       

    //cancel sign leader
    public function cancelsignleader($id, FLPParent $flp)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($decrypted); 
        $this->authorize('signflpstatus_user', $flp);
        $this->authorize('cancelsignleader', $flp);

        $old_datesign_leader= $flp->datesign_leader;           
                   
                                    
        
            $flp->datesign_leader =null;                        
            $flp->save();
            
            return redirect('/flp/'.$id.'/edit')->with('success','Cancel Sign Leader success...');

    }

    //update leader
    public function updateleader(Request $request,$id)
    {
                
        //get data flp        
        $flp = FLPParent::where('flpparents.id',$id)
        ->leftjoin('users as A', 'A.username','=','flpparents.inisiator')
        ->leftjoin('users as B', 'B.username','=','flpparents.leader')
        ->leftjoin('users as C', 'C.username','=','flpparents.reviewer')
        ->leftjoin('users as D', 'D.username','=','flpparents.approver')
        ->select('flpparents.*','A.department as deptinisiator','A.email as emailinisiator',
        'B.department as deptleader','B.email as emailleader','C.department as deptreviewer',
        'C.email as emailreviewer','D.department as deptapprover','D.email as emailapprover')
        ->first();     

        $this->authorize('signflpstatus_user', $flp);
        $this->authorize('updateleader', $flp);     
                 
       
        $oldleader = $flp->leader;      
        
        $listusers = User::where([['active',1]])         
        ->get();
        $listapprovers = $listusers->where('level',3);
        $listleaders = $listusers->where('department',$flp->deptinisiator);
        $request->validate([
            'modaltxteditleader' => ['required','exists:users,username,active,1,department,'.$flp->deptinisiator],           
               
        ]);
        $newleader = str::lower($request->modaltxteditleader);
        $flp->leader= $newleader;                   
        $flp->save();
        
        $id = Crypt::encryptString($flp->id);
        return redirect('/flp/'.$id.'/edit');   
            
              

    }

    //submit to reviewer
    public function submittoreviewer($id, FLPParent $flp)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($decrypted);              
       
        $reviewers = DB::table('users')->where('level',2)->where('active',1)->get(); 
        
        //get data action
        $flpactions = DB::table('flpactions')
        ->where('code',$flp->code)
        ->get();        
        $this->authorize('flpstatus_onprocess', $flp);
        $this->authorize('flpcomplete', $flp);       
        
       
                          
                $flp->datesubmit_reviewer =\Carbon\Carbon::now();    
                $flp->flpstatus="ON REVIEW";                   
                $flp->save(); 

            $emailreviewers = DB::table('users')
            ->where('level',2)
            ->where('active',1)->get('email');   
                
            //Send Notif to Reviewer                 
            $urlflp = '<a href="'.env('APP_URL').'/flp/'.$id.'/edit/details"'.' style="
            background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
            inline-block;text-decoration: none;"'.'>Go to FLP</a>';    
            $flplaunch = date('d-M-Y',strtotime($flp->launch));            
            $mailData = [
                'code' => $flp->code,
                'productname' => $flp->documentname,
                'ingredient' => $flp->ingredients,                    
                'urlflp'=>$urlflp,
                'flplaunch'=>$flplaunch,                    
            ];             
            $emailto = $emailreviewers;
            Mail::to(env('MAIL_TO_TESTING'))   //$emailreviewers->implode('email',',')         
            ->send(new FLPNotifToReviewer($mailData,$flp));  
                
                
                
                return redirect('/flp/'.$id.'/edit')->with('success','Submit to Reviewer success...');
            

             
        
    }
    //sign reviewer -> submit to Approver
    public function signreviewer($id, FLPParent $flp)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($decrypted);  
        $this->authorize('flpstatus_onreview', $flp); 
        $this->authorize('signreviewer', $flp);            
       
        
        
        if(!$flp->approver){
           return redirect('/flp/'.$id.'/edit')->with('error','Please choose approver first...');           
        }
                                    
               
            $flp->datesubmit_approver =\Carbon\Carbon::now();    
            $flp->reviewer= Auth::user()->username;
            $flp->flpstatus= "ON APPROVAL";                   
            $flp->save();
            
            $emailapprover = DB::table('users')->where('username',$flp->approver)->first()->email;  
            $nameapprover = DB::table('users')->where('username',$flp->approver)->first()->name;           
                       
            
            //Send Notif to Approver                 
            $urlflp = '<a href="'.env('APP_URL').'/flp/'.$id.'/edit/details"'.' style="
            background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
            inline-block;text-decoration: none;"'.'>Go to FLP</a>';    
            $flplaunch = date('d-M-Y',strtotime($flp->launch));            
            $mailData = [
                'code' => $flp->code,
                'productname' => $flp->documentname,
                'ingredient' => $flp->ingredients,                    
                'urlflp'=>$urlflp,
                'flplaunch'=>$flplaunch,  
                'nameapprover'=>$nameapprover,                  
            ];        
            $emailto = $emailapprover;     
            Mail::to(env('MAIL_TO_TESTING'))   //$emailapprover         
            ->send(new FLPNotifToApprover($mailData,$flp));  

            return redirect('/flp/'.$id.'/edit')->with('success','Submit to Approver success...');
        
    }
    

    //update approver Approver
    public function updateapprover(Request $request,$id)
    {
        
        // $decrypted = Crypt::decryptString($id);
        //get data flp
        $flp = FLPParent::find($id);  
        $this->authorize('flpstatus_approved', $flp);
        $this->authorize('updateapprover', $flp);     
                 
       
        $oldapprover = $flp->approver;        
        
        $request->validate([
            'modaltxteditapprover' => ['required','exists:users,username,active,1','exists:users,username,level,3'],
               
        ]);
        $newapprover = str::lower($request->modaltxteditapprover);
        $flp->approver= $newapprover;                   
        $flp->save();
        
        $id = Crypt::encryptString($flp->id);
        return redirect('/flp/'.$id.'/edit');      
            
              

    }

    //Approved FLP
    public function approvedflp(Request $request,$id)
    {
        
        //get data flp       
        $flp = FLPParent::where('flpparents.id',$id)
                ->leftjoin('users as A', 'A.username','=','flpparents.inisiator')
                ->leftjoin('users as B', 'B.username','=','flpparents.leader')
                ->leftjoin('users as C', 'C.username','=','flpparents.reviewer')
                ->leftjoin('users as D', 'D.username','=','flpparents.approver')
                ->select('flpparents.*','A.department as deptinisiator','A.email as emailinisiator',
                'B.department as deptleader','B.email as emailleader','C.department as deptreviewer',
                'C.email as emailreviewer','D.department as deptapprover','D.email as emailapprover')
                ->first();
           
        $this->authorize('flpstatus_approved', $flp);
        $this->authorize('approvedflp', $flp);              
        
        //cek if new year
        if(!$flp->noflp){
                if (date('y')==$flp->year){

                }else{
                    $flp->year = date('y');                
                    $flp->save();
                }
        }

        //get new flp no      
        $lastid = FLPParent::where('noflp','like','FLP-%')
                ->where('year',date('y'))->max('noflp');
        $lastno = intval(substr($lastid,-4));
        
        if($lastno==0 or !$lastno){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $noflp = "FLP-". date('y')."-". sprintf("%04s", $newid);
        
        $request->validate([
            'modaltxteditnotes' => ['required'],          
            
        ]); 
        
       
           //if do not have No FLP        
        if(!$flp->noflp){
            $flp->dateapproved= \Carbon\Carbon::now();
            $flp->noflp = $noflp;
            $flp->approved=1;
            $flp->notes2= $request->modaltxteditnotes;  
            $flp->flpstatus = "OPEN";                 
            $flp->save();        
            
            //if already have No FLP 
        }else{            
            if($flp->revision==0 or !$flp->revision){
                $newrev = 1;
            }else{
                $newrev = abs($flp->revision+1);
            }        
          
            $flp->dateapproved= \Carbon\Carbon::now();
            $flp->approved=1;
            $flp->revision =$newrev;
            $flp->notes2= $request->modaltxteditnotes;   
            $flp->flpstatus = "OPEN";                
            $flp->save();    
            
        }

       
            //update all status action to OPEN
        $actionupdates = DB::table('flpactions')->where('code',$flp->code)
        ->where('actionstatus',null)->update([
            'actionstatus'=> "OPEN"
        ]);  
        
          
          
            
            //get all data action for attach to email
            $flpactions = DB::table('flpactions')
            ->leftjoin('users', 'users.username', '=', 'flpactions.pic_action')
            ->select('flpactions.*','users.department as pic_dept','users.name as pic_name','flpactions.id as action_id','users.*')
            ->where('code',$flp->code)
            ->orderBy('duedate_action', 'asc')
            ->get();

        

        $data = [
            'flp'=>$flp,
            'flpactions'=>$flpactions,            
        ];
        //save attachment flp
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran FLP')
        ->first()->filepath;
        $lastid = FLPFile::where('code',$flp->code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $flp->code.'-ATT-'. sprintf("%02s", $newid);      
        $path = $paths.'/'.$code.'.pdf';
       
           
            $save = FLPFile::create([
            'code' => $flp->code,    
            'nofile'=>$code,
            'org_file_name'=>$code.'.pdf',
            'document_name'=>$flp->noflp.' (Approved Rev-'.$flp->revision.')', 
            'uploader'=>Auth::user()->username,
            'date_upload'=> \Carbon\Carbon::now(),  
            'file_path' => $path,
            ]);       
        
    
            $pdf = PDF::loadView('pdf/flp/flppdf', $data);
            Storage::put($path, $pdf->output());        
          
            //Send Notif to All PIC Action                 
           $urlflp = '<a href="'.env('APP_URL').'/flp/'.$id.'/edit/details"'.' style="
           background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
           inline-block;text-decoration: none;"'.'>Go to FLP</a>';    
           $flplaunch = date('d-M-Y',strtotime($flp->launch));    
                   
           $mailData = [
               'code' => $flp->code,
               'noflp'=>$flp->noflp,
               'productname' => $flp->documentname,
               'ingredient' => $flp->ingredients,                    
               'urlflp'=>$urlflp,
               'flplaunch'=>$flplaunch,              
               'notes'=>$flp->notes2,
               'path'=>$path,        
                       
           ];        
           $emailto = $flp->emailinisiator.','.$flp->emailpicaction.$emailapprover ;     
           Mail::to(env('MAIL_TO_TESTING'))   //$flp->emailinisiator.','.$flp->emailpicaction.$emailapprover        
           ->send(new FLPNotifHasApproved($mailData,$flp));   
         
        $id = Crypt::encryptString($flp->id);     
             
           return redirect('/flp/'.$id.'/edit')->with('success','FLP approved success');

   }         

    //print FLP
    public function printflp($id)
    {
        
        $decrypted = Crypt::decryptString($id);         
        $flp = DB::table('flpparents')->where('flpparents.id',$decrypted)
                ->leftjoin('users as A', 'A.username','=','flpparents.inisiator')
                ->leftjoin('users as B', 'B.username','=','flpparents.leader')
                ->leftjoin('users as C', 'C.username','=','flpparents.reviewer')
                ->leftjoin('users as D', 'D.username','=','flpparents.approver')
                ->select('flpparents.*','A.department as deptinisiator','A.email as emailinisiator',
                'B.department as deptleader','B.email as emailleader','C.department as deptreviewer',
                'C.email as emailreviewer','D.department as deptapprover','D.email as emailapprover')
                ->first(); 

        $flpactions = DB::table('flpactions')
        ->leftjoin('users', 'users.username', '=', 'flpactions.pic_action')
        ->select('flpactions.*','users.department as pic_dept','users.name as pic_name','flpactions.id as action_id','users.*')
        ->where('code',$flp->code)
        ->orderBy('duedate_action', 'asc')
        ->get();        

        $data = [
            'flp'=>$flp,
            'flpactions'=>$flpactions,            
        ];
        
        $pdf = PDF::loadView('pdf/flp/flppdf', $data);     
       
        
        //return view('pdf/flp/flppdf',$data);
        if (!$flp->noflp){
            return $pdf->stream($flp->code.'.pdf');   
        }else{
            return $pdf->stream($flp->noflp.'Rev-'.$flp->revision.'.pdf');    
        }        
    }  
    
}
