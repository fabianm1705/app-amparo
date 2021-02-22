<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    protected $fillable = [
        'status', 'fecha', 'user_id', 'payment_method_id',
    ];

    public static function findOrCreateById($shopping_cart_id)
    {
      if($shopping_cart_id){
        return ShoppingCart::find($shopping_cart_id);
      }else{
        return ShoppingCart::create();
      }
    }

    public static function createById($shopping_cart_id)
    {
      return ShoppingCart::create();
    }

    public function products(){
      return $this->belongsToMany('App\Models\Product','product_in_shopping_carts')->withPivot('cantidadUnidades', 'costo','percentage','cantidadCuotas');
    }

    public function productsCount(){
      return $this->products()->count();
    }

    public function amount()
    {
      $amount = 0;
      foreach ($this->products()->get() as $product) {
        foreach ($product->payment_method->payment_method_items->where('activo', 1)->where('cuotas', 1) as $payment_method_item){
          $amount = $amount + round($product->costo / 10 * (1+($payment_method_item->percentage/100))) * 10;
        }
      }
      return $amount;
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
