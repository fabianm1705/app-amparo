<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductInShoppingCart;
use App\Models\Product;
use App\Http\Resources\ProductsCollection;

class ProductInShoppingCartsController extends Controller
{
  public function __construct()
  {
    $this->middleware('shopping_cart');
  }

  public function store(Request $request)
  {
    $product = Product::find($request->product_id);
    $porcentaje = $product->payment_method->payment_method_items()->where('cuotas',1)->get()->first();
    $inShoppingCart = ProductInShoppingCart::create([
      'shopping_cart_id' => $request->shopping_cart->id,
      'product_id' => $request->product_id,
      'cantidadUnidades' => 1,
      'cantidadCuotas' => 1,
      'costo' => $product->costo,
      'percentage' => $porcentaje->percentage
    ]);
    if($inShoppingCart){
      return redirect()->back();
    }
    return redirect()->back()->withErrors('Hubo un problema');
  }

  public function update(Request $request)
  {
    $productInShoppingCart = ProductInShoppingCart::where([
                ['product_id', '=', $request->product_id],
                ['shopping_cart_id', '=', $request->shopping_cart_id]])->get()->first();
    $productInShoppingCart->cantidadUnidades = $request->cant;
    $productInShoppingCart->save();
    if($productInShoppingCart){
      return "Actualizado con éxito ".$productInShoppingCart->cantidadUnidades;
    }
  }

  public function products(Request $request)
  {
    return new ProductsCollection($request->shopping_cart->products()->get());
  }

  public function destroy($id)
  {
    $shopping_cart_id = \Session::get('shopping_cart_id');
    $productInShoppingCart = ProductInShoppingCart::where([
                ['product_id', '=', $id],
                ['shopping_cart_id', '=', $shopping_cart_id],
            ])->get()->first();
    $productInShoppingCart->delete();
    return redirect()->to('/carrito');
  }

  public function getProducts($id)
  {
    $products = ProductInShoppingCart::where('shopping_cart_id',$id)->get();
    foreach($products as $producto){
        $producto->modelo = $producto->product->modelo;
    }
    return $products;
  }

}
