<?php

namespace App\Http\Controllers\ICCS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ICCS\RelatedMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class RelatedMaterialController extends Controller
{
    public function store(Request $request)
    {
        $relatedmaterial = new RelatedMaterial;
        $relatedmaterial->code = $request->modalhidecodelup;
        $relatedmaterial->partsap = $request->modaltxtadd_partsap;
        $relatedmaterial->partdesc = $request->modaltxtadd_partdesc;        
        $relatedmaterial->uploader = Auth::user()->username;
        $relatedmaterial->save();
        return back();
       
    }
    public function update(Request $request, $id)
    {
        $relatedmaterial = RelatedMaterial::find($id);
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('related_materials'),['updated_at']);        
        
        //get old value 
        foreach($fields as $field){
            $old[$field]= $relatedmaterial->$field;
        }        
        $relatedmaterial->partsap = $request->modaltxtedit_partsap;
        $relatedmaterial->partdesc = $request->modaltxtedit_partdesc;        
        $relatedmaterial->uploader = Auth::user()->username;
        $relatedmaterial->updated_at = now();
        $relatedmaterial->save();

        //get audit change 
        foreach($fields as $field){
            if($relatedmaterial->wasChanged($field)){
                auditlups($relatedmaterial,Auth::user()->username,'Change Material Impact',$relatedmaterial->code,
                'related_materials',$field,$old[$field],$relatedmaterial->$field );
            }
        }
        return back();
        
        
    }

    public function delete(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $relatedmaterial = RelatedMaterial::find($decrypted);  
        
        auditlups($relatedmaterial,Auth::user()->username,'Delete Material Impact',$relatedmaterial->code,
                'related_materials','',$relatedmaterial->makeHidden(['id', 'deleted_at']),'');
        $relatedmaterial->delete();
        return back();        
    }
}
