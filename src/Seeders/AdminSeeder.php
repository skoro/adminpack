<?php

namespace Skoro\AdminPack\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(OptionElementSeeder::class);
    }
}
