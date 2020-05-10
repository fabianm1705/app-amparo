<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->truncateTables([
          'layers',
          'plans',
          'permissions',
          'roles',
          'products',
          'users',
          'groups',
          'specialties',
          'doctors',
          'interests',
          'subscriptions'
        ]);
        $this->call(PermissionsTableSeeder::class);
        $this->call(InterestsSeeder::class);
        $this->call(SpecialtiesTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(ProductsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(LayersTableSeeder::class);
        //$this->call(OrdersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function truncateTables(array $tables)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      foreach ($tables as $table) {
        DB::table($table)->truncate();
      }

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
