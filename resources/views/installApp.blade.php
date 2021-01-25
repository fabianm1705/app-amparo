<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">
<head>
    <title>Instalación App | amparosrl.com.ar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f6993f">

    <meta property="og:title" content="Instalación App | amparosrl.com.ar"/>
    <meta property="og:description" content="Recomendaciones para una instalación exitosa." />
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://amparosrl.com.ar/images/logo200x200.png"/>
    <meta property="og:url" content="https://amparosrl.com.ar/installApp"/>
    <meta property="og:site_name" content="amparo"/>

    <meta
      name="description"
      content="Amparo es una empresa de servicios sociales nacida en 2003,
               dedicada a brindar servicios de medicina ambulatoria, sepelio y odontología.">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="manifest" href="/manifest.json" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image: url({{ asset('images/01.webp' )}})">
  <div class="container">
    <div class="row justify-content-center m-4">
      <a class="" href="{{ route('welcome') }}">
        <img src="{{ asset('images/logo300x68.png') }}" height="68" alt="Amparo">
      </a>
    </div>
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9 col-lg-7 card shadow-sm m-1">
          <div class="title"><br>
            <div>
              <b>Instalación de nuestra App</b><hr>
            </div>
            <div class="">
              Estimados socios, en ella tienen toda la información de los servicios, profesionales y productos, incluso la posibilidad de emitir órdenes médicas. <br><br>Se ingresa con el número de DNI del socio y la contraseña es amparo, luego la aplicación permite modificar esa contraseña para que les quede más segura la cuenta.<br><br>
              <strong>NOTA IMPORTANTE: No es necesario registrarse, al afiliarse damos de alta sus datos para que puedan ingresar.</strong><br><br>
            </div>
            Algunas aclaraciones importantes antes de instalar:<br><br>
            * Si tu celular es Samsung tal vez al intentar abrir por primera vez te pregunte si debe abrir con "Amparo" o con "Internet de Samsung", en ese caso debes seleccionar "Internet de Samsung".<br><br>
            * Si instalas en una Tablet tal vez al intentar abrir por primera vez te pregunte si debe abrir con "Amparo", con "Navegador" o con "Chrome", en ese caso debes seleccionar "Chrome".<br><br>
            * Es recomendable tener instalado el navegador Chrome en el dispositivo que vayas a utilizar (PC, Celular o Tablet)<br><br>
            * Si tuvieras alguna duda o problema siempre puedes consultarnos o pasar por la oficina para realizar correctamente la instalación.<br><br><br>
            En la siguiente imagen tienes el link para descargar e instalar:<br><br>
            <div class="justify-content-center"><center>
              <a class="nav-link" rel="noopener" href="https://play.google.com/store/apps/details?id=ar.com.amparosrl" target="_blank">
                  <img src="{{ asset('images/disponible_google_play.png') }}" height="40" alt="Disponible en Google Play">
              </a></center>
            </div><br><br>
          </div>
        </div>
      </div>
  </div>
</body>
</html>
