@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Socio</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nroSocio">Nro. Socio</label>
                      <input type="text" class="form-control text-center" name="nroSocio" id="nroSocio" value="{{ $user->group->nroSocio }}/{{ $user->nroAdh }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nroDoc">Documento</label>
                      <input type="text" class="form-control" name="nroDoc" id="nroDoc" value="{{ $user->nroDoc }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fechaNac">Fecha Nac.</label>
                      <input type="text" class="form-control" name="fechaNac" id="fechaNac" value="{{ $user->fechaNac }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="direccion">Domicilio</label>
                      <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->group->direccion }}" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-4 mt-2">
                    <div class="form-check">
                      <input type="hidden" class="form-check-input" name="restablecerPassword" id="restablecerPassword" value="0">
                      <input type="checkbox" class="form-check-input" name="restablecerPassword" id="restablecerPassword">
                      <label class="form-check-label" for="vigente">Restablecer Contraseña</label>
                    </div>
                  </div>
                  <hr>
                  <h5>Lista de Roles</h5>
                  <div class="form-group">
                    <ul class="list-unstyled">
                      @foreach($roles as $role)
                        <li>
                          <label>
                              <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                  @if($user->roles->contains($role->id))
                                    checked=checked
                                  @endif>
                            {{ $role->name }}
                            <em>{{ $role->description ?: 'N/A' }}</em>
                          </label>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 text-right">
                <button class="btn btn-dark text-light" type="submit" name="button">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
