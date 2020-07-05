<?php

namespace Skoro\AdminPack\Tests;

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

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => dirname(__DIR__) . '/database/migrations',
        ]);

        $this->withFactories(dirname(__DIR__) . '/database/factories');
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
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminServiceProvider::class,
        ];
    }
}