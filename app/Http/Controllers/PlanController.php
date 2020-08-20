<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function getPlans($idGroup)
    {
      $plans = DB::table('plans')->where('group_id', '=', $idGroup)->get();
      return $plans;
    }

    public function activarPlan()
    {
      registro_acceso(11,'Plan Salud Grupal');
      Plan::create([
                    'nombre' => 'AMPARO SALUD PLUS',
                    'monto' => 900,
                    'group_id' => Auth::user()->group_id,
                    'subscription_id' => 5
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Ya puedes emitir órdenes médicas de consulta.');
    }
}
