<?php

namespace App\Models\ICCS;

use App\Models\LUP\LUPParent;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelatedUtility extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function lupparent()
    {
        return $this->belongsTo(LUPParent::class,'code', 'code');
    }

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
