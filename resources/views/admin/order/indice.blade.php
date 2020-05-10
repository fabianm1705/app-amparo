@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Órdenes Médicas</h5>
        <div class="ml-auto blanco mr-2 mt-2">
          @can('orders.crear')
            <a href="{{ route('orders.crear') }}" title="Nueva">
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
              <th>Fecha</th>
              <th>Socio</th>
              <th>Profesional</th>
              <th>Coseguro</th>
              <th>Emisión</th>
              <th>Obs</th>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id+5000 }}</td>
                  <td>{{ \Carbon\Carbon::parse($order->fecha)->format('d/m/Y') }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order->doctor->apeynom }}</td>
                  <td class="text-right">${{ $order->monto_s }}</td>
                  <td>{{ $order->lugarEmision }}</td>
                  <td>{{ $order->obs }}</td>
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
