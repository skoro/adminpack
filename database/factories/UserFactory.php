<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Skoro\AdminPack\Models\{User, Role};
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $roles = Role::all();
    return [
        'name' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password,
        'remember_token' => Str::random(10),
        'status' => random_int(0, 1),
        'role_id' => $roles->random()->id,
    ];
});
