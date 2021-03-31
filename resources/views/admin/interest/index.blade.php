@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Zonas de Interés</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('crear zonas de interes')
            <a href="{{ route('interests.create') }}" title="Nueva">
              Agregar Nueva
            </a>
            @endcan
         </div>
     </div>
     <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>ID</th>
              <th>Descripción</th>
              <th>Activo</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($interests as $interest)
                <tr>
                  <td>{{ $interest->id }}</td>
                  <td>{{ $interest->description }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="activo" name="activo" disabled value="1" {{ $interest->activo ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('editar zonas de interes')
                    <a href="{{ route('interests.edit', ['interest' => $interest ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('eliminar zonas de interes')
                    <form id="formEliminar{{ $interest->id }}" action="{{ route('interests.destroy', ['interest' => $interest ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $interest->id }})">
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
