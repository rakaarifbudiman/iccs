<?php

namespace App\Models\FLP;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FLPAction extends Model implements Auditable
{
    use HasFactory;
    protected $table = 'flpactions';
    protected $guarded = [
        'id',
        'longtext1',
        'longtext2',
        'longtext3',
        'text1',
        'text2',        
        'date1', 
        'date2',
        'date3', 
        'date4',   ];

    use \OwenIt\Auditing\Auditable;
    protected $auditExclude = [
        'id',  
        'longtext1',
        'longtext2',
        'longtext3',
        'text1',
        'text2',        
        'date1', 
        'date2',
        'date3', 
        'date4',       
    ];

    public function generateTags(): array
    {
        return [
            $this->code,
            
        ];
    }

    public function getStatusAttribute()
    {
        $date1 = strtotime(now());
        $date2 = strtotime($this->duedate_action,null);
        $datediff =round(($date2-$date1)/(60*60*24),0);
                    
                    if($datediff<8 AND !$this->dateapproved_evidence){
                            $statusaction = "OVERDUE";
                    }else{
                        $statusaction = $this->actionstatus;
                    }
    return $statusaction;
    }

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
