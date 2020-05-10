<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Doctor;
use App\User;

$factory->define(App\Models\Order::class, function (Faker $faker) {
  $countDoctors = Doctor::count();
  $countUsers = User::count();

  return [
    'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'fechaImpresion' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'monto_s' => 180,
    'monto_a' => 220,
    'estado' => $faker->randomElement($array = array ('Emitida','Pagada','Cancelada')),
    'lugarEmision' => $faker->randomElement($array = array ('Oficina','Web')),
    'doctor_id' => $faker->numberBetween(1,$countDoctors),
    'pacient_id' => $faker->numberBetween(1,$countUsers)
  ];
});
