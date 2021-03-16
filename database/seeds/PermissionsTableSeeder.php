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
        'name' => 'Módulo pagos',
        'slug' => 'users.pagos',
        'description' => 'Formas de pago disponibles para abonar la cuota social'
      ]);
    }
}
