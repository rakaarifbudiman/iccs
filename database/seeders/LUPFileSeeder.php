<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\LUP\LUPFile;

class LUPFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old lupfiles data
        $sqlquery = "INSERT INTO iccs_be.lupfiles (code, nofile, document_name, file_path, uploader, date_upload,org_file_name)
        SELECT nodokumenlup, NoLampiran, NamaLampiran, FolderFile, Uploader, DateUpload, NoLampiran
        FROM old_iccs.old_lupfiles";
        $result = DB::select(DB::raw($sqlquery));

        //change old filepath        
        $count=LUPFile::all()->count();
        
        for($i = 1; $i <= $count; $i++){        
        $lupfiles = LUPFile::find($i);
        $old_filepath = $lupfiles->file_path;
        $replace1 = str_replace("\\","/",$old_filepath);
        $replace2 = str_replace("//Sghdc-iccs/1-ICCS","public",$replace1);  
        if (!$lupfiles->file_path){
            $new_org_file_name=null;
        }else{
            $new_org_file_name= $lupfiles->nofile.".".substr($replace2, strpos($replace2, ".") + 1);
        }
        
        
        $lupfiles->org_file_name = $new_org_file_name;   
        $lupfiles->file_path = $replace2;
        $lupfiles->save();
        }

    }
}
