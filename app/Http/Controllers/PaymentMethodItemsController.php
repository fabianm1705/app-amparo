<?php

namespace App\Http\Controllers;

use App\PaymentMethodItem;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodItemsController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:navegar items de listas de precios')->only('index');
    $this->middleware('can:eliminar items de listas de precios')->only('destroy');
    $this->middleware('can:editar items de listas de precios')->only(['edit','update']);
    $this->middleware('can:crear items de listas de precios')->only(['create','store']);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $payment_methods = PaymentMethod::orderBy('name','asc')->get();
      $payment_method_items = PaymentMethodItem::orderBy('payment_method_id','asc')->get();

      return view('admin.payment_method_item.index',compact("payment_method_items","payment_methods"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $payment_methods = PaymentMethod::orderBy('name','asc')->get();
      return view('admin.payment_method_item.create', compact("payment_methods"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $payment_method_item = new PaymentMethodItem();
      $payment_method_item->name = $request->input('name');
      $payment_method_item->cuotas = $request->input('cuotas');
      $payment_method_item->percentage = $request->input('percentage');
      $payment_method_item->activo = $request->input('activo');
      $payment_method_item->payment_method_id = $request->input('payment_method_id');

      $payment_method_item->save();

      return redirect()
        ->route('payment_method_items.index',['payment_method_item' => $payment_method_item])
        ->with('message','Item Registrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethodItem  $paymentMethodItems
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethodItem $payment_method_item)
    {
      $payment_methods = PaymentMethod::orderBy('name','asc')->get();
      return view('admin.payment_method_item.edit', compact("payment_method_item","payment_methods"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethodItem  $paymentMethodItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethodItem $payment_method_item)
    {
      $payment_method_item->name = $request->input('name');
      $payment_method_item->cuotas = $request->input('cuotas');
      $payment_method_item->percentage = $request->input('percentage');
      $payment_method_item->activo = $request->input('activo');
      $payment_method_item->payment_method_id = $request->input('payment_method_id');

      $payment_method_item->save();

      return redirect()
        ->route('payment_method_items.index',['payment_method_item' => $payment_method_item])
        ->with('message','Item Registrado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethodItem  $paymentMethodItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethodItem $payment_method_item)
    {
      $payment_method_item->delete();
      return redirect()->route('payment_method_items.index');
    }
}
