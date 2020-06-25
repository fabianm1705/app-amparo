@extends('layouts.app')

@section('myLinks')
<script>
  function darkModePanel(valor){
    var el41 = document.getElementById("tabla1");
    var el42 = document.getElementById("tarjeta1");
    var el43 = document.getElementById("tarjeta2");
    var el431 = document.getElementById("texto21");
    var el432 = document.getElementById("texto22");
    var el433 = document.getElementById("texto23");
    var el434 = document.getElementById("texto24");
    var el435 = document.getElementById("texto25");
    var el436 = document.getElementById("texto26");
    var el44 = document.getElementById("tabla3");
    var el45 = document.getElementById("tarjeta3");
    var el46 = document.getElementById("tabla4");
    var el47 = document.getElementById("tarjeta4");
    var el48 = document.getElementById("tabla5");
    var el49 = document.getElementById("tarjeta5");
    if(valor){
      el41.classList.add('table-dark');
      el42.classList.add('bg-dark');
      el43.classList.add('bg-dark');
      el431.classList.add('text-white');
      el432.classList.add('text-white');
      el433.classList.add('text-white');
      el434.classList.add('text-white');
      el435.classList.add('text-white');
      el436.classList.add('text-white');
      el44.classList.add('table-dark');
      el45.classList.add('bg-dark');
      el46.classList.add('table-dark');
      el47.classList.add('bg-dark');
      el48.classList.add('table-dark');
      el49.classList.add('bg-dark');
    }else{
      el41.classList.remove('table-dark');
      el42.classList.remove('bg-dark');
      el43.classList.remove('bg-dark');
      el431.classList.remove('text-white');
      el432.classList.remove('text-white');
      el433.classList.remove('text-white');
      el434.classList.remove('text-white');
      el435.classList.remove('text-white');
      el436.classList.remove('text-white');
      el44.classList.remove('table-dark');
      el45.classList.remove('bg-dark');
      el46.classList.remove('table-dark');
      el47.classList.remove('bg-dark');
      el48.classList.remove('table-dark');
      el49.classList.remove('bg-dark');
    }
  };
</script>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="alert alert-success col-12">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Adhiriendo al débito automático tienes un 15% de descuento por 6 meses.
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Afiliados</h5>
      </div>
      <div id="tarjeta1" class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table id="tabla1" class="table table-hover table-sm table-responsive">
            <thead>
              <tr>
                <th class="text-center">Apellido y Nombres</th>
                <th>Fecha Nac.</th>
                <th>Documento</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($user->fechaNac)->format('d/m/Y') }}</td>
                  <td>{{ $user->nroDoc }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Info General</h5>
      </div>
      <div id="tarjeta2" class="card shadow-sm mt-1">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <label id="texto21" class="direccion">Domicilio</label>
              <input type="text" class="form-control" value="{{ $group->direccion }}" readonly id="direccion">
            </div>
            <div class="col-md-3">
              <label id="texto22" for="fechaAlta">Afiliación</label>
              <input type="text" class="form-control text-center" value="{{ \Carbon\Carbon::parse($group->fechaAlta)->format('d/m/Y') }}" readonly id="fechaAlta">
            </div>
            <div class="col-md-3">
              <label id="texto23" for="telefono">Teléfonos</label>
              <input type="text" class="form-control text-center" value="{{ $group->telefono }}" readonly id="telefono">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label id="texto24" for="direccionCobro">Domicilio de Cobro</label>
              <input type="text" class="form-control" value="{{ $group->direccionCobro }}" readonly id="direccionCobro">
            </div>
            <div class="col-md-3">
              <label id="texto25" for="diaCobro">Día de Cobro</label>
              <input type="text" class="form-control text-center" value="{{ $group->diaCobro }}" readonly id="diaCobro">
            </div>
            <div class="col-md-3">
              <label id="texto26" for="horaCobro">Horario</label>
              <input type="text" class="form-control text-center" value="{{ $group->horaCobro }}" readonly id="horaCobro">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Estado de Cuenta</h5>
        </div>
        <div id="tarjeta3" class="card shadow-sm mt-1">
            <div class="card-body centrado">
                <table id="tabla3" class="table table-hover table-sm table-responsive">
                  <thead>
                    <tr>
                      <th>Mes</th>
                      <th>Monto</th>
                      <th>F. Pago</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sales as $sale)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($sale->fechaEmision)->format('M') }}</td>
                        <td class="text-right">${{ $sale->total }}</td>
                        @if($sale->fechaPago)
                          <td>{{ \Carbon\Carbon::parse($sale->fechaPago)->format('d/m/y') }}</td>
                        @else
                          <td></td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Planes Suscriptos</h5>
      </div>
      <div id="tarjeta4" class="card shadow-sm mt-1">
        <div class="card-body centrado">
            <table id="tabla4" class="table table-hover table-sm table-responsive">
              <thead>
                <tr>
                  <th class="">Planes</th>
                  <th class="text-right">Monto</th>
                </tr>
              </thead>
              <tbody>
                @foreach($plans as $plan)
                  <tr>
                    <td>{{ $plan->nombre }}</td>
                    <td>{{ $plan->monto }}</td>
                  </tr>
                @endforeach
                @foreach($layers as $layer)
                  <tr>
                    <td>{{ $layer->nombre }}</td>
                    <td>{{ $layer->monto }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Órdenes</h5>
        </div>
        <div id="tarjeta5" class="card shadow-sm mt-1">
            <div class="card-body centrado">
                <table id="tabla5" class="table table-hover table-sm table-responsive">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Paciente</th>
                      <th>Profesional</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($order->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->doctor->apeynom }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
      </div>
    </div>
  </div>
  <img onload="darkModePanel({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
