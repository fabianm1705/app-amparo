<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\ShoppingCart;
use Illuminate\Support\Carbon;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('mensaje', function () {
    return view('mensaje_suelto');
})->name('mensaje_suelto');

Route::get('privacidad', function () {
    return view('privacidad');
})->name('privacidad');

Route::get('frecuentes', function () {
    return view('admin.frecuentes');
})->name('preguntas.frecuentes');

Route::get('installApp', function () {
    return view('installApp');
})->name('installApp');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')
              ->name('home');

Route::group(['prefix' => 'admin'], function() {
  Route::resource('specialties', 'SpecialtyController')
              ->except('show')
              ->middleware('auth');
  Route::resource('subscriptions', 'SubscriptionController')
              ->except('show')
              ->middleware('auth');
  Route::resource('doctors', 'DoctorController')
              ->except('show')
              ->middleware('auth');
  Route::resource('categories', 'CategoryController')
              ->except('show')
              ->middleware('auth');
  Route::resource('orders', 'OrderController')
              ->except('show')
              ->middleware('auth');
  Route::resource('products', 'ProductController')
              ->except('show')
              ->middleware('auth');
  Route::resource('roles', 'RoleController')
              ->except('show')
              ->middleware('auth');
  Route::resource('interests', 'InterestController')
              ->except('show')
              ->middleware('auth');
  Route::resource('receipts', 'ReceiptController')
              ->except(['show','create','store','update','edit'])
              ->middleware('auth');
  Route::resource('payment_methods', 'PaymentMethodController')
              ->except('show')
              ->middleware('auth');
  Route::resource('payment_method_items', 'PaymentMethodItemsController')
              ->middleware('auth');
  Route::resource('users', 'UserController')
              ->except(['store','create','show'])
              ->middleware('auth');
});

// ShoppingCartController maneja sólo el carrito actual
Route::get('/carrito', 'ShoppingCartController@show')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.cart');
Route::get('/carrito/{product}', 'ShoppingCartController@show3')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.buy');
Route::get('/carrito/productos', 'ShoppingCartController@products')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.products');
Route::post('/carritostore', 'ShoppingCartController@store')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.store');
Route::get('/carritofin', 'ShoppingCartController@show2')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.show');
Route::post('/pagar', 'ShoppingCartController@iniciarProcesoCobro')
              ->middleware(['auth','can:carrito'])
              ->name('iniciar.pago');
Route::get('/shoppingcart', 'ShoppingCartController@index')
              ->middleware(['auth','can:navegar shoppings'])
              ->name('shopping_cart.index');
Route::delete('/shopping_cart_destroy/{id}', 'ShoppingCartController@destroy')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.destroy');
Route::post('/getProducts/{id}', 'ProductInShoppingCartsController@getProducts')
              ->middleware('auth')
              ->name('getProducts');
Route::post('/updateCart', 'ProductInShoppingCartsController@update')
              ->middleware('auth')
              ->name('updateCart');


Route::delete('/out_shopping_cart/{id}', 'ProductInShoppingCartsController@destroy')
              ->middleware(['auth','can:carrito'])
              ->name('out_shopping_cart.destroy');
Route::post('/in_shopping_cart/{product_id}', 'ProductInShoppingCartsController@store')
              ->middleware(['auth','can:carrito'])
              ->name('in_shopping_cart.store');

Route::get('/user_interest', 'InterestController@visor')
              ->middleware(['auth','can:ver accesos'])
              ->name('interests.visor');
Route::delete('/out_user_interest/{id}', 'InterestController@borrar')
              ->middleware(['auth','can:eliminar zonas de interes'])
              ->name('user_interest.borrar');

//Buscar socios
Route::get('emergencia', 'UserController@emergencia')
              ->middleware(['auth','can:padron sos'])
              ->name('emergencia');
Route::get('odontologia', 'UserController@odontologia')
              ->middleware(['auth','can:padron aop'])
              ->name('odontologia');
Route::get('users/search', 'OrderController@search')
                    ->middleware(['auth','can:emitir ordenes'])
                    ->name('usersSearch');
Route::post('search/{name?}/{nroDoc?}/', 'UserController@getUsers')
              ->middleware('auth')
              ->where(['nroDoc' => '[0-9]+'])
              ->name('users.search');


Route::get('orders/search/{id}', 'OrderController@getOrdenes')
                    ->middleware('auth')
                    ->name('orders.search');
Route::post('/orders/pay/{id}', 'OrderController@pay')
              ->middleware('auth')
              ->name('orders.pay');

Route::get('uploadfiles', function () {
                return view('admin.upload');
            })->middleware('auth')
              ->name('users.uploadfiles');
Route::post('updatedb', 'UserController@upload')
              ->middleware(['auth','can:actualizar padron'])
              ->name('users.updatedb');

Route::post('activar/plan/{precio_grupo_salud}', 'PlanController@activarPlan')
              ->middleware('auth')
              ->name('activar.plan');
Route::post('activar/salud/{precio_individual_salud}', 'LayerController@activarSalud')
              ->middleware('auth')
              ->name('activar.salud');
Route::post('activar/odontologia/{precio_individual_odontologia}', 'LayerController@activarOdontologia')
              ->middleware('auth')
              ->name('activar.odontologia');


Route::get('pdf/{id}', 'PDFController@orden')
              ->middleware('auth')
              ->name('pdf');
Route::get('factura/{id}', 'PDFController@factura')
              ->middleware('auth')
              ->name('factura');
