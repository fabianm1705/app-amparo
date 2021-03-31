<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'modelo' => $this->faker->firstname,
        'category_id' => $this->faker->numberBetween(1,5),
        'descripcion' => $this->faker->text($maxNbChars = 100),
        'montoCuota' => $this->faker->numberBetween(1200,2900),
        'costo' => $this->faker->numberBetween(1200,2900),
        'cantidadCuotas' => 6,
        'image_url' => 'imagen.jpg',
        'image_url2' => 'imagen.jpg',
        'image_url3' => 'imagen.jpg',
        'vigente' => true
      ];
    }
}
