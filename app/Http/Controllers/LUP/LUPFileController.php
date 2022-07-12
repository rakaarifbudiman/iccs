<?php

namespace App\Http\Controllers\LUP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\LUP\LUPParent;
use App\Models\LUP\LUPFile;
use Illuminate\Support\Facades\Auth;

class LUPFileController extends Controller
{
    public function upload(Request $request,$id)
    {
        
        //get data lupparent
        $lup = lupparent::find($id);
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran LUP')
        ->first()->filepath;        
        $id= Crypt::encryptString($lup->id);

        //get code attachment
        $lastid = lupFile::where('code',$lup->code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $lup->code.'-ATT-'. sprintf("%02s", $newid);        
        
        
        $validatedData = $request->validate([
            'attachment_file' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',
    
           ]);
    
           $name = $request->file('attachment_file')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('attachment_file')->storeAs($paths,$code.'.'.$ext);
    
           
            $save = lupFile::create([
            'code' => $lup->code,    
            'nofile'=>$code,
            'org_file_name'=>$name,
            'document_name'=>$request->modaltxtadddocname, 
            'uploader'=>Auth::user()->username,
            'date_upload'=> \Carbon\Carbon::now(),  
            'file_path' => $path, 
            
        ]); 
           
        return redirect('/lup/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }

    public function uploadevidence(Request $request,$id)
    {
        
        //get data lupparent
        $lup = lupparent::find($id);
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran LUP')
        ->first()->filepath;        
        $id= Crypt::encryptString($lup->id);

        //get code attachment
        $lastid = lupFile::where('code',$lup->code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        
        if($lastid==0 or $lastid==NULL){
            $newid = 1;
        }else{
            $newid = abs($lastno+1);
        }        
        $code = $lup->code.'-ATT-'. sprintf("%02s", $newid);        
        
        
        $validatedData = $request->validate([
            'attachment_file' => 'required|mimes:xls,xlsx,pdf,jpg,png,jpeg,doc,docx,msg,eml|max:1000',
    
           ]);
    
           $name = $request->file('attachment_file')->getClientOriginalName();
           $ext = pathinfo($name, PATHINFO_EXTENSION);
           $path = $request->file('attachment_file')->storeAs($paths,$code.'.'.$ext);
    
           
            $save = lupFile::create([
            'code' => $lup->code,    
            'nofile'=>$code,
            'org_file_name'=>$name,
            'document_name'=>$request->modaltxtadddocname, 
            'uploader'=>Auth::user()->username,
            'date_upload'=> \Carbon\Carbon::now(),  
            'file_path' => $path,
            'is_evidence'=>true,
            'action'=>$request->referaction,            
        ]); 
        
        activity()->causedBy(Auth::user()->id)->performedOn($lup)->event('edited')->log('upload multi evidence Action LUP  '.$lup->code);
        return redirect('/lup/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }


    
    //download attachment lup
    public function download($id)
    {
        
        $decrypted = Crypt::decryptString($id);        
        $file = lupFile::find($decrypted);
        $paths = '/app/'.$file->file_path;  
        $url = storage_path($paths);       
        
     return Response()->download($url);
     
    }

    //change attachment lup
    public function reupload(Request $request,$id)
    {
        //get data lupparent
        $lup = lupparent::where('code',$request->modalhidecodelup)->first()->id;
        $code = $request->modalhidecodelup;
        $paths = DB::table('iccsfilepaths')
        ->where('description','Lampiran lup')
        ->first()->filepath;       
        $id= Crypt::encryptString($lup);
        
        //get code attachment
        $file_id = $request->modalhidefileid;
        $file = lupFile::find($file_id);
        $oldname = $file->document_name ;  
        $oldfile = $file->org_file_name;  
        
        //get code attachment
        $lastid = lupFile::where('code',$code)->max('nofile');
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

        if($file->wasChanged()==True){
            auditlups($file,Auth::user()->username,'Change Attachment',$file->code,
                'lupfiles','document_name',$oldname.' ; '.$oldfile,$file->document_name.' ; '.$file->org_file_name );
        }       
        
        activity()->causedBy(Auth::user()->id)->performedOn($file)->event('edited')->log('reupload attachment LUP  '.$file->code);
        return redirect('/lup/'.$id.'/edit')->with('info', 'File Has been uploaded successfully');       
           
    }

    //delete attachment lup
    public function destroy_attachment(lupFile $file,$id)
    {
        $decrypted = Crypt::decryptString($id);
        $file = lupFile::find($decrypted);
        $lup=$file->lupparent;
        $this->authorize('update',$lup);
        activity()->causedBy(Auth::user()->id)->performedOn($file)->event('deleted')->log('deleted attachment LUP  '.$file->code);
        auditlups($file,Auth::user()->username,'Delete Attachment',$file->code,
                'lupfiles','',$file->makeHidden(['id', 'deleted_at','file_path','longtext1','longtext2','longtext3','date1','date2','date3']),'');
        $file->delete();
        
        
        return back()->with('success','Attachment has been deleted!');
    }

}
