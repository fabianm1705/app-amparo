<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Group::class, function (Faker $faker) {
    return [
      'nroSocio' => $faker->numberBetween(100,5000),
      'fechaAlta' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'email' => $faker->email,
      'telefono' => $faker->phoneNumber,
      'direccion' => $faker->address,
      'direccionCobro' => $faker->address,
      'diaCobro' => '10',
      'horaCobro' => '10:00',
      'total' => $faker->numberBetween(120,1500),
      'activo' => true
    ];
});
