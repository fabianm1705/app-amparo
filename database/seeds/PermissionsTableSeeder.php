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
      //Recibos
        Permission::create([
          'name' => 'Navegar recibos',
          'slug' => 'receipts.index',
          'description' => 'Navega todos los recibos del sistema'
        ]);
        Permission::create([
          'name' => 'Ver recibos',
          'slug' => 'receipts.show',
          'description' => 'Ver en detalle cada recibo'
        ]);
        Permission::create([
          'name' => 'Eliminar recibos',
          'slug' => 'receipts.destroy',
          'description' => 'Eliminar un recibo del sistema'
        ]);
    }
}
