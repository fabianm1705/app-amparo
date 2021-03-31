<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sale;
use App\Concept;

class ConceptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Concept::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $count = Sale::count();
      return [
        'descripcion' => $this->faker->name,
        'obs' => $this->faker->name,
        'monto' => $this->faker->numberBetween(120,1400),
        'sale_id' => $this->faker->numberBetween(1,$count)
      ];
    }
}
