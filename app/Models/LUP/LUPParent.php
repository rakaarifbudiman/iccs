<?php

namespace App\Models\LUP;

use App\Models\User;
use App\Models\LUP\LUPFile;
use App\Models\LUP\AuditLUP;
use App\Models\LUP\LUPAction;
use App\Models\ICCS\RelatedUtility;
use App\Models\ICCS\RelatedDocument;
use App\Models\ICCS\RelatedMaterial;
use Illuminate\Support\Facades\Auth;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LUPParent extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $table = 'lup_parents';

    public function lupaction()
    {
        return $this->hasMany(LUPAction::class,'code', 'code');
    }
    public function relatedmaterial()
    {
        return $this->hasMany(RelatedMaterial::class,'code', 'code');
    }
    public function relatedutility()
    {
        return $this->hasMany(RelatedUtility::class,'code', 'code');
    }
    public function relateddocument()
    {
        return $this->hasMany(RelatedDocument::class,'code', 'code');
    }
    public function relateddepartment()
    {
        return $this->hasMany(RelatedDepartment::class,'code', 'code');
    }
    public function lupfile()
    {
        return $this->hasMany(LUPFile::class,'code', 'code');
    }
    public function auditlup()
    {
        return $this->hasMany(AuditLUP::class,'recordid', 'code')->orderBy('created_at','desc');
    }
    public function inisiators()
    {
        return $this->hasOne(User::class,'username','inisiator');
    }
    public function leaders()
    {
        return $this->hasOne(User::class,'username','leader');
    }
    public function reviewers()
    {
        return $this->hasOne(User::class,'username','reviewer');
    }
    public function reviewerqcjms()
    {
        return $this->hasOne(User::class,'username','reviewer2');
    }
    public function regulatory_reviewers()
    {
        return $this->hasOne(User::class,'username','regulatory_reviewer');
    }
    public function regulatory_approvers()
    {
        return $this->hasOne(User::class,'username','regulatory_approver');
    }
    public function approvers()
    {
        return $this->hasOne(User::class,'username','approver');
    }
    public function confirmers()
    {
        return $this->hasOne(User::class,'username','confirmer');
    }
    public function reviewers_closing()
    {
        return $this->hasOne(User::class,'username','reviewer_closing');
    }
    public function approvers_closing()
    {
        return $this->hasOne(User::class,'username','approver_closing');
    }
    public function cancel_requesters()
    {
        return $this->hasOne(User::class,'username','cancel_requester');
    }
    public function cancel_reviewers()
    {
        return $this->hasOne(User::class,'username','cancel_reviewer');
    }
    public function cancel_approvers()
    {
        return $this->hasOne(User::class,'username','cancel_approver');
    }
    public function closing_reviewers()
    {
        return $this->hasOne(User::class,'username','reviewer_closing');
    }
    public function closing_approvers()
    {
        return $this->hasOne(User::class,'username','approver_closing');
    }
    public function GetNewCodeAttribute()
    {
        $lastid = $this->where('year',date('y'))->max('code');
        $lastno = intval(substr($lastid,-5));             
        $code = "L". date('y'). sprintf("%05s", ($lastno==0 or $lastno==NULL) ? 1 : abs($lastno+1));    
       return $code;
    }
    public function GetNewNoLUPAttribute()
    {       
        $lastid = $this->where('nolup','like','LUP-%')
        ->where('year',date('y'))->max('nolup');
        $lastno = intval(substr($lastid,-4));             
        $code = "LUP-". date('y')."-". sprintf("%04s", ($lastno==0 or $lastno==NULL) ? 1 : abs($lastno+1));    
       return $code;
    }
    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }

    public function scopeOnLeader($query)
    {
        $query->where('leader',Auth::user()->username)
        ->where('datesign_leader',null);
    }
    public function scopeMyOnProcess($query)
    {
        $query->where('inisiator',Auth::user()->username)
        ->where('lupstatus','CREATE')
        ->orWhere(function($query) {
            $query->where('inisiator',Auth::user()->username)
                  ->where('lupstatus','ON PROCESS');
        });
    }
    public function scopeOnStatus($query,$status)
    {
        $query->where('lupstatus',$status);
    }   

}
