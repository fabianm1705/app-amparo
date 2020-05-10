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
    $inShoppingCart = ProductInShoppingCart::create([
      'shopping_cart_id' => $request->shopping_cart->id,
      'product_id' => $request->product_id,
      'cantidadUnidades' => 1,
      'costo' => $product->costo
    ]);
    if($inShoppingCart){
      return redirect()->back();
    }
    return redirect()->back()->withErrors('Hubo un problema');
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
    //Tomar los Id de todos los usuarios del grupo
    $productsId = ProductInShoppingCart::where('shopping_cart_id',$id)->pluck('product_id')->toArray();
    //Para buscar las órdenes de todos
    $products = Product::whereIn('id',$productsId)->orderBy('id', 'desc')->get();
    return $products;
  }

}
