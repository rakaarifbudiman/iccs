<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([                
            'grade' => 'Admin',
            'level' => 1
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Executive',
            'level' => 1
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Operator',
            'level' => 1
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Site Checker',
            'level' => 1
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Supervisor',
            'level' => 2
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Manager',
            'level' => 3
        ]);
        DB::table('grades')->insert([                
            'grade' => 'Director',
            'level' => 4
            
        ]);
    }
}
