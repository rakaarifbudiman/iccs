<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FLP\FLPAction;
use App\Models\FLP\FLPParent;

class FLPActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        

        //seed old flpactions data
        $sqlquery = "INSERT INTO iccs_be.flpactions (code, noaction,action, pic_action, duedate_action, signdate_action, evidence_filename, evidence_uploader, dateupload_evidence, evidence_approver, dateapproved_evidence, pic_extension,signdate_extension, deletion_flag, duedate_status, old_duedate, cancel_duedate_notes,notes, extension_count)
        SELECT nodokumenflp, NoAction, Action, WinID, DueDate, SignDate, FolderFileBC, UploaderBC, DateUploadBC, ApproverBC, DateApproveBC, PICPerpanjangan, SignDatePerpanjangan, DeletionFlag, DueDateStatus, DueDate2, AlasanCancel, Catatan, PerpanjanganKe
        FROM old_iccs.old_flpactions";
        $result = DB::select(DB::raw($sqlquery));

        //change old evidence filepath        
        $count=FLPaction::all()->count();
        
        for($i = 1; $i <= $count; $i++){        
        $flpactions = FLPAction::find($i);
        $oldflp = DB::table('old_iccs.old_flpparents')->where('NoDokumenflp',$flpactions->code)->first();
        $flpactions->extension_notes = $oldflp->AlasanPerpanjangan;
        $flpactions->approver_extension = $oldflp->ApproverPerpanjangan;
        $flpactions->dateapproved_extension = $oldflp->DateApprovedPerpanjangan;
        $oldevidence_filename = $flpactions->evidence_filename;
            if($oldevidence_filename=="" || $oldevidence_filename==null){                
                $flpactions->evidence_filename = null;
            }else{
                $replace1 = str_replace("\\","/",$oldevidence_filename);
                $replace2 = str_replace("//Sghdc-iccs/1-ICCS","public",$replace1);  
                $flpactions->evidence_filename = $replace2;            
            }     
        

        $flpactions->save();
        }

       
        
        


    }
}
