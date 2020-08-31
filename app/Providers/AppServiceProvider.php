<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\ShoppingCart;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('path.public',function(){
      		return'/home/fabianm/public_html';
    	});
    }

    /**
     *
     * Acá puedo meter cualquier variable y estará disponible en todas las vistas
     * @return void
     */
    public function boot()
    {
      setlocale(LC_ALL, 'es_ES');
      Schema::defaultStringLength(120);
      View::composer('*',function($view){
        $sessionName = 'shopping_cart_id';
        $shopping_cart_id = \Session::get($sessionName);
        $shopping_cart = ShoppingCart::findOrCreateById($shopping_cart_id);
        \Session::put($sessionName, $shopping_cart->id);
        $view->with('productsCount', $shopping_cart->productsCount());
      });
      $porccontado=15;
      if(Schema::hasTable('payment_methods')){
        $payment_methods = DB::table('payment_methods')->where('cant_cuotas',1)->get();
        if($payment_methods){
          foreach($payment_methods as $payment_method){
            $porccontado = $payment_method->percentage;
          }
        }
      }
      View::share('porccontado', $porccontado);
    }
}
