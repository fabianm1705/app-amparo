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
        'name' => 'Instalar App',
        'slug' => 'instalar.app',
        'description' => 'Permite instalar la aplicación en el dispositivo'
      ]);
    //Usuarios
      Permission::create([
        'name' => 'Navegar usuarios',
        'slug' => 'users.index',
        'description' => 'Navega todos los usuarios del sistema'
      ]);
      Permission::create([
        'name' => 'Ver usuarios',
        'slug' => 'users.show',
        'description' => 'Ver en detalle cada usuario del sistema'
      ]);
      Permission::create([
        'name' => 'Editar usuarios',
        'slug' => 'users.edit',
        'description' => 'Editar el detalle de cada usuario del sistema'
      ]);
      Permission::create([
        'name' => 'Eliminar usuarios',
        'slug' => 'users.destroy',
        'description' => 'Eliminar un usuario del sistema'
      ]);
      //Profits
      Permission::create([
        'name' => 'Navegar porcentajes',
        'slug' => 'profits.index',
        'description' => 'Navega todos los porcentajes de marcación'
      ]);
      Permission::create([
        'name' => 'Ver porcentajes',
        'slug' => 'profits.show',
        'description' => 'Ver en detalle cada porcentaje del sistema'
      ]);
      Permission::create([
        'name' => 'Editar porcentajes',
        'slug' => 'profits.edit',
        'description' => 'Editar el detalle de cada porcentaje del sistema'
      ]);
      Permission::create([
        'name' => 'Eliminar porcentajes',
        'slug' => 'profits.destroy',
        'description' => 'Eliminar un porcentaje del sistema'
      ]);
      //Roles
      Permission::create([
        'name' => 'Navegar Roles',
        'slug' => 'roles.index',
        'description' => 'Navega todos los roles del sistema'
      ]);
      Permission::create([
        'name' => 'Ver Roles',
        'slug' => 'roles.show',
        'description' => 'Ver en detalle cada rol del sistema'
      ]);
      Permission::create([
        'name' => 'Crear Roles',
        'slug' => 'roles.create',
        'description' => 'Crear un rol del sistema'
      ]);
      Permission::create([
        'name' => 'Editar Roles',
        'slug' => 'roles.edit',
        'description' => 'Editar el detalle de cada rol del sistema'
      ]);
      Permission::create([
        'name' => 'Eliminar Roles',
        'slug' => 'roles.destroy',
        'description' => 'Eliminar un rol del sistema'
      ]);
      //Productos
      Permission::create([
        'name' => 'Shopping de Productos',
        'slug' => 'products.shopping',
        'description' => 'Shopping de los Productos'
      ]);
      Permission::create([
        'name' => 'Navegar Productos',
        'slug' => 'products.index',
        'description' => 'Navega todos los productos del sistema'
      ]);
      Permission::create([
        'name' => 'Ver Productos',
        'slug' => 'products.show',
        'description' => 'Ver en detalle cada producto del sistema'
      ]);
      Permission::create([
        'name' => 'Crear Productos',
        'slug' => 'products.create',
        'description' => 'Crear un producto del sistema'
      ]);
      Permission::create([
        'name' => 'Editar Productos',
        'slug' => 'products.edit',
        'description' => 'Editar el detalle de cada producto del sistema'
      ]);
      Permission::create([
        'name' => 'Eliminar Productos',
        'slug' => 'products.destroy',
        'description' => 'Eliminar un producto del sistema'
      ]);
      //Categorías
      Permission::create([
        'name' => 'Navegar Categorias',
        'slug' => 'categories.index',
        'description' => 'Navega todas las categorias del sistema'
      ]);
      Permission::create([
        'name' => 'Ver Categorias',
        'slug' => 'categories.show',
        'description' => 'Ver en detalle cada categoria del sistema'
      ]);
      Permission::create([
        'name' => 'Crear Categorias',
        'slug' => 'categories.create',
        'description' => 'Crear una categoria del sistema'
      ]);
      Permission::create([
        'name' => 'Editar Categorias',
        'slug' => 'categories.edit',
        'description' => 'Editar el detalle de cada categoria del sistema'
      ]);
      Permission::create([
        'name' => 'Eliminar Categorias',
        'slug' => 'categories.destroy',
        'description' => 'Eliminar una categoria del sistema'
      ]);
      //Especialidades
        Permission::create([
          'name' => 'Navegar Especialidades',
          'slug' => 'specialties.index',
          'description' => 'Navega todas las especialidades del sistema'
        ]);
        Permission::create([
          'name' => 'Ver Especialidades',
          'slug' => 'specialties.show',
          'description' => 'Ver en detalle cada especialidad del sistema'
        ]);
        Permission::create([
          'name' => 'Crear Especialidades',
          'slug' => 'specialties.create',
          'description' => 'Crear una especialidad del sistema'
        ]);
        Permission::create([
          'name' => 'Editar Especialidades',
          'slug' => 'specialties.edit',
          'description' => 'Editar el detalle de cada especialidad del sistema'
        ]);
        Permission::create([
          'name' => 'Eliminar Especialidades',
          'slug' => 'specialties.destroy',
          'description' => 'Eliminar una especialidad del sistema'
        ]);
        //Doctores
        Permission::create([
          'name' => 'Navegar Profesionales',
          'slug' => 'doctors.index',
          'description' => 'Navega todas los profesionales del sistema'
        ]);
        Permission::create([
          'name' => 'Ver Profesionales Socio',
          'slug' => 'doctors.mostrar',
          'description' => 'Recupera para el socio todos los profesionales del sistema'
        ]);
        Permission::create([
          'name' => 'Ver Profesionales Oficina',
          'slug' => 'doctors.show',
          'description' => 'Ver en detalle cada profesional del sistema'
        ]);
        Permission::create([
          'name' => 'Crear Profesionales',
          'slug' => 'doctors.create',
          'description' => 'Crear un profesional del sistema'
        ]);
        Permission::create([
          'name' => 'Editar Profesionales',
          'slug' => 'doctors.edit',
          'description' => 'Editar el detalle de cada profesional del sistema'
        ]);
        Permission::create([
          'name' => 'Eliminar Profesionales',
          'slug' => 'doctors.destroy',
          'description' => 'Eliminar un profesional del sistema'
        ]);
        //Ordenes
        Permission::create([
          'name' => 'Navegar Ordenes Admin',
          'slug' => 'orders.index',
          'description' => 'Navega todas las ordenes emitidas'
        ]);
        Permission::create([
          'name' => 'Navegar Ordenes Socio',
          'slug' => 'orders.indice',
          'description' => 'Navega todas las ordenes emitidas'
        ]);
        Permission::create([
          'name' => 'Ver Ordenes en PDF',
          'slug' => 'orders.show',
          'description' => 'Ver en PDF cada orden del sistema'
        ]);
        Permission::create([
          'name' => 'Emitir Ordenes Socio',
          'slug' => 'orders.crear',
          'description' => 'Emite una orden a través de autogestión'
        ]);
        Permission::create([
          'name' => 'Emitir Ordenes Oficina',
          'slug' => 'orders.create',
          'description' => 'Emite una orden en oficina'
        ]);
        Permission::create([
          'name' => 'Editar Ordenes',
          'slug' => 'orders.edit',
          'description' => 'Editar el detalle de cada orden del sistema'
        ]);
        Permission::create([
          'name' => 'Eliminar Ordenes',
          'slug' => 'orders.destroy',
          'description' => 'Eliminar una orden del sistema'
        ]);
        Permission::create([
          'name' => 'Otros Servicios',
          'slug' => 'otros',
          'description' => 'Navega el resto de los servicios'
        ]);
        Permission::create([
          'name' => 'Formulario de Contacto',
          'slug' => 'contacto',
          'description' => 'Formulario de Contacto'
        ]);
        Permission::create([
          'name' => 'Navegar Métodos de Pago',
          'slug' => 'payment_methods.index',
          'description' => 'Navega todos los métodos de pago'
        ]);
        Permission::create([
          'name' => 'Editar Métodos de Pago',
          'slug' => 'payment_methods.edit',
          'description' => 'Editar un método de pago'
        ]);
        Permission::create([
          'name' => 'Eliminar Métodos de Pago',
          'slug' => 'payment_methods.destroy',
          'description' => 'Eliminar un método de pago'
        ]);
        Permission::create([
          'name' => 'Acceso Shopping Cart',
          'slug' => 'carrito',
          'description' => 'Acceso Shopping Cart'
        ]);
        Permission::create([
          'name' => 'Padrón SOS Emergencias',
          'slug' => 'sos.emergencias',
          'description' => 'Padrón SOS Emergencias'
        ]);
        Permission::create([
          'name' => 'Padrón Asociación Odontológica',
          'slug' => 'aop',
          'description' => 'Padrón Asociación Odontológica'
        ]);
        Permission::create([
          'name' => 'Padrón Farmacia',
          'slug' => 'farmacia',
          'description' => 'Padrón Farmacia'
        ]);
        Permission::create([
          'name' => 'Navegar Shopping Carts',
          'slug' => 'shopping_cart.index',
          'description' => 'Navega todos los carritos del sistema'
        ]);
        Permission::create([
          'name' => 'Ver Shopping Cart',
          'slug' => 'shopping_cart.show',
          'description' => 'Ver en detalle un carrito finalizado'
        ]);
        Permission::create([
          'name' => 'Ver Zonas de Interés',
          'slug' => 'interests.show',
          'description' => 'Ver en detalle cada zona de interés'
        ]);
        Permission::create([
          'name' => 'Navegar Zonas de Interés',
          'slug' => 'interests.index',
          'description' => 'Navega todas las zonas de interés'
        ]);
        Permission::create([
          'name' => 'Crear Zona de Interés',
          'slug' => 'interests.create',
          'description' => 'Crear una zona de interés'
        ]);
        Permission::create([
          'name' => 'Editar Zonas de Interés',
          'slug' => 'interests.edit',
          'description' => 'Editar el detalle de cada zona de interés'
        ]);
        Permission::create([
          'name' => 'Eliminar Zonas de Interés',
          'slug' => 'interests.destroy',
          'description' => 'Eliminar una zona de interés'
        ]);
        Permission::create([
          'name' => 'Ver Plans/Subscriptions',
          'slug' => 'subscriptions.show',
          'description' => 'Ver en detalle cada plan/subscription'
        ]);
        Permission::create([
          'name' => 'Navegar Plans/Subscriptions',
          'slug' => 'subscriptions.index',
          'description' => 'Navega todos los plans/subscriptions'
        ]);
        Permission::create([
          'name' => 'Crear Plans/Subscriptions',
          'slug' => 'subscriptions.create',
          'description' => 'Crear un plan/subscription'
        ]);
        Permission::create([
          'name' => 'Editar Plans/Subscriptions',
          'slug' => 'subscriptions.edit',
          'description' => 'Editar el detalle de cada plan/subscription'
        ]);
        Permission::create([
          'name' => 'Eliminar Plans/Subscriptions',
          'slug' => 'subscriptions.destroy',
          'description' => 'Eliminar un plan/subscription'
        ]);
        Permission::create([
          'name' => 'Ver Panel Socios',
          'slug' => 'users.panel',
          'description' => 'Ver en detalle los datos del grupo familiar'
        ]);
        Role::create([
          'name' => 'Admin',
          'slug' => 'admin',
          'description' => 'Acceso Administrativo'
        ]);
        Role::create([
          'name' => 'Socio activo',
          'slug' => 'socio',
          'description' => 'Acceso de Socios'
        ]);
        Role::create([
          'name' => 'Desarrollador',
          'slug' => 'dev',
          'description' => 'Acceso Total',
          'special' => 'all-access'
        ]);
        Role::create([
          'name' => 'Socio inactivo',
          'slug' => 'nosocio',
          'description' => 'Socio dado de baja'
        ]);
        Role::create([
          'name' => 'Asociación Odontológica Parana',
          'slug' => 'aop.aop',
          'description' => 'Acceso padrón odontológico'
        ]);
        Role::create([
          'name' => 'SOS Emergencias',
          'slug' => 'SOS.sos',
          'description' => 'Acceso padrón sos emergencias'
        ]);
        Role::create([
          'name' => 'Farmacia Nueva Farma',
          'slug' => 'farmacia.farmacia',
          'description' => 'Acceso padrón farmacia'
        ]);
        PaymentMethod::create([
          'name' => 'Cuotas de la Casa',
          'activo' => 1,
          'percentage' => 23,
          'cant_cuotas' => 6
        ]);
        PaymentMethod::create([
          'name' => 'Mercado Pago',
          'activo' => 1,
          'percentage' => 15,
          'cant_cuotas' => 1
        ]);
    }
}
