@extends('layouts.app')

@section('myLinks')
  <script>
    function darkModeVisor(valor){
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
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Visor de Accesos</h5>
      </div>
      <div id="tarjeta" class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table id="tabla" class="table table-hover table-sm table-responsive">
            <thead>
              <th></th>
              <th>Socio</th>
              <th>Zona</th>
              <th>Obs</th>
              <th>Fecha</th>
              <th>Borrar</th>
            </thead>
            <tbody>
              @foreach($user_interests as $user_interest)
                <tr>
                  <td>{{ $user_interest->user->group->nroSocio }}</td>
                  <td>{{ $user_interest->user->name }}</td>
                  <td>{{ $user_interest->interest->description }}</td>
                  <td>{{ $user_interest->obs }}</td>
                  <td>{{ $user_interest->created_at }}</td>
                  <td>
                    @can('interests.destroy')
                    <form action="{{ route('user_interest.borrar', ['id' => $user_interest->id ]) }}" method="post" style="background-color: transparent;">
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
        </div>
      </div>
    </div>
  </div>
  <img onload="darkModeVisor({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
