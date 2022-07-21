<?php

namespace App\Http\Controllers\FLP;

use PDF;
use Mail;
use App\Models\User;
use App\Models\FLP\FLPFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;
use Illuminate\Validation\Rule;
use App\Mail\FLP\FLPNotifToLeader;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\FLP\FLPNotifToApprover;
use App\Mail\FLP\FLPNotifToReviewer;
use Illuminate\Support\Facades\Auth;
use App\Mail\FLP\FLPNotifHasApproved;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
Use IlluminateDatabase\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FLP\StoreFLPRequest;
use Illuminate\Validation\Rules\DatabaseRule;


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
        $flpparents = DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*') 
                ->where('lup_parents.code','LIKE','F%')                    
                ->orderBy('lup_parents.id','desc')
                ->get();
        $statusaction=lupallstatusactions($flpparents);      
        
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
        $flpparents = LUPParent::all();
        return view('flp.newflp',['flpparents' => $flpparents]);           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFLPRequest $request)
    {
        $flpparent = LUPParent::where('code','LIKE','F%')->first();         
        if($flpparent==null){
            $newcodeflp='F'.date('y').'00001';
        }else{
            $newcodeflp = $flpparent->newcodeflp;
        }       
        $data1 = $request->validated();        
        $data2 = array('code'=>$newcodeflp,
                'inisiator'=>Auth::user()->username,
                'lupstatus'=>'CREATE',
                'year'=> date('y'),
                'notes' => $request->notes,
                'date_input' => now());    
       
        //save process
        $store = LUPParent::create(array_merge($data1,$data2));        
        return back(); 
        activity()->causedBy(Auth::user()->id)->performedOn($store)->event('created')->log('create FLP <a href="'.env('APP_URL').'/flp/'.$store->hashid.'/edit">'.$store->code.'</a>');   
        return redirect('/flp/'.$store->hashid.'/edit')->with('success','FLP has been created with following code : '.$store->code);    
        
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
        $flp = LUPParent::find($decrypted);
        $listusers = User::where([['active',1]])->get();
        $listactionclose = LUPAction::where('code',$flp->code)->where('actionstatus','CLOSED')->get();
        $listapprovers = $listusers->where('level',3);
        $listleaders = $listusers->where('department',$flp->inisiators->department)->where('grade_level','>',1);        
                    
            return view('flp.reviewflp',['flp'=>$flp,                                                         
            'listusers'=>$listusers,
            'listleaders'=>$listleaders,
            'listapprovers'=>$listapprovers,            
            ]);
            
    }    
        

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FLPParent  $fLPParent
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFLPRequest $request, $id)
    {
        $flp = FLPParent::find($id);
        //get old value
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_parents'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $flp->$field;
        }                
        $this->authorize('flpstatus_approved', $flp);        
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
                Mail::to($emailto)   //$emailleader         
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
            Mail::to($emailto)   //$emailreviewers->implode('email',',')         
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
            Mail::to($emailto)   //$emailapprover         
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
           Mail::to($emailto)   //$flp->emailinisiator.','.$flp->emailpicaction.$emailapprover        
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
