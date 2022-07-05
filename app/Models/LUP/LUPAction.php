<?php

namespace App\Models\LUP;

use App\Models\User;
use App\Models\LUP\LUPParent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LUPAction extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $table ='lup_actions';

    public function lupparent()
    {
        return $this->belongsTo(LUPParent::class,'code', 'code');
    }
    public function pic()
    {
        return $this->hasOne(User::class,'username','pic_action');
    }
    public function evidence_uploaders()
    {
        return $this->hasOne(User::class,'username','evidence_uploader');
    }
    public function evidence_approvers()
    {
        return $this->hasOne(User::class,'username','evidence_approver');
    }
    public function pic_extensions()
    {
        return $this->hasOne(User::class,'username','pic_extension');
    }
    public function reviewers_extension()
    {
        return $this->hasOne(User::class,'username','reviewer_extension');
    }
    public function approvers_extension()
    {
        return $this->hasOne(User::class,'username','approver_extension');
    }
    public function GetStatusActionAttribute()
    {
        $date1 = strtotime(\Carbon\Carbon::now());   
        $date2 = strtotime($this->duedate_action);
        $datediff =round(($date2-$date1)/(60*60*24),0);
       return ($datediff<8 AND !$this->dateapproved_evidence AND $this->lupparent->nolup AND $this->actionstatus=="OPEN" AND $this->lupparent->lupstatus=="OPEN" AND $this->signdate_action) ? "OVERDUE" : $this->actionstatus;
    }
    public function GetHashIDAttribute()
    {
        $encrypt = Crypt::encryptString($this->id);
        return $encrypt;
    }

    public function scopeStatus($query,$status)
    {
        $query->where('actionstatus',$status);
    }

    public function scopeOverdue($query)
    {
        $query->where('actionstatus','OPEN')
            ->where('evidence_filename',null)  
            ->where('signdate_action','<>',null)         
            ->whereDate('duedate_action','<',now()->addDays(8)); 
    }
    public function scopeOverdueThisMonth($query)
    {
        $query->where('actionstatus','OPEN')
            ->where('evidence_filename',null)  
            ->where('signdate_action','<>',null)         
            ->whereMonth('duedate_action',Carbon::today()->month);     
    }
}
