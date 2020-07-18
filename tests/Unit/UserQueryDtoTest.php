<?php

namespace Skoro\AdminPack\Tests\Feature;

use RuntimeException;
use Skoro\AdminPack\Dto\UserQueryDto;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Tests\TestCase;

class UserQueryDtoTest extends TestCase
{
    /** @test */
    public function default_values()
    {
        $dto = new UserQueryDto([]);

        $this->assertEquals('id', $dto->getSortField());
        $this->assertEquals('desc', $dto->getSortOrder());
        $this->assertFalse($dto->hasFindValue());
        $this->assertEmpty($dto->getFindValue());
        $this->assertFalse($dto->hasRoleId());
        $this->assertEquals(0, $dto->getRoleId());
        $this->assertFalse($dto->hasStatus());
        $this->assertEquals(User::STATUS_ACTIVE, $dto->getStatus());
    }

    /** @test */
    public function invalid_sort_order()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid sort order: foo');

        $dto = new UserQueryDto(['order' => 'foo']);

        $dto->getSortOrder();
    }

    /** @test */
    public function has_find_value()
    {
        $dto = new UserQueryDto(['text' => 'foo']);
        $this->assertTrue($dto->hasFindValue());
    }

    /** @test */
    public function find_value_space_string()
    {
        $dto = new UserQueryDto(['text' => '   ']);
        $this->assertFalse($dto->hasFindValue());
    }

    /** @test */
    public function role_id_is_not_int()
    {
        $dto = new UserQueryDto(['role' => 'admin']);
        $this->assertEquals(0, $dto->getRoleId());
    }

    /** @test */
    public function has_status()
    {
        $dto = new UserQueryDto(['status' => User::STATUS_DISABLED]);
        $this->assertTrue($dto->hasStatus());
        $this->assertEquals(User::STATUS_DISABLED, $dto->getStatus());
    }
}
