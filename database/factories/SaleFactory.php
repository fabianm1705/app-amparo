<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Group;

$factory->define(App\Models\Sale::class, function (Faker $faker) {
  $count = Group::count();
  return [
    'fechaEmision' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'fechaPago' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'nroFactura' => $faker->numberBetween(1,10000),
    'total' => $faker->numberBetween(120,1400),
    'group_id' => $faker->numberBetween(1,$count)
  ];
});
