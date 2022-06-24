<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ICCSPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 1,
            'filepath' => 'public/2-File/1-FLP/1-Lampiran FLP',
            'description' => 'Lampiran FLP',
            'notes' => 'file path for Lampiran FLP',           

        ]);
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 1,
            'filepath' => 'public/2-File/1-FLP/2-Bukti Close FLP',
            'description' => 'Bukti Close FLP',
            'notes' => 'file path for Bukti Close FLP',           

        ]);
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 2,
            'filepath' => 'public/2-File/2-LUPD/1-Lampiran LUPD',
            'description' => 'Lampiran LUPD',
            'notes' => 'file path for Lampiran LUPD',           

        ]);
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 2,
            'filepath' => 'public/2-File/2-LUPD/2-Bukti Close LUPD',
            'description' => 'Bukti Close LUPD',
            'notes' => 'file path for Bukti Close LUPD',           

        ]);
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 3,
            'filepath' => 'public/2-File/3-LUP/1-Lampiran LUP',
            'description' => 'Lampiran LUP',
            'notes' => 'file path for Lampiran LUP',           

        ]);
        DB::table('iccsfilepaths')->insert([
                
            'seq' => 3,
            'filepath' => 'public/2-File/3-LUP/2-Bukti Close LUP',
            'description' => 'Bukti Close LUP',
            'notes' => 'file path for Bukti Close LUP',           

        ]);
    }
}
