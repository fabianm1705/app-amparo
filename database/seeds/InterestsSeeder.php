<?php

use Illuminate\Database\Seeder;
use App\Interest;
class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Interest::create(['description' => 'Login', 'activo' => 0]);
      Interest::create(['description' => 'Admin Ordenes', 'activo' => 1]);
      Interest::create(['description' => 'Emitir Ordenes', 'activo' => 1]);
      Interest::create(['description' => 'Ver Profesionales', 'activo' => 1]);
      Interest::create(['description' => 'Ingresa al Shopping', 'activo' => 1]);
      Interest::create(['description' => 'Selecciona Categoría', 'activo' => 1]);
      Interest::create(['description' => 'Click Producto', 'activo' => 1]);
      Interest::create(['description' => 'Agregar al Carrito', 'activo' => 1]);
      Interest::create(['description' => 'Ir al Carrito', 'activo' => 1]);
      Interest::create(['description' => 'Finalizar Compra!', 'activo' => 1]);
      Interest::create(['description' => 'Activar Plan', 'activo' => 1]);
      Interest::create(['description' => 'Acceso Padrón', 'activo' => 1]);
    }
}
