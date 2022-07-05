<?php

namespace App\Policies\LUP;

use App\Models\User;
use App\Models\LUP\LUPParent;
use App\Models\LUP\RelatedDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;

class RelatedDepartmentPolicy
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
    public function signrelateddepartment(User $user, RelatedDepartment $relateddepartment)
    {        
        $lup = LUPParent::where('code',$relateddepartment->code)->first();
        return ($lup->lupstatus=="ON REVIEW") 
            && !$relateddepartment->signdate && ($user->username == $relateddepartment->username)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                  
    }
    public function cancelsignrelateddepartment(User $user, RelatedDepartment $relateddepartment)
    {        
        $lup = LUPParent::where('code',$relateddepartment->code)->first();
        return ($lup->lupstatus=="ON REVIEW") 
            && $relateddepartment->signdate && ($user->username == $relateddepartment->username)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'You are not authorized' :  'LUP status is '.$lup->lupstatus));                  
    }
    public function deleterelateddepartment(User $user, RelatedDepartment $relateddepartment)
    {        
        $lup = LUPParent::where('code',$relateddepartment->code)->first();
        $disposisi = DB::table('related_departments')->where('code',$lup->code)->where('username',$user->username)->first();
        return ($lup->lupstatus=="ON REVIEW") 
            && !$relateddepartment->signdate && ($user->level >1 || $disposisi)
                ? Response::allow()
                    : Response::deny('Failed... '.($lup->lupstatus=="ON REVIEW" ? 'LUP has been signed' :  'LUP status is '.$lup->lupstatus));                  
    }
}
