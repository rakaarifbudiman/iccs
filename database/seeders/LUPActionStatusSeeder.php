<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;

class LUPActionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

//change old status action        
$lupactions=LUPAction::all();
        
        foreach($lupactions as $lupaction){       
        
        $lup = LUPParent::where('code',$lupaction->code)->first()->lupstatus;
        
            if($lup=="OPEN" AND $lupaction->duedate_status==1 AND $lupaction->deletion_flag==0){
                
                if ($lupaction->evidence_filename){
                    if ($lupaction->evidence_approver){
                        $statusaction = "CLOSED";                    
                    }else{
                        $statusaction = "OPEN" ;
                    }
                }else{
                    $statusaction = "OPEN" ;
                }
            }
            if($lup=="OPEN" AND $lupaction->duedate_status==0 AND $lupaction->deletion_flag==0){              
                
                    $statusaction = "ON EXTENSION" ;
                
            }
            if($lup=="OPEN" AND $lupaction->duedate_status==1 AND $lupaction->deletion_flag==1){              
                
                $statusaction = "CANCEL" ;
            
            }
            if($lup=="CANCEL"){               
                
                $statusaction = "CANCEL" ;
           
            }  
            if($lup=="CREATE" || $lup=="ON PROCESS" || $lup=="ON REVIEW" || $lup=="ON APPROVAL"){               
                
                    $statusaction = null ;
               
            }  
        
        if(!$lupaction->signdate_action){
            $lupaction->created_at = \Carbon\Carbon::now(); 
        }else{
            $lupaction->sign_type='User';
            $lupaction->created_at = $lupaction->signdate_action; 
        }
               
        $lupaction->actionstatus = $statusaction;

        $lupaction->save();
        }
    }
}