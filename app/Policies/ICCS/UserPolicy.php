<?php

namespace App\Policies\ICCS;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    public function update(User $user, User $users)
    {                             
        return ($user->level>1 || $user->username==$users->username)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }
    public function changepassword(User $user, User $users)
    {                             
        return ($user->username==$users->username)
                ? Response::allow()
                    : Response::deny('Failed... You are not authorized ');                  
    }
}
