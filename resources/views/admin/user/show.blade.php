@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Socio</h4>
        </header>
        <div class="card-body">
          <div class="row justify-content-server">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="nroSocio">Nro. Socio</label>
                <input type="text" class="form-control" name="nroSocio" id="nroSocio" value="{{ $user->group->nroSocio }}/{{ $user->nroAdh }}">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                <label for="nroDoc">Documento</label>
                <input type="text" class="form-control" name="nroDoc" id="nroDoc" value="{{ $user->nroDoc }}">
                <label for="fechaNac">Fecha Nac.</label>
                <input type="text" class="form-control" name="fechaNac" id="fechaNac" value="{{ $user->fechaNac }}">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                <label for="direccion">Domicilio</label>
                <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->group->direccion }}">
              </div>
              <div class="form-check">
                <input type="hidden" class="form-check-input" name="no_aop" value="0">
                <input type="checkbox" class="form-check-input" id="no_aop" name="no_aop" value="1" {{ $user->no_aop ? 'checked="checked"' : '' }}>
                <label class="form-check-label" for="no_aop">No AOP</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
