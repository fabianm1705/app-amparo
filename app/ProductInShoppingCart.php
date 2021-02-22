<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInShoppingCart extends Model
{
  protected $fillable = [
      'product_id', 'shopping_cart_id','cantidadCuotas','cantidadUnidades','costo','percentage'
  ];

  public function product()
  {
    return $this->belongsTo('App\Models\Product');
  }

}
