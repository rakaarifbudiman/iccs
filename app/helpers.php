<?php
use App\Models\LUP\LUPParent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LUP\LUPAction;

function auditparts($masterpart,$change_by,$activity,$recordid,$table,$field,$before,$after){      
    
                DB::table('rdms_be.audit_parts')->insert([  
                    'created_at'=>now(),
                    'change_by'=>$change_by,
                    'activity'=>$activity,
                    'recordid' => $recordid,
                    'sourcetable' => $table,
                    'sourcefield' => $field,
                    'beforevalue' => $before,
                    'aftervalue' => $after,
                ]);    
}

function auditusers($user,$change_by,$activity,$recordid,$table,$field,$before,$after){      
    
    DB::table('iccs_be.auditusers')->insert([  
        'created_at'=>now(),
        'change_by'=>$change_by,
        'activity'=>$activity,
        'recordid' => $recordid,
        'sourcetable' => $table,
        'sourcefield' => $field,
        'beforevalue' => $before,
        'aftervalue' => $after,
    ]);    
}
   
function auditflps($flpparents,$change_by,$activity,$recordid,$table,$field,$before,$after){      
    
    DB::table('iccs_be.auditflps')->insert([  
        'created_at'=>now(),
        'change_by'=>$change_by,
        'activity'=>$activity,
        'recordid' => $recordid,
        'sourcetable' => $table,
        'sourcefield' => $field,
        'beforevalue' => $before,
        'aftervalue' => $after,
    ]); 
}

function auditlups($lupparents,$change_by,$activity,$recordid,$table,$field,$before,$after){      
    
    DB::table('iccs_be.auditlups')->insert([  
        'created_at'=>now(),
        'change_by'=>$change_by,
        'activity'=>$activity,
        'recordid' => $recordid,
        'sourcetable' => $table,
        'sourcefield' => $field,
        'beforevalue' => $before,
        'aftervalue' => $after,
    ]); 
}

function lupallstatusactions( $lupparents){
    $date1 = strtotime(now());    
    $count=$lupparents->count();
    if(!$count){
        $statusaction="";
    }else{
        for ($i=0; $i < $count ; $i++) {
            // get status action                
                $date2 = strtotime($lupparents[$i]->duedate_action ?:'');
                $datediff =round(($date2-$date1)/(60*60*24),0);
                
                if($datediff<8 AND !$lupparents[$i]->dateapproved_evidence AND $lupparents[$i]->nolup AND $lupparents[$i]->actionstatus=="OPEN" AND $lupparents[$i]->signdate_action){
                        $statusaction[] = "OVERDUE";
                }else{
                    $statusaction []= $lupparents[$i]->actionstatus;
                }                  
        }
    }   
    return $statusaction;
}


                


    