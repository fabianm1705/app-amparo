@extends('layouts.app')

@section('myLinks')
<script>
  function darkModeSearch(valor){
    var el31 = document.getElementById("tabla");
    if(valor){
      el31.classList.add('table-dark');
    }else{
      el31.classList.remove('table-dark');
    }
  };
</script>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        @if(Auth::user()->darkMode)
          <h4 class="title text-center text-white mb-3">Búsqueda del Socio</h4>
        @else
          <h4 class="title text-center mb-3">Búsqueda del Socio</h4>
        @endif
        <form action="{{ route('users.search') }}" method="post">
            @csrf
            <input type="hidden" class="form-control" id="desdeDonde" name="desdeDonde" value="Ordenes">
            <input type="text" class="form-control mb-1" id="name" name="name" placeholder="Nombre" autocomplete="off">
            <input type="text" class="form-control mb-2" id="nroDoc" name="nroDoc" placeholder="Documento" autocomplete="off">
            <button class="btn btn-success btn-block" type="submit">
              <i class="material-icons">search</i>
            </button>
        </form>
        @if(Auth::user()->darkMode)
          <h4 class="title text-center text-white mt-2">Resultados</h4>
        @else
          <h4 class="title text-center mt-2">Resultados</h4>
        @endif
        <table id="tabla" class="table table-hover table-sm table-responsive">
          <thead>
            <th>Nro Socio</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Domicilio</th>
            <th>Acciones</th>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->group->nroSocio }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nroDoc }}</td>
                <td>{{ $user->group->direccion }}</td>
                <td>
                  <a href="{{ route('orders.create', ['id' => $user->id ]) }}" title="Nueva Orden" class="">
                    <div class="">
                      @if(Auth::user()->darkMode)
                        <i class="material-icons" style="color:white">note_add</i>
                      @else
                        <i class="material-icons">note_add</i>
                      @endif
                    </div>
                  </a>&nbsp;
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
    <img onload="darkModeSearch({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
  </div>
@endsection
