<?php

namespace App\Models\RDMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditPart extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
}
