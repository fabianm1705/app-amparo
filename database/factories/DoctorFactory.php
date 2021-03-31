<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\Specialty;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $count = Specialty::count();
      return [
        'apeynom' => $this->faker->name,
        'direccion' => $this->faker->address,
        'email' => $this->faker->email,
        'telefono' => $this->faker->phoneNumber,
        'vigente' => true,
        'ordenWeb' => true,
        'coseguroConsultorio' => false,
        'specialty_id' => $this->faker->numberBetween(1,$count)
      ];
    }
}
