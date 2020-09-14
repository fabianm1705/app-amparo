<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Auth;

class PlanController extends Controller
{
    public function getPlans($idGroup)
    {
      $plans = DB::table('plans')->where('group_id', '=', $idGroup)->where('activo',1)->get();
      return $plans;
    }

    public function activarPlan($precio_grupo_salud)
    {
      registro_acceso(11,'Plan Salud Grupal');
      Plan::create([
                    'nombre' => 'AMPARO SALUD PLUS',
                    'monto' => $precio_grupo_salud,
                    'group_id' => Auth::user()->group_id,
                    'subscription_id' => 5
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Ya puedes emitir órdenes médicas de consulta.');
    }
}
