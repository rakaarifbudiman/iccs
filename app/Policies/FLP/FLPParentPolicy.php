<?php

namespace App\Policies\FLP;

use App\Models\FLP\FLPParent;
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

    public function signflpstatus_user(User $user, FLPParent $flp)
    {
        
        return $flp->flpstatus =="CREATE" ||$flp->flpstatus =="ON PROCESS"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is already '.$flp->flpstatus);          
        
    }
    public function flpstatus_onprocess(User $user, FLPParent $flp)
    {
        
        return $flp->flpstatus =="ON PROCESS"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON PROCESS');          
        
    }  
    public function flpstatus_onreview(User $user, FLPParent $flp)
    {
        
        return $flp->flpstatus =="ON REVIEW"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON REVIEW');          
        
    }  
    public function flpstatus_onapproval(User $user, FLPParent $flp)
    {
        
        return $flp->flpstatus =="ON APPROVAL"
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP status is must be ON APPROVAL');          
        
    }  
    public function flpstatus_approved(User $user, FLPParent $flp)
    {
        
        return $flp->dateapproved==null
                ? Response::allow()
                    : Response::deny('Failed...Sorry, FLP is already Approved');          
        
    }

    public function signinisiator(User $user, FLPParent $flp)
    {
        
                return ($user->username == $flp->inisiator AND $flp->flpstatus =="CREATE") ||
                    ($user->username == $flp->inisiator AND $flp->flpstatus =="ON PROCESS")
                ? Response::allow()
                        : Response::deny('Sorry, you do not have an authorization to sign this -> PIC : '.$flp->inisiator);          
        
    }
    public function signleader(User $user, FLPParent $flp)
    {
        
        return ($user->username == $flp->leader) AND (!$flp->datesign_leader)
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to sign this ! OR FLP already signed -> PIC : '.$flp->leader);  
    }
    public function signleader_complete(User $user, FLPParent $flp)
    {
        return !$flp->datesign_leader
        ? Response::allow()
                : Response::deny('Failed...Sorry, FLP already signed...');        
       
    }
    public function cancelsignleader(User $user, FLPParent $flp)
    {
        return $user->username == $flp->leader
        ? Response::allow()
            : Response::deny('Sorry, you do not have an authorization to sign this -> PIC : '.$flp->leader);  
        
              
    }

    public function updateleader(User $user, FLPParent $flp)
    {
      
        return !$flp->datesign_leader
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to update Leader !');  
    }


    public function signreviewer(User $user, FLPParent $flp)
    {
      
        return $user->level >1 || $flp->flpstatus =="ON REVIEW"
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to sign this !');  
    }

    public function updateapprover(User $user, FLPParent $flp)
    {
      
        return $user->level >1
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to update Approver !');  
    }

    public function approvedflp(User $user, FLPParent $flp)
    {
      
        return ($user->level ==3 && $flp->flpstatus =='ON APPROVAL'
        && $user->username == $flp->approver) 
        ? Response::allow()
                : Response::deny('Sorry, you do not have an authorization to this perform !');  
    }
    public function flpcomplete(User $user, FLPParent $flp)
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
