<?php

namespace Skoro\AdminPack;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Observers\ActivityLog;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('option', Repositories\OptionRepository::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->registerRoutes();
        $this->registerPublishing();
        $this->registerViewComponents();
        $this->registerMigrations();
        $this->registerFactories();
        $this->registerCommands();
        $this->registerMiddlewares();
        $this->registerBladeDirectives();
        $this->enableActivityLog();
    }

    /**
     * Registers the package publishable resources.
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/admin'),
            ], 'admin-views');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/admin'),
            ], 'admin-assets');

            $this->publishes([
                __DIR__ . '/../config/admin.php' => config_path('admin.php'),
            ], 'admin-config');
        }
    }

    /**
     * Registers the package migrations.
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * Registers the model factories.
     */
    private function registerFactories()
    {
        if ($this->app->runningInConsole()) {
            $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        }
    }

    /**
     * Registers the package 'artisan' console commands.
     */
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
     * Registers the package http middlewares.
     */
    private function registerMiddlewares()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app->make(Router::class);

        // Package middlewares.
        $router->aliasMiddleware('auth_admin', Http\Middleware\Authenticate::class);
        $router->aliasMiddleware('guest_admin', Http\Middleware\RedirectIfAuthenticated::class);
        $router->aliasMiddleware('active', Http\Middleware\ActiveUser::class);
    }

    /**
     * Registers the package Blade components.
     */
    private function registerViewComponents()
    {
        $this->loadViewComponentsAs('admin', [
            View\Components\Alert::class,
            View\Components\Button::class,
            View\Components\DeleteModel::class,
            View\Components\FormActions::class,
            View\Components\FormRow::class,
            View\Components\Icon::class,
            View\Components\Menu::class,
            View\Components\Submenu::class,
        ]);
    }

    /**
     * Registers the package routes.
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Gets the AdminPack route group configuration.
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'Skoro\AdminPack\Http\Controllers',
            'prefix' => config('admin.path', 'admin'),
            'middleware' => 'web',
        ];
    }

    /**
     * Registers the package new Blade directives.
     */
    private function registerBladeDirectives()
    {
        Blade::if('admincan', function ($abilities, $arguments = []) {
            if (empty($arguments)) {
                $arguments[] = User::class;
            }
            return auth_admin()->user()->can($abilities, $arguments);
        });

        Blade::if('admincanany', function ($abilities, $arguments = []) {
            $user = auth_admin()->user();
            if (empty($arguments)) {
                $arguments[] = User::class;
            }
            return app(Gate::class)->forUser($user)->any($abilities, $arguments);
        });
    }

    /**
     * Sets activity log handler for the admin models.
     */
    private function enableActivityLog()
    {
        // TODO: may be it better to add an config option for enabling
        // or disabling activity log ?
        Models\User::observe(ActivityLog::class);
        Models\Role::observe(ActivityLog::class);
    }
}
