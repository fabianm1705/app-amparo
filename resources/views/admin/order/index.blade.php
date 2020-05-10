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
      <div class="card shadow-sm mt-1">
        <div class="card-body">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Orden</th>
              <th>Emisión</th>
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
                  <td>{{ \Carbon\Carbon::parse($order->fecha)->format('d/m/Y') }}</td>
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
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('orders.destroy')
                      <form action="{{ route('orders.destroy', ['order' => $order ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
                          Borrar
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
