<?php

namespace Skoro\AdminPack\Seeders;

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        option([
            'user_register_enable' => true,
            'user_default_role' => 1,
            'user_password_min' => 6,
        ]);
    }
}
