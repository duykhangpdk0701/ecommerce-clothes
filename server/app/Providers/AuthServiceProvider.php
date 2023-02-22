<?php

namespace App\Providers;

use App\Acl\Acl;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Acl::ROLE_SUPER_ADMIN) ? true : null;
        });
        if (App::runningInConsole() && !App::environment('testing')) {
            return;
        }
    }
}
