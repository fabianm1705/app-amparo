<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:navegar planes')->only('index');
    $this->middleware('can:eliminar planes')->only('destroy');
    $this->middleware('can:editar planes')->only(['edit','update']);
    $this->middleware('can:crear planes')->only(['create','store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subscriptions = Subscription::all();
      return view('admin.subscription.index',compact("subscriptions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $subscription = new Subscription();
      $subscription->description = $request->input('description');
      $subscription->grupal = $request->input('grupal');
      $subscription->sepelio_estandar = $request->input('sepelio_estandar');
      $subscription->sepelio_plus = $request->input('sepelio_plus');
      $subscription->odontologia = $request->input('odontologia');
      $subscription->salud = $request->input('salud');
      $subscription->orden_medica = $request->input('orden_medica');
      $subscription->precio_grupo = $request->input('precio_grupo');
      $subscription->precio_individual = $request->input('precio_individual');
      $subscription->precio_adherente = $request->input('precio_adherente');

      $subscription->save();

      return redirect()
        ->route('subscriptions.index')
        ->with('message','Plan registrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
      return view('admin.subscription.edit', compact("subscription"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
      $subscription->description = $request->input('description');
      $subscription->grupal = $request->input('grupal');
      $subscription->sepelio_estandar = $request->input('sepelio_estandar');
      $subscription->sepelio_plus = $request->input('sepelio_plus');
      $subscription->odontologia = $request->input('odontologia');
      $subscription->salud = $request->input('salud');
      $subscription->orden_medica = $request->input('orden_medica');
      $subscription->precio_grupo = $request->input('precio_grupo');
      $subscription->precio_individual = $request->input('precio_individual');
      $subscription->precio_adherente = $request->input('precio_adherente');

      $subscription->save();

      return redirect()
        ->route('subscriptions.index')
        ->with('message','Plan actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
      $subscription->delete();
      return redirect()->route('subscriptions.index');
    }
}
