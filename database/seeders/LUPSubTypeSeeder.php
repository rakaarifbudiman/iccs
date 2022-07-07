<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LUPSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old related material data
        $sqlquery = "INSERT INTO iccs_be.lup_subtypes (luptype)
        SELECT SubJenisLUP
        FROM old_iccs.old_subjenislup";
        $result = DB::select(DB::raw($sqlquery));
    }
}
