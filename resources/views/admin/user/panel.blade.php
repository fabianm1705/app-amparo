@extends('layouts.app')

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
    <div class="col-lg-5 col-md-5 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Afiliados</h5>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
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
    <div class="col-lg-7 col-md-7 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Info General</h5>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <label class="direccion">Domicilio</label>
              <input type="text" class="form-control" value="{{ $group->direccion }}" readonly id="direccion">
            </div>
            <div class="col-md-3">
              <label for="fechaAlta">Afiliación</label>
              <input type="text" class="form-control text-center" value="{{ \Carbon\Carbon::parse($group->fechaAlta)->format('d/m/Y') }}" readonly id="fechaAlta">
            </div>
            <div class="col-md-3">
              <label for="telefono">Teléfonos</label>
              <input type="text" class="form-control text-center" value="{{ $group->telefono }}" readonly id="telefono">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="direccionCobro">Domicilio de Cobro</label>
              <input type="text" class="form-control" value="{{ $group->direccionCobro }}" readonly id="direccionCobro">
            </div>
            <div class="col-md-3">
              <label for="diaCobro">Día de Cobro</label>
              <input type="text" class="form-control text-center" value="{{ $group->diaCobro }}" readonly id="diaCobro">
            </div>
            <div class="col-md-3">
              <label for="horaCobro">Horario</label>
              <input type="text" class="form-control text-center" value="{{ $group->horaCobro }}" readonly id="horaCobro">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Órdenes</h5>
        </div>
        <div class="card shadow-sm mt-1">
            <div class="card-body centrado">
                <table class="table table-hover table-sm table-responsive">
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
    <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Planes Suscriptos</h5>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
            <table class="table table-hover table-sm table-responsive">
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
    <div class="col-lg-3 col-md-3 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Estado de Cuenta</h5>
        </div>
        <div class="card shadow-sm mt-1">
            <div class="card-body centrado">
                <table class="table table-hover table-sm table-responsive">
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
  </div>
</div>
@endsection
