<?php

namespace Skoro\AdminPack\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Skoro\AdminPack\Models\User;
use Skoro\AdminPack\Observers\ActivityLog;
use Skoro\AdminPack\Tests\TestCase;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_new_user()
    {
        $admin = $this->createAdmin();

        $this->loginToAdmin($admin)
             ->post(route('admin.user.store'), [
                 'name' => 'test',
                 'email' => 'test@test.com',
                 'password' => '12345678',
                 'password_confirmation' => '12345678',
                 'status' => User::STATUS_ACTIVE,
                 'role' => roles()->where('name', 'manager')->first()->id,
             ]);

        $this->assertDatabaseHas('admin_users', [
            'name' => 'test',
            'email' => 'test@test.com',
        ]);

        $this->assertDatabaseHas('admin_activities', [
            'user_id' => $admin->id,
            'event' => ActivityLog::TYPE_NEW,
            'message' => 'User: test',
        ]);
    }

    /** @test */
    public function update_user()
    {
        $roleId = roles()->first()->id;
        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'role_id' => $roleId,
        ]);

        $admin = $this->createAdmin();

        $this->loginToAdmin($admin)
             ->put(route('admin.user.update', ['user' => $user]), [
                'name' => 'new test',
                'email' => 'test@test.com',
                'role' => $roleId,
             ]);

        $this->assertDatabaseHas('admin_users', ['name' => 'new test']);
        $this->assertDatabaseHas('admin_activities', [
            'user_id' => $admin->id,
            'event' => ActivityLog::TYPE_UPDATED,
            'message' => 'User: new test',
        ]);
    }

    /** @test */
    public function delete_user()
    {
        $roleId = roles()->first()->id;
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);

        $admin = $this->createAdmin();
        
        $this->loginToAdmin($admin)
             ->delete(route('admin.user.delete', ['user' => $user]));

        $this->assertDatabaseMissing('admin_users', ['name' => 'test']);
        $this->assertDatabaseHas('admin_activities', [
            'user_id' => $admin->id,
            'event' => ActivityLog::TYPE_DELETED,
            'message' => $user->getDescription(),
        ]);
    }

    /** @test */
    public function check_activities_permission()
    {
        $admin = $this->createAdmin();
        $test = factory(User::class)->create([
            'role_id' => roles()->where('name', 'manager')->first()->id,
        ]);

        $this->loginToAdmin($admin)
             ->post(route('admin.user.store'), [
                 'name' => 'test',
                 'email' => 'test@test.com',
                 'password' => '12345678',
                 'password_confirmation' => '12345678',
                 'status' => User::STATUS_ACTIVE,
                 'role' => roles()->where('name', 'manager')->first()->id,
             ]);
        
        $data = $this->loginToAdmin($admin)
                     ->get(route('admin.activities.data'))
                     ->json('data');
        $this->assertNotEmpty($data);

        $data = $this->loginToAdmin($test)
                     ->get(route('admin.activities.data'))
                     ->json('data');
        $this->assertEmpty($data);
    }
}
