<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RDMSKonversiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.rdms_conversions (part,uom_from,uom_to,value)
        SELECT rdms_part,uom_from,uom_to,value
        FROM old_iccs.old_rdms_konversi";
        $result = DB::select(DB::raw($sqlquery));
    }
}
