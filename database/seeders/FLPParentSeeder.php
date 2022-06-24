<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FLP\FLPParent;

class FLPParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old flpactions data
        $sqlquery = "INSERT INTO iccs_be.flpparents (id, date_input, code, noflp, documentname, ingredients, dosageform, bussinessunit, flpstatus, packaging, regno, het, launch, inisiator, leader, reviewer, Approver, notes1, notes2, notes, datesign_inisiator, datesign_leader, datesubmit_reviewer, datesubmit_approver, dateapproved, approved,notes_closing, verified_a, verified_b, reviewer_closing, approver_closing, dateclosing_reviewer, dateclosing_approver, extension_count,year)
        SELECT ID, dateinput, nodokumenflp, noflp, NamaDok, ActiveIng, DosageForm, BussinessUnit, StatusFLP, Packaging, RegNo, HET, TargetLaunch, Inisiator, AtasanInisiator, Reviewer, Approver, note1, note2, Note, SignDateInisiator, SignDateAtasanInisiator, DateSubmitToQC, DateSubmitToApprover, DateApproved, FLPApproved, CatatanClosing, VerifikasiA, VerifikasiB, ClosingBy, ApproverClosing, DateClosingReview, DateClosing, PerpanjanganKe,date_format(dateinput,'%y')
        FROM old_iccs.old_flpparents";
        $result = DB::select(DB::raw($sqlquery));

        
    }
}
