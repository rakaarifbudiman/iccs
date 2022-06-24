<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count=User::all()->count();
        
        for($i = 1; $i <= $count; $i++){
        
        $users = User::find($i);
        $newpassword = Hash::make('12345678');        
        //$newpassword = Hash::make('123456');
        $users->password = $newpassword;
        $users->save();
        }	
    }
}
