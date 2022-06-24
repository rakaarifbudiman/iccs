<?php

namespace App\Models\LUP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class LUPFile extends Model
{
    use HasFactory;
    protected $table = 'lupfiles';
    protected $guarded = [
        'id',];

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
    public function GetNewCodeAttribute()
    {
        $lastid = $this->where('code',$lup->code)->max('nofile');
        $lastno = intval(substr($lastid,-2));
        $code = $this->code.'-ATT-'. sprintf("%02s", ($lastno==0 or $lastno==NULL) ? 1 : abs($lastno+1));    
        return $code;
    }
}
