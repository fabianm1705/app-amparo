@extends('layouts.app')

<script>
  function darkModeEmergencia(valor){
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
    <div class="col-lg-6 col-md-10 col-sm-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Padrón - {{ $usersCount }} cápitas</h5>
      </div>
      <div id="tarjeta" class="card shadow-sm mt-1">
        <div class="card-body">
          <table id="tabla" class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nro. Socio</th>
              <th>Nombre</th>
              <th>Documento</th>
              <th>Fecha Nac.</th>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->group->nroSocio }}/{{ $user->nroAdh }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->nroDoc }}</td>
                  <td>{{ \Carbon\Carbon::parse($user->fechaNac)->format('d/m/Y') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <img onload="darkModeEmergencia({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