Route::get('imprimir/recibo/{id}', 'PDFController@recibo')
              ->middleware('auth')
              ->name('receipts.show');
Route::get('recibo/crear/{id}', 'ReceiptController@create')
              ->middleware(['auth'])
              ->name('receipts.create');
Route::post('recibo/store', 'ReceiptController@store')
              ->middleware('auth')
              ->name('receipts.store');

Route::get('asignar/roles', 'UserController@asignarRoles')
                    ->name('asignar.roles');

//Especialidades y médicos
Route::get('lector/qr', 'OrderController@lector')
                    ->middleware(['auth','can:validar qr orden'])
                    ->name('lector.qr');
Route::post('validar/qr/{id}', 'OrderController@validar')
                    ->middleware(['auth','can:validar qr orden'])
                    ->name('validar.qr');
Route::get('doctors/mostrar', 'DoctorController@mostrar')
                    ->middleware(['auth','can:mostrar profesionales'])
                    ->name('doctors.mostrar');
Route::post('/getDoctors/{id}', 'DoctorController@getDoctors')
              ->middleware('auth')
              ->name('getDoctors');
Route::post('/getProfesionales/{id}', 'DoctorController@getProfesionales')
              ->middleware('auth')
              ->name('getProfesionales');
Route::post('/getCoseguro/{id}', 'SpecialtyController@getCoseguro')
              ->middleware('auth')
              ->name('getCoseguro');
Route::post('/getDataUser/{id}', 'SpecialtyController@getDataUser')
              ->middleware('auth')
              ->name('getDataUser');
Route::post('/getOrdenes/{id}', 'OrderController@getOrdenes')
              ->middleware('auth')
              ->name('getOrdenes');


//Shopping y productos
Route::get('/admin/products/{productId}', 'ProductController@show')
              ->middleware('auth')
              ->name('products.show');
Route::get('products/shopping', 'ProductController@shopping')
              ->middleware(['auth','can:shopping'])
              ->name('products.shopping');
Route::get('getCategories', 'CategoryController@getCategories')
              ->middleware('auth')
              ->name('getCategories');
Route::post('getProductsXCategory/{id}', 'ProductController@getProductsXCategory')
              ->middleware('auth')
              ->name('getProductsXCategory');

Route::post('/process_payment', 'MercadoPagoController@process_payment')
              ->middleware('auth');

//Ordenes
Route::get('orders/indice', 'OrderController@indice')
              ->middleware(['auth','can:navegar ordenes'])
              ->name('orders.indice');
Route::get('orders/indice/profesional', 'OrderController@indice_profesional')
              ->middleware(['auth','can:validar qr orden'])
              ->name('orders.indice.profesional');

Route::get('users/panel/{id}', 'UserController@panel')
              ->middleware(['auth','can:ver panel socios'])
              ->name('users.panel');
Route::get('users/suscripcion', 'UserController@suscripcion')
              ->middleware('auth')
              ->name('users.suscripcion');
Route::get('users/pagos', 'UserController@pagos')
              ->middleware('auth','can:modulo pagos')
              ->name('users.pagos');
Route::post('users/pago/tarjeta/', 'UserController@pagoConTarjeta')
              ->middleware('auth')
              ->name('users.pagoConTarjeta');
Route::get('password/edit', 'UserController@editPassword')
              ->name('password.edit');
Route::post('password/change', 'UserController@change')
              ->name('password.change');

//Planes de grupo e individuales del socio
Route::post('getPlans/{idGroup}', 'PlanController@getPlans')
              ->middleware('auth')
              ->name('getPlans');
Route::post('getLayers/{id}', 'LayerController@getLayers')
              ->middleware('auth')
              ->name('getLayers');


Route::get('otros', function () {return view('admin.otros');})
              ->middleware(['auth','can:otros servicios'])
              ->name('otros');
Route::get('planes', 'UserController@planes')
              ->middleware(['auth','can:ver planes'])
              ->name('planes');
Route::post('darkmode', 'UserController@darkMode')
              ->middleware(['auth'])
              ->name('users.darkMode');
Route::get('users/afiliar', function () {
  return view('admin.user.afiliar');
})->name('users.afiliar');
Route::get('users/promotor', function () {
  return view('admin.user.promotor');
})->name('users.promotor');

// Contactos
Route::get('contacto/app', function () {
  return view('admin.contacto.app');
})->middleware('auth')->name('contacto.appVista');
Route::post('contacto/app','ContactUsController@contactoApp')
  ->middleware('auth')->name('contacto.app');

Route::get('contacto/llamada', function () {
  return view('admin.contacto.llamada');
})->name('contacto.llamadaVista');
Route::post('contacto/llamada','ContactUsController@contactoLlamada')
  ->name('contacto.llamada');

Route::get('contacto/promotor', function () {
  return view('admin.contacto.promotor');
})->name('contacto.promotorVista');
Route::post('contacto/promotor','ContactUsController@contactoPromotor')
  ->name('contacto.promotor');

Route::post('/','ContactUsController@contactoWelcome')
  ->name('contacto.welcome');

Route::post('/notifications', function () {
    $shopping_cart = ShoppingCart::where('operation_id',$_POST["id"])->get()->first();
    if($shopping_cart){
      $shopping_cart->estado = 'pagado';
      $shopping_cart->fechaPago = Carbon::now();
      $shopping_cart->save();
    }
    return http_response_code(200);
});
