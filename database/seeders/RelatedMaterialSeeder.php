<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ICCS\RelatedMaterial;

class RelatedMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old related material data
        $sqlquery = "INSERT INTO iccs_be.related_materials (code,partsap,partdesc,uploader,created_at)
        SELECT NoDokumenLUP,PartNo,PartDesc,Uploader,DateUpload
        FROM old_iccs.old_relatedmaterials";
        $result = DB::select(DB::raw($sqlquery));
    }
}
