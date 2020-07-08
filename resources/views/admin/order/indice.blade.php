@extends('layouts.app')

@section('myLinks')
<script>
  function darkModeIndexOrder(valor){
    var el51 = document.getElementById("tabla");
    var el52 = document.getElementById("tarjeta");
    if(valor){
      el51.classList.add('table-dark');
      el52.classList.add('bg-dark');
    }else{
      el51.classList.remove('table-dark');
      el52.classList.remove('bg-dark');
    }
  };
</script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mt-3 mb-3 ml-3">Órdenes Médicas</h5>
        <div class="ml-auto blanco mr-2 mt-2">
          @can('orders.crear')
            <a href="{{ route('orders.create',['id' => 0]) }}" title="Nueva">
              Nueva Orden
            </a>
          @endcan
         </div>
      </div>
      <div id="tarjeta" class="card shadow-sm mt-1">
        <div class="card-body">
          <table id="tabla" class="table table-hover table-sm table-responsive">
            <thead>
              <th>Orden</th>
              <th>Fecha</th>
              <th>Socio</th>
              <th>Profesional</th>
              <th>Coseguro</th>
              <th>Emisión</th>
              <th>Obs</th>
              <th>Descargar</th>
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
                  <td>
                    <a href="{{ route('pdf', ['id' => $order->id ]) }}" title="Descargar">
                      <div class="">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">get_app</i>
                        @else
                          <i class="material-icons">get_app</i>
                        @endif
                      </div>
                    </a>
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
  <img onload="darkModeIndexOrder({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>

@endsection
