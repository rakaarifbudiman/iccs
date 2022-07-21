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
        
        //seed old FLP
        $sqlqueryflp = "INSERT INTO iccs_be.lup_parents (date_input, code, nolup, documentname, ingredients, dosageform, 
        bussinessunit, lupstatus, packaging, regno, het, duedate_start, inisiator, leader, reviewer, Approver, note_reviewer, note_approver, 
        notes, datesign_inisiator, datesign_leader, datesubmit_reviewer, datesubmit_approver, dateapproved, approved,
        closing_notes, verified_a, verified_b, reviewer_closing, approver_closing, dateclosing_reviewer, dateclosing_approver, 
        extension_count,year)
        SELECT dateinput, nodokumenflp, noflp, NamaDok, ActiveIng, DosageForm, BussinessUnit, StatusFLP, Packaging, 
        RegNo, HET, TargetLaunch, Inisiator, AtasanInisiator, Reviewer, Approver, note1, note2, Note, SignDateInisiator, 
        SignDateAtasanInisiator, DateSubmitToQC, DateSubmitToApprover, DateApproved, FLPApproved, CatatanClosing, VerifikasiA, 
        VerifikasiB, ClosingBy, ApproverClosing, DateClosingReview, DateClosing, PerpanjanganKe,date_format(dateinput,'%y')
        FROM old_iccs.old_flpparents";
        $resultflp = DB::select(DB::raw($sqlqueryflp));

        //fill duedate_type
        $lupparents=lupparent::all();        
        foreach($lupparents as $lupparent){        
           

            if ($lupparent->permanent==1 && $lupparent->temporary==0){
                $lupparent->duedate_type ='Permanent' ;
            }elseif($lupparent->permanent==0 && $lupparent->temporary==1){
                $lupparent->duedate_type ='Temporary' ;
                $lupparent->duedate_start =$lupparent->duedate_start_temporary ;
            }else{
                $lupparent->duedate_type =null ;
            }

            //change regulatory variation
            if($lupparent->regulatory_variation=='- Berdampak'){
                $lupparent->regulatory_impact=true;
                $lupparent->regulatory_variation=null;
            }elseif($lupparent->regulatory_variation=='- Tidak Berdampak'){
                $lupparent->regulatory_variation=null;
            }elseif($lupparent->regulatory_variation=='- Variasi Minor'){
                $lupparent->regulatory_impact=true;
                $lupparent->regulatory_variation='Minor';
            }elseif($lupparent->regulatory_variation=='- Variasi Mayor'){
                $lupparent->regulatory_impact=true;
                $lupparent->regulatory_variation='Major';
            }elseif($lupparent->regulatory_variation=='- Variasi Minor - Notifikasi'){
                $lupparent->regulatory_impact=true;
                $lupparent->regulatory_variation='Notification';
            }

            //change regulatory variation
            if($lupparent->regulatory_change_type=='- Perubahan dapat langsung dilaksanakan tanpa menunggu izin dari Badan Regulatory'){            
                $lupparent->regulatory_change_type='Can be implemented immediately';
            }elseif($lupparent->regulatory_change_type=='- Perubahan telah disetujui Badan Regulatory, tanggal:'){
                $lupparent->regulatory_change_type='Have been approved by regulatory body';
            }elseif($lupparent->regulatory_change_type=='- Menunggu persetujuan Badan Regulatory'){
                $lupparent->regulatory_change_type='Waiting approval of regulatory body';
            }

            $approver = ICCSApproval::where('code',$lupparent->approver)->first();
            //change approver name
            if($lupparent->approver && Str::contains($lupparent->approver, '-')){         
           
                $lupparent->approver=$approver->username;
            }

            $regreviewer = ICCSApproval::where('code',$lupparent->regulatory_reviewer)->first();
            //change regulatory reviewer name
            if($lupparent->regulatory_reviewer && Str::contains($lupparent->regulatory_reviewer, '-')){                
           
                $lupparent->regulatory_reviewer=$regreviewer->username;;
            }

            $regapprover = ICCSApproval::where('code',$lupparent->regulatory_approver)->first();
            //change regulatory approver name
            if($lupparent->regulatory_approver && Str::contains($lupparent->regulatory_approver, '-')){  
            
                $lupparent->regulatory_approver=$regapprover->username;;
            }

            //change LUP Status
            if($lupparent->lupstatus=="ON PROCESS"){
                $lupparent->lupstatus="CREATE";
                $lupparent->datesign_leader=null;
            }elseif($lupparent->lupstatus=="ON REVIEW" || $lupparent->lupstatus=="ON APPROVAL"){
                $lupparent->lupstatus="ON PROCESS";
                $lupparent->datesign_leader=null;
                $lupparent->note_reviewer2 =null;
                $lupparent->note_confirmer =null;        
                $lupparent->datesubmit_approver = null;
                $lupparent->dateapproved = null;
                $lupparent->dateconfirmed = null;
                $lupparent->approved = null;
                $lupparent->confirmed = null;
            }elseif($lupparent->lupstatus=="OPEN"){
                $lupparent->reviewer2=$lupparent->approver;
                $lupparent->confirmer=$lupparent->approver;
            }
            $lupparent->save();
        }

        
        
    }
}
