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

        DB::table('admin_option_elements')->insert([
            'option_id' => Option::where('key', 'user_password_min')->first()->id,
            'perm_id' => $perm->id,
            'label' => 'Minimum password length',
            'description' => 'This option sets the limit of the user minimum password length and affects to the user creation form.',
            'group' => 'User',
            'widget' => 'input',
            'validators' => 'required|int|min:4|max:100',
            'priority' => 0,
        ]);
    }
}
