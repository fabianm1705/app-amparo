@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Categorías</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('crear categorias')
            <a href="{{ route('categories.create') }}" title="Nueva">
              Agregar Nueva
            </a>
            @endcan
           </div>
       </div>
       <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Descripción</th>
              <th>Activa</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <td>{{ $category->nombre }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="activa" name="activa" disabled value="1" {{ $category->activa ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('editar categorias')
                    <a href="{{ route('categories.edit', ['category' => $category ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('eliminar categorias')
                    <form id="formEliminar{{ $category->id }}" action="{{ route('categories.destroy', ['category' => $category ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $category->id }})">
                        Borrar
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
