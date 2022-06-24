<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FLP\FLPFile;

class FLPFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old flpfiles data
        $sqlquery = "INSERT INTO iccs_be.flpfiles (code, nofile, document_name, file_path, uploader, date_upload,org_file_name)
        SELECT nodokumenflp, NoLampiran, NamaLampiran, FolderFile, Uploader, DateUpload, NoLampiran
        FROM old_iccs.old_flpfiles";
        $result = DB::select(DB::raw($sqlquery));

        //change old filepath        
        $count=FLPFile::all()->count();
        
        for($i = 1; $i <= $count; $i++){        
        $flpfiles = FLPFile::find($i);
        $old_filepath = $flpfiles->file_path;
        $replace1 = str_replace("\\","/",$old_filepath);
        $replace2 = str_replace("//Sghdc-iccs/1-ICCS","public",$replace1);  
        if (!$flpfiles->file_path){
            $new_org_file_name=null;
        }else{
            $new_org_file_name= $flpfiles->nofile.".".substr($replace2, strpos($replace2, ".") + 1);
        }
        
        
        $flpfiles->org_file_name = $new_org_file_name;   
        $flpfiles->file_path = $replace2;
        $flpfiles->save();
        }

    }
}
