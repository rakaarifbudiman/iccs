<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([                
            'department' => 'Quality Assurance'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Quality Control'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Formulation Development'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Packaging Development'
        ]);
        DB::table('departments')->insert([                
            'department' => 'R&D Analytical'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Maintenance'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Solid Production'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Liquid Production'
        ]);
        DB::table('departments')->insert([                
            'department' => 'International Bussiness'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Material Planning'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Extract & Food Production'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Supply Planning 2'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Plant Logistics'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Sourcing'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Material Procurement'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Supply Planning 1'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Quality Compliance'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Validation'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Production'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Technical Service'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Quality Operation'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Marketing'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Regulatory'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Product Innovation'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Bussiness Development'
        ]);
        DB::table('departments')->insert([                
            'department' => 'R&D RPV'
        ]);
        DB::table('departments')->insert([                
            'department' => 'HSE'
        ]);
        DB::table('departments')->insert([                
            'department' => 'Supply Chain'
        ]);


    }
}
