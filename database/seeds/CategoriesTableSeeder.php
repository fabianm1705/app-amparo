<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::create(["nombre" => "Celulares", "activa" => 1]);
      Category::create(["nombre" => "Artesanales", "activa" => 1]);
      Category::create(["nombre" => "Manteles", "activa" => 1]);
      Category::create(["nombre" => "Colchones", "activa" => 1]);
      Category::create(["nombre" => "Sábanas", "activa" => 1]);
    }
}
