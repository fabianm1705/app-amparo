<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
