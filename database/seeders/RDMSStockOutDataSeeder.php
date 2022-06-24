<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RDMS\RDMSStockOutData;
use App\Models\RDMS\MasterPart;
use App\Models\RDMS\RDMSConversion;

class RDMSStockOutDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.stock_out_data (transaction_id,
        formula_no,
        part,
        batch,        
        qty_out,
        uom_out,
        qty_unit,        
        notes       
        )
    SELECT IDStockOut,NoFormula,PartNo,NoBatch,QtyOut,UomOut,QtyPerUnit,AddNote
    FROM old_iccs.old_rdms_stock_out_data";
    $result = DB::select(DB::raw($sqlquery));
    $count=RDMSStockoutData::all()->count();
        
        for($i = 1; $i <= $count; $i++){
        
            $stockout = RDMSStockoutData::find($i);    
            
            if($stockout->uom_out=='gr'){
                $newuom_out = 'G';
            }elseif($stockout->uom_out==='Kg'){
                $newuom_out = 'KG';                
            }elseif($stockout->uom_out==='mg'){
                $newuom_out = 'MG';                
            }elseif($stockout->uom_out==='mL'){
                $newuom_out = 'ML';                
            }elseif($stockout->uom_out==='mcg'){
                $newuom_out = 'mcg';                
            }elseif($stockout->uom_out==='Pcs'){
                $newuom_out = 'PC';                
            }elseif($stockout->uom_out==='g'){
                $newuom_out = 'G';                
            }elseif($stockout->uom_out==='L'){
                $newuom_out = 'L';                
            }else{
                $newuom_out='';
            }
            $stockout->uom_out=$newuom_out;
            $uom_master = MasterPart::where('rdms_part',$stockout->part)->first();
            if (!$uom_master){
                $newqty =0;
            }else{
                $value = RDMSConversion::where('uom_from',$newuom_out)->where('uom_to',$uom_master->sap_uom)->first();
            }
            
            if (!$value){
                $newqty =0;
            }else{
                $newqty = $stockout->qty_out * $value->value;
            }            
            $stockout->qty_konversi = $newqty;
            $stockout->save();
        }

        //seed MasterPart stock_out
        $count=MasterPart::all()->count();    
        for($i = 1; $i <= $count; $i++){
            $masterpart = MasterPart::find($i);  
            if(!$masterpart->rdms_part){
                $stockout=0;
            }else{                
                $stockout = RDMSStockoutData::where('part',$masterpart->rdms_part)->sum('qty_konversi');
            }
            
            if(!$stockout){
                $masterpart->stock_out = 0;                
            }else{
                $masterpart->stock_out = $stockout;  
            }
            $masterpart->save();  
        }

        //seed MasterPart total_stock
        $count=MasterPart::all()->count();    
        for($i = 1; $i <= $count; $i++){
            $masterpart = MasterPart::find($i);  
            $totalstock = $masterpart->stock_in - $masterpart->stock_out;
            $masterpart->totalstock = $totalstock;
            $masterpart->save();  
        }

    }
}
