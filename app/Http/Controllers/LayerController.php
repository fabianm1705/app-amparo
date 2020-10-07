<?php

namespace App\Http\Controllers;

use App\Models\Layer;
use Illuminate\Support\Facades\DB;
use Auth;
use Mail;

class LayerController extends Controller
{
    public function getLayers($id)
    {
      $layers = DB::table('layers')->where('user_id', '=', $id)->where('activo',1)->get();
      return $layers;
    }

    public function activarSalud($precio_individual_salud)
    {
      registro_acceso(11,'Plan Salud Individual');
      Mail::send('admin.contacto.emailActivaPlan', array(
              'name' => 'Probando',
              'user_message' => 'Mensaje'
           ), function($message){
               $message->from('admin@amparosrl.com.ar');
               $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Socio: Activaron un plan');
      });
      Layer::create([
                    'nombre' => 'Amparo Salud',
                    'monto' => $precio_individual_salud,
                    'user_id' => Auth::user()->id,
                    'subscription_id' => 6
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Ya puedes emitir órdenes médicas de consulta.');
    }

    public function activarOdontologia($precio_individual_odontologia)
    {
      registro_acceso(11,'Plan Odontológico');
      Mail::send('admin.contacto.emailActivaPlan', array(
              'name' => 'Probando',
              'user_message' => 'Mensaje'
           ), function($message){
               $message->from('admin@amparosrl.com.ar');
               $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Socio: Activaron un plan');
      });
      Layer::create([
                    'nombre' => 'Amparo Odontológico',
                    'monto' => $precio_individual_odontologia,
                    'user_id' => Auth::user()->id,
                    'subscription_id' => 9
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Llamanos o escribenos a la oficina para comenzar a utilizarlo.');
    }
}
