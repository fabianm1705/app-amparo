<?php

use Illuminate\Database\Seeder;
use App\Models\Layer;
use App\User;
use App\Subscription;
use Illuminate\Support\Str;

class LayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lineas = file('storage/app/public/iplanes.txt');
      foreach ($lineas as $linea)
      {
        $datos = explode("|", $linea);
        if($datos<>""){
          $layer = new Layer();
          $layer->nombre = Str::title(utf8_encode(trim($datos[2])));
          $layer->monto = intval(trim($datos[3]));
          $layer->emiteOrden = intval(trim($datos[5]));

          $user = User::where('name', '=', utf8_encode(trim($datos[4])))
                        ->get()->first();
          if (isset($user)) {
            if($user->group->nroSocio==utf8_encode(trim($datos[0]))){
              $layer->user_id=$user->id;
            }
          }

          $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[2])))
                        ->get()->first();
          if (isset($subscription)) {
            $layer->subscription_id=$subscription->id;
          }

          $layer->save();
        }
      }
    }
}
