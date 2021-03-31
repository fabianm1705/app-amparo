<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\User;
use \App\Models\Group;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = User::all();
      foreach ($users as $user)
      {
        if($user->group->nroSocio == '1232'){
          $user->assignRole('desarrollador');
        }elseif ($user->group->nroSocio == '1231') {
          $user->assignRole('admin');
        }else{
          $user->assignRole('socio');
        }
      }
    }

}
