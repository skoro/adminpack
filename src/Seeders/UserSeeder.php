<?php

namespace Skoro\AdminPack\Seeders;

use Skoro\AdminPack\Models\Role;
use Skoro\AdminPack\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::find(1);
        DB::table('admin_users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin'),
            'status' => User::STATUS_ACTIVE,
            'role_id' => $adminRole->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
