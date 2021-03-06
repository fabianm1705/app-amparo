@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-10 col-sm-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Padrón - {{ $usersCount }} cápitas</h5>
      </div>
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm mt-1 bg-dark">
      @else
        <div class="card shadow-sm mt-1">
      @endif
        <div class="card-body">
          @if(Auth::user()->darkMode)
            <table class="table table-hover table-sm table-responsive table-dark">
          @else
            <table class="table table-hover table-sm table-responsive">
          @endif
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
</div>
@endsection
