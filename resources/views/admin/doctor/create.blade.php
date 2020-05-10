@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm"><br>
          <header class="centrado">
            <h4>Cargar Nuevo Profesional</h4>
          </header>
          <div class="card-body">
            <form action="{{ route('doctors.store') }}" method="post">
              @csrf
              <div class="row justify-content-server">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="title">Nombre</label>
                    <input type="text" class="form-control" name="apeynom" id="apeynom" value="{{ old('apeynom') }}">
                    <label for="content">Consultorio</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}">
                    <label for="content">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
                    <label for="content">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    <label for="content">Especialidad</label>
                    <select class="custom-select" name="specialty_id" id="specialty_id">
                      <option selected>Seleccione especialidad</option>
                      @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->descripcion }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="vigente" value="0">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ old('vigente') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="vigente">Activo</label>
                  </div>
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="coseguroConsultorio" value="0">
                    <input type="checkbox" class="form-check-input" id="coseguroConsultorio" name="coseguroConsultorio" value="1" {{ old('coseguroConsultorio') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="coseguroConsultorio">Cobra coseguro en consultorio</label>
                  </div>
                </div>
                <div class="col-sm-12 text-right"><br>
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
