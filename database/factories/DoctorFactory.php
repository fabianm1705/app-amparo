<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Specialty;

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    $count = Specialty::count();
    return [
      'apeynom' => $faker->name,
      'direccion' => $faker->address,
      'email' => $faker->email,
      'telefono' => $faker->phoneNumber,
      'vigente' => true,
      'coseguroConsultorio' => false,
      'specialty_id' => $faker->numberBetween(1,$count)
    ];
});
