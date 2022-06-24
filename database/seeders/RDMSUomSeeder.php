<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RDMSUomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.rdms_uoms (uom, uom_alias,desc_uom)
        SELECT uom, uom_alias,desc_uom
        FROM old_iccs.old_rdms_uom";
        $result = DB::select(DB::raw($sqlquery));
    }
}
