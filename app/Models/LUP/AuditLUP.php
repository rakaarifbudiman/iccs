<?php

namespace App\Models\LUP;

use App\Models\LUP\LUPParent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLUP extends Model
{ 
    use HasFactory;
    
    protected $table = 'auditlups';
    public function lupparent()
    {
        return $this->belongsTo(LUPParent::class,'recordid', 'code');
    }
}
