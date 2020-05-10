@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        @auth
          <div class="row justify-content-center">
            @can('orders.crear')
              <div class="col-md-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                  @foreach (Auth::user()->roles as $role)
                    @if(($role->slug=='dev') or ($role->slug=='admin'))
                      <a style="text-decoration:none;font-size: 12pt;" href="{{ route('usersSearch') }}">Emitir Orden</a>
                    @else
                      <a style="text-decoration:none;font-size: 12pt;" href="{{ route('orders.crear') }}">Emitir Orden</a>
                    @endif
                  @endforeach
                </button>
              </div>
            @endcan
            @can('doctors.mostrar')
              <div class="col-md-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                  <a style="text-decoration:none;font-size: 12pt;" href="{{ route('doctors.mostrar') }}">Profesionales</a>
                </button>
              </div>
            @endcan
            @can('products.shopping')
              <div class="col-md-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                  <a style="text-decoration:none;font-size: 12pt;" href="{{ route('products.shopping') }}">Shopping</a>
                </button>
              </div>
            @endcan
            @can('otros')
              <div class="col-md-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                  <a style="text-decoration:none;font-size: 12pt;" href="{{ route('otros') }}">+Servicios</a>
                </button>
              </div>
            @endcan
            @can('users.panel')
              <div class="col-md-2 blanco">
                <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                  <a style="text-decoration:none;font-size: 12pt;" href="{{ route('users.panel', ['id' => Auth::user()->id ]) }}">Mis Datos</a>
                </button>
              </div>
            @endcan
            @if(Auth::user()->password_changed_at)
              @can('otros')
                <div class="col-md-2 blanco">
                  <button class="btn btn-success m-1 text-light btn-block" type="" name="button">
                    <a style="text-decoration:none;font-size: 12pt;" href="{{ route('planes') }}">Planes</a>
                  </button>
                </div>
              @endcan
            @else
              <div class="col-md-2 blanco">
                <button class="btn btn-danger m-1 text-light btn-block" type="" name="button">
                  <a style="text-decoration:none;font-size: 12pt;" href="{{ route('password.edit') }}">Modif Contraseña</a>
                </button>
              </div>
            @endif
          </div>

          @if(Auth::user()->password_changed_at==null)
            <div class="container alert alert-danger mt-1 col-md-6">
              <ul>
                <li>Por seguridad modifique una vez su contraseña de acceso</li>
              </ul>
            </div>
          @endif

        @endauth
    </div>
  </div>
</div>
<div class="container mt-2">
    <div class="text-center">
      Oficina Cura Alvarez 615, Paraná, Entre Ríos<br>
      Horario: Lunes a Viernes 8:30 a 18:00hs<br>
      Teléfonos Útiles<br>
      Whatsapp: 155-508247<br>
      Sepelio: 4235108 / 154-057991<br>
      SOS Emergencias: 4222322 / 4233333<br>
      www.amparosrl.com.ar
    </div>
</div>


@endsection
