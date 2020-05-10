<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Mail;

class ContactUsController extends Controller
{

  public function contactoApp(Request $request)
  {
      $this->validate($request, [
         'name' => 'required',
         'message' => 'required'
       ]);

      Mail::send('admin.contacto.emailApp', array(
              'name' => $request->get('name'),
              'address' => $request->get('address'),
              'telephone' => $request->get('telephone'),
              'email' => $request->get('email'),
              'user_message' => $request->get('message')
           ), function($message){
                $message->from('admin@amparosrl.com.ar');
                $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Socio: Alguien ha enviado un mensaje');
      });
      return redirect('home')->with('message', '¡Gracias por el mensaje! Nos contactaremos a la brevedad.');
  }

  public function contactoLlamada(Request $request)
  {
      $this->validate($request, [
         'nombre' => 'required',
         'telefono' => 'required'
       ]);

      Mail::send('admin.contacto.emailLlamada', array(
              'nombre' => $request->get('nombre'),
              'telefono' => $request->get('telefono'),
              'horario' => $request->get('horario'),
           ), function($message){
                $message->from('admin@amparosrl.com.ar');
                $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Visitante: Alguien solicita una llamada');
      });
      return redirect('/')->with('jsAlert', '¡Gracias! Nos contactaremos a la brevedad');
  }

  public function contactoPromotor(Request $request)
  {
      $this->validate($request, [
         'nombre' => 'required',
         'domicilio' => 'required',
         'telefono' => 'required'
       ]);

      Mail::send('admin.contacto.emailPromotor', array(
              'nombre' => $request->get('nombre'),
              'domicilio' => $request->get('domicilio'),
              'telefono' => $request->get('telefono'),
              'horario' => $request->get('horario'),
           ), function($message){
                $message->from('admin@amparosrl.com.ar');
                $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Visitante: Alguien solicita un promotor');
      });
      return redirect('/')->with('jsAlert', '¡Gracias! Nos contactaremos para coordinar la visita.');
  }

  public function contactoWelcome(Request $request)
  {
      $this->validate($request, [
         'name' => 'required',
         'message' => 'required'
       ]);

      Mail::send('admin.contacto.emailApp', array(
              'name' => $request->get('name'),
              'address' => $request->get('address'),
              'telephone' => $request->get('telephone'),
              'email' => $request->get('email'),
              'user_message' => $request->get('message')
           ), function($message){
               $message->from('admin@amparosrl.com.ar');
               $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
              ->subject('Visitante: Alguien ha enviado un mensaje');
      });
      return redirect('/')->with('jsAlert', 'Gracias por el mensaje, ¡Nos contactaremos a la brevedad!');
  }

}
