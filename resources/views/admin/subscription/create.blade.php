@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm"><br>
          <header class="centrado">
            <h4>Nuevo Plan/Subscripción</h4>
          </header>
          <div class="card-body">
            <form action="{{ route('subscriptions.store') }}" method="post">
              @csrf
              <div class="row justify-content-server">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="grupal" value="0">
                    <input type="checkbox" class="form-check-input" id="grupal" name="grupal" value="1" {{ old('grupal') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="grupal">Plan Grupal</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="sepelio_estandar" value="0">
                    <input type="checkbox" class="form-check-input" id="sepelio_estandar" name="sepelio_estandar" value="1" {{ old('sepelio_estandar') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="sepelio_estandar">Sepelio Estándar</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="sepelio_plus" value="0">
                    <input type="checkbox" class="form-check-input" id="sepelio_plus" name="sepelio_plus" value="1" {{ old('sepelio_plus') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="sepelio_plus">Sepelio Plus</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="odontologia" value="0">
                    <input type="checkbox" class="form-check-input" id="odontologia" name="odontologia" value="1" {{ old('odontologia') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="odontologia">Odontología</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="salud" value="0">
                    <input type="checkbox" class="form-check-input" id="salud" name="salud" value="1" {{ old('salud') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="salud">Salud</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="orden_medica" value="0">
                    <input type="checkbox" class="form-check-input" id="orden_medica" name="orden_medica" value="1" {{ old('orden_medica') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="orden_medica">Emite Orden Médica</label>
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
