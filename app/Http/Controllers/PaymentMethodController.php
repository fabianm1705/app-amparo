<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:navegar listas de precios')->only('index');
    $this->middleware('can:eliminar listas de precios')->only('destroy');
    $this->middleware('can:editar listas de precios')->only(['edit','update']);
    $this->middleware('can:crear listas de precios')->only(['create','store']);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $payment_methods = PaymentMethod::all();
    return view('admin.payment_method.index',compact("payment_methods"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.payment_method.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $payment_method = new PaymentMethod;
    $payment_method->name = $request->input('name');
    $payment_method->percentage = $request->input('percentage');
    $payment_method->cant_cuotas = $request->input('cant_cuotas');
    $payment_method->activo = $request->input('activo');

    $payment_method->save();

    return redirect()
      ->route('payment_methods.index')
      ->with('message','Método de Pago Registrado');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(PaymentMethod $payment_method)
  {
    return view('admin.payment_method.edit', compact("payment_method"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, PaymentMethod $payment_method)
  {
    $payment_method->name = $request->input('name');
    $payment_method->percentage = $request->input('percentage');
    $payment_method->cant_cuotas = $request->input('cant_cuotas');
    $payment_method->activo = $request->input('activo');

    $payment_method->save();

    return redirect()
      ->route('payment_methods.index')
      ->with('message','Método de Pago Actualizado');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(PaymentMethod $payment_method)
  {
    $payment_method->delete();
    return redirect()
      ->route('payment_methods.index');
  }
}
