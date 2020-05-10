@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Profesional</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('doctors.update', ['doctor' => $doctor]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="apeynom">Nombre</label>
                  <input type="text" class="form-control" name="apeynom" id="apeynom" value="{{ $doctor->apeynom }}">
                  <label for="direccion">Consultorio</label>
                  <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $doctor->direccion }}">
                </div>
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="telefono">Teléfono</label>
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
<!--

                  <div class="row">
                    <div class="col-sm-7">
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Seleccione la Especialidad
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          @foreach($specialties as $specialty)
                            <a class="dropdown-item" href="#" value="{{ $specialty->id }}" onclick="$('#especialidad').attr('value', '{{ $specialty->descripcion }}');$('#specialty_id').attr('value', '{{ $specialty->id }}');">{{ $specialty->descripcion }}</a>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <input type="hidden" class="form-control" id="specialty_id" name="specialty_id" value="{{ $doctor->specialty->id }}">
                      <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ $doctor->specialty->descripcion }}" readonly>
                    </div>
                  </div><br> -->
