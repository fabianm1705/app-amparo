<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#fff">

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
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @if (\Request::is('products/shopping'))
      <link rel="stylesheet" href="{{ asset('swiper/css/swiper.min.css') }}">
    @else
      <script src="{{ asset('js/app.min.js') }}" defer></script>
    @endif
    @auth
        <script src="{{ asset('js/darkModeClean.js') }}" defer></script>
    @endauth
    <script src="{{ asset('js/addToHomeScreen.js') }}" defer></script>
    <!-- Fonts -->
    <link href="{{ asset('css/fresh-bootstrap-table.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-amparo.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" crossorigin="anonymous"></script>
   @yield('myLinks')
</head>

<body id="cuerpo" onLoad="darkMode({{ Auth::user()->darkMode }})">
    <div id="app">
      <nav class="navbar navbar-light fixed-top">
        <div class="row ml-1">
          <a class="navbar-brand" href="{{ URL::previous() }}">
            <span id="iconBack" class="material-icons">
              arrow_back
            </span>
          </a>
          <a class="navbar-brand" href="{{ url('/home') }}">
            <span id="iconHome" class="material-icons">
              home
            </span>
          </a>
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
