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
      \Carbon\Carbon::setlocale('es');
      \Carbon\Carbon::setlocale(LC_TIME,'es_ES');
      Schema::defaultStringLength(120);
      View::composer('*',function($view){
        $sessionName = 'shopping_cart_id';
        $shopping_cart_id = \Session::get($sessionName);
        $shopping_cart = ShoppingCart::findOrCreateById($shopping_cart_id);
        \Session::put($sessionName, $shopping_cart->id);
        $view->with('productsCount', $shopping_cart->productsCount());
      });
      if(Schema::hasTable('payment_methods')){
        $cuotas = DB::table('payment_methods')->where('id',1)->get();
        if($cuotas->isEmpty()){
          $porccuotas = 23;
        }else{
          foreach($cuotas as $cuota){
            $porccuotas = $cuota->percentage;
          }
        }
        View::share('porccuotas', $porccuotas);
        View::share('porccredito', 15);
      }
    }
}
