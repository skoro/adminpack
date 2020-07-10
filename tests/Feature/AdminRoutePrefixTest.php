<?php

namespace Skoro\AdminPack\Tests\Feature;

use Skoro\AdminPack\Tests\TestCase;

class AdminRoutePrefixTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('admin.path', 'backend');
    }

    /** @test */
    public function can_access_login_by_prefix()
    {
        $this->get('/backend/login')->assertStatus(200);
    }

    /** @test */
    public function cannot_access_admin_prefix()
    {
        $this->get('/admin/login')->assertStatus(404);
    }
}
