@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Ver Especialidad</h4>
        </header>
        <div class="card-body">
          <div class="row justify-content-server">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Descripción</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $specialty->descripcion }}">
              </div>
              <div class="row d-flex">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="content">Monto Socio</label>
                    <input type="text" class="form-control" name="monto_s" id="monto_s" value="{{ $specialty->monto_s }}">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="content">Monto Amparo</label>
                    <input type="text" class="form-control" name="monto_a" id="monto_a" value="{{ $specialty->monto_a }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="vigente" value="0">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ $specialty->vigente ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="vigente">Activa</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="vigenteOrden" value="0">
                    <input type="checkbox" class="form-check-input" id="vigenteOrden" name="vigenteOrden" value="1" {{ $specialty->vigenteOrden ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="vigente">Permitir órdenes online</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
