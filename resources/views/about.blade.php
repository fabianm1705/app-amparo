<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Quienes Somos - Amparo Servicios Sociales
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="manifest" href="/manifest.json" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('material/material-kit.css?v=2.1.0') }}" rel="stylesheet" />
  <link href="{{ asset('css/app-amparo.css') }}" rel="stylesheet">
</head>

<body class="profile-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ route('welcome') }}">
          <img src="{{ asset('images/logoSinSSSmall.png') }}" height="35">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/amparosrl" target="_blank" data-original-title="Danos un me gusta en Facebook">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url({{ asset('images/30.jpg' )}})"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="{{ asset('images/ic_launcher.jpg' )}}" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h3 class="title">Quienes Somos</h3>
                <a  href="https://www.facebook.com/amparosrl" class="btn btn-just-icon btn-link btn-facebook"><i class="fa fa-facebook"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="description text-center">
          <p>Amparo es una empresa de Servicios Sociales de Paraná,
          nacida en 2003 y comprometida con el desarrollo de la ciudad y su gente.
          Prestamos un servicio solidario que permite a mucha gente disponer de
          un sepelio de excelencia, tener asistencia médica a un bajo costo y servicios varios.
          Somos conscientes de la responsabilidad que implica para con nuestra gente
          y trabajamos día a día para estar a la altura de esa responsabilidad.
          Contamos en nuestro haber con la experiencia de estos años y el aval de nuestros
          afiliados por el hecho de cumplir. Somos una organización de probada responsabilidad
          y preocupada por brindar nuestros servicios en forma accesible y eficaz.</p><br><br>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer footer-default">
    <div class="container">
      <nav class="float-left">
        <ul>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}">Volver a Inicio</a>
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
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
            document.write(new Date().getFullYear())
            </script>, <b>Amparo</b> Cura Alvarez 615 - Tel.:4235108
          </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="{{ asset('material/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/plugins/moment.min.js') }}" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('material/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/plugins/bootstrap-tagsinput.js') }}" type="text/javascript"></script>
  <script src="{{ asset('material/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('material/js/material-kit.js?v=2.1.0') }}" type="text/javascript"></script>
</body>

</html>
