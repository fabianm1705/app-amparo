@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-5 col-sm-5 card shadow-sm fresh-table full-color-orange ml-2 mr-2 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Salud</h5>
          <h1 class="card-title">
            @if($salud)
              @if($usersCount===1)
                <small class="text-white">$</small><strong>{{ $precio_individual_salud }}</strong><small class="text-white"> /mes</small>
              @else
                <small class="text-white">$</small><strong>{{ $precio_grupo_salud }}</strong><small class="text-white"> Grupo Fliar</small>
              @endif
            @else
              <h5>Tienes este plan activo</h5>
            @endif
          </h1><br>
          Cobertura Ambulatoria Integral<hr>
          Consultorios Externos, Laboratorio<hr>
          Farmacia, Ambulancia, Emergencias<hr>
          Estudios, Radiografías, Ecografías y más.<br><br>
          @if($salud)
            <div>
              @if($usersCount===1)
                <form action="{{ route('activar.salud') }}" method="post">
                  @csrf
                  <button class="btn btn-lg" type="submit" name="button">Activar</button>
                </form>
              @else
                <form action="{{ route('activar.plan') }}" method="post">
                  @csrf
                  <button class="btn btn-lg" type="submit" name="button">Activar</button>
                </form>
              @endif
            </div>
          @else
            <h5>Tienes este plan activo</h5>
          @endif
        </div>
      </div>
      <div class="col-lg-4 col-md-5 col-sm-5 card shadow-sm fresh-table full-color-orange ml-2 mr-2 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Odontológico</h5>
          <h1 class="card-title">
            @if($odontologia)
              <small class="text-white">$</small><strong>{{ $precio_individual_odontologia }}</strong><small class="text-white"> /ind.</small>
            @else
              <h5>Tienes este plan activo</h5>
            @endif
          </h1><br>
          + ${{ $precio_adherente_odontologia }} por Adherente<hr>
          Cobertura Odontológica Integral<hr>
          Odontólogos distribuidos por la ciudad<hr>
          Turnos rápidos, coseguros muy económicos<br><br>
          @if($odontologia)
            <div>
              <form action="{{ route('activar.odontologia') }}" method="post">
                @csrf
                <button class="btn btn-lg" type="submit" name="button">Activar</button>
              </form>
            </div>
          @else
            <h5>Tienes este plan activo</h5>
          @endif
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
              Siendo socios activos y agregando un nuevo plan no hay espera. Por el contrario, si se acaban de afiliar hay una espera de 2 meses en cualquiera de los planes.
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
              No, es un plan ambulatorio, cubre todo lo que es laboratorio, radiografías, ecografías, consultorios externos, ya sea con órdenes o reintegros, emergencia médica, farmacia, óptica, etc.
            </div>
          </div>
        </div>
        @if(Auth::user()->darkMode)
          <div class="card bg-secondary">
        @else
          <div class="card">
        @endif
          <div class="card-header" id="headingCuatro">
            <h2 class="mb-0">
              @if(Auth::user()->darkMode)
                <button class="btn collapsed d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro">
              @else
                <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro">
              @endif
                ¿Trabajan con otras obras sociales?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#accordionExample">
            @if(Auth::user()->darkMode)
              <div class="card-body text-white">
            @else
              <div class="card-body">
            @endif
              No, al afiliarse a Amparo se atienden como socios de Amparo.
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
                ¿Puedo tener otra obra social y ser socio de Amparo?
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
        @if(Auth::user()->darkMode)
          <div class="card bg-secondary">
        @else
          <div class="card">
        @endif
          <div class="card-header" id="headingOcho">
            <h2 class="mb-0">
              @if(Auth::user()->darkMode)
                <button class="btn collapsed d-flex text-white" type="button" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho">
              @else
                <button class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho">
              @endif
                ¿Puedo pagar la cuota con tarjeta de crédito?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseOcho" class="collapse" aria-labelledby="headingOcho" data-parent="#accordionExample">
            @if(Auth::user()->darkMode)
              <div class="card-body text-white">
            @else
              <div class="card-body">
            @endif
              Sí, pero sólo en oficina yendo mes a mes, las formas de pago además son débito vía CBU bancario, transferencia bancaria, rapipago, pago fácil, pago en oficina o cobranza domiciliaria.
            </div>
          </div>
        </div>
      </div>
    </center>
</div>
@endsection
