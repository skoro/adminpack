<?php

namespace Skoro\AdminPack;

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
        \Skoro\AdminPack\Models\User::class => \Skoro\AdminPack\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $this->app['config'];

        $config->set('auth.guards.admin', [
            'driver' => 'session',
            'provider' => 'admin_users',
        ]);
        $config->set('auth.providers.admin_users', [
            'driver' => 'eloquent',
            'model' => \Skoro\AdminPack\Models\User::class,
        ]);

        $this->registerPolicies();

        Gate::define('manageRoles', 'Skoro\AdminPack\Policies\UserPolicy@manageRoles');
        Gate::define('manageOptions', 'Skoro\AdminPack\Policies\UserPolicy@manageOptions');
        Gate::define('viewActions', 'Skoro\AdminPack\Policies\UserPolicy@viewActions');
    }
}