<?php

namespace App\Http\Controllers\ICCS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ICCS\RelatedUtility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class RelatedUtilityController extends Controller
{
    public function store(Request $request)
    {
        $relatedutility = new RelatedUtility;
        $relatedutility->code = $request->modalhidecodelup;
        $relatedutility->area = $request->modaltxtadd_area;
        $relatedutility->description = $request->modaltxtadd_description;        
        $relatedutility->uploader = Auth::user()->username;
        $relatedutility->save();
        return back();
       
    }
    public function update(Request $request, $id)
    {
        $relatedutility = RelatedUtility::find($id);
        $fields = array_diff(Schema::Connection('mysql')->getColumnListing('related_utilities'),['updated_at']);        
        
        //get old value 
        foreach($fields as $field){
            $old[$field]= $relatedutility->$field;
        }

        $relatedutility->area = $request->modaltxtedit_area;
        $relatedutility->description = $request->modaltxtedit_description;        
        $relatedutility->uploader = Auth::user()->username;
        $relatedutility->updated_at = now();
        $relatedutility->save();

        //get audit change 
        foreach($fields as $field){
            if($relatedutility->wasChanged($field)){
                auditlups($relatedutility,Auth::user()->username,'Change Utility Impact',$relatedutility->code,
                'related_utilitys',$field,$old[$field],$relatedutility->$field );
            }
        }
        return back();
        
        
    }

    public function delete(Request $request, $id)
    {
        $decrypted = Crypt::decryptString($id);
        $relatedutility = RelatedUtility::find($decrypted);  
        
        auditlups($relatedutility,Auth::user()->username,'Delete Utility Impact',$relatedutility->code,
                'related_utilitys','',$relatedutility->makeHidden(['id', 'deleted_at']),'');
        $relatedutility->delete();
        return back();        
    }
}
