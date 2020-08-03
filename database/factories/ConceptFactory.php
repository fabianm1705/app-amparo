<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Concept;
use App\Models\Sale;
use Faker\Generator as Faker;

$factory->define(Concept::class, function (Faker $faker) {
    $count = Sale::count();
    return [
      'descripcion' => $faker->name,
      'obs' => $faker->name,
      'monto' => $faker->numberBetween(120,1400),
      'sale_id' => $faker->numberBetween(1,$count)
    ];
});
