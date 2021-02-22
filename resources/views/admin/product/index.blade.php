@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Productos</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('products.create')
              <a href="{{ route('products.create') }}" title="Nuevo">
                Agregar Nuevo
              </a>
            @endcan
           </div>
       </div>
       @if(Auth::user()->darkMode)
         <div class="card shadow-sm mt-1 bg-dark">
       @else
         <div class="card shadow-sm mt-1">
       @endif
        <div class="card-body centrado">
          @if(Auth::user()->darkMode)
            <table class="table table-hover table-sm table-responsive table-dark">
          @else
            <table class="table table-hover table-sm table-responsive">
          @endif
            <thead>
              <th>Categoría</th>
              <th>Modelo</th>
              <th>Descripcion</th>
              <th class="text-center">Costo</th>
              <th>Precio</th>
              <th class="text-center">Activo</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              @foreach($products as $product)
                <tr>
                  <td>{{ $product->category->nombre }}</td>
                  <td>{{ $product->modelo }}</td>
                  <td class="text-justify">{{ $product->descripcion }}</td>
                  <td class="text-center">${{ $product->costo }}</td>
                  <td>{{ $product->payment_method->name }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" disabled value="1" {{ $product->vigente ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('products.edit')
                      <a href="{{ route('products.edit', ['product' => $product ]) }}" title="Editar" class="">
                        <div class="">
                          @if(Auth::user()->darkMode)
                            <i class="material-icons" style="color:white">edit</i>
                          @else
                            <i class="material-icons">edit</i>
                          @endif
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('products.destroy')
                      <form id="formEliminar{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="borrarRegistro({{ $product->id }})">
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/borrarRegistro.js') }}" defer></script>
@endsection
