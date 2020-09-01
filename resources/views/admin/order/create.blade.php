@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9 col-lg-6 mt-2">
      <form action="{{ route('orders.store') }}" method="post">
          @csrf
          <div class="fresh-table full-color-orange shadow-sm">
            <div class="row">
              <h5 class="card-title text-white mt-3 mb-3 ml-4">&nbsp;&nbsp;Emisión de Órdenes</h5><br>
            </div>
            <div class="col-md-12">
              @auth
                @foreach (Auth::user()->roles as $role)
                  @if($role->slug=='socio')
                    <select class="custom-select mb-1" name="user_id" id="user_id" onchange="checkSocio(true)">
                  @else
                    <select class="custom-select mb-1" name="user_id" id="user_id" onchange="checkSocio(false)">
                  @endif
                @endforeach
              @endauth
                <option value="0" selected>Seleccione Paciente</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">
                      {{ $user->name }}
                  </option>
                @endforeach
              </select>
              @auth
                @foreach (Auth::user()->roles as $role)
                  @if($role->slug=='socio')
                    <select class="custom-select mb-1" name="specialty_id" id="specialty_id" onchange="getDoctors(true)">
                  @else
                    <select class="custom-select mb-1" name="specialty_id" id="specialty_id" onchange="getDoctors(false)">
                  @endif
                @endforeach
              @endauth
                <option value="0" selected>Seleccione Especialidad</option>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}"
                          data-limit-orders="{{ $specialty->limitOrders }}"
                          data-cantlimitorders="{{ $specialty->cantLimitOrders }}">
                      {{ $specialty->descripcion }}
                  </option>
                @endforeach
              </select>
              <select class="custom-select" name="doctor_id" id="doctor_id">
                <option value="0" selected>Seleccione Profesional</option>
                @foreach($doctors as $doctor)
                  <option value="{{ $doctor->id }}">
                      {{ $doctor->apeynom }}
                  </option>
                @endforeach
              </select><br><br>
            </div>
          </div>

          <center>
            <div class="btn-group btn-group-toggle mt-2" style="display:none" id="oftalmologiaOptions" data-toggle="buttons">
              <label class="btn btn-success active">
                <input type="radio" name="options" id="oftalmologiaConsulta" checked onclick="obsSwitch('Orden de Consulta')"> Orden de Consulta
              </label>
              <label class="btn btn-success">
                <input type="radio" name="options" id="oftalmologiaEstudio" onclick="obsSwitch('Orden de Estudio')"> Orden de Estudio
              </label>
            </div>
          </center>
          @auth
            @foreach (Auth::user()->roles as $role)
              @if($role->slug=='socio')
                <textarea class="form-control mt-2 mb-2" style="display:none" id="obs" name="obs" rows="2" placeholder="Observaciones" autocomplete="off"></textarea>
              @else
                <textarea class="form-control mt-2 mb-2" id="obs" name="obs" rows="2" placeholder="Observaciones" autocomplete="off"></textarea>
              @endif
            @endforeach
          @endauth

          @if($emiteOficina)
            <div>
              <div class="row justify-content-center mb-2">
                <div class="col-md-2">
                  <label for="monto_s" id="msg_monto_s">Monto S.</label>
                  <input type="text" class="form-control" name="monto_s" id="monto_s">
                </div>
                <div class="col-md-2">
                  <label for="monto_a" id="msg_monto_a">Monto A.</label>
                  <input type="text" class="form-control" name="monto_a" id="monto_a">
                </div>
              </div>
            </div>
          @else
            <div>
              <input type="hidden" class="form-control" name="monto_s" id="monto_s">
              <input type="hidden" class="form-control" name="monto_a" id="monto_a">
            </div>
          @endif
          <div class="mt-4">
            <input type="hidden" name="cant_orders_salud" id="cant_orders_salud">
            <input type="hidden" name="cant_orders_odonto" id="cant_orders_odonto">
            <h5 class="card-title d-flex justify-content-center">
              <small><label id="msgCoseguro"></label></small><label id="coseguro"></label>
            </h5>
          </div>
          <div class="text-center" id="divBtnGenerarOrden">
            <input class="btn btn-success btn-block btn-lg" id="btnGenerarOrden" type="submit" value="Generar Orden" />
          </div>
      </form>
    </div>
  </div>
  <br>
  <center>
    <div id="divCarenciaOdonto" style="display:none" class="alert alert-warning mt-2 col-md-9 col-lg-6">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Carencia activa del plan odontológico hasta el &nbsp;<label id="carencia_odonto"></label>

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
    <div id="divCarenciaSalud" style="display:none" class="alert alert-warning mt-2 col-md-9 col-lg-6">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Carencia activa del plan salud hasta el &nbsp;<label id="carencia_salud"></label>

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>

    <div id="divNecesitaSalud" style="display:none" class="col-md-9 col-lg-6 alert alert-warning text-justify mt-2">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Puedes activar el Plan Salud para poder utilizar nuestra red de consultorios, haciéndolo ahora mismo puedes comenzar a utilizarlo de inmediato!

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
    <div id="divNecesitaOdontologia" style="display:none" class="col-md-9 col-lg-6 alert alert-warning text-justify mt-2">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Puedes activar el Plan Odontológico para atenderte con nuestros profesionales, haciéndolo ahora mismo puedes comenzar a utilizarlo de inmediato!

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
  </center>
  <div class="row justify-content-center">
      <div id="divNecesitaSalud2" style="display:none" class="col-md-4 card shadow-sm fresh-table full-color-orange ml-4 mr-4 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Salud</h5>
          <h1 class="card-title">
            @if($usersCount===1)
              <small class="text-white">$</small><strong>{{ $precio_individual_salud }}</strong><small class="text-white"> /mes</small>
            @else
              <small class="text-white">$</small><strong>{{ $precio_grupo_salud }}</strong><small class="text-white"> Grupo Fliar</small>
            @endif
          </h1><br>
          Cobertura Ambulatoria Integral<hr>
          Consultorios Externos, Laboratorio<hr>
          Farmacia, Ambulancia, Emergencias<hr>
          Estudios, Radiografías, Ecografías y más.<br><br>
          @if($usersCount===1)
            <form action="{{ route('activar.salud', ['precio_individual_salud' => $precio_individual_salud ]) }}" method="post">
              @csrf
              <button class="btn btn-lg" type="submit" name="button">Activar</button>
            </form>
          @else
            <form action="{{ route('activar.plan', ['precio_grupo_salud' => $precio_grupo_salud ]) }}" method="post">
              @csrf
              <button class="btn btn-lg" type="submit" name="button">Activar</button>
            </form>
          @endif
        </div>
      </div>
      <div id="divNecesitaOdontologia2" style="display:none" class="col-md-4 card shadow-sm fresh-table full-color-orange ml-4 mr-4 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Odontológico</h5>
          <h1 class="card-title">
            <small class="text-white">$</small><strong>{{ $precio_individual_odontologia }}</strong><small class="text-white"> /ind.</small>
          </h1><br>
          + ${{ $precio_adherente_odontologia }} por Adherente<hr>
          Cobertura Odontológica Integral<hr>
          Odontólogos distribuidos por la ciudad<hr>
          Turnos rápidos, coseguros muy económicos<br><br>
          <form action="{{ route('activar.odontologia', ['precio_individual_odontologia' => $precio_individual_odontologia ]) }}" method="post">
            @csrf
            <button class="btn btn-lg" type="submit" name="button">Activar</button>
          </form>
        </div>
      </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/orders.create.js') }}" defer></script>
@endsection
