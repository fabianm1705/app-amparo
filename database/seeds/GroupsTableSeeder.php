<?php

use Illuminate\Database\Seeder;
use App\Models\Group;
use Illuminate\Support\Str;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lineas = file('storage/app/public/grupos.txt');
      foreach ($lineas as $linea)
      {
        $datos = explode("|", $linea);
        if($datos<>""){
          $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[0])))
                                    ->get()->first();
          if (is_null($group)) {
            $group = new Group();
          }
          $group->nroSocio = utf8_encode(trim($datos[0]));
          $group->fechaAlta = utf8_encode(trim($datos[1]));
          $group->email=utf8_encode(trim($datos[2]));
          $group->telefono=utf8_encode(trim($datos[3]));
          $group->direccion = Str::title(utf8_encode(trim($datos[4])));
          $group->direccionCobro = Str::title(utf8_encode(trim($datos[5])));
          $group->diaCobro = Str::lower(utf8_encode(trim($datos[6])));
          $group->horaCobro = Str::lower(utf8_encode(trim($datos[7])));
          $group->total = intval(trim($datos[8]));
          $group->activo=intval(trim($datos[9]));
          $group->save();
        }
      }
    }
}
