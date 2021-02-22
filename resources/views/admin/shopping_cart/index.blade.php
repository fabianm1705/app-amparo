@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nro. Socio</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th class="text-center">Mostrar</th>
            </thead>
            <tbody>
              @foreach($shopping_carts as $shopping_cart)
                <tr>
                  <td class="align-middle">{{ $shopping_cart->user->group->nroSocio }}</td>
                  <td class="align-middle">{{ $shopping_cart->user->name }}</td>
                  <td class="align-middle">{{ $shopping_cart->fecha }}</td>
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
                        <i class="material-icons">double_arrow</i>
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
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
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
