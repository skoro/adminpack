<?php

namespace Skoro\AdminPack\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Skoro\AdminPack\Dto\UserQueryDto;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Repositories\UsersPaginateQuery;
use Skoro\AdminPack\Tests\TestCase;

class UsersPaginateQueryTest extends TestCase
{
    /**
     * Don't forget about seeding!
     * 
     * There is admin user with ID = 1.
     */
    use RefreshDatabase;

    protected function getPaginate()
    {
        return new UsersPaginateQuery();
    }

    /** @test */
    public function default_index()
    {
        factory(User::class)->create(['id' => 10]);
        factory(User::class)->create(['id' => 11]);
        factory(User::class)->create(['id' => 12]);

        $users = $this->getPaginate()->paginate(new UserQueryDto([]))->items();
        $users = collect($users);

        $this->assertEquals([12,11,10,1], $users->pluck('id')->toArray());
    }

    /** @test */
    public function sort_by_name_asc()
    {
        factory(User::class)->create(['name' => 'new user']);
        factory(User::class)->create(['name' => 'guest']);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'name',
                'order' => 'asc',
            ]))->items();

        $this->assertEquals(['Administrator', 'guest', 'new user'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function sort_by_name_desc()
    {
        factory(User::class)->create(['name' => 'new user']);
        factory(User::class)->create(['name' => 'guest']);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'name',
                'order' => 'desc',
            ]))->items();

        $this->assertEquals(['new user', 'guest', 'Administrator'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function sort_by_email_asc()
    {
        factory(User::class)->create(['email' => 'vi@test.com']);
        factory(User::class)->create(['email' => 'good@another.com']);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'email',
                'order' => 'asc',
            ]))->items();

        $this->assertEquals(['admin@localhost', 'good@another.com', 'vi@test.com'],
            collect($users)->pluck('email')->toArray());
    }

    /** @test */
    public function sort_by_email_desc()
    {
        factory(User::class)->create(['email' => 'vi@test.com']);
        factory(User::class)->create(['email' => 'good@another.com']);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'email',
                'order' => 'desc',
            ]))->items();

        $this->assertEquals(['vi@test.com', 'good@another.com', 'admin@localhost'],
            collect($users)->pluck('email')->toArray());
    }

    /** @test */
    public function sort_by_role_asc()
    {
        factory(User::class)->create([
            'name' => 'vi', 'role_id' => roles()->where('name', 'developer')->first()->id
        ]);
        factory(User::class)->create([
            'name' => 'miki', 'role_id' => roles()->where('name', 'developer')->first()->id
        ]);
        factory(User::class)->create([
            'name' => 'jio', 'role_id' => roles()->where('name', 'manager')->first()->id
        ]);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'role',
                'order' => 'asc',
            ]))->items();

        $this->assertEquals(['Administrator', 'vi', 'miki', 'jio'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function sort_by_role_desc()
    {
        factory(User::class)->create([
            'name' => 'vi', 'role_id' => roles()->where('name', 'developer')->first()->id
        ]);
        factory(User::class)->create([
            'name' => 'miki', 'role_id' => roles()->where('name', 'developer')->first()->id
        ]);
        factory(User::class)->create([
            'name' => 'jio', 'role_id' => roles()->where('name', 'manager')->first()->id
        ]);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'sort' => 'role',
                'order' => 'desc',
            ]))->items();

        $this->assertEquals(['jio', 'vi', 'miki', 'Administrator'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function find_users()
    {
        factory(User::class)->create(['name' => 'find_user_test']);
        factory(User::class)->create(['name' => 'some_name', 'email' => 'find_user_test@test.com']);
        factory(User::class)->create(['name' => 'find_used']);
        factory(User::class, 10)->create();

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'text' => 'find_user',
            ]))->items();

        $this->assertEquals(['some_name', 'find_user_test'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function find_users_and_sort_by_name()
    {
        factory(User::class)->create(['name' => 'find_user_test']);
        factory(User::class)->create(['name' => 'some_name', 'email' => 'find_user_test@test.com']);
        factory(User::class)->create(['name' => 'find_used']);
        factory(User::class, 10)->create();

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'text' => 'find_',
                'sort' => 'name',
                'order' => 'asc',
            ]))->items();

        $this->assertEquals(['find_used', 'find_user_test', 'some_name'],
            collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function find_only_disabled()
    {
        factory(User::class)->create(['status' => User::STATUS_DISABLED, 'name' => 'foo']);
        factory(User::class)->create(['status' => User::STATUS_ACTIVE]);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'status' => User::STATUS_DISABLED,
            ]))->items();

        $this->assertEquals(['foo'], collect($users)->pluck('name')->toArray());
    }

    /** @test */
    public function find_only_active()
    {
        factory(User::class)->create(['status' => User::STATUS_DISABLED]);
        factory(User::class)->create(['status' => User::STATUS_DISABLED]);

        $users = $this->getPaginate()
            ->paginate(new UserQueryDto([
                'status' => User::STATUS_ACTIVE,
            ]))->items();

        $this->assertEquals(['Administrator'], collect($users)->pluck('name')->toArray());
    }
}
