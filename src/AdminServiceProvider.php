<?php

namespace Skoro\AdminPack;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('option', Models\Option::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->registerMigrations();
        $this->registerCommands();
        $this->registerMiddleware(Http\Middleware\RegisterIsEnabled::class);
    }

    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AdminInit::class,
                Console\OptionGet::class,
                Console\OptionList::class,
                Console\OptionSet::class,
                Console\OptionDelete::class,
            ]);
        }
    }

    /**
     * Register the package middleware.
     *
     * @param string $middleware The middleware class name.
     */
    private function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}
