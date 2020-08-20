<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use Illuminate\Support\Facades\DB;

class LayerController extends Controller
{
    public function getLayers($id)
    {
      $layers = DB::table('layers')->where('user_id', '=', $id)->get();
      return $layers;
    }

    public function activarSalud()
    {
      registro_acceso(11,'Plan Salud Individual');
      Layer::create([
                    'nombre' => 'Amparo Salud',
                    'monto' => 600,
                    'user_id' => Auth::user()->id,
                    'subscription_id' => 6
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Ya puedes emitir órdenes médicas de consulta.');
    }

    public function activarOdontologia()
    {
      registro_acceso(11,'Plan Odontológico');
      Layer::create([
                    'nombre' => 'Amparo Odontológico',
                    'monto' => 220,
                    'user_id' => Auth::user()->id,
                    'subscription_id' => 9
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Llamanos o escribenos a la oficina para comenzar a utilizarlo.');
    }
}
