<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#fff">
    <meta http-equiv="Cache-Control" content="max-age=31536000">

    <meta property="og:title" content="App | amparosrl.com.ar"/>
    <meta property="og:description" content="Aplicación disponible en Google Play, con toda la información de los servicios, productos y la posibilidad de emitir órdenes médicas." />
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://amparosrl.com.ar/images/logo200x200.png"/>
    <meta property="og:url" content="https://amparosrl.com.ar/home"/>
    <meta property="og:site_name" content="amparo"/>

    <meta
      name="description"
      content="Amparo es una empresa de servicios sociales nacida en 2003,
               dedicada a brindar servicios de medicina ambulatoria, sepelio y odontología.">
    <title>{{ config('app.name', 'Amparo') }}</title>
    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}" defer></script>
    @auth
      @if(Auth::user()->hasRole('desarrollador'))
        <script src="{{ asset('js/darkModeDev.js') }}" defer></script>
      @endif
      @if(Auth::user()->hasRole('admin'))
        <script src="{{ asset('js/darkModeAdmin.js') }}" defer></script>
      @endif
      @if(Auth::user()->hasRole('socio'))
        <script src="{{ asset('js/darkModeSocio.js') }}" defer></script>
      @endif
      @if(Auth::user()->hasAnyRole('aop','sos','profesional'))
        <script src="{{ asset('js/darkModeAOPSOS.js') }}" defer></script>
      @endif
    @endauth
    <!-- Styles -->
    <link href="{{ asset('css/fresh-bootstrap-table.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   @yield('myLinks')
   @livewireStyles
</head>

@auth
  <body id="cuerpo" onLoad="darkMode({{ Auth::user()->darkMode }})">
@endauth
@guest
  <body id="cuerpo">
@endguest
    <div id="app">
        <nav id="navAmparo" class="navbar navbar-expand-xl fixed-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                  <div class="d-flex justify-content-end">
                    <div class="mr-2">
                      <img src="{{ asset('images/logoSinSSSmall.webp') }}" width="153" height="35" alt="Amparo">
                    </div>
                  </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
              </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      @auth
                        @can('menu admin')
                          <li>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle text-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Admin
                            </button>
                            <div id="menuAdmin" class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                              @can('ver accesos')
                                <a id="visorAccesos" class="dropdown-item" href="{{ route('interests.visor') }}">Visor de Accesos</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('navegar socios')
                                <a id="busquedaSocios" class="dropdown-item" href="{{ route('users.index') }}">Búsqueda Socios</a>
                              @endcan
                              @can('actualizar padron')
                                <a id="actualizacionPadron" class="dropdown-item" href="{{ route('users.uploadfiles') }}">Actualización Padrón</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('navegar productos')
                                <a id="productos" class="dropdown-item" href="{{ route('products.index') }}">Productos</a>
                              @endcan
                              @can('navegar shoppings')
                                <a id="shoppingCarts" class="dropdown-item" href="{{ route('shopping_cart.index') }}">Shopping Carts</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('navegar especialidades')
                                <a id="especialidades" class="dropdown-item" href="{{ route('specialties.index') }}">Especialidades</a>
                              @endcan
                              @can('navegar profesionales')
                                <a id="profesionales" class="dropdown-item" href="{{ route('doctors.index') }}">Profesionales</a>
                              @endcan
                              @can('navegar categorias')
                                <a id="categorias" class="dropdown-item" href="{{ route('categories.index') }}">Categorías</a>
                              @endcan
                              @can('navegar roles')
                                <a id="roles" class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                              @endcan
                              @can('navegar listas de precios')
                                <a id="metodosPago" class="dropdown-item" href="{{ route('payment_methods.index') }}">Listas de Precios</a>
                                <a id="metodosPagoItem" class="dropdown-item" href="{{ route('payment_method_items.index') }}">Ítems Listas de Precios</a>
                              @endcan
                              @can('navegar zonas de interes')
                                <a id="zonasInteres" class="dropdown-item" href="{{ route('interests.index') }}">Zonas de Interés</a>
                              @endcan
                              @can('navegar planes')
                                <a id="planes" class="dropdown-item" href="{{ route('subscriptions.index') }}">Planes</a>
                              @endcan
                              @can('navegar recibos')
                                <a id="recibos" class="dropdown-item" href="{{ route('receipts.index') }}">Recibos</a>
                              @endcan
                            </div>
                          </div>
                        </li>
                        @endcan
                      @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      @auth
                        @can('navegar ordenes')
                          <li class="nav-item active">
                            @if(Auth::user()->hasAnyRole('desarrollador','admin'))
                                <a class="nav-link" href="{{ route('orders.index') }}">Ordenes</a>
                            @else
                                <a class="nav-link" href="{{ route('orders.indice') }}">Ordenes</a>
                            @endif
                          </li>
                        @endcan
                        @can('mostrar profesionales')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('doctors.mostrar') }}">Profesionales</a>
                          </li>
                        @endcan
                        @can('shopping')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('products.shopping') }}">Shopping</a>
                          </li>
                        @endcan
                        @can('carrito')
                          <li class="nav-item active blanco">
                            <a class="nav-link"
                              href="{{ route('shopping_cart.cart') }}"
                              title="Carrito de Compras">
                              <livewire:cart-counter />
                            </a>
                          </li>
                        @endcan
                        @can('padron aop')
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ route('odontologia') }}">Odontológico</a>
                        </li>
                        @endcan
                        @can('padron sos')
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ route('emergencia') }}">Padrón</a>
                        </li>
                        @endcan
                        @can('ver planes')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('planes') }}">Planes</a>
                          </li>
                        @endcan
                        @can('contacto')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('contacto.appVista') }}">Contacto</a>
                          </li>
                        @endcan
                      @endauth
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@lang('messages.login')</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Str::before(Str::after(Auth::user()->name,' '),' ') }} <span class="caret"></span>
                                </a>

                                <div id="menuLogin" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.darkMode') }}"
                                       onclick="activeDarkMode({{ Auth::user()->darkMode }});">
                                      <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switchDarkMode">
                                        <label id="labelDarkMode" class="custom-control-label" for="switchDarkMode">Modo Oscuro</label>
                                      </div>
                                    </a>
                                    <form id="darkmode-form" action="{{ route('users.darkMode') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @can('ver panel socios')
                                        <a id="misDatos" class="dropdown-item" href="{{ route('users.panel', ['id' => Auth::user()->id ]) }}">Mis Datos</a>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <div id="divLogout" class="">
                                          @lang('messages.logout')
                                        </div>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4"><br><br>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                @if(Session::has('message'))
                  <div class="container alert alert-success">
                    {{ Session::get('message') }}
                  </div>
                @endif
                @if(Session::has('error'))
                  <div class="container alert alert-danger">
                    {{ Session::get('error') }}
                  </div>
                @endif

                @if($errors->any())
                  <div class="container alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              </div>
            </div>
          </div>

          @yield('content')
        </main>
    </div>
    @yield('myScripts')
    @livewireScripts
</body>
<script>
  // Nos aseguramos que el navegador implementa la api 'serviceWorker'
  if ('serviceWorker' in navigator) {
    // Esperamos al evento load para registrar nuestro service worker
    window.addEventListener('load', () => {
    // Registramos el service worker
    navigator.serviceWorker.register('/service-worker.js');
    });
  }
</script>
</html>
