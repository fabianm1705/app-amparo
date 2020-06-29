@extends('layouts.app')

@section('myLinks')
<script>
  function darkModeHome(valor){
    var el31 = document.getElementById("textoHome");
    if(valor){
      el31.classList.add('text-white');
    }else{
      el31.classList.remove('text-white');
    }
  };
</script>
@endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        @auth
          <div class="row justify-content-center">
            @can('orders.crear')
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button id="btnEmitir" class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                  @foreach (Auth::user()->roles as $role)
                    @if(($role->slug=='dev') or ($role->slug=='admin'))
                      <a style="text-decoration:none;" href="{{ route('usersSearch') }}">Emitir Orden</a>
                    @else
                      <a style="text-decoration:none;" href="{{ route('orders.crear') }}">Emitir Orden</a>
                    @endif
                  @endforeach
                </button>
              </div>
            @endcan
            @can('doctors.mostrar')
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                  <a style="text-decoration:none;" href="{{ route('doctors.mostrar') }}">Profesionales</a>
                </button>
              </div>
            @endcan
            @can('products.shopping')
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                  <a style="text-decoration:none;" href="{{ route('products.shopping') }}">Shopping</a>
                </button>
              </div>
            @endcan
            @can('otros')
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                  <a style="text-decoration:none;" href="{{ route('otros') }}">+Servicios</a>
                </button>
              </div>
            @endcan
            @can('users.panel')
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                  <a style="text-decoration:none;" href="{{ route('users.panel', ['id' => Auth::user()->id ]) }}">Mis Datos</a>
                </button>
              </div>
            @endcan
            @if(Auth::user()->password_changed_at)
              @can('planes')
                <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                  <button class="btn btn-success m-1 text-light btn-block btn-lg" name="button">
                    <a style="text-decoration:none;" href="{{ route('planes') }}">Planes</a>
                  </button>
                </div>
              @endcan
            @else
              <div class="col-sm-6 col-md-4 col-lg-2 blanco">
                <button class="btn btn-danger m-1 text-light btn-block btn-lg" name="button">
                  <a style="text-decoration:none;" href="{{ route('password.edit') }}">Modif Contraseña</a>
                </button>
              </div>
            @endif
          </div>

          @if(Auth::user()->password_changed_at==null)
            <div class="container alert alert-danger mt-1 col-sm-12 col-md-6">
              <ul>
                <li>Por seguridad modifique una vez su contraseña de acceso</li>
              </ul>
            </div>
          @endif

          @if(Auth::user()->darkMode_verified_at==null)
            <div class="container alert alert-danger mt-1 col-sm-12 col-md-6">
              <ul>
                <li>Hemos implementado una función "modo oscuro" para hacer más agradable la visualización y consumir menos batería de su dispositivo, claro es optativo, para probarlo deben ir al menú superior donde encuentran su nombre personal, ahí disponen de un submenú donde pueden activar/desactivar el modo oscuro.</li>
              </ul>
            </div>
          @endif

        @endauth
    </div>
  </div>
</div>
<div class="container mt-2">
    <div id="textoHome" class="text-center">
      Oficina Cura Alvarez 615, Paraná, Entre Ríos<br>
      Horario: Lunes a Viernes 8:30 a 18:00hs<br>
      Teléfonos Útiles<br>
      Whatsapp: 155-508247<br>
      Sepelio: 4235108 / 154-057991<br>
      SOS Emergencias: 4222322 / 4233333<br>
      www.amparosrl.com.ar
    </div>
    <img onload="darkModeHome({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
