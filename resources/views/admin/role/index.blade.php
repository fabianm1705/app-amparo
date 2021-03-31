@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Roles</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('crear roles')
            <a href="{{ route('roles.create') }}" title="Nueva">
              Agregar Nuevo
            </a>
            @endcan
           </div>
       </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nombre</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              @foreach($roles as $role)
                <tr>
                  <td>{{ $role->name }}</td>
                  <td class="text-right d-flex">
                    @can('editar roles')
                      <a href="{{ route('roles.edit', ['role' => $role ]) }}" title="Editar" class="">
                        <div class="">
                          <i class="material-icons">edit</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('eliminar roles')
                      <form id="formEliminar{{ $role->id }}" action="{{ route('roles.destroy', ['role' => $role ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="borrarRegistro({{ $role->id }})">
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
