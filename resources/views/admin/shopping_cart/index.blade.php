@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-dark">
      @else
        <div class="card shadow-sm">
      @endif
        <div class="card-body centrado">
          @if(Auth::user()->darkMode)
            <table class="table table-hover table-sm table-responsive table-dark">
          @else
            <table class="table table-hover table-sm table-responsive">
          @endif
            <thead>
              <th>MP-Id</th>
              <th>Nro. Socio</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th class="text-center">Mostrar</th>
            </thead>
            <tbody>
              @foreach($shopping_carts as $shopping_cart)
                <tr>
                  <td class="align-middle">{{ $shopping_cart->operation_id }}</td>
                  <td class="align-middle">{{ $shopping_cart->user->group->nroSocio }}</td>
                  <td class="align-middle">{{ $shopping_cart->user->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($shopping_cart->fecha)->format('d/m/Y') }}</td>
                  <td class="align-middle">{{ $shopping_cart->estado }}</td>
                  <td class="d-flex">
                    <form id="formEliminar{{ $shopping_cart->id }}" action="{{ route('shopping_cart.destroy', ['id' => $shopping_cart->id ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $shopping_cart->id }})">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">delete</i>
                        @else
                          <i class="material-icons">delete</i>
                        @endif
                      </button>
                    </form>
                    <button class="btn btn-sm" onclick="cargarCarrito({{ $shopping_cart->id }})" style="background-color: transparent;">
                      <div class="">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">double_arrow</i>
                        @else
                          <i class="material-icons">double_arrow</i>
                        @endif
                      </div>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-dark">
      @else
        <div class="card shadow-sm">
      @endif
        <div class="card-body centrado">
          @if(Auth::user()->darkMode)
            <table class="table table-hover table-sm table-responsive table-dark">
          @else
            <table class="table table-hover table-sm table-responsive">
          @endif
            <thead>
              <th>Producto</th>
              <th>Cantidad</th>
              <th class="text-right">Monto</th>
            </thead>
            <tbody id="tablaproductos">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/shopping_carts.index.js') }}" defer></script>
  <script src="{{ asset('js/borrarRegistro.js') }}" defer></script>
@endsection
