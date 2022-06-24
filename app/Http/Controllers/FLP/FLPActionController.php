<?php

namespace App\Http\Controllers\FLP;

use Mail;
use App\Models\User;
use App\Models\FLP\FLPAction;
use App\Models\FLP\FLPParent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class FLPActionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flp = $request->modalhideidflp;               
        
        $validator=$request->validate([
            'modaltxtaddduedateaction' => ['required','after:tomorrow'],
            'modaltxtaddpicaction' => ['required','exists:users,username,active,1'],
            'modaltxtaddaction' => ['required'],           
              
        ]);
        //save process
        $store = FLPAction::create([    
            'code' => $request->modalhidecodeflp,
            'action' => $request->modaltxtaddaction,        
            'pic_action' => str::lower($request->modaltxtaddpicaction),
            'duedate_action' => $request->modaltxtaddduedateaction,           
                 
        ]);
        
        $id= Crypt::encryptString($flp);      
        return redirect('/flp/'.$id.'/edit');
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FLPAction  $fLPAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = FLPAction::find($id);
        //get old value
        $oldpicaction = $data->pic_action;
        $oldduedate = $data->duedate_action;
        $oldaction = $data->action;
        $code = $request->modalhidecode;
        $flp = FLPParent::where('code',$code)->first()->id;
       

        //validation
        $request->validate([
            'modaltxteditduedateaction' => ['required','after:tomorrow'],
            'modaltxteditpicaction' => ['required','exists:users,username,active,1'],
            'modaltxteditaction' => ['required'],           
              
        ]);
        if ($request->modalhidesigndate!=""){
            if (Auth::User()->username==$request->modalhidepicaction){
                return back()->with('error','Action already signed, please cancel sign to edit data');
                exit();
            }else{
                return back()->with('error','You do not have authorization to edit this action');
                exit();
            }
        }

                
        if ($request->modaltxteditduedateaction=='1970-01-01'){
            $saveduedate = null;
        }else{
            $saveduedate=$request->modaltxteditduedateaction." 00:00:00";
        }

        //get value for update
        $data->action = $request->modaltxteditaction;
        $data->pic_action = str::lower($request->modaltxteditpicaction);
        $data->duedate_action = $saveduedate;
        $data->save();
        $id= Crypt::encryptString($flp);
        return redirect('/flp/'.$id.'/edit');
    }              
                    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FLPAction  $fLPAction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $decrypted = Crypt::decryptString($id);
        $flpactions = FLPAction::find($decrypted);        
        $oldcode = $flpactions->code;
        $oldid = $flpactions->id;
        $oldaction = $flpactions->action;
        $oldpicaction = $flpactions->pic_action;
        $oldduedate = $flpactions->duedate_action;

        $code = $flpactions->code;
        $flp = FLPParent::where('code',$code)->first();       

        if (!$flpactions->signdate_action){
            $flpactions->delete();
            
                $id= Crypt::encryptString($flp->id);
                    
                return redirect('/flp/'.$id.'/edit')->with('success','Action has been deleted!');    
                
        }else{
            return back()->with('warning','This action has been signed...');
        }
    }

    public function sign($id, FLPAction $flpactions)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flpaction
        $flpactions = flpaction::find($decrypted);
        $code = $flpactions->code;
        $flp = FLPParent::where('code',$code)->first();
        
        $id= Crypt::encryptString($flp->id);                  
                    
        $this->authorize('flpstatus_approved', $flp);
        $this->authorize('complete_duedate_action', $flpactions);
        $this->authorize('complete_pic_action', $flpactions);
        $this->authorize('signaction', $flpactions);
        
        
            $flpactions->signdate_action =\Carbon\Carbon::now();
            $flpactions->duedate_status=1;
            $flpactions->save();
            
        return redirect('/flp/'.$id.'/edit')->with('success','Sign action success...');
                 
       
    }

    public function cancelsign($id)
    {
        $decrypted = Crypt::decryptString($id);
        //get data flpaction
        $flpactions = flpaction::find($decrypted);
        $oldsigndate = $flpactions->signdate_action;
        $code = $flpactions->code;
        $flp = FLPParent::where('code',$code)->first();        
       
        $id= Crypt::encryptString($flp->id);
        
        $this->authorize('flpstatus_approved', $flp);
        $this->authorize('signaction', $flpactions);

        $flpactions->signdate_action =null;
        $flpactions->duedate_status=0;
        $flpactions->save();          
        

            return redirect('/flp/'.$id.'/edit')->with('success','Cancel Sign action success...');
        
    }

    //download evidence FLP
    public function downloadevidence(Request $request,$id)
    {
        
        $decrypted = Crypt::decryptString($id);
        $file = FLPAction::find($decrypted);
        $paths = '/app/'.$file->evidence_filename;  
        $url = storage_path($paths);       
        
     return Response()->download($url);
     
    }

    //upload closing evidence
    public function uploadevidence(Request $request,$id)
    {
        
        //get data flpaction
        $flpactions = FLPAction::find($id);        
        $paths = DB::table('iccsfilepaths')
        ->where('description','Bukti Close FLP')
        ->first()->filepath;
        
        $flp= FLPParent::where('code',$flpactions->code)->first();
       
        $id= Crypt::encryptString($flp->id);        
        $code = $flp->noflp.'-EVD-'. sprintf("%05s", $flpactions->id);        
        $this->authorize('complete_evidence', $flpactions);
        
        $validatedData = $request->validate([
            'evidence_file' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',
    
           ]);
    
           $name = $request->file('evidence_file')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('evidence_file')->storeAs($paths,$code.'.'.$ext);
          
           
            $flpactions->evidence_filename = $path;
            $flpactions->evidence_uploader = Auth::User()->username;
            $flpactions->dateupload_evidence = \Carbon\Carbon::now();
            $flpactions->save();  
           
        return redirect('/flp/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }

    //Approved Closing Evidence
    public function approvedevidence($id, FLPAction $flpactions)
    {
        
        $decrypted = Crypt::decryptString($id);
        //get data flpaction
        $flpactions = flpaction::find($decrypted);
        $code = $flpactions->code;
        $flp = FLPParent::where('code',$code)->first();         
       
        $id= Crypt::encryptString($flp->id);                  
                    
        $this->authorize('complete_evidence', $flpactions);       
        
        
            $flpactions->dateapproved_evidence =\Carbon\Carbon::now();
            $flpactions->actionstatus='CLOSED';
            $flpactions->save();
            
        return redirect('/flp/'.$id.'/edit')->with('success','Approved Closing Evidence Success...');
                 
       
    }
    

}
