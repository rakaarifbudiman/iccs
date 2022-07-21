<?php

namespace App\Policies\FLP;

use App\Models\LUP\LUPParent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FLPParentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LUPParent $flp)
    {                           
        if($flp->lupstatus=="OPEN"){
            return ($flp->lupstatus=="OPEN") 
            && ($user->level >1)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized update this data');       
        }else{
            return ($flp->lupstatus=="CREATE" || $flp->lupstatus=="ON PROCESS" || $flp->lupstatus=="ON REVIEW" || $flp->lupstatus=="ON APPROVAL") 
            && ($user->username == $flp->inisiator || $user->username == $flp->leader || $user->level >1)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized update this data');        
        }         
    }
    public function signflpstatus_user(User $user, LUPParent $flp)
    {
        
        return $flp->lupstatus =="CREATE" ||$flp->lupstatus =="ON PROCESS"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is already '.$flp->lupstatus);          
        
    }
    public function flpstatus_onprocess(User $user, LUPParent $flp)
    {
        
        return $flp->lupstatus =="ON PROCESS"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON PROCESS');          
        
    }  
    public function flpstatus_onreview(User $user, LUPParent $flp)
    {
        
        return $flp->lupstatus =="ON REVIEW"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON REVIEW');          
        
    }  
    public function flpstatus_onapproval(User $user, LUPParent $flp)
    {
        
        return $flp->lupstatus =="ON APPROVAL"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON APPROVAL');          
        
    }  
    public function flpstatus_approved(User $user, LUPParent $flp)
    {
        
        return $flp->dateapproved==null
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP is already Approved');          
        
    }

    public function signinisiator(User $user, LUPParent $flp)
    {
        
                return ($user->username == $flp->inisiator AND $flp->lupstatus =="CREATE") ||
                    ($user->username == $flp->inisiator AND $flp->lupstatus =="ON PROCESS")
                ? Response::allow()
                        : Response::deny('Sorry, you do not have an authorization to sign this -> PIC : '.$flp->inisiator);          
        
    }
    public function signleader(User $user, LUPParent $flp)
    {
        
        return ($user->username == $flp->leader) AND (!$flp->datesign_leader)
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to sign this ! OR FLP already signed -> PIC : '.$flp->leader);  
    }
    public function signleader_complete(User $user, LUPParent $flp)
    {
        return !$flp->datesign_leader
        ? Response::allow()
                : Response::deny('Failed...Sorry, FLP already signed...');        
       
    }
    public function cancelsignleader(User $user, LUPParent $flp)
    {
        return $user->username == $flp->leader
        ? Response::allow()
            : Response::deny('Sorry, you do not have an authorization to sign this -> PIC : '.$flp->leader);  
        
              
    }

    public function updateleader(User $user, LUPParent $flp)
    {
      
        return !$flp->datesign_leader
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to update Leader !');  
    }


    public function signreviewer(User $user, LUPParent $flp)
    {
      
        return $user->level >1 || $flp->lupstatus =="ON REVIEW"
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to sign this !');  
    }

    public function updateapprover(User $user, LUPParent $flp)
    {
      
        return $user->level >1
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to update Approver !');  
    }

    public function approvedflp(User $user, LUPParent $flp)
    {
      
        return ($user->level ==3 && $flp->lupstatus =='ON APPROVAL'
        && $user->username == $flp->approver) 
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to this perform !');  
    }
    public function flpcomplete(User $user, LUPParent $flp)
    {
            //check completeness 
            $flpactions = DB::table('flpactions')
            ->where('code',$flp->code)
            ->get();        
            if (!$flp->datesign_inisiator  || !$flp->datesign_leader){
                $inisiatorcomplete="Incomplete";
            }else{
                $inisiatorcomplete="Complete";
            }        
            $count = $flpactions->count();         
            $countactionincomplete = $flpactions->where('signdate_action',null)->count();       
            
            
            if($count>0 && $countactionincomplete==0){
                $actioncomplete = "Complete";            
            }else{
                $actioncomplete = "Incomplete";
            }
        return $inisiatorcomplete=="Complete" && $actioncomplete == "Complete"          
            ? Response::allow()
                : Response::deny('Sorry, FLP Status is incomplete (Inisiator : '.$inisiatorcomplete.' & Action : '.$actioncomplete.')');  
        
       
        
    }

}
