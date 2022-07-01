<?php

namespace App\Http\Controllers\LUP;

use Illuminate\Http\Request;
use App\Models\LUP\LUPParent;
use App\Mail\LUP\LUPNotifToQC;
use App\Models\ICCS\ICCSApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;


class RelatedDepartmentController extends Controller
{
    public function autofillapprovals(Request $request)
    {
        $data = ICCSApproval::where('code',$request->code_relateddepartment)
            ->first();                        
        return response()->json($data);
    }

    public function autofillapprovals2(Request $request)
    {      
        $data = ICCSApproval::where('code',$request->code)
            ->first();
                    
        return response()->json($data);
    }

    public function storedepartment(Request $request){        
        $cek = RelatedDepartment::where('code',$request->modalhidecodelup)->where('department',$request->department)->exists();   
        $lup = LUPParent::where('code',$request->modalhidecodelup)->first();
        
        if($cek){
                return back()->with('error','Failed...Related Department Already Exists..');
        }else{
                $relateddepartment = new RelatedDepartment;
                $relateddepartment->code = $request->modalhidecodelup;
                $relateddepartment->approval_code = $request->code;
                $relateddepartment->username = $request->username;
                $relateddepartment->department = $request->department;                   
                $relateddepartment->save();
                $relateddepartment = RelatedDepartment::where('code',$request->modalhidecodelup)->where('username',$request->username)->first();     
                
                            //Send Notif to PIC        
                    $urllup = '<a href="'.env('APP_URL').'/lup/'.Crypt::encryptString($lup->id).'/edit"'.' style="
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
                        'name'=>$relateddepartment->user->name,
                    ];                             
                $emailto = $relateddepartment->user->email;
                
                Mail::to(env('MAIL_TO_TESTING'))        
                    ->send(new LUPNotifToQC($mailData,$lup));  
                return back()->with('Success','Success...LUP Has been submitted to related department');
        }

    }

    public function signdepartment(Request $request, $id,RelatedDepartment $relateddepartment)
    {
        $decrypted = Crypt::decryptString($id);
        $relateddepartment = Relateddepartment::find($decrypted);        
        $this->authorize('signrelateddepartment', $relateddepartment);    
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('related_departments'),['updated_at']);        
        
        //get old value 
        foreach($fields as $field){
            $old[$field]= $relateddepartment->$field;
        }        
        $relateddepartment->code = $request->modalhidecodelup;
        $relateddepartment->approval_code = $request->code;
        $relateddepartment->username = $request->username;
        $relateddepartment->department = $request->department;    
        $relateddepartment->note = $request->note; 
        $relateddepartment->signdate = now(); 
        $relateddepartment->save();       
        return back()->with('success','Sign '.$relateddepartment->department.' -> Success...');        
    }

    public function delete(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $relateddepartment = RelatedDepartment::find($decrypted);  
        $lup=$relateddepartment->lupparent;
        $this->authorize('update',$lup);
        auditlups($relateddepartment,Auth::user()->username,'Delete Related Department',$relateddepartment->code,
                'related_departments','',$relateddepartment->makeHidden(['id', 'deleted_at']),'');
        $relateddepartment->delete();
        return back();        
    }

    //cancel sign 
    public function cancelsign($id,RelatedDepartment $relateddepartment)
    {        
        $decrypted = Crypt::decryptString($id);
        //get data lup
        $relateddepartment = RelatedDepartment::find($decrypted); 
        $this->authorize('cancelsignrelateddepartment', $relateddepartment);    

        $old_datesign= $relateddepartment->department.' | '.$relateddepartment->signdate .' | ' . $relateddepartment->note;                                       
            
            $relateddepartment->signdate =null;      
            $relateddepartment->note =null;  
            auditlups($relateddepartment,Auth::user()->username,'Cancel Sign Related Department - '.$relateddepartment->department,$relateddepartment->code,
            'related_departments','',$old_datesign,null );                      
            $relateddepartment->save();        
            
            return back()->with('success','Cancel Sign '.$relateddepartment->department.' Success...'); 
    }
}
