@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        @auth
          <div class="row justify-content-center">
            @can('emitir ordenes')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button id="btnEmitir" class="btn btn-success m-1 btn-block btn-lg" name="button">
                  @foreach (Auth::user()->roles as $role)
                    @if(($role->name=='desarrollador') or ($role->name=='admin'))
                      <a class="text-light text-decoration-none" href="{{ route('usersSearch') }}">Emitir Orden</a>
                    @else
                      <a class="text-light text-decoration-none" href="{{ route('orders.create',['id' => 0]) }}">Emitir Orden</a>
                    @endif
                  @endforeach
                </button>
              </div>
            @endcan
            @can('mostrar profesionales')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('doctors.mostrar') }}">Profesionales</a>
                </button>
              </div>
            @endcan
            @can('shopping')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('products.shopping') }}">Shopping</a>
                </button>
              </div>
            @endcan
            @can('otros servicios')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('otros') }}">+Servicios</a>
                </button>
              </div>
            @endcan
            @can('ver planes')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('planes') }}">Planes</a>
                </button>
              </div>
            @endcan
            @can('ver panel socios')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('users.panel', ['id' => Auth::user()->id ]) }}">Mis Datos</a>
                </button>
              </div>
            @endcan
            @can('modulo pagos')
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-success m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('users.pagos', ['id' => Auth::user()->id ]) }}">Pagos</a>
                </button>
              </div>
            @endcan
            @if(Auth::user()->password_changed_at==null)
              <div class="col-sm-6 col-md-4 col-lg-2">
                <button class="btn btn-danger m-1 btn-block btn-lg" name="button">
                  <a class="text-light text-decoration-none" href="{{ route('password.edit') }}">Modif Contraseña</a>
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

          {{-- @if(Auth::user()->darkMode_verified_at==null)
          <div class="container alert alert-danger mt-4 col-sm-12 col-md-6">
            <ul>
              <li>Esta semana del 22 hasta el 26 de marzo atenderemos en oficina en el horario de 8:30 a 13:00hs</li>
            </ul>
          </div>
          @endif --}}

        @endauth
    </div>
  </div>
</div>
<div class="container mt-2">
  @if(Auth::user()->darkMode)
    <div class="text-center text-white">
  @else
    <div class="text-center">
  @endif
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
