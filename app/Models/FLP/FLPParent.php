<?php

namespace App\Models\FLP;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FLPParent extends Model implements Auditable
{
    
    use HasFactory;
    protected $table = 'flpparents';
    protected $guarded =['id'];
    use \OwenIt\Auditing\Auditable;
    protected $auditExclude = [
        'id',      
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
