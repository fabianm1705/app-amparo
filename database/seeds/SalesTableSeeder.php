<?php

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Group;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lineas = file('storage/app/public/facturas.txt');
      foreach ($lineas as $linea)
      {
        $datos = explode("|", $linea);
        if($datos<>""){
          $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[4])))
                                    ->get()->first();
          if(isset($group)){
            $sale = new Sale();
            $sale->group_id=$group->id;
            $sale->nroFactura = intval(trim($datos[0]));
            $sale->total = intval(trim($datos[1]));
            $time = strtotime($datos[2]);
            $sale->fechaEmision = date('Y-m-d',$time);
            if($datos[3]<>""){
              $time = strtotime($datos[3]);
              $sale->fechaPago = date('Y-m-d',$time);
            }

            $sale->save();
          }
        }
      }
    }
}
