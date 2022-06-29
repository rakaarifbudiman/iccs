<?php

namespace App\Http\Controllers\LUP;

use PDF;
use Mail;
use QRCode;
use App\Models\User;
use App\Models\LUP\LUPFile;
use App\Models\LUP\LUPType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;
use App\Mail\LUP\LUPHasCancel;
use App\Mail\LUP\LUPNotifToQC;
use App\Models\ICCS\ICCSApproval;
use App\Mail\LUP\LUPNotifToLeader;
use App\Mail\LUP\LUPRequestCancel;
use Illuminate\Support\Facades\DB;
use App\Models\ICCS\RelatedUtility;
use App\Http\Controllers\Controller;
use App\Models\ICCS\RelatedDocument;
use App\Models\ICCS\RelatedMaterial;
use Illuminate\Support\Facades\Auth;
use App\Mail\LUP\LUPNotifHasApproved;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use App\Mail\LUP\LUPNotifHasConfirmed;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LUP\SignLUPRequest;
use App\Http\Requests\LUP\StoreLUPParentRequest;
use App\Http\Controllers\LUP\LUPParentController;
use App\Http\Requests\LUP\UpdateLUPParentRequest;
use App\Http\Requests\LUP\UpdateCategorizationRequest;
use App\Http\Requests\LUP\UpdateLUPCategorizationRequest;


class LUPParentController extends Controller
{

    //show masterlist lup
    public function index()
    {            
            $lupparents = cache()->remember('masterlistlup',300,function(){
                 return DB::table('lup_parents')
                ->leftjoin('lup_actions', 'lup_parents.code', '=', 'lup_actions.code')            
                ->select('lup_parents.*','lup_parents.id as lup_id', 'lup_parents.code as lup_code','lup_actions.*')                     
                ->orderBy('lup_parents.id','desc')
                ->get();         
            });  
            
        $statusaction=lupallstatusactions( $lupparents);        
        
	    return view('lup.masterlistlup', ['lupparents' => $lupparents,
        'statusaction'=>$statusaction,  
        ]);
    }

    //show form new lup
    public function create()
    {
        $listtypes = DB::table('lup_types')->get('luptype');      
        return view('lup.newlup',['listtypes'=>$listtypes]);
    }

    // store new lup
    public function store(StoreLUPParentRequest $request)
    {           
        $lupparent = LUPParent::first();         
        if($lupparent==null){
            $newcode='L'.date('y').'00001';
        }else{
            $newcode = $lupparent->newcode;
        }
       
        $data1 = $request->except(['_token','_method']);         
        $data2 = array('code'=>$newcode,'inisiator'=>Auth::user()->username,'lupstatus'=>'CREATE',
        'year'=> date('y'),'date_input' => now());     
        $data3= array('lup_type'=>collect($request->input('lup_type'))->implode(';'));  
        //save process
        $store = LUPParent::create(array_merge($data1,$data2,$data3));
        $encrypted = Crypt::encryptString($store->id);        
        return redirect('/lup/'.$encrypted.'/edit')->with('success','LUP has been created with following code : '.$store->code);           
    }

    //show from LUP
    public function edit($id)
    {
        $decrypted = Crypt::decryptString($id);         
        $lupparent=LUPParent::find($decrypted);                          
        $luptypes = explode(';',$lupparent->lup_type);
        $listtypes = DB::table('lup_types')->get('luptype');       
        $listusers = User::where([['active',1]])->get();
        $listactionclose = LUPAction::where('code',$lupparent->code)->where('actionstatus','CLOSED')->get();
        $listapprovers = $listusers->where('level',3);
        $listleaders = $listusers->where('department',$lupparent->inisiators->department)->where('grade_level','>',1);        
        $listregulatory_reviewers = DB::table('approvals')->where('type','Reviewer Regulatory')->where('active',1)->get();
        $listregulatory_approvers = DB::table('approvals')->where('type','Approval Regulatory')->where('active',1)->get();
        $listdepartments = DB::table('approvals')->where([['active',1],['note','like','%Disposisi%']])->orwhere([['active',1],['note','like','%Disposisi%']])
        ->orderBy('type','asc')->orderBy('username','asc')->get();        
        return view('lup.reviewlup',[
            'id'=>$id,
            'lupparent'=>$lupparent,   
            'listactionclose'=>$listactionclose,  
            'listtypes'=>$listtypes,     
            'luptypes'=>$luptypes,                                  
            'listusers'=>$listusers,
            'listleaders'=>$listleaders,
            'listapprovers'=>$listapprovers,
            'listregulatory_reviewers'=>$listregulatory_reviewers,
            'listregulatory_approvers'=>$listregulatory_approvers,      
            'listdepartments'  =>  $listdepartments,  
        ]);
    }

