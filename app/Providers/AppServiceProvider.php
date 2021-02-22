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

      $precio_grupo_salud=900;
      $precio_individual_salud=600;
      if(Schema::hasTable('subscriptions')){
        $subscriptions = DB::table('subscriptions')->where('id',5)->get();
        if($subscriptions){
          foreach($subscriptions as $subscription){
            $precio_grupo_salud = $subscription->precio_grupo;
            $precio_individual_salud = $subscription->precio_individual;
          }
        }
      }
      View::share('precio_grupo_salud', $precio_grupo_salud);
      View::share('precio_individual_salud', $precio_individual_salud);

      $precio_adherente_odontologia=180;
      $precio_individual_odontologia=220;
      if(Schema::hasTable('subscriptions')){
        $subscriptions = DB::table('subscriptions')->where('id',9)->get();
        if($subscriptions){
          foreach($subscriptions as $subscription){
            $precio_adherente_odontologia = $subscription->precio_adherente;
            $precio_individual_odontologia = $subscription->precio_individual;
          }
        }
      }
      View::share('precio_adherente_odontologia', $precio_adherente_odontologia);
      View::share('precio_individual_odontologia', $precio_individual_odontologia);

      $precio_individual_joven=850;
      if(Schema::hasTable('subscriptions')){
        $subscriptions = DB::table('subscriptions')->where('id',7)->get();
        if($subscriptions){
          foreach($subscriptions as $subscription){
            $precio_individual_joven = $subscription->precio_individual;
          }
        }
      }
      View::share('precio_individual_joven', $precio_individual_joven);

      $porccontado=24;
      if(Schema::hasTable('payment_methods')){
        $payment_method = DB::table('payment_methods')->first();
        $porccontado = $payment_method->percentage;
      }
      View::share('porccontado', $porccontado);
    }
}
