@extends('layouts.app')

<script>
  function darkModeUser(valor){
    var el41 = document.getElementById("tabla");
    var el42 = document.getElementById("tarjeta");
    if(valor){
      el41.classList.add('table-dark');
      el42.classList.add('bg-dark');
    }else{
      el41.classList.remove('table-dark');
      el42.classList.remove('bg-dark');
    }
  };
</script>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="fresh-table full-color-orange shadow-sm">
          <div class="row">
            <div class="col-md-3 col-sm-12">
              <h5 class="card-title text-white mt-4 mb-4 ml-4">Socios</h5>
            </div>
            <div class="col-md-9 col-sm-12">
              <div class="ml-auto blanco mr-2 mt-2 mb-2">
                <form action="{{ route('users.search') }}" method="post">
                    @csrf
                    <input type="hidden" class="form-control" id="desdeDonde" name="desdeDonde" value="Usuarios">
                    <div class="row">
                      <div class="col-md-4 ml-2 mt-2">
                        <input type="text" class="form-control mb-1" id="name" name="name" placeholder="Nombre" autocomplete="off">
                      </div>
                      <div class="col-md-4 ml-2 mt-2">
                        <input type="text" class="form-control mb-2" id="nroDoc" name="nroDoc" placeholder="Documento" autocomplete="off">
                      </div>
                      <div class="col-md-3 ml-2 mt-2">
                        <button class="btn btn-sm btn-block" type="submit">
                          <i class="material-icons">search</i>
                        </button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
      </div>
      <div id="tarjeta" class="card shadow-sm mt-1">
        <div class="card-body">
          <table id="tabla" class="table table-hover table-sm table-responsive">
            <thead>
              <th>ID / ID Grupo</th>
              <th>Nro. Socio</th>
              <th>Nombre</th>
              <th>Documento</th>
              <th>Fecha Nac.</th>
              <th>Email</th>
              <th>Domicilio</th>
              <th>No AOP</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}/{{ $user->group->id }}</td>
                  <td>{{ $user->group->nroSocio }}/{{ $user->nroAdh }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->nroDoc }}</td>
                  <td>{{ \Carbon\Carbon::parse($user->fechaNac)->format('d/m/Y') }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->group->direccion }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="no_aop" name="no_aop" disabled value="1" {{ $user->no_aop ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('users.edit')
                      <a href="{{ route('receipt.create', ['id' => $user->id ]) }}" title="Generar Recibo" class="">
                        <div class="">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">receipt</i>
                          @else
                            <i class="material-icons">receipt</i>
                          @endif
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('users.show')
                      <a href="{{ route('users.panel', ['id' => $user->id ]) }}" title="Ver Socio" class="">
                        <div class="">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">search</i>
                          @else
                            <i class="material-icons">search</i>
                          @endif
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('users.edit')
                      <a href="{{ route('users.edit', ['user' => $user ]) }}" title="Editar Socio" class="">
                        <div class="">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">edit</i>
                          @else
                            <i class="material-icons">edit</i>
                          @endif
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('users.destroy')
                      <form action="{{ route('users.destroy', ['user' => $user ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
                          @if(Auth::user()->darkMode)
                            <div class="text-white">X</div>
                          @else
                            <div>X</div>
                          @endif
                        </button>
                      </form>
                    @endcan
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
  <img onload="darkModeUser({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
