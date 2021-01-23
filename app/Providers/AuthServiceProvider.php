<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('AdministradorSistema', function ($user) {
            return $user->role_id == '1';
        });
        Gate::define('AdministradorGeneral', function ($user) {
            return $user->role_id == '2';
        });
        Gate::define('ResponsableFinanzas', function ($user) {
            return $user->role_id == '3';
        });
        Gate::define('ResponsableÁrea', function ($user) {
            return $user->role_id == '4';
        });
    }
}
