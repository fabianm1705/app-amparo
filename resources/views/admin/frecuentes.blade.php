<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f6993f">

    <meta property="og:title" content="Preguntas Frecuentes | amparosrl.com.ar"/>
    <meta property="og:description" content="Consultas sobre toda la información de los servicios, productos, carencias, forma de pago y uso." />
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://amparosrl.com.ar/images/logo200x200.png"/>
    <meta property="og:url" content="https://amparosrl.com.ar/frecuentes"/>
    <meta property="og:site_name" content="amparo"/>

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
    <div class="row justify-content-center m-4">
      <a class="" href="{{ route('welcome') }}">
        <img src="{{ asset('images/logo300x68.png') }}" height="68" alt="Amparo">
      </a>
    </div>
    <div class="mb-4 text-center">
      <h2>Preguntas Frecuentes</h2>
    </div>
    <center>
      <div class="accordion col-md-6" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn d-flex" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Al afiliarse hay espera para utilizar los planes?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            Si, todos nuestros planes tienen una espera de 2 meses.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn d-flex collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              El Plan Salud incluye Odontología?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            No, Salud y Odontología son planes separados y opcionales, se puede tomar uno o ambos, tanto de forma individual como por grupo familiar.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              ¿El Plan Salud cubre internación?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            No, es un plan ambulatorio, cubre todo lo que es laboratorio, radiografías, ecografías, consultorios externos, practicamente están todas las especialidades, emergencia médica, farmacia, etc.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingCuatro">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro">
              ¿Trabajan con otras obras sociales?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#accordionExample">
          <div class="card-body">
            No, al afiliarse a Amparo se atienden como socios de Amparo.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingCinco">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco">
              ¿Puedo tener otra obra social y ser socio de Amparo?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#accordionExample">
          <div class="card-body">
            Si, Amparo es un servicio privado que puede funcionar como complemento de su obra social.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingSeis">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseSeis" aria-expanded="false" aria-controls="collapseSeis">
              ¿Puedo asociarme si vivo en otra ciudad?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseSeis" class="collapse" aria-labelledby="headingSeis" data-parent="#accordionExample">
          <div class="card-body">
            Si, pero nuestro servicio funciona sólo en la ciudad y aledaños, los médicos atienden en Paraná.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingSiete">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete">
              ¿Hay límite de edad para afiliarse?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#accordionExample">
          <div class="card-body">
            No, nuestros planes no tienen límite de edad.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingOcho">
          <h2 class="mb-0">
            <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho">
              ¿Puedo pagar la cuota con tarjeta de crédito?
              <span class="material-icons ml-auto">
                keyboard_arrow_down
              </span>
            </button>
          </h2>
        </div>
        <div id="collapseOcho" class="collapse" aria-labelledby="headingOcho" data-parent="#accordionExample">
          <div class="card-body">
            Si, las formas de pago habilitadas son crédito, débito vía CBU bancario, transferencia bancaria, rapipago, pago fácil, pago en oficina o cobranza domiciliaria.
          </div>
        </div>
      </div>
    </div>
    </center>
    <div class="row m-4">
      <div class="col-md-6 mb-1">
        <form action="{{ route('contacto.llamadaVista') }}" method="get">
          @csrf
          <button class="btn btn-outline-dark btn-lg btn-block" type="submit" name="button">
            <div class="d-flex justify-content-center">
              Quiero que me llamen por teléfono
            </div>
          </button>
        </form>
      </div>
      <div class="col-md-6 mb-1">
        <form action="{{ route('contacto.promotorVista') }}" method="get">
          @csrf
          <button class="btn btn-outline-dark btn-lg btn-block" type="submit" name="button">
            <div class="d-flex justify-content-center">
              Quiero que me visite un promotor
            </div>
          </button>
        </form>
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
