<?php

namespace Skoro\AdminPack\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'administrator',
            ],
            [
                'id' => 2,
                'name' => 'developer',
            ],
            [
                'id' => 3,
                'name' => 'manager',
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'scope' => 'user',
                'name' => 'view any',
            ],
            [
                'id' => 2,
                'scope' => 'user',
                'name' => 'view',
            ],
            [
                'id' => 3,
                'scope' => 'user',
                'name' => 'create',
            ],
            [
                'id' => 4,
                'scope' => 'user',
                'name' => 'update',
            ],
            [
                'id' => 5,
                'scope' => 'user',
                'name' => 'delete',
            ],
            [
                'id' => 6,
                'scope' => 'user',
                'name' => 'manage roles',
            ],
            [
                'id' => 7,
                'scope' => 'user',
                'name' => 'view actions',
            ],
            [
                'id' => 8,
                'scope' => 'system',
                'name' => 'manage options',
            ],
        ]);

        DB::table('role_perms')->insert([
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 8],
        ]);
    }
}
