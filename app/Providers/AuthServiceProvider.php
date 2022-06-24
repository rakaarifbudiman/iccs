<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\FLPAction;
use App\Policies\FLPParent;
use App\Models\LUP\LUPAction;
use App\Models\LUP\LUPParent;
use Illuminate\Support\Facades\Gate;
use App\Models\LUP\RelatedDepartment;
use App\Policies\LUP\LUPActionPolicy;
use App\Policies\LUP\LUPParentPolicy;
use App\Policies\LUP\RelatedDepartmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        LUPParent::class => LUPParentPolicy::class,  
        LUPAction::class => LUPActionPolicy::class,            
        RelatedDepartment::class => RelatedDepartmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
