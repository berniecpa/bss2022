<?php

namespace App\Providers;

use Doctrine\DBAL\Exception\RetryableException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Give access to Super Admin for every permission
        Gate::before(function ($user, $ability){
            return $user->hasRole('super_admin') ? true : null;
        });
    }
}
