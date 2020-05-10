<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Group;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
    $group = factory(Group::class)->create();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'nroAdh' => $faker->numberBetween(0,10),
        'tipoDoc' => 1,
        'nroDoc' => $faker->numberBetween(7234567,55765321),
        'sexo' => 'f',
        'fechaNac' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'activo' => 1,
        'group_id' => $group->id,
        'vigenteOrden' => 1,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
