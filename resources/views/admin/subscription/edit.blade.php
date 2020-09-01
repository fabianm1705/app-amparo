@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm"><br>
          <header class="centrado">
            <h4>Actualizar Plan/Subscripción</h4>
          </header>
          <div class="card-body">
            <form action="{{ route('subscriptions.update', ['subscription' => $subscription]) }}" method="post">
              @method('PUT')
              @csrf
              <div class="row justify-content-server">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ $subscription->description }}">
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="grupal" value="0">
                    <input type="checkbox" class="form-check-input" id="grupal" name="grupal" value="1" {{ $subscription->grupal ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="grupal">Plan Grupal</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="sepelio_estandar" value="0">
                    <input type="checkbox" class="form-check-input" id="sepelio_estandar" name="sepelio_estandar" value="1" {{ $subscription->sepelio_estandar ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="sepelio_estandar">Sepelio Estándar</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="sepelio_plus" value="0">
                    <input type="checkbox" class="form-check-input" id="sepelio_plus" name="sepelio_plus" value="1" {{ $subscription->sepelio_plus ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="sepelio_plus">Sepelio Plus</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="odontologia" value="0">
                    <input type="checkbox" class="form-check-input" id="odontologia" name="odontologia" value="1" {{ $subscription->odontologia ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="odontologia">Odontología</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="salud" value="0">
                    <input type="checkbox" class="form-check-input" id="salud" name="salud" value="1" {{ $subscription->salud ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="salud">Salud</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="orden_medica" value="0">
                    <input type="checkbox" class="form-check-input" id="orden_medica" name="orden_medica" value="1" {{ $subscription->orden_medica ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="orden_medica">Emite Orden Médica</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                      <label for="precio_grupo">Precio Grupal</label>
                      <input type="text" class="form-control" name="precio_grupo" id="precio_grupo" value="{{ $subscription->precio_grupo }}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                      <label for="precio_individual">Precio Individual</label>
                      <input type="text" class="form-control" name="precio_individual" id="precio_individual" value="{{ $subscription->precio_individual }}">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                      <label for="precio_adherente">Precio Adherente</label>
                      <input type="text" class="form-control" name="precio_adherente" id="precio_adherente" value="{{ $subscription->precio_adherente }}">
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
