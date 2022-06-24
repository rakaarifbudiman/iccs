<?php

namespace App\Models\RDMS;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RDMSUom extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    protected $table = 'rdms_uoms';

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
