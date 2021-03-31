<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Doctor;
use App\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $countDoctors = Doctor::count();
      $countUsers = User::count();
      return [
        'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'fechaImpresion' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'monto_s' => 180,
        'monto_a' => 220,
        'estado' => $this->faker->randomElement($array = array ('Emitida','Pagada','Cancelada')),
        'lugarEmision' => $this->faker->randomElement($array = array ('Oficina','Web')),
        'doctor_id' => $this->faker->numberBetween(1,$countDoctors),
        'pacient_id' => $this->faker->numberBetween(1,$countUsers)
      ];
    }
}
