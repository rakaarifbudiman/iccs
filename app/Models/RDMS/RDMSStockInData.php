<?php

namespace App\Models\RDMS;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RDMSStockInData extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    protected $table = 'stock_in_data';
    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
