<?php

namespace App\Policies\LUP;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\LUP\LUPParent;
use App\Models\LUP\LUPAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class LUPActionPolicy
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
    public function update(User $user, LUPAction $lupaction)
    {       
        
        return ($lupaction->lupparent->lupstatus=="APPROVED")             
            && (!$lupaction->signdate_action)
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->signdate_action ? 'This action has been signed':($lupaction->lupparent->lupstatus=="APPROVED" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus)));         
    }
    public function sign(User $user, LUPAction $lupaction)
    {       
        
        return ($lupaction->lupparent->lupstatus=="APPROVED")             
            && (!$lupaction->signdate_action) && ($user->username==$lupaction->pic_action)
                ? Response::allow()
                    : Response::deny('Failed....'. ($user->username<>$lupaction->pic_action ? 'You are not authorized to sign this action':($lupaction->signdate_action ? 'This action has been signed':($lupaction->lupparent->lupstatus=="APPROVED" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }
    public function cancelsign(User $user, LUPAction $lupaction)
    {                
        return ($lupaction->lupparent->lupstatus=="APPROVED")             
            && ($lupaction->signdate_action) && ($user->username==$lupaction->pic_action)
                ? Response::allow()
                    : Response::deny('Failed....'. ($user->username<>$lupaction->pic_action ? 'You are not authorized to sign this action':(!$lupaction->signdate_action ? 'This action has not been signed':($lupaction->lupparent->lupstatus=="APPROVED" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }
    public function upload(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && (!$lupaction->dateapproved_evidence) 
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->signdate_action ? 'This action has been signed':($lupaction->lupparent->lupstatus=="APPROVED" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus)));         
    }
    public function approvedevidence(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($user->level==2) && ($lupaction->actionstatus=="ON CLOSING" || $lupaction->actionstatus=="OPEN") && (!$lupaction->dateapproved_evidence)
                ? Response::allow()
                    : Response::deny('Failed....'. ($user->level==1 ? 'You are not authorized to sign this action':($lupaction->dateapproved_evidence ? 'This action has been closed':($lupaction->lupparent->lupstatus=="OPEN" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }
    public function extended(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($lupaction->actionstatus=="OPEN") && (!$lupaction->dateapproved_evidence) && ($lupaction->extension_count<2)
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->extension_count>1 ? 'This action had been extended for second times':($lupaction->dateapproved_evidence ? 'This action has been closed':($lupaction->lupparent->lupstatus=="OPEN" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }
    public function reviewextended(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($lupaction->actionstatus=="ON EXTENSION") && (!$lupaction->dateapproved_evidence) && ($lupaction->extension_count<2)
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->extension_count>1 ? 'This action had been extended for second times':($lupaction->dateapproved_evidence ? 'This action has been closed':($lupaction->lupparent->lupstatus=="OPEN" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }
    public function approvedextended(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($lupaction->actionstatus=="ON EXTENSION APPROVAL") && (!$lupaction->dateapproved_evidence) && ($lupaction->extension_count<2) && ($user->level>2)
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->extension_count==2 ? 'This action had been extended for second times':($lupaction->dateapproved_evidence ? 'This action has been closed':($lupaction->lupparent->lupstatus=="OPEN" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }

    public function rejectextended(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($lupaction->actionstatus=="ON EXTENSION" || $lupaction->actionstatus=="ON EXTENSION APPROVAL") && (!$lupaction->dateapproved_evidence) && ($lupaction->extension_count<2)
                ? Response::allow()
                    : Response::deny('Failed....'. ($lupaction->extension_count>1 ? 'This action had been extended for second times':($lupaction->dateapproved_evidence ? 'This action has been closed':($lupaction->lupparent->lupstatus=="OPEN" ?  : 'LUP status is '.$lupaction->lupparent->lupstatus))));         
    }

    public function requestcancelaction(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($user->level==2 || $lupaction->pic_action) && ($lupaction->actionstatus=="OPEN")
                ? Response::allow()
                    : Response::deny('Failed....You are not authorized');         
    }

    public function approvedcancelaction(User $user, LUPAction $lupaction)
    {               
        return ($lupaction->lupparent->lupstatus=="OPEN")             
            && ($lupaction->signdate_action) && ($user->level==2) && ($lupaction->actionstatus=="ON CANCEL") && ($lupaction->cancel_duedate_notes)
                ? Response::allow()
                    : Response::deny('Failed....You are not authorized');         
    }
        
     
   
}
