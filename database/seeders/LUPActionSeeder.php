<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;

class LUPActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        

        //seed old lupactions data
        $sqlquery = "INSERT INTO iccs_be.lup_actions (code, noaction,action, pic_action, duedate_action, 
        signdate_action, evidence_filename, evidence_uploader, dateupload_evidence, evidence_approver, 
        dateapproved_evidence, pic_extension,signdate_extension, deletion_flag, duedate_status, old_duedate, 
        cancel_duedate_notes,notes, extension_count)
        SELECT nodokumenlup, NoAction, Action, WinID, DueDate, 
        SignDate, FolderFileBC, UploaderBC, DateUploadBC, ApproverBC, DateApproveBC, 
        PICPerpanjangan, SignDatePerpanjangan, DeletionFlag, DueDateStatus, DueDate2, 
        AlasanCancel, Catatan, PerpanjanganKe
        FROM old_iccs.old_lupactions";
        $result = DB::select(DB::raw($sqlquery));

        //seed old flpactions data
        $sqlqueryflp = "INSERT INTO iccs_be.lup_actions (code, noaction,action, pic_action, duedate_action, 
        signdate_action, evidence_filename, evidence_uploader, dateupload_evidence, evidence_approver, 
        dateapproved_evidence, pic_extension,signdate_extension, deletion_flag, duedate_status, old_duedate, 
        cancel_duedate_notes,notes, extension_count)
        SELECT nodokumenflp, NoAction, Action, WinID, DueDate, SignDate, FolderFileBC, UploaderBC, DateUploadBC, 
        ApproverBC, DateApproveBC, PICPerpanjangan, SignDatePerpanjangan, DeletionFlag, DueDateStatus, DueDate2, 
        AlasanCancel, Catatan, PerpanjanganKe
        FROM old_iccs.old_flpactions";
        $resultflp = DB::select(DB::raw($sqlqueryflp));

        //change old evidence filepath        
        $lupactions=LUPAction::all();
        
        foreach($lupactions as $lupaction){      
        
            if(DB::table('old_iccs.old_lupparents')->where('NoDokumenLUP',$lupaction->code)->first()){
                $oldlup = DB::table('old_iccs.old_lupparents')->where('NoDokumenLUP',$lupaction->code)->first();
            }elseif(DB::table('old_iccs.old_flpparents')->where('NoDokumenFLP',$lupaction->code)->first()){
                $oldlup = DB::table('old_iccs.old_flpparents')->where('NoDokumenFLP',$lupaction->code)->first();
            }        
            $lupaction->extension_notes = $oldlup->AlasanPerpanjangan;
            $lupaction->approver_extension = $oldlup->ApproverPerpanjangan;
            $lupaction->dateapproved_extension = $oldlup->DateApprovedPerpanjangan;
            $oldevidence_filename = $lupaction->evidence_filename;
                if($oldevidence_filename=="" || $oldevidence_filename==null){                
                    $lupaction->evidence_filename = null;
                }else{
                    $replace1 = str_replace("\\","/",$oldevidence_filename);
                    $replace2 = str_replace("//Sghdc-iccs/1-ICCS","public",$replace1);  
                    $lupaction->evidence_filename = $replace2;
                
                }    
            $lupaction->save();
        }
    }
}
