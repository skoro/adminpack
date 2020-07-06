<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Skoro\AdminPack\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'scope' => $faker->unique()->name,
        'name' => $faker->unique()->name,
    ];
});
