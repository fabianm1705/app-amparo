@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange shadow-sm">
        <div class="row text-white">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <h5 class="card-title text-white mt-3 mb-3 ml-4">Órdenes Médicas</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="row">
              <div class="col-md-8 m-2">
                <select class="custom-select" name="doctor" id="doctor" onchange="cargarOrdenes()">
                  <option selected>Seleccione profesional</option>
                  @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->apeynom }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 mt-2 blanco d-flex">
            <div class="ml-auto mr-2">
              @can('emitir ordenes')
                <a href="{{ route('usersSearch') }}" title="Nueva">
                  Nueva Orden
                </a>
              @endcan
            </div>
          </div>
        </div>
      </div>
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm mt-1 bg-dark">
      @else
        <div class="card shadow-sm mt-1">
      @endif
        <div class="card-body">
          @if(Auth::user()->darkMode)
            <table class="table table-hover table-sm table-responsive table-dark">
          @else
            <table class="table table-hover table-sm table-responsive">
          @endif
            <thead>
              <th>Orden</th>
              <th>Impresión</th>
              <th>Socio</th>
              <th>Nombre</th>
              <th>Profesional</th>
              <th>Soc</th>
              <th>Amp</th>
              <th>noAOP</th>
              <th>Estado</th>
              <th>Pago</th>
              <th>Obs</th>
              <th>Acciones</th>
            </thead>
            <tbody id="tablaordenes">
              @foreach($orders as $order)
                <tr id="borrar">
                  <td>{{ $order->id+5000 }}</td>
                  <td>{{ \Carbon\Carbon::parse($order->fechaImpresion)->format('d/m/Y') }}</td>
                  <td>{{ $order->user->group->nroSocio }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order->doctor->apeynom }}</td>
                  <td>{{ $order->monto_s }}</td>
                  <td>{{ $order->lugarEmision }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="no_aop" name="no_aop" disabled value="1" {{ $order->user->no_aop ? 'checked="checked"' : '' }}>
                  </td>
                  <td>{{ $order->estado }}</td>
                  @if($order->fechaPago)
                    <td>{{ \Carbon\Carbon::parse($order->fechaPago)->format('d/m/Y') }}</td>
                  @else
                    <td></td>
                  @endif
                  <td>{{ $order->obs }}</td>
                  <td class="text-right d-flex">
                    <a href="{{ route('pdf', ['id' => $order->id ]) }}" title="Descargar">
                      <div class="">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">get_app</i>
                        @else
                          <i class="material-icons">get_app</i>
                        @endif
                      </div>
                    </a>
                    <a href="{{ route('pdf', ['id' => $order->id ]) }}" title="Imprimir">
                      <div class="">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">print</i>
                        @else
                          <i class="material-icons">print</i>
                        @endif
                      </div>
                    </a>
                    @if(is_null($order->fechaPago))
                      <form id="formPagar{{ $order->id }}" action="{{ route('orders.pay', ['id' => $order->id ]) }}" method="post" style="background-color: transparent;">
                        @csrf
                        <button class="btn btn-sm" onclick="pagarOrden({{ $order->id }})">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">attach_money</i>
                          @else
                            <i class="material-icons">attach_money</i>
                          @endif
                        </button>
                      </form>
                    @endif
                    @can('eliminar ordenes')
                      <form id="formEliminar{{ $order->id }}" action="{{ route('orders.destroy', ['order' => $order ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="borrarRegistro({{ $order->id }})">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">delete</i>
                          @else
                            <i class="material-icons">delete</i>
                          @endif
                        </button>
                      </form>
                    @endcan
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div id="paginador">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/borrarRegistro.js') }}" defer></script>
  <script src="{{ asset('js/orders.index.js') }}" defer></script>
@endsection
