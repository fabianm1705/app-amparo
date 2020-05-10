<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInShoppingCart extends Model
{
  protected $fillable = [
      'product_id', 'shopping_cart_id','cantidadCuotas','cantidadUnidades','total','costo'
  ];
}
