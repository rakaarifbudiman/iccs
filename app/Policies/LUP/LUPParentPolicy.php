<?php

namespace App\Policies\LUP;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\LUP\LUPParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class LUPParentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, LUPParent $lup)
    {                   
        $disposisi = DB::table('related_departments')->where('code',$lup->code)->where('username',$user->username)->first();
        if($lup->lupstatus=="OPEN"){
            return ($lup->lupstatus=="OPEN") 
            && ($user->level >1)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized update this data');       
        }else{
            return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS" || $lup->lupstatus=="ON REVIEW" || $lup->lupstatus=="ON APPROVAL") 
            && ($user->username == $lup->inisiator || $user->username == $lup->leader || $user->username == $lup->regulatory_reviewer || 
            $user->username == $lup->regulatory_approver || $user->level >1 || $disposisi)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized update this data');        
        }         
    }
    public function signinisiator(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") 
            && $lup->documentname<>null && $lup->lup_type<>null && $lup->duedate_type<>null
            && $lup->duedate_start<>null && $lup->lup_current<>null && $lup->lup_proposed<>null && $lup->lup_reason<>null 
            && $lup->categorization<>null && $lup->risk_assestment<>null
            && !$lup->datesign_inisiator && $user->username == $lup->inisiator
                ? Response::allow()
                    : Response::deny('Failed... '.  (($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") ? 'You are not authorized ' :  'LUP status is already '.$lup->lupstatus));                  
    }
    public function cancelsigninisiator(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") 
            && $lup->datesign_inisiator && $user->username == $lup->inisiator
                ? Response::allow()
                    : Response::deny('Failed... '.  (($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") ? 'You are not authorized ' :  'LUP status is already '.$lup->lupstatus));                  
    }
    public function signleader(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") 
            && $lup->documentname<>null && $lup->lup_type<>null && $lup->duedate_type<>null
            && $lup->duedate_start<>null && $lup->lup_current<>null && $lup->lup_proposed<>null && $lup->lup_reason<>null 
            && $lup->categorization<>null && $lup->risk_assestment<>null
            && !$lup->datesign_leader && $user->username == $lup->leader
                ? Response::allow()
                    : Response::deny('Failed... '.  (($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") ? 'You are not authorized ' :  'LUP status is already '.$lup->lupstatus));                  
    }
    public function cancelsignleader(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") 
            && $lup->datesign_leader && $user->username == $lup->leader
                ? Response::allow()
                    : Response::deny('Failed... '.  (($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") ? 'You are not authorized ' :  'LUP status is already '.$lup->lupstatus));                  
    }
    public function updateleader(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") 
            && !$lup->datesign_leader && ($user->username == $lup->leader || $user->username == $lup->inisiator || $user->level >1)
                ? Response::allow()
                    : Response::deny('Failed... '.  (($lup->lupstatus=="CREATE" || $lup->lupstatus=="ON PROCESS") ? 'You are not authorized ' :  'LUP status is already '.$lup->lupstatus));                  
    }
    public function signregulatoryreviewer(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && !$lup->datesubmit_regulatory_approver && ($user->username == $lup->regulatory_reviewer)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                    
    }
    public function updateregulatoryreviewer(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && !$lup->datesubmit_regulatory_approver && ($user->username == $lup->leader || $user->username == $lup->inisiator || $user->level >1 || $user->department=='Regulatory')
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                  
    }
    public function cancelsignregulatoryreviewer(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && $lup->datesubmit_regulatory_approver && ($user->username == $lup->regulatory_reviewer)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                
    }
    public function signregulatoryapprover(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && !$lup->datesign_regulatory_approver && ($user->username == $lup->regulatory_approver)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                
    }
    public function updateregulatoryapprover(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && !$lup->datesign_regulatory_approver && ($user->username == $lup->leader || $user->username == $lup->inisiator || $user->level >1 || $user->department=='Regulatory')
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                     
    }
    public function cancelsignregulatoryapprover(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON REVIEW") 
            && $lup->datesign_regulatory_approver && ($user->username == $lup->regulatory_reviewer)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                  
    }
    public function signreviewerqse(User $user, LUPParent $lup)
    {        
        return ($lup->lupstatus=="ON PROCESS" && $lup->documentname<>null && $lup->lup_type<>null && $lup->duedate_type<>null
            && $lup->duedate_start<>null && $lup->lup_current<>null && $lup->lup_proposed<>null && $lup->lup_reason<>null 
            && $lup->categorization<>null) && $lup->risk_assestment<>null
            && !$lup->datesubmit_reviewer2 && $user->level >1
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON PROCESS" ? 'You are not authorized ' :  'LUP status is '.$lup->lupstatus));                  
    }

    public function signreviewerqcjm(User $user, LUPParent $lup)
    {        

        $disposisi = $lup->relateddepartment->where('signdate',null)->count();
        return ($lup->lupstatus=="ON REVIEW") 
            && (!$lup->datesubmit_approver) && ($lup->datesubmit_reviewer2) && ($lup->reviewer2) && ($user->level >2) && ($disposisi<1)
                ? Response::allow()
                    : Response::deny('Failed... '.($disposisi>0 ? 'Related Departments sign has not been complete' :($lup->lupstatus==="ON REVIEW" ? 'You are not authorized ' :  'LUP status is '.$lup->lupstatus)));                  
    }

    public function signapprover(User $user, LUPParent $lup)
    {                
        return ($lup->lupstatus=="ON APPROVAL") 
            && (!$lup->dateapproved) && ($lup->datesubmit_approver) && ($user->level ==3) 
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->dateapproved ? 'LUP has been approved' :($lup->lupstatus==="ON APPROVAL" ? 'You are not authorized ' :  'LUP status is '.$lup->lupstatus)));                  
    }

    public function confirmedlup(User $user, LUPParent $lup)
    {                
        $action = $lup->lupaction->where('signdate_action',null)->count();
        return ($lup->lupstatus=="APPROVED") 
            && (!$lup->dateconfirmed) && ($lup->dateapproved) && ($user->level ==3) && ($action<1)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->dateconfirmed ? 'LUP has been confirmed' :($lup->lupstatus==="APPROVED" ? 'You are not authorized ' :  'LUP status is '.$lup->lupstatus)));                  
    }

    public function requestcancel(User $user, LUPParent $lup)
    {                  
        return ($lup->lupstatus != "CANCEL" AND $lup->lupstatus != "ON CANCEL" AND $lup->lupstatus != "ON CANCEL APPROVAL") 
            && ($user->level >1 || $user->username==$lup->inisiator)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized');     
       
    }
    public function reviewcancel(User $user, LUPParent $lup)
    {                  
        return ($lup->lupstatus == "ON CANCEL") 
            && ($user->level==2)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized');     
       
    }
    public function approvedcancel(User $user, LUPParent $lup)
    {                  
        return ($lup->lupstatus == "ON CANCEL APPROVAL") 
            && ($user->level==3)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized');       
    }

    public function requestclosinglup(User $user, LUPParent $lup)
    {                
        $action = $lup->lupaction->where('actionstatus','<>','CLOSED')->where('actionstatus','<>','CANCEL')->count();        
        return ($lup->lupstatus=="OPEN") 
            && ($user->level ==2) && ($action<1)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }

    public function closinglup(User $user, LUPParent $lup)
    {                
        $action = $lup->lupaction->where('actionstatus','<>','CLOSED')->where('actionstatus','<>','CANCEL')->count();        
        return ($lup->lupstatus=="ON CLOSING") 
            && ($user->level ==3) && ($action<1)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }
    public function displayclosinglup(User $user, LUPParent $lup)
    {                
        return ($lup->lupstatus=="ON CLOSING" || $lup->lupstatus=="CLOSED")             
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }

    public function rollback(User $user, LUPParent $lup)
    {                
        return ($lup->lupstatus=="OPEN") && ($user->level ==3)             
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }


}
