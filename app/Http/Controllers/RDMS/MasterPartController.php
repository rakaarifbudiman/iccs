<?php

namespace App\Http\Controllers\RDMS;


use Illuminate\Http\Request;
use App\Models\RDMS\SAPPrefix;
use App\Models\RDMS\MasterPart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class MasterPartController extends Controller
{
    public function index() //show list of master parts
    {
        $masterparts = DB::table('rdms_be.master_parts')
        ->whereNotNull('sap_part')->get();
        return view('rdms.masterpart.list',[
            'masterparts'=>$masterparts,
        ]);
        
    }
    public function query($id) 
    {
       
        $masterparts = MasterPart::where('sap_desc','Like','%'.$id.'%')->get();  
        return view('rdms.masterpart.list',[
            'masterparts'=>$masterparts,
        ]);        
    }
    public function autofill_old_desc(Request $request)
    {
        if ($request->old_part){
            $data = MasterPart::where('sap_part',$request->old_part)
            ->first();
        }
        if ($request->sap_part){
            $data = MasterPart::where('sap_part',$request->sap_part)->where('sap_mat_type','ZFGD')
            ->first();
        }
        if ($request->sap_prefix){
            $data  = SAPPrefix::where('prefix',$request->sap_prefix)
                ->first();    
        }                    
        return response()->json($data);
    }

    public function create() //show create form
    {        
        $listpm =array('AHP','ALP','ALB','PVC','PVDC','CAP','Pot Acrylic',
                    'Tutup Takar','Spatula','Sendok Takar','BOX','CCV','Envelope','Leaflet',
                    'Stiker','Master Box','Etiket Master Box','Alu Paper','Shrink Seal',
                    'Kantong','Plakband','Seal Security','Partisi','Cellotape','Rondo Ampul',
                    'Packing Slip','Layer','Air Bubble','Hologram');
        return view('rdms.masterpart.newpart',[
            'listpm'=>$listpm
        ]);        
    }

    public function store(Request $request) //store new part
    {
        
        $fields = array_diff(Schema::Connection('mysql2')->getColumnListing('master_parts'),['updated_at','id']); 
                    
        if(DB::table('rdms_be.sapprefixs')->where('prefix', $request->sap_prefix)->exists()){
            //get code                 
            $lastid = MasterPart::where('sap_part','like',$request->sap_prefix.'%')->max('sap_part');            
            $lastno = intval(substr($lastid,-3));            
            if($lastno==0 or $lastno==NULL){
                $newid = 1;
            }else{
                $newid = abs($lastno+1);
            }        
            $code = $request->sap_prefix. sprintf("%03s", $newid);           
            //end get code   
        }else{
            return back()->with('error','No Prefix listed...');  
        }                    
            
        
        $prefix = DB::table('rdms_be.sapprefixs')->where('prefix',$request->sap_prefix)->first();
        $mat_type = $prefix->mat_type;
        $mat_group = $prefix->mat_group;

        //store new part
        $masterpart = new MasterPart;
        foreach($fields as $field){           
            $newvalue[] = $field.' : '.$request->$field;                  
            $masterpart->$field = $request->$field;           
        }
        $masterpart->rdms_status_part='OK'; 
        $masterpart->sap_status_part='N'; 
        $masterpart->sap_mat_type=$mat_type;
        $masterpart->sap_mat_group=$mat_group;       
        $masterpart->rdms_part = $code;
        $masterpart->sap_part = $code;
        $masterpart->save();
        
        

        //redirect to url edit
        $history = DB::table('rdms_be.audit_parts')
        ->where('recordid',$masterpart->sap_part)->get();
        $encrypted = Crypt::encryptString($masterpart->id);
        return redirect('/masterpart/'.$encrypted.'/edit')
        ->with('success','Part has been created with following no : '.$masterpart->sap_part);          
    }
        
        

    public function edit($id) //show edit form of part
    {
        $partid= Crypt::decryptString($id);
        $masterpart = DB::table('rdms_be.master_parts')
        ->where('id',$partid)->first();
        $history = DB::table('rdms_be.audit_parts')
        ->where('recordid',$masterpart->sap_part)->get();
        
        return view('rdms.masterpart.review',[
            'masterpart'=>$masterpart,
            'history'=>$history,
        ]);        
    }

    public function updatebasic(Request $request, $id) //update basic data
    {       
        $masterpart = MasterPart::Find($id);
        $fields = array_diff(Schema::Connection('mysql2')->getColumnListing('master_parts'),['updated_at']);        
        
        //get old value 
        foreach($fields as $field){
            $old[$field]= $masterpart->$field;
        }
        
        //update data
        $data = $request->except(['_token','_method','sap_part']);
        $masterpart->update($data);             
            
        //check audit change     
        if($masterpart->wasChanged()==TRUE){
            foreach($fields as $field){
                if($masterpart->wasChanged($field)){
                    auditparts($masterpart,Auth::user()->username,'Audit Change',$masterpart->sap_part,
                    'master_parts',$field,$old[$field],$masterpart->$field );
                }
            }
            
            return back()->with('success','Data edited successfully!');
        }else{
           

            return back()->with('info','Nothing Changed!');            
        }        
    }

    public function tesupdatehistory(Request $request) //update tesupdatehistory
    {
        if ($request->jenis=='checkbox'){
            $id = $request->id_audit;
            $updated = $request->updated;
            if ($updated =='false'){
                $updated = 0;
            }elseif ($updated =='true'){
                $updated = 1;
            }
            $data = DB::table('rdms_be.audit_parts')->where('id',$id)->first();     
            $save = DB::table('rdms_be.audit_parts')->where('id',$id)          
            ->update(['updated' => $updated]);
        }
        if ($request->jenis=='tes'){
            $id = $request->pk;
            $data = DB::table('rdms_be.audit_parts')->where('id',$id)->update([
                $request->name =>$request->value
            ]);    
            return response()->json($id);
        }
        // return response()->json($data);
    }


   

}
