<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClearAuditLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audits = DB::table('audits')->where ('auditable_type','App\Models\User')
                                    ->where ('old_values','[]')
                                    ->where ('new_values','[]');;
        
        $audits->delete();
    }
}
