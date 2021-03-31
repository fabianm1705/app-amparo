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
        $lineas = file('storage/app/public/socios.txt');
        foreach ($lineas as $linea)
        {
          $datos = explode("|", $linea);
          if($datos<>""){
            $user = User::where('name', '=', Str::title(utf8_encode(trim($datos[1]))))
                                      ->get()->first();
            if (is_null($user)) {
              $user = new User();
              $user->password = Hash::make('amparo');
              $user->no_aop=0;
            }
            $user->nroAdh = utf8_encode(trim($datos[0]));
            $user->name = Str::title(utf8_encode(trim($datos[1])));
            $user->nroDoc = str_replace(".","",utf8_encode(trim($datos[2])));
            $user->tipoDoc=1;
            $time = strtotime($datos[3]);
            $user->fechaNac = date('Y-m-d',$time);
            $user->sexo=utf8_encode(trim($datos[4]));
            $user->vigenteOrden=intval(trim($datos[5]));
            $user->activo=intval(trim($datos[6]));

            $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[7])))
                                      ->get()->first();
            if (isset($group)) {
              $user->group_id=$group->id;
            }

            $user->save();
            if(utf8_encode(trim($datos[7]))=='1232'){
              $user->assignRole('desarrollador');
            }elseif ((utf8_encode(trim($datos[7]))=='1231')) {
              $user->assignRole('admin');
            }else{
              $user->assignRole('socio');
            }
          }
        }

    }

}
