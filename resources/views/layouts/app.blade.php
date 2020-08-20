<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#fff">
    <meta
      name="description"
      content="Amparo es una empresa de servicios sociales nacida en 2003,
               dedicada a brindar servicios de medicina ambulatoria, sepelio y odontología.">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}" defer></script>
    @auth
      @foreach (Auth::user()->roles as $role)
        @if($role->slug=='dev')
          <script src="{{ asset('js/darkModeDev.js') }}" defer></script>
        @elseif($role->slug=='admin')
          <script src="{{ asset('js/darkModeAdmin.js') }}" defer></script>
        @elseif($role->slug=='socio')
          <script src="{{ asset('js/darkModeSocio.js') }}" defer></script>
        @elseif(($role->slug=='aop.aop') or ($role->slug=='SOS.sos'))
          <script src="{{ asset('js/darkModeAOPSOS.js') }}" defer></script>
        @endif
      @endforeach
    @endauth
    <!-- Fonts -->
    <link href="{{ asset('css/fresh-bootstrap-table.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   @yield('myLinks')
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
                      <img src="{{ asset('images/logoSinSSSmall.webp') }}" height="35" alt="Amparo">
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
                        @can('orders.index')
                          <div class="dropdown">
                            <button class="btn dropdown-toggle text-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Admin
                            </button>
                            <div id="menuAdmin" class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                              @can('interests.index')
                                <a id="visorAccesos" class="dropdown-item" href="{{ route('interests.visor') }}">Visor de Accesos</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('users.index')
                                <a id="busquedaSocios" class="dropdown-item" href="{{ route('users.index') }}">Búsqueda Socios</a>
                              @endcan
                              @can('users.upload')
                                <a id="actualizacionPadron" class="dropdown-item" href="{{ route('users.uploadfiles') }}">Actualización Padrón</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('products.index')
                                <a id="productos" class="dropdown-item" href="{{ route('products.index') }}">Productos</a>
                              @endcan
                              @can('shopping_cart.index')
                                <a id="shoppingCarts" class="dropdown-item" href="{{ route('shopping_cart.index') }}">Shopping Carts</a>
                              @endcan
                              <div class="dropdown-divider"></div>
                              @can('specialties.index')
                                <a id="especialidades" class="dropdown-item" href="{{ route('specialties.index') }}">Especialidades</a>
                              @endcan
                              @can('doctors.index')
                                <a id="profesionales" class="dropdown-item" href="{{ route('doctors.index') }}">Profesionales</a>
                              @endcan
                              @can('categories.index')
                                <a id="categorias" class="dropdown-item" href="{{ route('categories.index') }}">Categorías</a>
                              @endcan
                              @can('roles.index')
                                <a id="roles" class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                              @endcan
                              @can('payment_methods.index')
                                <a id="metodosPago" class="dropdown-item" href="{{ route('payment_methods.index') }}">Métodos de Pago</a>
                              @endcan
                              @can('interests.index')
                                <a id="zonasInteres" class="dropdown-item" href="{{ route('interests.index') }}">Zonas de Interés</a>
                              @endcan
                              @can('subscriptions.index')
                                <a id="planes" class="dropdown-item" href="{{ route('subscriptions.index') }}">Planes/Subscriptions</a>
                              @endcan
                            </div>
                          </div>
                        @endcan
                      @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      @auth
                        @can('orders.indice')
                          <li class="nav-item active">
                            @foreach (Auth::user()->roles as $role)
                              @if(($role->slug=='dev') or ($role->slug=='admin'))
                                <a class="nav-link" href="{{ route('orders.index') }}">Ordenes</a>
                              @else
                                <a class="nav-link" href="{{ route('orders.indice') }}">Ordenes</a>
                              @endif
                            @endforeach
                          </li>
                        @endcan
                        @can('doctors.mostrar')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('doctors.mostrar') }}">Profesionales</a>
                          </li>
                        @endcan
                        @can('products.shopping')
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('products.shopping') }}">Shopping</a>
                          </li>
                        @endcan
                        @can('carrito')
                          <li class="nav-item active blanco">
                            <a class="nav-link"
                              href="{{ route('shopping_cart.cart') }}"
                              title="Carrito de Compras">
                              <cart-counter-component :count="{{ $productsCount }}">
                              </cart-counter-component>
                            </a>
                          </li>
                        @endcan
                        @can('aop')
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ route('odontologia') }}">Odontológico</a>
                        </li>
                        @endcan
                        @can('sos.emergencias')
                        <li class="nav-item active">
                          <a class="nav-link" href="{{ route('emergencia') }}">Padrón</a>
                        </li>
                        @endcan
                        @can('planes')
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
                                       onclick="event.preventDefault();
                                                      document.getElementById('darkmode-form').submit();">
                                      <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switchDarkMode">
                                        <label id="labelDarkMode" class="custom-control-label" for="switchDarkMode">Modo Oscuro</label>
                                      </div>
                                    </a>
                                    <form id="darkmode-form" action="{{ route('users.darkMode') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @can('users.panel')
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
</body>

<script type="text/javascript">
  // var $table = $('#fresh-table')
  // $(function () {
  //   $table.bootstrapTable({
  //     classes: 'table table-hover table-striped',
  //     // toolbar: '.toolbar',
  //     search: true,
  //     showRefresh: true,
  //     showToggle: true,
  //     showColumns: true,
  //     pagination: true,
  //     striped: true,
  //     sortable: true,
  //     pageSize: 8,
  //     pageList: [8, 10, 25, 50, 100],
  //     formatShowingRows: function (pageFrom, pageTo, totalRows) {
  //       return ''
  //     },
  //     formatRecordsPerPage: function (pageNumber) {
  //       return pageNumber + ' rows visible'
  //     }
  //   })
  // })
  // $('#facebook').sharrre({
  //   share: {
  //     facebook: true
  //   },
  //   enableHover: false,
  //   enableTracking: true,
  //   click: function (api, options) {
  //     api.simulateClick()
  //     api.openPopup('facebook')
  //   },
  //   template: '<i class="fa fa-facebook-square"></i> {total}',
  //   url: location.href
  // })
</script>
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
