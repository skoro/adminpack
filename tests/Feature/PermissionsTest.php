<?php

namespace Skoro\AdminPack\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Tests\TestCase;

class PermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(): User
    {
        $roleId = roles()->where('name', 'administrator')->first()->id;
        return factory(User::class)->create([
            'role_id' => $roleId,
            'status' => true,
        ]);
    }

    protected function createUser(): User
    {
        $roleId = roles()->where('name', 'manager')->first()->id;
        return factory(User::class)->create([
            'role_id' => $roleId,
            'status' => true,
        ]);
    }

    /** @test */
    public function admin_can_view_create_user()
    {
        $admin = $this->createAdmin();
        $this->loginToAdmin($admin)
             ->get(route('admin.user.create'))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_create_user()
    {
        $user = $this->createUser();
        $this->loginToAdmin($user)
             ->get(route('admin.user.create'))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_user_list()
    {
        $admin = $this->createAdmin();
        $this->loginToAdmin($admin)
             ->get(route('admin.users'))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_user_list()
    {
        $user = $this->createUser();
        $this->loginToAdmin($user)
             ->get(route('admin.users'))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_edit_user()
    {
        $admin = $this->createAdmin();
        $newUser = factory(User::class)->create();

        $this->loginToAdmin($admin)
             ->get(route('admin.user.edit', $newUser->id))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_edit_user()
    {
        $user = $this->createUser();
        $newUser = factory(User::class)->create();

        $this->loginToAdmin($user)
             ->get(route('admin.user.edit', $newUser->id))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $admin = $this->createAdmin();
        $newUser = factory(User::class)->create();

        $this->loginToAdmin($admin)
             ->delete(route('admin.user.delete', $newUser->id))
             ->assertStatus(302)
             ->assertRedirect(route('admin.users'));
    }

    /** @test */
    public function user_cannot_delete_user()
    {
        $user = $this->createUser();
        $newUser = factory(User::class)->create();

        $this->loginToAdmin($user)
             ->delete(route('admin.user.delete', $newUser->id))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_roles()
    {
        $admin = $this->createAdmin();
        $this->loginToAdmin($admin)
             ->get(route('admin.roles'))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_roles()
    {
        $user = $this->createUser();
        $this->loginToAdmin($user)
             ->get(route('admin.roles'))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_create_role()
    {
        $admin = $this->createAdmin();
        $this->loginToAdmin($admin)
             ->get(route('admin.role.create'))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_create_role()
    {
        $user = $this->createUser();
        $this->loginToAdmin($user)
             ->get(route('admin.role.create'))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_edit_role()
    {
        $admin = $this->createAdmin();
        $role = roles()->first();
        $this->loginToAdmin($admin)
             ->get(route('admin.role.edit', $role->id))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_edit_role()
    {
        $user = $this->createUser();
        $role = roles()->first();
        $this->loginToAdmin($user)
             ->get(route('admin.role.edit', $role->id))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_role()
    {
        $admin = $this->createAdmin();
        $role = roles()->first();
        $this->loginToAdmin($admin)
             ->delete(route('admin.role.delete', $role->id))
             ->assertStatus(302)
             ->assertRedirect(route('admin.roles'));
    }

    /** @test */
    public function user_cannot_delete_role()
    {
        $user = $this->createUser();
        $role = roles()->first();
        $this->loginToAdmin($user)
             ->delete(route('admin.role.delete', $role->id))
             ->assertStatus(403);
    }

    /** @test */
    public function admin_can_view_options()
    {
        $admin = $this->createAdmin();
        $this->loginToAdmin($admin)
             ->get(route('admin.options'))
             ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_view_options()
    {
        $user = $this->createUser();
        $this->loginToAdmin($user)
             ->get(route('admin.options'))
             ->assertStatus(403);
    }
}