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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('about', function () {
    return view('about');
})->name('about');

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
              ->middleware('auth');
  Route::resource('subscriptions', 'SubscriptionController')
              ->middleware('auth');
  Route::resource('doctors', 'DoctorController')
              ->middleware('auth');
  Route::resource('categories', 'CategoryController')
              ->middleware('auth');
  Route::resource('orders', 'OrderController')
              ->middleware('auth');
  Route::resource('products', 'ProductController')
              ->middleware('auth');
  Route::resource('roles', 'RoleController')
              ->middleware('auth');
  Route::resource('profits', 'ProfitController')
              ->middleware('auth');
  Route::resource('interests', 'InterestController')
              ->middleware('auth');
  Route::resource('payment_methods', 'PaymentMethodController')
              ->except('show')
              ->middleware('auth');
  Route::resource('users', 'UserController')
              ->except(['store','create'])
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
              ->middleware(['auth','can:shopping_cart.index'])
              ->name('shopping_cart.index');
Route::delete('/shopping_cart_destroy/{id}', 'ShoppingCartController@destroy')
              ->middleware(['auth','can:carrito'])
              ->name('shopping_cart.destroy');
Route::post('/getProducts/{id}', 'ProductInShoppingCartsController@getProducts')
              ->middleware('auth')
              ->name('getProducts');


Route::delete('/out_shopping_cart/{id}', 'ProductInShoppingCartsController@destroy')
              ->middleware(['auth','can:carrito'])
              ->name('out_shopping_cart.destroy');
Route::post('/in_shopping_cart/{product_id}', 'ProductInShoppingCartsController@store')
              ->middleware(['auth','can:carrito'])
              ->name('in_shopping_cart.store');

Route::get('/user_interest', 'InterestController@visor')
              ->middleware(['auth','can:interests.index'])
              ->name('interests.visor');
Route::delete('/out_user_interest/{id}', 'InterestController@borrar')
              ->middleware(['auth','can:interests.destroy'])
              ->name('user_interest.borrar');


//Buscar socios
Route::get('emergencia', 'UserController@emergencia')
              ->middleware('auth')
              ->name('emergencia');
Route::get('odontologia', 'UserController@odontologia')
              ->middleware('auth')
              ->name('odontologia');
Route::get('users/search', 'OrderController@search')
                    ->middleware(['auth','can:orders.create'])
                    ->name('usersSearch');
Route::post('search/{name?}/{nroDoc?}/', 'UserController@getUsers')
              ->middleware('auth')
              ->where(['nroDoc' => '[0-9]+'])
              ->name('users.search');

Route::get('uploadfiles', function () {
                return view('admin.upload');
            })->middleware('auth')
              ->name('users.uploadfiles');
Route::post('updatedb', 'UserController@upload')
              ->middleware('auth')
              ->name('users.updatedb');

Route::post('activar/plan', 'PlanController@activarPlan')
              ->middleware('auth')
              ->name('activar.plan');
Route::post('activar/salud', 'LayerController@activarSalud')
              ->middleware('auth')
              ->name('activar.salud');
Route::post('activar/odontologia', 'LayerController@activarOdontologia')
              ->middleware('auth')
              ->name('activar.odontologia');


Route::get('pdf/{id}', 'PDFController@invoice')
              ->middleware('auth')
              ->name('pdf');
Route::get('imprimir/recibo/{id}/letras/{num_en_letras}', 'PDFController@recibo')
              ->middleware('auth')
              ->name('recibo');
Route::get('recibo/crear/{id}', 'ReceiptController@create')
              ->middleware(['auth'])
              ->name('receipt.create');
Route::post('recibo/store', 'ReceiptController@store')
              ->middleware('auth')
              ->name('receipt.store');

Route::get('asignar/roles', 'UserController@asignarRoles')
                    ->name('asignar.roles');

//Especialidades y médicos
Route::get('doctors/mostrar', 'DoctorController@mostrar')
                    ->middleware(['auth','can:doctors.mostrar'])
                    ->name('doctors.mostrar');
Route::post('/getDoctors/{id}', 'DoctorController@getDoctors')
              ->middleware('auth')
              ->name('getDoctors');
Route::post('/checkSocio/{id}', 'UserController@checkSocio')
              ->middleware('auth')
              ->name('checkSocio');
Route::post('/getCoseguro/{id}', 'SpecialtyController@getCoseguro')
              ->middleware('auth')
              ->name('getCoseguro');


//Shopping y productos
Route::get('/admin/products/{productId}', 'ProductController@show')
              ->middleware(['auth'])
              ->name('products.show');
Route::get('products/shopping', 'ProductController@shopping')
              ->middleware(['auth','can:products.shopping'])
              ->name('products.shopping');
Route::get('getCategories', 'CategoryController@getCategories')
              ->middleware('auth')
              ->name('getCategories');
Route::post('getProductsXCategory/{id}', 'ProductController@getProductsXCategory')
              ->middleware('auth')
              ->name('getProductsXCategory');

//Ordenes
Route::get('orders/crear', 'OrderController@crear')
              ->middleware(['auth','can:orders.crear'])
              ->name('orders.crear');
Route::get('orders/indice', 'OrderController@indice')
              ->middleware(['auth','can:orders.indice'])
              ->name('orders.indice');
Route::post('getOnlyOrders/{id}', 'OrderController@getOnlyOrders')
              ->middleware('auth')
              ->name('getOnlyOrders');
Route::post('cantOrders/{id}', 'OrderController@cantOrders')
              ->middleware('auth')
              ->name('cantOrders');

Route::get('users/panel/{id}', 'UserController@panel')
              ->middleware(['auth','can:users.panel'])
              ->name('users.panel');
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
              ->middleware(['auth','can:otros'])
              ->name('otros');
Route::get('planes', 'UserController@planes')
              ->middleware(['auth','can:planes'])
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
