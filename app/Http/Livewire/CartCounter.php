<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ShoppingCart;

class CartCounter extends Component
{
  public $count = 0;
  protected $listeners = ['addProd' => 'increment'];

  public function increment()
  {
      $this->count++;
  }

  public function render()
  {
    $sessionName = 'shopping_cart_id';
    $shopping_cart_id = \Session::get($sessionName);
    $shopping_cart = ShoppingCart::find($shopping_cart_id);
    $this->count = $shopping_cart->productsCount();
    return view('livewire.cart-counter');
  }
}
