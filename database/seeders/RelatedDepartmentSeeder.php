<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ICCS\ICCSApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelatedDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               //seed old related material data
               $sqlquery = "INSERT INTO iccs_be.related_departments (code,username,note,signdate,approval_code)
               SELECT NoDokumenLUP,WinID,Komentar,SignDate,Department
               FROM old_iccs.old_disposisi";
               $result = DB::select(DB::raw($sqlquery));
               $count=RelatedDepartment::all()->count();

        for($i = 1; $i <= $count; $i++){ 
            $disposisi=RelatedDepartment::find($i);
            $approver = ICCSApproval::where('code',$disposisi->approval_code)->first();
            $disposisi->username = $approver->username;
            $disposisi->department = $approver->type;
            $disposisi->save();
        }
    }
}
