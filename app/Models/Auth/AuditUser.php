<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditUser extends Model
{
    use HasFactory;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'change_by',
        'activity',
        'recordid',
        'sourcetable',
        'sourcefield',
        'beforevalue',        
        'aftervalue',        
        'notes',
        ];
        
}
