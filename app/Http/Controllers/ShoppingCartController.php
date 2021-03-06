<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductsCollection;
use Config;
use Auth;
use Illuminate\Support\Carbon;
use App\ShoppingCart;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Mail;

class ShoppingCartController extends Controller
{
  public function __construct()
  {
    $this->middleware('shopping_cart');
  }

  public function index()
  {
    $shopping_carts = ShoppingCart::orderBy('id','desc')->where('status','=',1)->get();
    return view('admin.shopping_cart.index',['shopping_carts' => $shopping_carts]);
  }

  public function show(Request $request)
  {
    registro_acceso(9,'Directo al Carrito');
    $payment_methods = PaymentMethod::where('activo',1)->get();
    $productsCost = $request->shopping_cart->amount();
    return view('admin.shopping_cart.cart',
    ['shopping_cart' => $request->shopping_cart,
    'payment_methods' => $payment_methods,
    'productsCost' => $productsCost]);
  }

  public function show3(Request $request,Product $product)
  {
    registro_acceso(9,$product->modelo);
    $payment_methods = PaymentMethod::where('activo',1)->get();
    $productsCost = $request->shopping_cart->amount();
    return view('admin.shopping_cart.cart',
    ['shopping_cart' => $request->shopping_cart,
    'payment_methods' => $payment_methods,
    'productsCost' => $productsCost]);
  }

  public function show2(ShoppingCart $shopping_cart)
  {
    $payment_method = PaymentMethod::where('id',$shopping_cart->payment_method_id)->get();
    $productsCost = $request->shopping_cart->amount();
    return view('admin.shopping_cart.cartfin',
    ['shopping_cart' => $shopping_cart,
    'payment_method' => $payment_method,
    'productsCost' => $productsCost]);
  }

  public function store(Request $request)
  {
    Mail::send('admin.contacto.emailCompraFinalizada', array(
            'name' => 'Probando',
            'user_message' => 'Mensaje'
         ), function($message){
             $message->from('admin@amparosrl.com.ar');
             $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
            ->subject('Socio: Confirmaron una compra en el Shopping');
    });
    registro_acceso(10,'');
    $request->shopping_cart->status = 1;
    $request->shopping_cart->user_id = Auth::user()->id;
    $request->shopping_cart->fecha = Carbon::now();
    $request->shopping_cart->payment_method_id = $request->input('payment_method_id');
    $productsCost = $request->shopping_cart->amount();
    $request->shopping_cart->save();
    $payment_methods = PaymentMethod::where('id',$request->shopping_cart->payment_method_id)->get();
    $shopping_cart_vendido = $request->shopping_cart;
    \Session::pull('shopping_cart_id', $shopping_cart_vendido->id);

    return view('admin.shopping_cart.cartfin',
    ['shopping_cart' => $shopping_cart_vendido,
    'payment_methods' => $payment_methods,
    'productsCost' => $productsCost])->with('message','Compra finalizada!');
  }

  public function products(Request $request)
  {
    return new ProductsCollection($request->shopping_cart->products()->get());
  }

  public function destroy($id)
  {
    DB::table('product_in_shopping_carts')->where('shopping_cart_id', '=', $id)->delete();
    $shopping_cart = ShoppingCart::find($id);
    $shopping_cart->delete();
    return redirect()->route('shopping_cart.index');
  }
}
