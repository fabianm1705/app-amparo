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
      Role::create([
        'name' => 'Acceso Odontólogo',
        'slug' => 'odontologo',
        'description' => 'Acceso de Odontólogo a registro de órdenes y carga.'
      ]);
      Permission::create([
        'name' => 'Gestión Odontólogo',
        'slug' => 'odontologo.gestion',
        'description' => 'Cargar órdenes y ver listados de pendientes'
      ]);
    }
}
