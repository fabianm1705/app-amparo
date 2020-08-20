@extends('layouts.app')

@section('myLinks')
  <script>
    function darkModePlanes(valor){

      var el41 = document.getElementById("titulo");
      var el42 = document.getElementById("tarjeta1");
      var el43 = document.getElementById("boton1");
      var el44 = document.getElementById("respuesta1");
      var el45 = document.getElementById("tarjeta2");
      var el46 = document.getElementById("boton2");
      var el47 = document.getElementById("respuesta2");
      var el48 = document.getElementById("tarjeta3");
      var el49 = document.getElementById("boton3");
      var el50 = document.getElementById("respuesta3");
      var el51 = document.getElementById("tarjeta4");
      var el52 = document.getElementById("boton4");
      var el53 = document.getElementById("respuesta4");
      var el54 = document.getElementById("tarjeta5");
      var el55 = document.getElementById("boton5");
      var el56 = document.getElementById("respuesta5");
      var el57 = document.getElementById("tarjeta6");
      var el58 = document.getElementById("boton6");
      var el59 = document.getElementById("respuesta6");
      var el60 = document.getElementById("tarjeta7");
      var el61 = document.getElementById("boton7");
      var el62 = document.getElementById("respuesta7");
      if(valor){
        el41.classList.add('text-white');
        el42.classList.add('bg-secondary');
        el43.classList.add('text-white');
        el44.classList.add('text-white');
        el45.classList.add('bg-secondary');
        el46.classList.add('text-white');
        el47.classList.add('text-white');
        el48.classList.add('bg-secondary');
        el49.classList.add('text-white');
        el50.classList.add('text-white');
        el51.classList.add('bg-secondary');
        el52.classList.add('text-white');
        el53.classList.add('text-white');
        el54.classList.add('bg-secondary');
        el55.classList.add('text-white');
        el56.classList.add('text-white');
        el57.classList.add('bg-secondary');
        el58.classList.add('text-white');
        el59.classList.add('text-white');
        el60.classList.add('bg-secondary');
        el61.classList.add('text-white');
        el62.classList.add('text-white');
      }else{
        el41.classList.remove('text-white');
        el42.classList.remove('bg-secondary');
        el43.classList.remove('text-white');
        el44.classList.remove('text-white');
        el45.classList.remove('bg-secondary');
        el46.classList.remove('text-white');
        el47.classList.remove('text-white');
        el48.classList.remove('bg-secondary');
        el49.classList.remove('text-white');
        el50.classList.remove('text-white');
        el51.classList.remove('bg-secondary');
        el52.classList.remove('text-white');
        el53.classList.remove('text-white');
        el54.classList.remove('bg-secondary');
        el55.classList.remove('text-white');
        el56.classList.remove('text-white');
        el57.classList.remove('bg-secondary');
        el58.classList.remove('text-white');
        el59.classList.remove('text-white');
        el60.classList.remove('bg-secondary');
        el61.classList.remove('text-white');
        el62.classList.remove('text-white');
      };

    }
  </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-5 col-sm-5 card shadow-sm fresh-table full-color-orange ml-2 mr-2 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Salud</h5>
          <h1 class="card-title">
            @if($salud)
              @if($usersCount===1)
                <small class="text-white">$</small><strong>600</strong><small class="text-white"> /mes</small>
              @else
                <small class="text-white">$</small><strong>900</strong><small class="text-white"> Grupo Fliar</small>
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
              <small class="text-white">$</small><strong>220</strong><small class="text-white"> /ind.</small>
            @else
              <h5>Tienes este plan activo</h5>
            @endif
          </h1><br>
          + $180 por Adherente<hr>
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
    <div id="titulo" class="m-4 text-center">
      <h2>Preguntas Frecuentes</h2>
    </div>
    <center>
      <div class="accordion col-lg-6 col-md-9 col-sm-12" id="accordionExample">
        <div id="tarjeta1" class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button id="boton1" class="btn d-flex" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Al afiliarse hay espera para utilizar los planes?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div id="respuesta1" class="card-body">
              No, por ser socios activos no hay espera al agregar un nuevo plan.
            </div>
          </div>
        </div>
        <div id="tarjeta2" class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button id="boton2" class="btn d-flex collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                El Plan Salud incluye Odontología?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div id="respuesta2" class="card-body">
              No, Salud y Odontología son planes separados y opcionales, se puede tomar uno o ambos, tanto de forma individual como por grupo familiar.
            </div>
          </div>
        </div>
        <div id="tarjeta3" class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button id="boton3" class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                ¿El Plan Salud cubre internación?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div id="respuesta3" class="card-body">
              No, es un plan ambulatorio, cubre todo lo que es laboratorio, radiografías, ecografías, consultorios externos, practicamente están todas las especialidades, emergencia médica, farmacia, etc.
            </div>
          </div>
        </div>
        <div id="tarjeta4" class="card">
          <div class="card-header" id="headingCuatro">
            <h2 class="mb-0">
              <button id="boton4" class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro">
                ¿Trabajan con otras obras sociales?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#accordionExample">
            <div id="respuesta4" class="card-body">
              No, al afiliarse a Amparo se atienden como socios de Amparo.
            </div>
          </div>
        </div>
        <div id="tarjeta5" class="card">
          <div class="card-header" id="headingCinco">
            <h2 class="mb-0">
              <button id="boton5" class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco">
                ¿Puedo tener otra obra social y ser socio de Amparo?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#accordionExample">
            <div id="respuesta5" class="card-body">
              Si, Amparo es un servicio privado que puede funcionar como complemento de su obra social.
            </div>
          </div>
        </div>
        <div id="tarjeta6" class="card">
          <div class="card-header" id="headingSiete">
            <h2 class="mb-0">
              <button id="boton6" class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete">
                ¿Hay límite de edad para afiliarse?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#accordionExample">
            <div id="respuesta6" class="card-body">
              No, nuestros planes no tienen límite de edad.
            </div>
          </div>
        </div>
        <div id="tarjeta7" class="card">
          <div class="card-header" id="headingOcho">
            <h2 class="mb-0">
              <button id="boton7" class="btn collapsed d-flex" type="button" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho">
                ¿Puedo pagar la cuota con tarjeta de crédito?
                <span class="material-icons ml-auto">
                  keyboard_arrow_down
                </span>
              </button>
            </h2>
          </div>
          <div id="collapseOcho" class="collapse" aria-labelledby="headingOcho" data-parent="#accordionExample">
            <div id="respuesta7" class="card-body">
              No, las formas de pago habilitadas son débito vía CBU bancario, transferencia bancaria, rapipago, pago fácil, pago en oficina o cobranza domiciliaria.
            </div>
          </div>
        </div>
      </div>
    </center>
    <img onload="darkModePlanes({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
