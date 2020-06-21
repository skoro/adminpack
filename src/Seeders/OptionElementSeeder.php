<?php

namespace Skoro\AdminPack\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Skoro\AdminPack\Models\Option;
use Skoro\AdminPack\Models\Permission;

class OptionElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm = Permission::where([
            'scope' => 'system',
            'name' => 'manage options',
        ])->firstOrFail();

        $roles = roles()->pluck('name', 'id')->toArray();

        DB::table('option_elements')->insert([
            'option_id' => Option::where('key', 'user_register_enable')->first()->id,
            'perm_id' => $perm->id,
            'label' => 'User registration',
            'description' => 'When disabled only user with "user: create" permission can register a new user.',
            'group' => 'User',
            'widget' => 'checkbox',
            'validators' => 'required|bool',
            'priority' => 0,
        ]);
        DB::table('option_elements')->insert([
            'option_id' => Option::where('key', 'user_default_role')->first()->id,
            'perm_id' => $perm->id,
            'label' => 'Default role',
            'description' => 'Newly registered users are attached to this role. This option is actual only if user registration is enabled.',
            'group' => 'User',
            'values' => json_encode($roles),
            'widget' => 'select',
            'validators' => 'required|int|exists:roles,id',
            'priority' => 0,
        ]);
        DB::table('option_elements')->insert([
            'option_id' => Option::where('key', 'user_password_min')->first()->id,
            'perm_id' => $perm->id,
            'label' => 'Minimum password length',
            'description' => 'This option sets the limit of the user minimum password length and affects to the registration and user creation forms.',
            'group' => 'User',
            'widget' => 'input',
            'validators' => 'required|int|min:4|max:100',
            'priority' => 0,
        ]);
    }
}
