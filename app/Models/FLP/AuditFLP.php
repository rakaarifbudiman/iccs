<?php

namespace App\Models\FLP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditFLP extends Model
{
    use HasFactory;
    
    protected $table = 'auditflps';
}