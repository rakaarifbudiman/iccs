<?php

namespace App\Models\FLP;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FLPFile extends Model implements Auditable
{
    use HasFactory;
    protected $table = 'flpfiles';
    protected $guarded = [
        'id',];
    
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

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
