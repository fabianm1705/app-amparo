@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="apeynom">Nombre</label>
                  <input type="text" class="form-control" name="apeynom" id="apeynom" value="{{ $doctor->apeynom }}">
                  <label for="content">Consultorio</label>
                  <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $doctor->direccion }}">
                </div>
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="content">Teléfono</label>
                      <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $doctor->telefono }}">
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" value="{{ $doctor->email }}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="content">Especialidad</label>
                  <select class="custom-select" name="specialty_id" id="specialty_id">
                    @foreach($specialties as $specialty)
                      @if($doctor->specialty_id == $specialty->id)
                        <option selected value="{{ $specialty->id }}">{{ $specialty->descripcion }}</option>
                      @else
                        <option value="{{ $specialty->id }}">{{ $specialty->descripcion }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-check">
                  <input type="hidden" class="form-check-input" name="vigente" value="0">
                  <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ $doctor->vigente ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="vigente">Activo</label>
                  <input type="hidden" class="form-check-input" name="coseguroConsultorio" value="0">
                  <input type="checkbox" class="form-check-input" id="coseguroConsultorio" name="coseguroConsultorio" value="1" {{ $doctor->coseguroConsultorio ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="vigente">Cobra coseguro en consultorio</label>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
