<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Cache-Control" content="max-age=31536000, public">
  <meta name="theme-color" content="#fff">
  <meta name="description"
        content="Amparo es una empresa de servicios sociales nacida en 2003,
             dedicada a brindar servicios de medicina ambulatoria, sepelio y odontología.">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Amparo Servicios Sociales
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="manifest" href="/manifest.json" />
  <script src="{{ asset('js/addToHomeScreen.js') }}" defer></script>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <!-- CSS Files -->
  <link href="{{ asset('material/material-kit-amparo.min.css?v=2.1.0') }}" rel="stylesheet">
  <!-- jquery library -->
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" crossorigin="anonymous"></script>
</head>

<body class="landing-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ route('welcome') }}">
          <img src="{{ asset('images/logoSinSSSmall.webp') }}" height="35" alt="Logo Amparo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <!-- navbar-nav ml-auto -->
              <li class="nav-item">
                  <a class="nav-link" rel="noopener" href="{{ route('installApp') }}">
                      <img src="{{ asset('images/disponible_google_play.png') }}" height="40" alt="Disponible en Google Play">
                  </a>
              </li>
              <li class="nav-item">
                @if (Route::has('login'))
                    @auth
                        <a class="nav-link" href="{{ url('/home') }}"><i class="material-icons">account_circle</i>&nbsp;Zona Socios</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}"><i class="material-icons">account_circle</i>&nbsp;Zona Socios</a>

                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">Registro</a>
                        @endif
                    @endauth
                @endif
              </li>
          </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('images/30.webp' )}})">
    <div class="container">
      <div class="row justify-content-left">
        <div class="col-md-6">
          <div class="">
            <button type="submit" class="btn btn-warning btn-lg">
                @if (Route::has('login'))
                    @auth
                        <a class="text-white" href="{{ url('/home') }}"><i class="material-icons">account_circle</i>&nbsp;Zona Socios</a>
                    @else
                        <a class="text-white" href="{{ route('login') }}"><i class="material-icons">account_circle</i>&nbsp;Zona Socios</a>
                    @endauth
                @endif
            </button>
          </div>
          <h4>Somos una organización de Paraná de probada responsabilidad,
              que desde 2003 se preocupa y ocupa en brindar servicios
              en forma accesible y eficaz.</h4>
          <br>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
          <div class="features">
            <div class="row">
              <div class="col-md-4">
                <div class="card card-pricing card-plain">
                  <div class="card-body">
                    <h5 class=""><strong>PLAN SALUD</strong></h5>
                    <h1 class="card-title">
                      <small>$</small>600
                      <small>/mes</small>
                    </h1>
                    $900 por Grupo Familiar<hr>
                    Cobertura Ambulatoria Integral<hr>
                    Consultorios Externos<hr>
                    Estudios Médicos, Farmacia, Ambulancia<br><br>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-pricing card-raised bg-warning">
                  <div class="card-body">
                    <h5 class="" style="color:#FFFFFF"><strong>ODONTOLOGIA</strong></h5>
                    <h1 class="card-title">
                      <small>$</small>200
                      <small>/mes</small>
                    </h1>
                    + $150 por Adherente<hr>
                    Cobertura Odontológica Integral<hr>
                    Odontólogos distribuidos por la ciudad<hr>
                    Turnos rápidos, coseguros muy económicos<br><br>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-pricing card-plain">
                  <div class="card-body">
                    <h5 class=""><strong>PLAN JOVEN</strong></h5>
                    <h1 class="card-title">
                      <small>$</small>850
                      <small>/mes</small>
                    </h1>
                    Plan Individual hasta 35 años<hr>
                    Incluye Plan Salud<hr>
                    Plan Odontológico<hr>
                    Sepelio Completo<br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-4">
          <form action="{{ route('preguntas.frecuentes') }}" method="get">
            @csrf
            <button class="btn btn-warning btn-lg btn-block" type="submit" name="button">
              <div class="d-flex justify-content-center">
                Preguntas Frecuentes
              </div>
            </button>
          </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-4">
          <form action="{{ route('contacto.llamadaVista') }}" method="get">
            @csrf
            <button class="btn btn-warning btn-lg btn-block" type="submit" name="button">
              <div class="d-flex justify-content-center">
                Quiero que me llamen por teléfono
              </div>
            </button>
          </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-4">
          <form action="{{ route('contacto.promotorVista') }}" method="get">
            @csrf
            <button class="btn btn-warning btn-lg btn-block" type="submit" name="button">
              <div class="d-flex justify-content-center">
                Quiero que me visite un promotor
              </div>
            </button>
          </form>
        </div>
      </div>
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="title">Nos mantenemos en contacto</h2>
              <h5>Recibe toda la información que necesitas sin compromiso alguno,
              dejanos tus datos y un promotor se pondrá en contacto.</h5>
              <div>
                <div class="icon icon-warning d-flex">
                  <i class="material-icons mr-2 mt-2">pin_drop</i>
                  <h4 class="info-title">Encuentranos en la oficina</h4>
                </div>
                <div>
                  <p> Cura Alvarez 615,
                    <br> 3100 Paraná,
                    <br> Entre Ríos, Argentina
                  </p>
                </div>
              </div>
              <div>
                <div class="icon icon-warning d-flex">
                  <i class="material-icons mr-2 mt-2">phone</i>
                  <h4 class="info-title">Llamanos</h4>
                </div>
                <div>
                  <p> Leonela o Fabián
                    <br> Fijo: 4235108, Whatsapp: 155-508247,
                    <br> Lun - Vie, 8:30-18:00
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-5 ml-auto"><br><br>
              <div class="card card-contact">
                <form method="POST" action="{{ route('contacto.welcome') }}">
                  @csrf
                  <div class="card-header card-header-raised card-header-warning text-center">
                    <h4 class="card-title">Contacto</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group label-floating is-empty">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" class="form-control">
                      <span class="material-input"></span>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group label-floating is-empty">
                          <label for="address">Domicilio</label>
                          <input type="text" name="address" id="address" class="form-control">
                          <span class="material-input"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group label-floating is-empty">
                          <label for="telephone">Teléfono</label>
                          <input type="text" name="telephone" id="telephone" class="form-control">
                          <span class="material-input"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group label-floating is-empty">
                      <label class="bmd-label-floating" for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control">
                      <span class="material-input"></span>
                    </div>
                    <div class="form-group label-floating is-empty">
                      <label for="message" class="bmd-label-floating">Mensaje...</label>
                      <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                      <span class="material-input"></span>
                    </div>
                  </div>
                  <div class="card-footer right-content">
                    <button type="submit" class="btn btn-warning pull-right" id="form-submit">Enviar Mensaje</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer footer-default">
    <div class="container">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="{{ route('about') }}">
                        Sobre Nosotros
                    </a>
                </li>
                <li>
                  <a class="nav-link" rel="noopener" title="Facebook" data-placement="bottom" href="https://www.facebook.com/amparosrl" target="_blank" data-original-title="Danos un Me Gusta en Facebook">
                      <i class="fa fa-facebook-square"></i> Facebook
                  </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">
            &copy;
            <strong id="fecha"></strong>, <b>Amparo</b> Cura Alvarez 615 - Tel.:4235108
        </div>
    </div>
  </footer>
  <script>
      var msg = '{{Session::get('jsAlert')}}';
      var exist = '{{Session::has('jsAlert')}}';
      if(exist){
        alert(msg);
      }
    </script>
  <!--   Core JS Files   -->
  <script src="{{ asset('material/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('material/js/material-kit.min.js?v=2.1.0') }}" type="text/javascript"></script>
  <script>
    var ano = (new Date).getFullYear();
    $(document).ready(function() {
      $("#fecha").text( ano );
    });
  </script>
  <script>
    var span = document.getElementsByTagName('span')[0];
    span.textContent = ''; // change DOM text content
    span.style.display = 'inline';  // change CSSOM property
    // create a new element, style it, and append it to the DOM
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
</body>
</html>
