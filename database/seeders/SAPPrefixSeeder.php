<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SAPPrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.sapprefixs (prefix, mat_type, mat_group, notes)
        SELECT prefix, mat_type, mat_group, notes
        FROM old_iccs.old_sap_prefix";
        $result = DB::select(DB::raw($sqlquery));
    }
}
