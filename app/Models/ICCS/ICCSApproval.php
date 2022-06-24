<?php

namespace App\Models\ICCS;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ICCSApproval extends Model
{
    use HasFactory;
    
    protected $guarded =['id'];
    protected $table = 'approvals';

    public function user(){
        return $this->belongsTo(User::class,'username', 'username');
    }

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }
}
