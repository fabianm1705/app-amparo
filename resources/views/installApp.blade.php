<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f6993f">
    <meta
      name="description"
      content="Amparo es una empresa de servicios sociales nacida en 2003,
               dedicada a brindar servicios de medicina ambulatoria, sepelio y odontología.">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-9 col-lg-7 card shadow-sm m-1">
          <div class="title"><br>
            <div>
              <b>Instalación de nuestra App</b><hr>
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
