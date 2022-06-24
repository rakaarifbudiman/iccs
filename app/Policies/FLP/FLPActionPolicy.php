<?php

namespace App\Policies\FLP;

use App\Models\FLP\FLPParent;
use App\Models\FLP\FLPAction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FLPActionPolicy
{
    use HandlesAuthorization;

    public function complete_duedate_action(User $user, FLPAction $flpactions)
    {
        
        return $flpactions->duedate_action
        ? Response::allow()
                : Response::deny('Failed... Sorry,  
                due date Action still empty');              
        
    }
    public function complete_evidence(User $user, FLPAction $flpactions)
    {
        
        return !$flpactions->dateapproved_evidence
        ? Response::allow()
                : Response::deny('Failed... Sorry,  
                this action has been closed');              
        
    }
    public function complete_pic_action(User $user, FLPAction $flpactions)
    {
        
        return $flpactions->pic_action
        ? Response::allow()
                : Response::deny('Failed... Sorry,  
               PIC Action still empty');              
        
    }
    public function signaction(User $user, FLPAction $flpactions)
    {
        
        $msg = 'Sorry, you do not have an authorization to sign this Action -> PIC : '. $flpactions->pic_action .' !';
        return $user->username == $flpactions->pic_action 
        ? Response::allow()
                : Response::deny($msg);              
        
    }
                
        
}
