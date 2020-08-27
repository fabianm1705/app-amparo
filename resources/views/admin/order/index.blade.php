@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Órdenes Médicas</h5>
        <div class="ml-auto blanco mr-2 mt-2">
          @can('orders.create')
            <a href="{{ route('usersSearch') }}" title="Nueva">
              Nueva Orden
            </a>
          @endcan
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
              <th>App</th>
              <th>Estado</th>
              <th>Obs</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id+5000 }}</td>
                  <td>{{ \Carbon\Carbon::parse($order->fechaImpresion)->format('d/m/Y') }}</td>
                  <td>{{ $order->user->group->nroSocio }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order->doctor->apeynom }}</td>
                  <td>{{ $order->monto_s }}</td>
                  <td>{{ $order->monto_a }}</td>
                  <td>{{ $order->lugarEmision }}</td>
                  <td>{{ $order->estado }}</td>
                  <td>{{ $order->obs }}</td>
                  <td class="text-right d-flex">
                    @can('orders.edit')
                    <a href="{{ route('orders.edit', ['order' => $order ]) }}" title="Editar" class="">
                      <div class="">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">edit</i>
                        @else
                          <i class="material-icons">edit</i>
                        @endif
                      </div>
                    </a>&nbsp;
                    @endcan
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
                    @can('orders.destroy')
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
          {{ $orders->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/borrarRegistro.js') }}" defer></script>
@endsection
