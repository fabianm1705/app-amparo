<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductsCollection;
use Config;
use MercadoPago\SDK;
use Auth;
use Illuminate\Support\Carbon;
use App\ShoppingCart;
use App\UserInterest;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

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
    $payment_methods = PaymentMethod::where('activo',1)->get();
    $productsCost = $request->shopping_cart->amount();
    $this->registroAcceso(9,'Directo al Carrito');
    return view('admin.shopping_cart.cart',
    ['shopping_cart' => $request->shopping_cart,
    'payment_methods' => $payment_methods,
    'productsCost' => $productsCost]);
  }

  public function show3(Request $request,Product $product)
  {
    $payment_methods = PaymentMethod::where('activo',1)->get();
    $productsCost = $request->shopping_cart->amount();
    $this->registroAcceso(9,$product->modelo);
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
    $this->registroAcceso(10,'');
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

  public function iniciarProcesoCobro()
  {
    $method = new \App\MercadoPago;
    $preference = $method->setupPaymentAndGetRedirectURL();
    return view('admin.shopping_cart.previaMercadoPago',['preference' => $preference]);
  }

  public function products(Request $request)
  {
    return new ProductsCollection($request->shopping_cart->products()->get());
  }

  protected function generatePaymentGateway(Request $request)
  {
      // pay de codigo facilito
      $shoppingCart = $request->shopping_cart;
      $method = new \App\MercadoPago;
      $amount = 10;

      return $method->setupPaymentAndGetRedirectURL();
  }

  public function iniciarProcesoPago(Request $request)
  {
      $allowedPaymentMethods = config('payment-methods.enabled');

      // $request->validate([
      //     'payment_method' => [
      //         'required',
      //         true,
      //     ],
      //     'terms' => 'accepted',
      // ]);
      $shoppingCart = $request->shopping_cart;
      # $order = $this->setUpOrder($preOrder, $request);
      //dd($order->id);
      $amount = $request->shopping_cart->amount();
      # $this->notify($order);
      $url = $this->generatePaymentGateway($request);
      return redirect()->to($url);
  }

  public function destroy($id)
  {
    DB::table('product_in_shopping_carts')->where('shopping_cart_id', '=', $id)->delete();
    $shopping_cart = ShoppingCart::find($id);
    $shopping_cart->delete();
    return redirect()->route('shopping_cart.index');
  }

  public function registroAcceso($interest_id,$obs)
  {
    foreach (Auth::user()->roles as $role){
      if(($role->slug<>'dev') and ($role->slug<>'admin')){
        UserInterest::create(['user_id' => Auth::user()->id,
                              'interest_id' => $interest_id,
                              'obs' => $obs]);
      }
    }
  }
}
