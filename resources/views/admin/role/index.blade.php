@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bgOrange d-flex">
          <h5 class="card-title text-white">Roles</h5>
          <div class="ml-auto blanco">
            @can('roles.create')
              <a href="{{ route('roles.create') }}" title="Nuevo">
                Agregar Nuevo
              </a>
            @endcan
           </div>
        </div>
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nombre</th>
              <th>Slug</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              @foreach($roles as $role)
                <tr>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->slug }}</td>
                  <td class="text-right d-flex">
                    @can('roles.show')
                      <a href="{{ route('roles.show', ['role' => $role ]) }}" title="Ver" class="">
                        <div class="">
                          <i class="material-icons">search</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                      <a href="{{ route('roles.edit', ['role' => $role ]) }}" title="Editar" class="">
                        <div class="">
                          <i class="material-icons">edit</i>
                        </div>
                      </a>&nbsp;
                    @can('roles.destroy')
                      <form action="{{ route('roles.destroy', ['role' => $role ]) }}" method="post" style="background-color: transparent;">
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
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
