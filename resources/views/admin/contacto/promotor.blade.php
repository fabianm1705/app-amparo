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
    <div class="row justify-content-center mt-4">
      <a class="" href="{{ route('welcome') }}">
        <img src="{{ asset('images/logo300x68.png') }}" height="68" alt="Logo Amparo">
      </a>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-md-6">
          <div class="alert alert-success">
            Dejanos tu nombre, domicilio, teléfono y horario para coordinar la visita!
          </div>
      </div>
    </div>
    <div class="row justify-content-center ml-1 mr-1 mb-1">
      <div class="card shadow-sm col-md-6">
        <div class="card-body">
          <form action="{{ route('contacto.promotor') }}" method="post">
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="domicilio">Domicilio</label>
                  <input type="text" class="form-control" name="domicilio" id="domicilio" value="{{ old('domicilio') }}">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="horario">Horario</label>
                  <input type="text" class="form-control" name="horario" id="horario" value="{{ old('horario') }}">
                </div>
              </div>
              <div class="col-sm-12 text-right mt-4">
                <button class="btn btn-dark btn-lg text-light" type="submit" name="button">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if(session()->has('jsAlert'))
      <script>
          alert({{ session()->get('jsAlert') }});
      </script>
  @endif
</body>
</html>
