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
      @if(Auth::user()->darkMode)
        <div class="m-4 text-center text-white">
      @else
        <div class="m-4 text-center">
      @endif
        <h2>Preguntas Frecuentes</h2>
      </div>
      <center>
        <div class="accordion col-lg-6 col-md-9 col-sm-12" id="accordionExample">
          @if(Auth::user()->darkMode)
            <div class="card bg-secondary">
          @else
            <div class="card">
          @endif
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                @if(Auth::user()->darkMode)
                  <button class="btn d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                @else
                  <button class="btn d-flex" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                @endif
                  Al afiliarse hay espera para utilizar los planes?
                  <span class="material-icons ml-auto">
                    keyboard_arrow_down
                  </span>
                </button>
              </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              @if(Auth::user()->darkMode)
                <div class="card-body text-white">
              @else
                <div class="card-body">
              @endif
                No, por ser socios activos no hay espera al agregar un nuevo plan.
              </div>
            </div>
          </div>
          @if(Auth::user()->darkMode)
            <div class="card bg-secondary">
          @else
            <div class="card">
          @endif
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                @if(Auth::user()->darkMode)
                  <button class="btn d-flex collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                @else
                  <button class="btn d-flex collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                @endif
                  El Plan Salud incluye Odontología?
                  <span class="material-icons ml-auto">
                    keyboard_arrow_down
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              @if(Auth::user()->darkMode)
                <div class="card-body text-white">
              @else
                <div class="card-body">
              @endif
                No, Salud y Odontología son planes separados y opcionales, se puede tomar uno o ambos, tanto de forma individual como por grupo familiar.
              </div>
            </div>
          </div>
          @if(Auth::user()->darkMode)
            <div class="card bg-secondary">
          @else
            <div class="card">
          @endif
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                @if(Auth::user()->darkMode)
                  <button class="btn collapsed d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                @else
                  <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                @endif
                  ¿El Plan Salud cubre internación?
                  <span class="material-icons ml-auto">
                    keyboard_arrow_down
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              @if(Auth::user()->darkMode)
                <div class="card-body text-white">
              @else
                <div class="card-body">
              @endif
                No, es un plan ambulatorio, cubre todo lo que es laboratorio, radiografías, ecografías, consultorios externos, practicamente están todas las especialidades, emergencia médica, farmacia, etc.
              </div>
            </div>
          </div>
          @if(Auth::user()->darkMode)
            <div class="card bg-secondary">
          @else
            <div class="card">
          @endif
            <div class="card-header" id="headingCinco">
              <h2 class="mb-0">
                @if(Auth::user()->darkMode)
                  <button class="btn collapsed d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco">
                @else
                  <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco">
                @endif
                  ¿Puedo tener otra obra social y el plan salud de Amparo?
                  <span class="material-icons ml-auto">
                    keyboard_arrow_down
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#accordionExample">
              @if(Auth::user()->darkMode)
                <div class="card-body text-white">
              @else
                <div class="card-body">
              @endif
                Si, Amparo es un servicio privado que puede funcionar como complemento de su obra social.
              </div>
            </div>
          </div>
          @if(Auth::user()->darkMode)
            <div class="card bg-secondary">
          @else
            <div class="card">
          @endif
            <div class="card-header" id="headingSiete">
              <h2 class="mb-0">
                @if(Auth::user()->darkMode)
                  <button class="btn collapsed d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete">
                @else
                  <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete">
                @endif
                  ¿Hay límite de edad para afiliarse?
                  <span class="material-icons ml-auto">
                    keyboard_arrow_down
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#accordionExample">
              @if(Auth::user()->darkMode)
                <div class="card-body text-white">
              @else
                <div class="card-body">
              @endif
                No, nuestros planes no tienen límite de edad.
              </div>
            </div>
          </div>
        </div>
      </center>
    </div>
  </div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/doctors.mostrar.js') }}" defer></script>
@endsection
