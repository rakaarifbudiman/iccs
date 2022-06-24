<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\RDMS\MasterPart;

class MasterPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed old flpactions data
        $sqlquery = "INSERT INTO rdms_be.master_parts (created_at,    
            rdms_part,  
            old_part,
            old_desc,
            sap_part,
            sap_desc,
            sap_mat_type,
            sap_mat_group,
            sap_uom,
            sap_edisi,
            note_change,
            requester_part,            
            rdms_status_part,
            sap_status_part,
            rdms_remarks,
            sap_date_input,
            rdms_date_share,       
            dosage_form,    
            primary_packaging,   
            product_type,    
            product_group, 
            product_content_box, 
            product_bruto_box, 
            product_dimension_box,
            product_content_mstbox, 
            product_bruto_mstbox, 
            product_dimension_mstbox,
            product_shelf_life,
            product_batch_size,
            product_storage            
            )
        SELECT Tanggal, 
            PartBaru,
            PartLama,
            PartDescLama, 
            PartBaru,
            PartDesc,
            MatType,
            MGCode,
            UoM,
            NoEdisi,
            DeskUbah,
            Inisiator,
            KodeSA,
            KodeSS,
            Remarks,
            DueDate,
            Date1,
            BentukSediaan,
            KemasanPrimer,
            JenisProduk,
            GolonganProduk,
            Jumlahperbox,
            Brutoperbox,
            DimensiBox,
            JumlahperMasterBox,
            BrutoperMasterBox,
            DimensiMasterBox,
            Daluarsa,
            BS,
            Penyimpanan            
        FROM old_iccs.old_masterparts";
        $result = DB::select(DB::raw($sqlquery));
    }
}