    //update data LUP
    public function update($id, LUPParent $lupparent, UpdateLUPParentRequest $request)
    {
        $lupparent = LUPParent::Find($id);
        $this->authorize('update', $lupparent); 
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_parents'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $lupparent->$field;
        }                
           
        //update data        
        $data1 = $request->except(['_token','_method','code']);       
        if(!$request->duedate_finish){
            $data2 = array('duedate_start'=>$request->duedate_start." 00:00:00");        
        }else{
            $data2 = array('duedate_start'=>$request->duedate_start." 00:00:00",'duedate_finish'=>$request->duedate_finish." 00:00:00");        
        }
        $data3= array('lup_type'=>collect($request->input('lup_type'))->implode(';'));     
        //categorization
        if($request->boolean('patient_impact')==true){
            $categorization = array('categorization'=>'Critical');
        }elseif($request->boolean('facilities_impact')==true || $request->boolean('productcontact_impact')==true 
        || $request->boolean('maintenance_impact')==true || $request->boolean('compliance_impact')==true ||
        $request->boolean('regulatory_impact')==true || $request->boolean('integrity_impact')==true ||
        $request->boolean('validation_impact')==true || $request->boolean('stability_impact')==true){
            $categorization = array('categorization'=>'Major');
        }elseif($request->boolean('product_impact')==true || $request->boolean('equipment_impact')==true ||
        $request->boolean('decomission_impact')==true || $request->boolean('environment_impact')==true
        || $request->boolean('health_impact') || $request->boolean('computer_impact')==true ||
        $request->boolean('supply_impact')==true){
            $categorization = array('categorization'=>'Minor');
        }else{
            $categorization = array('categorization'=>'Minor');
        }            
        if($lupparent->adjustments==0){
            $lupparent->update(array_merge($data1,$data2,$data3,$categorization));       
        }else{
            $lupparent->update(array_merge($data1,$data2,$data3));       
        }         
                       
