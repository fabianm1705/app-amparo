<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Amparo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('material/material-kit.css?v=2.1.0') }}" rel="stylesheet" />
        <link href="{{ asset('css/app-amparo.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">

            <div class="content">
                <div class="title m-b-md">
                  <div class="d-flex justify-content-end">
                    <div class="mr-4"><br>
                      <img src="{{ asset("images/logo300x68.png") }}">
                    </div>
                  </div>
                </div>
                <div class="blanco">
                  <h4>Error 403 - Acceso no autorizado</h4>
                  <button type="submit" class="btn btn-warning btn-lg">
                      @if (Route::has('login'))
                          @auth
                              <a class="" href="{{ url('/home') }}">Volver a Zona Socios</a>
                          @else
                              <a class="" href="{{ route('login') }}">Volver a Zona Socios</a>
                          @endauth
                      @endif
                  </button>
                </div>
            </div>
        </div>
    </body>
</html>
