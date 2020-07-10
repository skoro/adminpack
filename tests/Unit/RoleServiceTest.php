<?php

namespace Skoro\AdminPack\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Skoro\AdminPack\Models\Permission;
use Skoro\AdminPack\Models\Role;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Services\RoleService;
use Skoro\AdminPack\Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_new_role()
    {
        $byUser = factory(User::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        /** @var RoleService $roleService */
        $roleService = app(RoleService::class);

        $IDs = $permissions->pluck('id')->toArray();
        $role = $roleService->create('NewRole', $IDs, $byUser);

        $this->assertEquals('NewRole', $role->name);
        $this->assertDatabaseHas('admin_roles', [
            'name' => $role->name,
        ]);
        $this->assertEquals($IDs, $role->permissions->pluck('id')->toArray());
    }

    /** @test */
    public function create_permissions_cannot_be_empty()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Permissions list cannot be empty.');

        $user = factory(User::class)->create();
        app(RoleService::class)->create('NewRole', [], $user);
    }

    /** @test */
    public function update_role()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('admin_roles', ['name' => 'administrator']);
        $role = Role::where('name', 'administrator')->first();

        $permissions = factory(Permission::class, 4)->create();
        $IDs = $permissions->pluck('id')->toArray();

        $updated = app(RoleService::class)->update($role, 'SuperVisor', $IDs, $user);

        $this->assertDatabaseMissing('admin_roles', ['name' => 'administrator']);
        $this->assertDatabaseHas('admin_roles', ['name' => 'SuperVisor']);
        $this->assertEquals($IDs, $updated->permissions->pluck('id')->toArray());
    }

    /** @test */
    public function delete_role()
    {
        $user = factory(User::class)->create();

        $role = Role::create(['name' => 'TestDelete']);
        $this->assertDatabaseHas('admin_roles', ['name' => 'TestDelete']);

        app(RoleService::class)->delete($role, $user);

        $this->assertDatabaseMissing('admin_roles', ['name' => 'TestDelete']);
    }

    /** @test */
    public function cannot_delete_role_with_users()
    {
        $role = Role::create(['name' => 'TestCase']);
        factory(User::class, 5)->create(['role_id' => $role->id]);

        $user = factory(User::class)->create();
        
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Role is used by users and cannot be deleted.');

        app(RoleService::class)->delete($role, $user);
    }
}
