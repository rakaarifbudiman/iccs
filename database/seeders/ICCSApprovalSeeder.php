<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ICCS\ICCSApproval;

class ICCSApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old related material data
        $sqlquery = "INSERT INTO iccs_be.approvals (code,type,username,note,active)
        SELECT No,Activity,PIC,Note,Aktif
        FROM old_iccs.old_iccsapprovals";
        $result = DB::select(DB::raw($sqlquery));

        $count=ICCSApproval::all()->count();
        
        for($i = 1; $i <= $count; $i++){ 
            $approvals = ICCSApproval::find($i);
            if($approvals->type=='Approval HSE' || $approvals->type=='Approval Validasi'){
                $approvals->note='Approval Disposisi';
            }
            if($approvals->note=='Approval Change Request Committee' || $approvals->note=='Approval Change Request Committe'){
                $approvals->note='Approval Disposisi Change Request Committee';
            }
            $approvals->save();
        }   

    }
}
