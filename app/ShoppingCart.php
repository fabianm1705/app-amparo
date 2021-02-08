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
      return $this->belongsToMany('App\Models\Product','product_in_shopping_carts');
    }

    public function productsCount(){
      return $this->products()->count();
    }

    public function amount(){
      $payment_methods = DB::table('payment_methods')->where('cant_cuotas',1)->get();
      $porccontado = 0;
      if($payment_methods){
        foreach($payment_methods as $payment_method){
          $porccontado = $payment_method->percentage;
        }
      }
      $margen =  1+($porccontado/100);
      return round(($this->products()->sum('product_in_shopping_carts.costo')*$margen/10),0)*10;
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function paymentMethod()
    {
      return $this->belongsTo('App\Models\PaymentMethod');
    }
}
