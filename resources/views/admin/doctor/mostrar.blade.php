@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-6">
        <div class="fresh-table full-color-orange shadow-sm">
          <div class="row">
            <h5 class="card-title text-white mt-3 mb-3 ml-4">&nbsp;&nbsp;Profesionales</h5><br>
          </div>
          <div class="col-md-12">
            <select class="custom-select mb-4" name="specialty" id="specialty" onchange="cargarProfesionales()">
              <option selected>Seleccione especialidad</option>
              @foreach($specialties as $specialty)
                <option value="{{ $specialty->id }}">
                    {{ $specialty->descripcion }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        @if(Auth::user()->darkMode)
          <div class="card mt-1 bg-dark">
        @else
          <div class="card mt-1">
        @endif
          <div class="card-body">
            @if(Auth::user()->darkMode)
              <table class="table table-hover table-sm table-responsive table-dark">
            @else
              <table class="table table-hover table-sm table-responsive">
            @endif
              <thead>
                <th>Nombre</th>
                <th>Consultorio</th>
                <th>Teléfono</th>
              </thead>
              <tbody id="tablaprofesionales">
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/doctors.mostrar.js') }}" defer></script>
@endsection
