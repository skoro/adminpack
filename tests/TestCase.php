<?php

namespace Skoro\AdminPack\Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Skoro\AdminPack\AdminServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMix();

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => dirname(__DIR__) . '/database/migrations',
        ]);

        $this->withFactories(dirname(__DIR__) . '/database/factories');

        $this->artisan('admin:init')->run();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('admin.path', 'admin');
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminServiceProvider::class,
        ];
    }

    /**
     * Acting as 'admin' guard.
     *
     * @return $this
     */
    public function loginToAdmin(Authenticatable $user)
    {
        return $this->actingAs($user, 'admin');
    }
}