<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use App\Models\PaymentMethod;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permission::create([
        'name' => 'Autocarga nueva afiliación',
        'slug' => 'users.afiliar',
        'description' => 'Visitante que se afilia directo desde la web'
      ]);
      Permission::create([
        'name' => 'Visitante solicita llamada para informarse',
        'slug' => 'users.llamada',
        'description' => 'Formulario de carga: Nombre y Teléfono'
      ]);
      Permission::create([
        'name' => 'Visitante solicita promotor para informarse',
        'slug' => 'users.promotor',
        'description' => 'Formulario de carga: Nombre, Dirección y Teléfono'
      ]);
      Permission::create([
        'name' => 'Visualización de los planes de Amparo',
        'slug' => 'planes',
        'description' => 'Mostramos cada plan con detalles y precios'
      ]);
    }
}
