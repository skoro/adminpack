<?php

namespace Skoro\AdminPack\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Services\User\UpdateUserService;
use Skoro\AdminPack\Tests\TestCase;

class UpdateUserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_change_status()
    {
        $user = factory(User::class)->create(['status' => true]);
        $dto = new UserDto([
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => false,
        ]);
        
        $updated = app(UpdateUserService::class)->profile($user, $dto);
        $this->assertDatabaseHas('admin_users', [
            'id' => $user->id,
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => true,
        ]);
    }

    /** @test */
    public function cannot_change_role()
    {
        $role_id = roles()->first()->id;
        $user = factory(User::class)->create(['role_id' => $role_id]);
        $dto = new UserDto([
            'name' => 'test',
            'email' => 'test@test.com',
            'role' => roles()->last()->id,
        ]);
        
        $updated = app(UpdateUserService::class)->profile($user, $dto);
        $this->assertDatabaseHas('admin_users', [
            'id' => $user->id,
            'name' => 'test',
            'email' => 'test@test.com',
            'role_id' => $role_id,
        ]);
    }
}
