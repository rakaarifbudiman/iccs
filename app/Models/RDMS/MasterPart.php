<?php

namespace App\Models\RDMS;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterPart extends Model implements Auditable
{
    use HasFactory;
    
    use \OwenIt\Auditing\Auditable;
    protected $connection = 'mysql2';
    protected $guarded = [
        'id',
        '_token',
        '_method',
         ];
    
         protected $auditEvents = [
             'created',
            'deleted',
            'restored',
        ];     
        protected $auditExclude = [
            'id',      
        ];
    public function generateTags(): array
    {
        return [
            $this->rdms_part,
            
        ];
    }

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
