<?php

namespace Skoro\AdminPack\Tests\Feature;

use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Tests\TestCase;

class LoginFormTest extends TestCase
{
    /** @test */
    public function can_see_login_form()
    {
        $this->get('/admin/login')
             ->assertSee('Admin Login');
    }

    /** @test */
    public function need_login_before_access()
    {
        $this->get(route('admin.roles'))
             ->assertRedirect('/admin/login');
    }

    /** @test */
    public function can_see_login_by_name()
    {
        option(['user_login_name' => 'name']);
        $this->get('/admin/login')
             ->assertSee('Name')
             ->assertSee('Password');
    }

    /** @test */
    public function can_see_login_by_email()
    {
        option(['user_login_name' => 'email']);
        $this->get('/admin/login')
             ->assertSee('Email')
             ->assertSee('Password');
    }

    /** @test */
    public function auth_cannot_see_login()
    {
        $user = factory(User::class)->create([
            'status' => true,
        ]);
        $this->loginToAdmin($user)->get('/admin/login')
            ->assertRedirect(route('admin.home'));
    }

    /** @test */
    public function only_users_with_active_status_can_login()
    {
        $user = factory(User::class)->create([
            'status' => false,
        ]);
        $this->loginToAdmin($user)->get(route('admin.home'))
            ->assertRedirect('/admin/login');
    }
}
