<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Group;
use App\Subscription;
use Illuminate\Support\Str;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $lineas = file('storage/app/public/planes.txt');
      foreach ($lineas as $linea)
      {
        $datos = explode("|", $linea);
        if($datos<>""){
          $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[0])))
                                    ->get()->first();
          if(isset($group)){
            $plan = new Plan();
            $plan->group_id=$group->id;
            $plan->nombre = Str::title(utf8_encode(trim($datos[1])));
            $plan->monto = intval(trim($datos[2]));
            $plan->emiteOrden = intval(trim($datos[3]));

            $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[1])))
                          ->get()->first();
            if (isset($subscription)) {
              $plan->subscription_id=$subscription->id;
            }

            $plan->save();
          }
        }
      }
    }
}