        //check audit change     
        if($lupparent->wasChanged()==TRUE){
            foreach($fields as $field){
                if($lupparent->wasChanged($field)){
                    if($old[$field]!=$lupparent->$field ){
                        auditlups($lupparent,Auth::user()->username,'Audit Change',$lupparent->code,
                        'lup_parents',$field,$old[$field],$lupparent->$field );
                    }
                }
            }            
            return back()->with('success','Data was Saved !');
        }else{
           

            return back()->with('info','Nothing Changed!');            
        }        
    }    

    //update data LUP
    public function updatecategorization($id, LUPParent $lupparent, UpdateCategorizationRequest $request)
    {
        $decrypted = Crypt::decryptString($id);
        $lupparent = LUPParent::Find($decrypted);
        //$this->authorize('update', $lupparent);           
        $oldcategorization = $lupparent->categorization; 
        $lupparent->adjustments=1;
        $lupparent->categorization = $request->categorization;               
        $lupparent->save();            
          
        //check audit change     
        if($lupparent->wasChanged()==TRUE){                  
                        auditlups($lupparent,Auth::user()->username,'Audit Change',$lupparent->code,
                        'lup_parents','categorization',$oldcategorization,$lupparent->categorization);                 
            return back()->with('success','Data was Saved !');
        }else{
            return back()->with('info','Nothing Changed!');            
        }        
    }    

    //sign inisiator
    public function signinisiator($id, LUPParent $lup)
    {
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('signinisiator', $lup);           

            $lup->datesign_inisiator =\Carbon\Carbon::now();    
            if (!$lup->datesign_leader || !$lup->leader){
                $lup->leader =$lup->inisiators->leader;
            }                    
            $lup->save();          
            
             //Send Notif to Leader 
                $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
                $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
                $mailData = [
                    'code' => $lup->code,
                    'documentname' => $lup->documentname,
                    'lup_current' => $lup->lup_current,
                    'lup_proposed' => $lup->lup_proposed,
                    'lup_reason' => $lup->lup_reason,   
                    'categorization' => $lup->categorization,                     
                    'risk_assestment' => $lup->risk_assestment,  
                    'urllup'=>$urllup,
                    'duedate'=>$duedate,
                    'name'=>$lup->leaders->name,
                ];        
            $emailto = $lup->leaders->email;         
            Mail::to(env('MAIL_TO_TESTING'))           
                ->send(new LUPNotifToLeader($mailData,$lup));      
                

            return back()->with('success','Sign Inisiator success...');

    }

    //cancel sign inisiator
    public function cancelsigninisiator($id, LUPParent $lup)
    {
        
        $decrypted = Crypt::decryptString($id);        
        //get data lup
        $lup = LUPParent::find($decrypted);
        $this->authorize('cancelsigninisiator', $lup);
        $old_datesign_inisiator= $lup->datesign_inisiator;                  
                                    
        auditlups($lup,Auth::user()->username,'Cancel Sign Inisiator',$lup->code,
                        'lup_parents','datesign_inisiator',$old_datesign_inisiator,null );

            $lup->datesign_inisiator =null;                        
            $lup->save();
            
            return back()->with('success','Cancel Sign Inisiator success...');

    }

    //sign leader
    public function signleader($id, SignLUPRequest $request, LUPParent $lup)
    {
        
        $decrypted = Crypt::decryptString($id);       
        
        //get data lup
        $lup = lupParent::find($decrypted );   
        $this->authorize('signleader', $lup);      
        $lup->note_leader =$request->note_leader;                           
        $lup->datesign_leader =\Carbon\Carbon::now();  
        if ($lup->lupstatus == "CREATE"){
            $lup->lupstatus = "ON PROCESS";            
        }         
        $lup->save();       
       
        //Send Notif to Reviewer
        $name='Reviewer';
        $emailreviewer = DB::table('approvals')
        ->leftjoin('users as A', 'A.username','=','approvals.username')
        ->select('approvals.*','A.email as emailreviewer')         
        ->where('type','Reviewer LUP')
        ->where('approvals.active',1)->get('emailreviewer');
        $emailto = $emailreviewer->implode('emailreviewers',',');
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$name,
        ];         
    
    
    Mail::to(env('MAIL_TO_TESTING'))        
        ->send(new LUPNotifToQC($mailData,$lup));     
        return back()->with('success','Sign Leader success...');

    }

    //edit leader
    public function updateleader($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);  
        //get data lup
        $lup = lupParent::find($decrypted ); 
        $this->authorize('updateleader', $lup);    
        if($lup->leader!=$request->leader){
            auditlups($lup,Auth::user()->username,'Edit Leader',$lup->code,
            'lup_parents','leader',$lup->leader,$request->leader);      
        }             
        $lup->leader =$request->leader;             
        $lup->save();        
        return back();
    }      

    //cancel sign leader
    public function cancelsignleader($id, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('cancelsignleader', $lup);

        $old_datesign_leader= $lup->datesign_leader .' | ' . $lup->note_leader;                                       
            
            $lup->datesign_leader =null;      
            $lup->note_leader =null;  
            auditlups($lup,Auth::user()->username,'Cancel Sign Leader',$lup->code,
            'lup_parents','datesign_leader',$old_datesign_leader,null );                      
            $lup->save();        
            
            return back()->with('success','Cancel Sign Leader success...');

    }

    //edit regulatory_reviewer
    public function updateregulatoryreviewer($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);      

        //get data lup
        $lup = lupParent::find($decrypted );  
        $this->authorize('updateregulatoryreviewer', $lup);     
        if($lup->regulatory_reviewer!=$request->regulatory_reviewer){
            auditlups($lup,Auth::user()->username,'Edit Regulatory Reviewer',$lup->code,
            'lup_parents','regulatory_reviewer',$lup->regulatory_reviewer,$request->regulatory_reviewer);      
        }             
        $lup->regulatory_reviewer =$request->regulatory_reviewer;   
        $lup->datesubmit_regulatory_reviewer  =\Carbon\Carbon::now();             
        $lup->save();        

        //Send Notif to Regulatory Reviewer        
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$lup->regulatory_reviewers->name,
        ];         
    
    $emailto = $lup->regulatory_reviewers->email;
    Mail::to(env('MAIL_TO_TESTING'))        
        ->send(new LUPNotifToQC($mailData,$lup));   

        return back()->with('success','Success...LUP has been submitted to Regulatory Reviewer');
    }

    //sign regulatory_reviewer
    public function signregulatoryreviewer($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = lupParent::find($decrypted );  
        $this->authorize('signregulatoryreviewer', $lup);       
        $lup->regulatory_approver = $request->regulatory_approver;
        $lup->note_regulatory_reviewer =$request->note_regulatory_reviewer;                           
        $lup->datesubmit_regulatory_approver =\Carbon\Carbon::now();         
        $lup->save();
        
        //Send Notif to Regulatory Approver       
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$lup->regulatory_approvers->name,
        ];         
    
    $emailto = $lup->regulatory_approvers->email;
    Mail::to(env('MAIL_TO_TESTING'))        
        ->send(new LUPNotifToQC($mailData,$lup)); 
        
        return back()->with('success','Sign Regulatory success...');
    }

    //cancel sign regulatoryreviewer
    public function cancelsignregulatoryreviewer($id, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('cancelsignregulatoryreviewer', $lup);   

        $old_datesign_regulatory_reviewer= $lup->datesubmit_regulatory_approver .' | ' . $lup->note_regulatory_reviewer;                                       
            
            $lup->datesubmit_regulatory_approver =null;      
            $lup->note_regulatory_reviewer =null;  
            auditlups($lup,Auth::user()->username,'Cancel Sign Regulatory Reviewer',$lup->code,
            'lup_parents','datesign_regulatory_reviewer',$old_datesign_regulatory_reviewer,null );                      
            $lup->save();        
            
            return back()->with('success','Cancel Sign Regulatory Reviewer success...');

    }

    //edit regulatory_approver
    public function updateregulatoryapprover($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);      

        //get data lup
        $lup = lupParent::find($decrypted );  
        $this->authorize('updateregulatoryapprover', $lup);   
        if($lup->regulatory_approver!=$request->regulatory_approver){
            auditlups($lup,Auth::user()->username,'Edit Regulatory Approver',$lup->code,
            'lup_parents','regulatory_approver',$lup->regulatory_approver,$request->regulatory_approver);      
        }             
        $lup->regulatory_approver =$request->regulatory_approver;             
        $lup->save();        
        return back();
    }

    //sign regulatory_approver
    public function signregulatoryapprover($id, SignLUPRequest $request, LUPParent $lup)
    {
        
        $decrypted = Crypt::decryptString($id);

        //get data lup
        $lup = lupParent::find($decrypted );     
        $this->authorize('signregulatoryapprover', $lup);       
        $lup->note_regulatory_approver =$request->note_regulatory_approver;                           
        $lup->datesign_regulatory_approver =\Carbon\Carbon::now();         
        $lup->save();
        // email to regulatory_approver
        
        return back()->with('success','Sign Regulatory success...');
    }

    //cancel sign regulatoryapprover
    public function cancelsignregulatoryapprover($id, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted);             
        $this->authorize('cancelsignregulatoryapprover', $lup);  

        $old_datesign_regulatory_approver= $lup->datesign_regulatory_approver .' | ' . $lup->note_regulatory_approver;                                       
            
            $lup->datesign_regulatory_approver =null;      
            $lup->note_regulatory_approver =null;  
            auditlups($lup,Auth::user()->username,'Cancel Sign Regulatory Approver',$lup->code,
            'lup_parents','datesign_regulatory_approver',$old_datesign_regulatory_approver,null );                      
            $lup->save();        
            
            return back()->with('success','Cancel Sign Regulatory Approver success...');
    }

    //update external party
    public function updateexternalparty($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = lupParent::find($decrypted);  
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_parents'),['updated_at']);  
                //get old value 
                foreach($fields as $field){
                    $old[$field]= $lup->$field;
                } 
       
        $lup->external_party_name =$request->external_party_name; 
        $lup->note_external_party =$request->note_external_party;   
        $lup->save();

        //check audit change     
        if($lup->wasChanged()==TRUE){
            foreach($fields as $field){                
                    if($old[$field]!=$lup->$field ){
                        auditlups($lup,Auth::user()->username,'Change External Party',$lup->code,
                        'lup_parents',$field,$old[$field],$lup->$field );
                    }                
            }            
            return back()->with('success','Data was Saved !');
        }else{
           

            return back()->with('info','Nothing Changed!');            
        }                
    }    

    //sign Reviewer by QSE
    public function signreviewerqse($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('signreviewerqse', $lup); 
        $lup->reviewer =Auth::user()->username; 
        $lup->reviewer2 =$request->reviewer2; 
        $lup->note_reviewer =$request->note_reviewer; 
        $lup->lupstatus ='ON REVIEW'; 
        $lup->datesubmit_reviewer2 =now();   
        $lup->save();

        //Send Notif to Approver        
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$lup->reviewerqcjms->name,
        ];         
    
    $emailto = $lup->reviewerqcjms->email;
    Mail::to(env('MAIL_TO_TESTING'))        
        ->send(new LUPNotifToQC($mailData,$lup));             
    
        return back()->with('Success','LUP has been submitted to next process...');         
       
    }    

    //sign Reviewer by QCJM
    public function signreviewerqcjm($id, SignLUPRequest $request, LUPParent $lup)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('signreviewerqcjm', $lup);        
        $lup->approver =$request->approver; 
        $lup->confirmer =$request->approver; 
        $lup->note_reviewer2 =$request->note_reviewer2; 
        $lup->lupstatus ='ON APPROVAL'; 
        $lup->datesubmit_approver =now();   
        $lup->save();

        //email to reviewer 2
        return back()->with('Success','LUP has been submitted to next process...');         
       
    }    

    //Approved LUP
    public function approvedlup(Request $request,$id, LUPParent $lup)
    {        
        //get data lup   
        $decrypted = Crypt::decryptString($id);       
        $lup=LUPParent::find($decrypted);          
        $this->authorize('signapprover', $lup);              
        
        //cek if new year
        if(!$lup->nolup){
                if (date('y')==$lup->year){

                }else{
                    $lup->year = date('y');                
                    $lup->save();
                }
        }    
       
           //if do not have No LUP        
        if(!$lup->nolup){
            $lup->dateapproved= \Carbon\Carbon::now();
            $lup->nolup = $lup->newnolup;
            $lup->approved=1;
            $lup->note_approver= $request->note_approver;  
            $lup->lupstatus = "APPROVED";                 
            $lup->save();        
            
            //if already have No LUP 
        }else{            
            if($lup->revision==0 or !$lup->revision){
                $newrev = 1;
            }else{
                $newrev = abs($lup->revision+1);
            }        
          
            $lup->dateapproved= \Carbon\Carbon::now();
            $lup->approved=1;
            $lup->revision =$newrev;
            $lup->note_approver= $request->note_approver;   
            $lup->lupstatus = "APPROVED";                
            $lup->save();            
        }     
        
        //save attachment lup        
        $printby=Auth::user()->username;
        $printdate=now();
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran LUP')
        ->first()->filepath;
        $qrcodetext=stripslashes('Code: '.$lup->code."\n".
                                'No LUP : '.$lup->nolup."\n".
                                'Status : '.$lup->lupstatus."\n".
                                'Date Approved : '.date("d-M-y", strtotime($lup->dateapproved))."\n".
                                'Approved By: '.$lup->approver."\n".
                                'Print By: '.$printby."\n"                                
                                );                          
        \QrCode::size(500)
            ->format('png')
            ->generate($qrcodetext,public_path('qrcode/'.$lup->code.'.png'));            
        $qrcodepath =  public_path('qrcode/'.$lup->code.'.png');        
       $data = [
           'lup'=>$lup,           
           'printby'=>$printby,
           'printdate'=>$printdate,
           'qrcodepath'=>$qrcodepath,
           
       ];
       
       $lastid = LUPFile::where('code',$lup->code)->max('nofile');
       $lastno = intval(substr($lastid,-2));
       
       if($lastid==0 or $lastid==NULL){
           $newid = 1;
       }else{
           $newid = abs($lastno+1);
       }        
       $code = $lup->code.'-ATT-'. sprintf("%02s", $newid);      
       $path = $paths.'/'.$code.'.pdf';       
       if($lup->nolup){
        $documentname= $lup->nolup.' ('.$lup->lupstatus.' Rev-'.$lup->revision.')';
       }else{
        $documentname= $lup->code.' ('.$lup->lupstatus.' Rev-'.$lup->revision.')';
       }   
           $save = LUPFile::create([
           'code' => $lup->code,    
           'nofile'=>$code,
           'org_file_name'=>$code.'.pdf',
           'document_name'=>$documentname, 
           'uploader'=>Auth::user()->username,
           'date_upload'=> \Carbon\Carbon::now(),  
           'file_path' => $path,
           ]);       
           $pdf = PDF::loadView('pdf/lup/luppdf', $data);     
           Storage::put($path, $pdf->output());             
          
            //Send Notif to Inisiator,Leader, Reviewer, Approver
        $name=User::where('username',$lup->reviewer2)->first()->name;        
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$name,
            'path'=>$path,
        ];                 
        $emailto = $lup->emailinisiator.','.$lup->emailleader.','.$lup->emailreviewer.','.$lup->emailapprover;              

        Mail::to(env('MAIL_TO_TESTING'))     
            ->send(new LUPNotifHasApproved($mailData,$lup));             
           return back()->with('success','LUP approved success');
   }

   //Confirmed LUP
   public function confirmedlup(Request $request,$id, LUPParent $lup)
   {       
        //get data lup   
        $decrypted = Crypt::decryptString($id);       
        $lup=LUPParent::find($decrypted);   
        $lup->dateconfirmed= \Carbon\Carbon::now();
        $lup->confirmed= 1;  
        $lup->note_confirmer= $request->note_confirmer; 
        $lup->lupstatus = "OPEN";                 
        $lup->save();  

        //update all status action to OPEN
        $actionupdates = DB::table('lup_actions')->where('code',$lup->code)
        ->where('actionstatus',null)->update([
            'actionstatus'=> "OPEN"]);   

        //save attachment lup       
        $printby=Auth::user()->username;
        $printdate=now();
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran LUP')
        ->first()->filepath;
        $qrcodetext=stripslashes('Code: '.$lup->code."\n".
                                'No LUP : '.$lup->nolup."\n".
                                'Status : '.$lup->lupstatus."\n".
                                'Date Approved : '.date("d-M-y", strtotime($lup->dateapproved))."\n".
                                'Approved By: '.$lup->approver."\n".
                                'Print By: '.$printby."\n"                                
                                );                          
        \QrCode::size(500)
            ->format('png')
            ->generate($qrcodetext,public_path('qrcode/'.$lup->code.'.png'));            
        $qrcodepath =  public_path('qrcode/'.$lup->code.'.png');        
       $data = [
           'lup'=>$lup,           
           'printby'=>$printby,
           'printdate'=>$printdate,
           'qrcodepath'=>$qrcodepath,
           
       ];
       
       $lastid = LUPFile::where('code',$lup->code)->max('nofile');
       $lastno = intval(substr($lastid,-2));
       
       if($lastid==0 or $lastid==NULL){
           $newid = 1;
       }else{
           $newid = abs($lastno+1);
       }        
       $code = $lup->code.'-ATT-'. sprintf("%02s", $newid);      
       $path = $paths.'/'.$code.'.pdf';       
       if($lup->nolup){
        $documentname= $lup->nolup.' ('.$lup->lupstatus.' Rev-'.$lup->revision.')';
       }else{
        $documentname= $lup->code.' ('.$lup->lupstatus.' Rev-'.$lup->revision.')';
       }   
           $save = LUPFile::create([
           'code' => $lup->code,    
           'nofile'=>$code,
           'org_file_name'=>$code.'.pdf',
           'document_name'=>$documentname, 
           'uploader'=>Auth::user()->username,
           'date_upload'=> \Carbon\Carbon::now(),  
           'file_path' => $path,
           ]);       
           $pdf = PDF::loadView('pdf/lup/luppdf', $data);     
           Storage::put($path, $pdf->output());         
                  
          
            //Send Notif to Inisiator,Leader, Reviewer, Approver
        $name=User::where('username',$lup->reviewer2)->first()->name;        
        $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
        background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
        inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
        $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
        $mailData = [
            'code' => $lup->code,
            'documentname' => $lup->documentname,
            'lup_current' => $lup->lup_current,
            'lup_proposed' => $lup->lup_proposed,
            'lup_reason' => $lup->lup_reason,   
            'categorization' => $lup->categorization,                     
            'risk_assestment' => $lup->risk_assestment,  
            'urllup'=>$urllup,
            'duedate'=>$duedate,
            'name'=>$name,
            'path'=>$path,
        ];         
        
        $lupactions = $lupactions = DB::table('lup_actions')
        ->leftjoin('users', 'users.username', '=', 'lup_actions.pic_action')
        ->select('lup_actions.*','users.department as pic_dept','users.email as pic_email','lup_actions.id as action_id','users.*')
        ->where('code',$lup->code)
        ->get(); 
        $emailaction = $lupactions->implode('pic_email',',');        
        $emailto = $lup->emailinisiator.','.$lup->emailleader.','.$lup->emailreviewer.','.$lup->emailapprover.','.str_replace(' ', '', $lup->action_notifier).','.$emailaction;              

        Mail::to(env('MAIL_TO_TESTING'))     
            ->send(new LUPNotifHasConfirmed($mailData,$lup));    
        return back()->with('success','Success...LUP has been confirmed');
   }

   //print FLP
   public function printlup($id)
   {
       
        $decrypted = Crypt::decryptString($id);         
        $lup = LUPParent::find($decrypted);           
        $printby=Auth::user()->username;
        $printdate=now();
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran LUP')
        ->first()->filepath;
        $qrcodetext=stripslashes('Code: '.$lup->code."\n".
                                'No LUP : '.$lup->nolup."\n".
                                'Status : '.$lup->lupstatus."\n".
                                'Date Approved : '.date("d-M-y", strtotime($lup->dateapproved))."\n".
                                'Approved By: '.$lup->approver."\n".
                                'Print By: '.$printby."\n"                                
                                );                          
        \QrCode::size(500)
            ->format('png')
            ->generate($qrcodetext,public_path('qrcode/'.$lup->code.'.png'));            
        $qrcodepath =  public_path('qrcode/'.$lup->code.'.png');        
       $data = [
           'lup'=>$lup,          
           'printby'=>$printby,
           'printdate'=>$printdate,
           'qrcodepath'=>$qrcodepath,
           
       ];      
       $pdf = PDF::loadView('pdf/lup/luppdf', $data);          
        // return view('pdf/lup/luppdf',$data);
        if (!$lup->nolup){
            return $pdf->stream($lup->code.'.pdf');   
        }else{
            return $pdf->stream($lup->nolup.'Rev-'.$lup->revision.'.pdf');    
        }        
    }

    public function updatenotif($id, LUPParent $lupparent, Request $request)
    {
        $decrypted = Crypt::decryptString($id);      
        $lupparent = LUPParent::Find($decrypted);        
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_parents'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $lupparent->$field;
        }
        
        //update data        
        $data1 = $request->except(['_token','_method','code']);      
        if($lupparent->action_notifier){
            $newdata = $lupparent->action_notifier.', '.$request->action_notifier;
            $data3 = array('action_notifier'=>$newdata); 
        }else{
            $data3 = array('action_notifier'=>$request->action_notifier);
        }        
        
        $lupparent->update(array_merge($data1,$data3));        
       
        //check audit change     
        if($lupparent->wasChanged()==TRUE){
            foreach($fields as $field){
                if($lupparent->wasChanged($field)){
                    if($old[$field]!=$lupparent->$field ){
                        auditlups($lupparent,Auth::user()->username,'Audit Change',$lupparent->code,
                        'lup_parents',$field,$old[$field],$lupparent->$field );
                    }
                }
            }            
            return back()->with('success','Data was Saved !');
        }else{
           

            return back()->with('info','Nothing Changed!');            
        }        
    }    
    public function deletenotif($id, LUPParent $lupparent, Request $request)
    {
        $decrypted = Crypt::decryptString($id);      
        $lupparent = LUPParent::Find($decrypted);        
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('lup_parents'),['updated_at']);        
           
        //get old value 
        foreach($fields as $field){
            $old[$field]= $lupparent->$field;
        }
        
        //update data        
        $data1 = $request->except(['_token','_method','code']);      
        if($lupparent->action_notifier){            
            $olddata=explode(',',str_replace(' ', '', $lupparent->action_notifier)) ;           
            $remove=array($request->action_notifier);
            $newdata =implode(', ',array_diff($olddata,$remove)); 
            
            $data3 = array('action_notifier'=>$newdata); 
        }else{
            $data3 = array('action_notifier'=>$request->action_notifier);
        }        
        
        $lupparent->update(array_merge($data1,$data3));        
       
        //check audit change     
        if($lupparent->wasChanged()==TRUE){
            foreach($fields as $field){
                if($lupparent->wasChanged($field)){
                    if($old[$field]!=$lupparent->$field ){
                        auditlups($lupparent,Auth::user()->username,'Audit Change',$lupparent->code,
                        'lup_parents',$field,$old[$field],$lupparent->$field );
                    }
                }
            }            
            return back()->with('success','Data was Saved !');
        }else{
           

            return back()->with('info','Nothing Changed!');            
        }        
    }    

    //download Regulatory Cheat Sheet
    public function downloadregcheatsheet()
    {                
        $paths = DB::table('iccsfilepaths')
        ->where('description','Regulatory Cheat Sheet')
        ->first()->filepath;          
        $url = public_path().'/'.$paths;           
     return Response()->download($url);
     
    }

    //download Panduan
    public function downloadpanduan()
    {                
        $paths = DB::table('iccsfilepaths')
        ->where('description','Tutorial ICCS')
        ->first()->filepath;          
        $url = public_path().'/'.$paths;           
     return Response()->download($url);     
    }

    //Request Cancel LUP
    public function requestcancellup(Request $request,$id)
    {      
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('requestcancel', $lup);   
        $lup->cancel_notes = $request->cancel_notes;
        $lup->cancel_requester = Auth::user()->username;
        $lup->datecancel_request = now();         
        $lup->lupstatus = 'ON CANCEL';                 
        $lup->save();          
            
             //Send Notif to Reviewer
                $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
                $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
                $mailData = [
                    'code' => $lup->code,
                    'documentname' => $lup->documentname,
                    'lup_current' => $lup->lup_current,
                    'lup_proposed' => $lup->lup_proposed,
                    'lup_reason' => $lup->lup_reason,   
                    'categorization' => $lup->categorization,                     
                    'risk_assestment' => $lup->risk_assestment,  
                    'urllup'=>$urllup,
                    'duedate'=>$duedate,
                    'name'=>Auth::user()->username,
                    'note'=>$request->cancel_notes,
                ];        
            
            if(!$lup->reviewer){
                $emailreviewer = DB::table('approvals')
                ->leftjoin('users as A', 'A.username','=','approvals.username')
                ->select('approvals.*','A.email as emailreviewer')         
                ->where('type','Reviewer LUP')
                ->where('approvals.active',1)->get('emailreviewer');
            $emailto = $emailreviewer->implode('emailreviewers',',');
            }else{
                $emailto = $lup->reviewers->email; 
            }        
            
            Mail::to(env('MAIL_TO_TESTING'))           
                ->send(new LUPRequestCancel($mailData,$lup));               

            return back()->with('success','Success...Request Cancellation has been submitted');           
        
    }

    //Review Cancel LUP
    public function reviewcancellup(Request $request,$id)
    {      
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('reviewcancel', $lup);        
        $lup->cancel_reviewer = Auth::user()->username;
        $lup->cancel_approver = $request->approver;
        $lup->datecancel_reviewed = now();         
        $lup->lupstatus = 'ON CANCEL APPROVAL';                
        $lup->save();          
            
             //Send Notif to Approver
                $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
                $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
                $mailData = [
                    'code' => $lup->code,
                    'documentname' => $lup->documentname,
                    'lup_current' => $lup->lup_current,
                    'lup_proposed' => $lup->lup_proposed,
                    'lup_reason' => $lup->lup_reason,   
                    'categorization' => $lup->categorization,                     
                    'risk_assestment' => $lup->risk_assestment,  
                    'urllup'=>$urllup,
                    'duedate'=>$duedate,
                    'name'=>Auth::user()->username,
                    'note'=>$lup->cancel_notes,
                ];        
            $emailto = $lup->cancel_approvers->email;         
            Mail::to(env('MAIL_TO_TESTING'))           
                ->send(new LUPRequestCancel($mailData,$lup)); 
            return back()->with('success','Success...Cancellation has been submitted');       
        
    }

    //Approved Cancel LUP
    public function approvedcancellup(Request $request,$id)
    {      
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        $this->authorize('approvedcancel', $lup);          
        $lup->cancel_approver = Auth::user()->username;
        $lup->datecancel_approved = now();         
        $lup->lupstatus = 'CANCEL';      
        $lup->approvercancel_notes = $request->approvercancel_notes;          
        $lup->save();  

        //update all status action to CANCEL
        $actionupdates = DB::table('lup_actions')->where('code',$lup->code)
        ->update(['actionstatus'=> "CANCEL"]);       
             //Send Notif to Inisiator
                $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
                $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
                $mailData = [
                    'code' => $lup->code,
                    'documentname' => $lup->documentname,
                    'lup_current' => $lup->lup_current,
                    'lup_proposed' => $lup->lup_proposed,
                    'lup_reason' => $lup->lup_reason,   
                    'categorization' => $lup->categorization,                     
                    'risk_assestment' => $lup->risk_assestment,  
                    'urllup'=>$urllup,
                    'duedate'=>$duedate,
                    'review'=>$lup->cancel_reviewer,
                    'approver'=>$lup->cancel_approver,
                    'note'=>$request->approvercancel_notes,
                ];        
            $emailto = $lup->inisiators->email;         
            Mail::to(env('MAIL_TO_TESTING'))           
                ->send(new LUPHasCancel($mailData,$lup)); 
            return back()->with('success','Success...LUP has been Cancel');        
    }
    //Request Closing LUP
    public function requestclosinglup(Request $request,$id)
    {      
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $lup = LUPParent::find($decrypted); 
        //$this->authorize('signinisiator', $lup);          
        $lup->reviewer_closing = Auth::user()->username;
        $lup->approver_closing = $request->approver; 
        $lup->verified_a = $request->verified_a;    
        $lup->verified_b = $request->verified_b;  
        $lup->verified_c = $request->verified_c;   
        $lup->closing_notes = $request->closing_notes;    
        $lup->dateclosing_reviewer = now();         
        $lup->lupstatus = 'ON CLOSING';                
        $lup->save();          
            
             //Send Notif to Approver
                $urllup = '<a href="'.env('APP_URL').'/lup/'.$id.'/edit"'.' style="
                background-color: #04AA6D;border: none;color: white;padding: 20px;display: 
                inline-block;text-decoration: none;"'.'>Go to LUP</a>';    
                $duedate = date('d-M-Y',strtotime($lup->duedate_start));            
                $mailData = [
                    'code' => $lup->code,
                    'documentname' => $lup->documentname,
                    'lup_current' => $lup->lup_current,
                    'lup_proposed' => $lup->lup_proposed,
                    'lup_reason' => $lup->lup_reason,   
                    'categorization' => $lup->categorization,                     
                    'risk_assestment' => $lup->risk_assestment,  
                    'urllup'=>$urllup,
                    'duedate'=>$duedate,
                    'name'=>Auth::user()->username,
                    'note'=>$request->closing_notes,
                ];        
            $emailto = $lup->closing_approvers->email;         
            Mail::to(env('MAIL_TO_TESTING'))           
                ->send(new LUPRequestCancel($mailData,$lup)); 
            return back()->with('success','Success...Cancellation has been submitted');       
        
    }
}
