<?php

namespace App\Models;

use App\Models\LUP\LUPParent;
use App\Models\ICCS\ICCSApproval;
use Laravel\Sanctum\HasApiTokens;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;
    
    
    
   	protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'level',
        'leader',
        'department',
        'grade',        
        'email',
        'active',
        'notes',
        'password',
        'unid',
        'last_seen'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function iccsapproval()
    {
        return $this->hasMany(ICCSApproval::class,'username', 'username');
    }
    public function relateddepartment()
    {
        return $this->hasMany(RelatedDepartment::class,'username', 'username');
    }

    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }




}
