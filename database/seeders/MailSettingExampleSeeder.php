<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MailSettingExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mail_settings')->insert([
            'driver'=>'smtp',           
            'host'=>'',
            'port'=>'',
            'username'=>'',
            'password'=>'',
            'encryption'=>null,
            'from_address'=>'',
            'from_name'=>'ICCS',
        ]);
            
    }
}
