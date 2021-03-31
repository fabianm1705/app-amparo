<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
      $role = Role::create(['name' => 'sos']);
      $permission = Permission::create(['name' => 'padron sos']);
      $role->givePermissionTo($permission);

      $role = Role::create(['name' => 'aop']);
      $permission = Permission::create(['name' => 'padron aop']);
      $role->givePermissionTo($permission);

      Permission::create(['name' => 'menu admin']);
      Permission::create(['name' => 'actualizar padron']);
      Permission::create(['name' => 'otros servicios']);
      Permission::create(['name' => 'contacto']);

      Permission::create(['name' => 'navegar roles']);
      Permission::create(['name' => 'crear roles']);
      Permission::create(['name' => 'editar roles']);
      Permission::create(['name' => 'eliminar roles']);

      Permission::create(['name' => 'ver accesos']);
      Permission::create(['name' => 'navegar zonas de interes']);
      Permission::create(['name' => 'crear zona de interes']);
      Permission::create(['name' => 'editar zonas de interes']);
      Permission::create(['name' => 'eliminar zonas de interes']);

      Permission::create(['name' => 'ver planes']); // opción en menu de botones
      Permission::create(['name' => 'navegar planes']);
      Permission::create(['name' => 'crear planes']);
      Permission::create(['name' => 'editar planes']);
      Permission::create(['name' => 'eliminar planes']);

      Permission::create(['name' => 'navegar socios']);
      Permission::create(['name' => 'editar socios']);
      Permission::create(['name' => 'eliminar socios']);
      Permission::create(['name' => 'ver panel socios']);

      Permission::create(['name' => 'navegar categorias']);
      Permission::create(['name' => 'crear categorias']);
      Permission::create(['name' => 'editar categorias']);
      Permission::create(['name' => 'eliminar categorias']);
      Permission::create(['name' => 'navegar productos']);
      Permission::create(['name' => 'crear productos']);
      Permission::create(['name' => 'editar productos']);
      Permission::create(['name' => 'eliminar productos']);
      Permission::create(['name' => 'navegar listas de precios']);
      Permission::create(['name' => 'crear listas de precios']);
      Permission::create(['name' => 'editar listas de precios']);
      Permission::create(['name' => 'eliminar listas de precios']);
      Permission::create(['name' => 'crear items de listas de precios']);
      Permission::create(['name' => 'editar items de listas de precios']);
      Permission::create(['name' => 'eliminar items de listas de precios']);
      Permission::create(['name' => 'shopping']);
      Permission::create(['name' => 'carrito']);
      Permission::create(['name' => 'navegar shoppings']);

      Permission::create(['name' => 'navegar especialidades']);
      Permission::create(['name' => 'crear especialidades']);
      Permission::create(['name' => 'editar especialidades']);
      Permission::create(['name' => 'eliminar especialidades']);
      Permission::create(['name' => 'navegar profesionales']);
      Permission::create(['name' => 'mostrar profesionales']);
      Permission::create(['name' => 'crear profesionales']);
      Permission::create(['name' => 'editar profesionales']);
      Permission::create(['name' => 'eliminar profesionales']);
      Permission::create(['name' => 'navegar ordenes']);
      Permission::create(['name' => 'emitir ordenes']);
      Permission::create(['name' => 'eliminar ordenes']);

      Permission::create(['name' => 'modulo pagos']);
      Permission::create(['name' => 'navegar recibos']);
      Permission::create(['name' => 'crear recibos']);
      Permission::create(['name' => 'eliminar recibos']);


      Role::create(['name' => 'socio'])->givePermissionTo([
        'ver panel socios',
        'shopping',
        'carrito',
        'mostrar profesionales',
        'otros servicios',
        'navegar ordenes',
        'emitir ordenes',
        'modulo pagos',
        'contacto',
        'ver planes'
      ]);

      Role::create(['name' => 'admin'])->givePermissionTo([
        'menu admin',
        'ver accesos',
        'actualizar padron',
        'navegar planes',
        'crear planes',
        'editar planes',
        'eliminar planes',
        'navegar socios',
        'editar socios',
        'eliminar socios',
        'ver panel socios',
        'navegar categorias',
        'crear categorias',
        'editar categorias',
        'eliminar categorias',
        'navegar productos',
        'crear productos',
        'editar productos',
        'eliminar productos',
        'navegar listas de precios',
        'editar listas de precios',
        'eliminar listas de precios',
        'shopping',
        'carrito',
        'navegar shoppings',
        'navegar especialidades',
        'crear especialidades',
        'editar especialidades',
        'eliminar especialidades',
        'padron sos',
        'padron aop',
        'navegar profesionales',
        'mostrar profesionales',
        'crear profesionales',
        'editar profesionales',
        'eliminar profesionales',
        'navegar ordenes',
        'emitir ordenes',
        'eliminar ordenes',
        'modulo pagos',
        'navegar recibos',
        'crear recibos',
        'eliminar recibos'
      ]);

      Role::create(['name' => 'desarrollador']);

      // PaymentMethod::create([
      //   'name' => 'Cuotas de la Casa',
      //   'activo' => 1,
      //   'percentage' => 23,
      //   'cant_cuotas' => 6
      // ]);
      // PaymentMethod::create([
      //   'name' => 'Mercado Pago',
      //   'activo' => 1,
      //   'percentage' => 15,
      //   'cant_cuotas' => 1
      // ]);
    }
}
