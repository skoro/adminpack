<?php

namespace Skoro\AdminPack\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Skoro\AdminPack\Tests\TestCase;

class OptionCommandsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function command_set()
    {
        $this->artisan('option:set test 123')
            ->expectsOutput('test = 123');
    }

    /** @test */
    public function command_get()
    {
        option(['test' => 'abc']);
        $this->artisan('option:get test')
            ->expectsOutput('abc');
    }

    /** @test */
    public function command_delete()
    {
        option(['test' => 'abc']);
        $this->artisan('option:delete test')
            ->expectsOutput("Option 'test' has been deleted.");
    }

    /** @test */
    public function command_list()
    {
        $this->artisan('option:list')
            ->expectsOutput('+-------------------+-------+')
            ->expectsOutput('| Name              | Value |')
            ->expectsOutput('+-------------------+-------+')
            ->expectsOutput('| user_login_name   | name  |')
            ->expectsOutput('| user_password_min | 6     |')
            ->expectsOutput('+-------------------+-------+');
    }
}
