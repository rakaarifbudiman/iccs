<?php

namespace App\Http\Controllers\ICCS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ICCS\RelatedDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class RelatedDocumentController extends Controller
{
    public function store(Request $request)
    {
        $relateddocument = new RelatedDocument;
        $relateddocument->code = $request->modalhidecodelup;
        $relateddocument->type = $request->modaltxtadd_type;
        $relateddocument->doc_number = $request->modaltxtadd_doc_number;
        $relateddocument->doc_title = $request->modaltxtadd_doc_title;
        $relateddocument->uploader = Auth::user()->username;
        $relateddocument->save();
        return back();
       
    }
    public function update(Request $request, $id)
    {
        $relateddocument = RelatedDocument::find($id);
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('related_documents'),['updated_at']);        
        
        //get old value 
        foreach($fields as $field){
            $old[$field]= $relateddocument->$field;
        }

        $relateddocument->type = $request->modaltxtedit_type;
        $relateddocument->doc_number = $request->modaltxtedit_doc_number;
        $relateddocument->doc_title = $request->modaltxtedit_doc_title;
        $relateddocument->uploader = Auth::user()->username;
        $relateddocument->updated_at = now();
        $relateddocument->save();

        //get audit change 
        foreach($fields as $field){
            if($relateddocument->wasChanged($field)){
                auditlups($relateddocument,Auth::user()->username,'Change Document Impact',$relateddocument->code,
                'related_documents',$field,$old[$field],$relateddocument->$field );
            }
        }
        return back();
        
        
    }

    public function delete(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $relateddocument = RelatedDocument::find($decrypted);        
        auditlups($relateddocument,Auth::user()->username,'Delete Document Impact',$relateddocument->code,
                'related_documents','',$relateddocument->makeHidden(['id', 'deleted_at']),'');
        $relateddocument->delete();
        return back();        
    }

    

}
