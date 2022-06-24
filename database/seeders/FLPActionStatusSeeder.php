<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FLP\FLPAction;
use App\Models\FLP\FLPParent;

class FLPActionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

//change old status action        
        $count=FLPaction::all()->count();
        
        for($i = 1; $i <= $count; $i++){        
        $flpactions = FLPAction::find($i);
        $flp = FLPParent::where('code',$flpactions->code)->first()->flpstatus;
        
            if($flp=="OPEN" AND $flpactions->duedate_status==1 AND $flpactions->deletion_flag==0){
                
                if ($flpactions->evidence_filename){
                    if ($flpactions->evidence_approver){
                        $statusaction = "CLOSED";                    
                    }else{
                        $statusaction = "OPEN" ;
                    }
                }else{
                    $statusaction = "OPEN" ;
                }
            }
            if($flp=="OPEN" AND $flpactions->duedate_status==0 AND $flpactions->deletion_flag==0){              
                
                    $statusaction = "ON EXTENSION" ;
                
            }
            if($flp=="OPEN" AND $flpactions->duedate_status==1 AND $flpactions->deletion_flag==1){              
                
                $statusaction = "CANCEL" ;
            
            }
            if($flp=="CANCEL"){
                
                
                $statusaction = "CANCEL" ;
           
        }  
            if($flp=="CREATE" || $flp=="ON PROCESS" || $flp=="ON REVIEW" || $flp=="ON APPROVAL"){
                
                
                    $statusaction = null ;
               
            }  

               
        $flpactions->actionstatus = $statusaction;

        $flpactions->save();
        }
    }
}