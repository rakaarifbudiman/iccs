<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\LUP\LUPParent;
use Illuminate\Database\Seeder;
use App\Models\ICCS\ICCSApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LUPParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old lupactions data
        $sqlquery = "INSERT INTO iccs_be.lup_parents (date_input, code, nolup, documentname, lup_type,lup_type_others, year,
        lupstatus,lup_current,lup_proposed,lup_reason,categorization,permanent,temporary,duedate_start,duedate_finish,
        inisiator,leader,datesign_inisiator,datesign_leader,note_reviewer,note_approver,datesubmit_regulatory_reviewer,regulatory_change_type,
        regulatory_variation,regulatory_reviewer,datesubmit_regulatory_approver,regulatory_approver,datesign_regulatory_approver,
        datesubmit_reviewer,reviewer,datesubmit_approver,approver,approved,dateapproved,duedate_start_temporary,risk_assestment,
        closing_notes,verified_a,verified_b,verified_c,reviewer_closing,approver_closing,dateclosing_approver,note_regulatory_reviewer,datesubmit_reviewer2
        )
        SELECT dateinput, nodokumenlup, nolup, NamaDok, JenisLUP,JenisLUPNote, date_format(dateinput,'%y'),
        StatusLUP,StatusSaatIni,DetailUsulanPerubahan,AlasanPerubahan,6Kategori,81Permanen,82Sementara,811StartPermanen,822FinishSementara,
        Inisiator,AtasanInisiator,SignDateInisiator,SignDateAtasanInisiator,Note1,Note2,DateSubmitToReg,JenisPerubahanReg,
        JenisReg,RegReviewer,DateRegReview,RegApprover,DateRegApproved,
        DateSubmitToQC,Reviewer,DateSubmitToApprover,Approver,LUPApproved,DateApproved,821StartSementara,DeskripsiKajianResiko,
        CatatanClosing,VerifikasiA,VerifikasiB,VerifikasiC,ClosingBy,ApproverClosing,DateClosing,13Note,DateSubmitToApprover
        FROM old_iccs.old_lupparents";
        $result = DB::select(DB::raw($sqlquery));
        
        //fill duedate_type
        $count=lupparent::all()->count();        
        for($i = 1; $i <= $count; $i++){        
            $lupparents = lupparent::find($i);          

            if ($lupparents->permanent==1 && $lupparents->temporary==0){
                $lupparents->duedate_type ='Permanent' ;
            }elseif($lupparents->permanent==0 && $lupparents->temporary==1){
                $lupparents->duedate_type ='Temporary' ;
                $lupparents->duedate_start =$lupparents->duedate_start_temporary ;
            }else{
                $lupparents->duedate_type =null ;
            }

            //change regulatory variation
            if($lupparents->regulatory_variation=='- Berdampak'){
                $lupparents->regulatory_impact=true;
                $lupparents->regulatory_variation=null;
            }elseif($lupparents->regulatory_variation=='- Tidak Berdampak'){
                $lupparents->regulatory_variation=null;
            }elseif($lupparents->regulatory_variation=='- Variasi Minor'){
                $lupparents->regulatory_variation='Minor';
            }elseif($lupparents->regulatory_variation=='- Variasi Mayor'){
                $lupparents->regulatory_variation='Major';
            }elseif($lupparents->regulatory_variation=='- Variasi Minor - Notifikasi'){
                $lupparents->regulatory_variation='Notification';
            }

            //change regulatory variation
            if($lupparents->regulatory_change_type=='- Perubahan dapat langsung dilaksanakan tanpa menunggu izin dari Badan Regulatory'){            
                $lupparents->regulatory_change_type='Can be implemented immediately';
            }elseif($lupparents->regulatory_change_type=='- Perubahan telah disetujui Badan Regulatory, tanggal:'){
                $lupparents->regulatory_change_type='Have been approved by regulatory body';
            }elseif($lupparents->regulatory_change_type=='- Menunggu persetujuan Badan Regulatory'){
                $lupparents->regulatory_change_type='Waiting approval of regulatory body';
            }

            $approver = ICCSApproval::where('code',$lupparents->approver)->first();
            //change approver name
            if(!$lupparents->approver){                    
            }else{
                $lupparents->approver=$approver->username;
            }

            $regreviewer = ICCSApproval::where('code',$lupparents->regulatory_reviewer)->first();
            //change regulatory reviewer name
            if(!$lupparents->regulatory_reviewer){                   
            }else{
                $lupparents->regulatory_reviewer=$regreviewer->username;;
            }

            $regapprover = ICCSApproval::where('code',$lupparents->regulatory_approver)->first();
            //change regulatory approver name
            if(!$lupparents->regulatory_approver){                   
            }else{
                $lupparents->regulatory_approver=$regapprover->username;;
            }

            //change LUP Status
            if($lupparents->lupstatus=="ON PROCESS"){
                $lupparents->lupstatus="CREATE";
                $lupparents->datesign_leader=null;
            }elseif($lupparents->lupstatus=="ON REVIEW" || $lupparents->lupstatus=="ON APPROVAL"){
                $lupparents->lupstatus="ON PROCESS";
                $lupparents->datesign_leader=null;
                $lupparents->note_reviewer2 =null;
                $lupparents->note_confirmer =null;        
                $lupparents->datesubmit_approver = null;
                $lupparents->dateapproved = null;
                $lupparents->dateconfirmed = null;
                $lupparents->approved = null;
                $lupparents->confirmed = null;
            }
            $lupparents->save();
        }

        
    }
}
