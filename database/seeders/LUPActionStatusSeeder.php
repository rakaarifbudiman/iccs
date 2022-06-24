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
        $count=LUPAction::all()->count();
        
        for($i = 1; $i <= $count; $i++){        
        $lupactions = LUPAction::find($i);
        $lup = LUPParent::where('code',$lupactions->code)->first()->lupstatus;
        
            if($lup=="OPEN" AND $lupactions->duedate_status==1 AND $lupactions->deletion_flag==0){
                
                if ($lupactions->evidence_filename){
                    if ($lupactions->evidence_approver){
                        $statusaction = "CLOSED";                    
                    }else{
                        $statusaction = "OPEN" ;
                    }
                }else{
                    $statusaction = "OPEN" ;
                }
            }
            if($lup=="OPEN" AND $lupactions->duedate_status==0 AND $lupactions->deletion_flag==0){              
                
                    $statusaction = "ON EXTENSION" ;
                
            }
            if($lup=="OPEN" AND $lupactions->duedate_status==1 AND $lupactions->deletion_flag==1){              
                
                $statusaction = "CANCEL" ;
            
            }
            if($lup=="CANCEL"){               
                
                $statusaction = "CANCEL" ;
           
            }  
            if($lup=="CREATE" || $lup=="ON PROCESS" || $lup=="ON REVIEW" || $lup=="ON APPROVAL"){               
                
                    $statusaction = null ;
               
            }  
        
        if(!$lupactions->signdate_action){
            $lupactions->created_at = \Carbon\Carbon::now(); 
        }else{
            $lupactions->sign_type='User';
            $lupactions->created_at = $lupactions->signdate_action; 
        }
               
        $lupactions->actionstatus = $statusaction;

        $lupactions->save();
        }
    }
}