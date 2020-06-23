<?php

namespace Skoro\AdminPack;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
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
    }
}