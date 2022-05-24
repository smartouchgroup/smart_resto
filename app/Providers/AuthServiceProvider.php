<?php

namespace App\Providers;

use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Define gates for differents users

        Gate::define('admin', function(User $user) {
            return in_array($user->roleId, [1, 2]);
        });

        Gate::define('restaurant', function(User $user) {
            return (int) $user->roleId === 4;
        });

        Gate::define('organization', function(User $user) {
            return (int) $user->roleId === 3;
        });
    }
}
