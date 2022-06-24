<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RDMS\RDMSStockInData;
use App\Models\RDMS\MasterPart;
use App\Models\RDMS\RDMSConversion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class RDMSStockInDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.stock_in_data (transaction_id,
        po_number,
        part,
        batch,
        expired,
        qty_input,
        uom_input,
        storage,
        notes       
        )
        SELECT IDStockIn,NoPembelian,PartNo,NoBatch,Expired,QtyInput,UomInput,Storage,AddNote
        FROM old_iccs.old_rdms_stock_in_data";
        $result = DB::select(DB::raw($sqlquery));

        //seed qty_konversi
        $count=RDMSStockInData::all()->count();        
        for($i = 1; $i <= $count; $i++){
        
            $stockin = RDMSStockInData::find($i);    
            if($stockin->uom_input==='gr'){
                $newuom_input = 'G';
            }elseif($stockin->uom_input==='Kg'){
                $newuom_input = 'KG';                
            }elseif($stockin->uom_input==='mg'){
                $newuom_input = 'MG';                
            }elseif($stockin->uom_input==='mL'){
                $newuom_input = 'ML';                
            }elseif($stockin->uom_input==='mcg'){
                $newuom_input = 'mcg';                
            }elseif($stockin->uom_input==='Pcs'){
                $newuom_input = 'PC';                
            }elseif($stockin->uom_input==='g'){
                $newuom_input = 'G';                
            }elseif($stockin->uom_input==='L'){
                $newuom_input = 'L';                
            }else{
                $newuom_input = '';
            }
            
            $stockin->uom_input=$newuom_input;
            $uom_master = MasterPart::where('rdms_part',$stockin->part)->first();
            if (!$uom_master){
                $newqty =0;
            }else{
                $value = RDMSConversion::where('uom_from',$newuom_input)->where('uom_to',$uom_master->sap_uom)->first();
            }
            
            if (!$value){
                $newqty =0;
            }else{
                $newqty = $stockin->qty_input * $value->value;
            }            
            $stockin->qty_konversi = $newqty;  

            $stockin->save();            
        }

        //seed MasterPart stock_in
        $count=MasterPart::all()->count();    
        for($i = 1; $i <= $count; $i++){
            $masterpart = MasterPart::find($i);  
            if(!$masterpart->rdms_part){
                $stockin=0;
            }else{                
                $stockin = RDMSStockInData::where('part',$masterpart->rdms_part)->sum('qty_konversi');
            }
            
            if(!$stockin){
                $masterpart->stock_in = 0;                
            }else{
                $masterpart->stock_in = $stockin;  
            }
            $masterpart->save();  
        }
        
        
    }
}
