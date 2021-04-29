<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ProductInShoppingCart;
use App\Models\Product;

class BtnAddProd extends Component
{
    public $product_id;
    protected $listeners = ['agregarProd'];

    public function mount($product_id)
    {
      $this->product_id = $product_id;
    }

    public function agregarProd()
    {
      $product = Product::find($this->product_id);
      $sessionName = 'shopping_cart_id';
      $shopping_cart_id = \Session::get($sessionName);
      $porcentaje = $product->payment_method->payment_method_items()->where('cuotas',1)->get()->first();
      $inShoppingCart = ProductInShoppingCart::create([
        'shopping_cart_id' => $shopping_cart_id,
        'product_id' => $this->product_id,
        'cantidadUnidades' => 1,
        'cantidadCuotas' => 1,
        'costo' => $product->costo,
        'percentage' => $porcentaje->percentage
      ]);
      $this->emit('addProd');
    }

    public function render()
    {
      return view('livewire.btn-add-prod');
    }
}
