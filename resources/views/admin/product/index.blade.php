@extends('layouts.app')

@section('myLinks')
  <script>
    function darkModeProductos(valor){
      var el41 = document.getElementById("tabla");
      var el42 = document.getElementById("tarjeta");
      if(valor){
        el41.classList.add('table-dark');
        el42.classList.add('bg-dark');
      }else{
        el41.classList.remove('table-dark');
        el42.classList.remove('bg-dark');
      }
    };
  </script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
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
       <div id="tarjeta" class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table id="tabla" class="table table-hover table-sm table-responsive">
            <thead>
              <th>Categoría</th>
              <th>Modelo</th>
              <th>Descripcion</th>
              <th class="text-center">Costo</th>
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
                      <form action="{{ route('products.destroy', ['product' => $product ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
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
  <img onload="darkModeProductos({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
