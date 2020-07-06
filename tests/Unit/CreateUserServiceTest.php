<?php

namespace Skoro\AdminPack\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Services\User\CreateUserService;
use Skoro\AdminPack\Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_user_from_dto()
    {
        $role_id = roles()->first()->id;
        $dto = new UserDto([
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => true,
            'role' => $role_id,
            'password' => '123456',
        ]);

        /** @var User $user */
        $user = app(CreateUserService::class)->create($dto);

        $this->assertDatabaseHas('admin_users', [
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => true,
            'role_id' => $role_id, 
        ]);
    }

    /** @test */
    public function create_user_from_dto_without_password()
    {
        $role_id = roles()->first()->id;
        $dto = new UserDto([
            'name' => 'test',
            'email' => 'test@test.com',
            'status' => true,
            'role' => $role_id,
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot create user without password.');

        app(CreateUserService::class)->create($dto);
    }

    /** @test */
    public function create_user_dto_empty_name()
    {
        $dto = new UserDto([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot get user name.');
        app(CreateUserService::class)->create($dto);
    }

    /** @test */
    public function create_user_dto_empty_email()
    {
        $dto = new UserDto(['name' => 'test']);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot get user email.');
        app(CreateUserService::class)->create($dto);
    }
}
