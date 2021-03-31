<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;
use App\Models\Sale;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $count = Group::count();
      return [
        'puntoContable' => 3,
        'cae' => '12345678987654',
        'fechaCae' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'fechaEmision' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'fechaPago' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        'nroFactura' => $this->faker->numberBetween(1,10000),
        'total' => $this->faker->numberBetween(120,1400),
        'obs' => '-',
        'group_id' => $this->faker->numberBetween(1,$count),
        'comprob_id' => $this->faker->numberBetween(1,1000000)
      ];
    }
}
