<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ICCS\Grade;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed real user data
        $sqlquery = "INSERT INTO iccs_be.users (username, name, level, leader, department, grade, email, active, notes, password, unid, level_rdms)
        SELECT WinID, FirstName, AccessLevel, Leader, Department, JobGrade, Email, Aktif, Notes, Password, Password,AcLevelRDMS
        FROM old_iccs.old_users";
        $result = DB::select(DB::raw($sqlquery));

        //seed change to new password
        $count=User::all()->count();
        
        for($i = 1; $i <= $count; $i++){
        
        $users = User::find($i);
        $grade = Grade::where('grade',$users->grade)->first();
        
        $newpassword = Hash::make('123456');
        $users->grade_level = $grade->level;
        $users->password = $newpassword;
        $users->save();
        }	

       
    }
}
