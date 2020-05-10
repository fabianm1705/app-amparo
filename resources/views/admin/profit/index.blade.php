@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bgOrange d-flex">
          <h5 class="card-title text-white">Porcentajes de Marcación</h5>
          <div class="ml-auto blanco">
            @can('categories.create')
            <a href="{{ route('profits.create') }}" title="Nueva">
              Agregar Nuevo
            </a>
            @endcan
           </div>
        </div>
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Descripción</th>
              <th>%</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($profits as $profit)
                <tr>
                  <td>{{ $profit->description }}</td>
                  <td class="text-center">${{ $profit->percentage }}</td>
                  <td class="text-right d-flex">
                    @can('profits.show')
                    <a href="{{ route('profits.show', ['profit' => $profit ]) }}" title="Ver" class="">
                      <div class="">
                        <i class="material-icons">search</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('profits.edit')
                    <a href="{{ route('profits.edit', ['profit' => $profit ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('profits.destroy')
                    <form action="{{ route('profits.destroy', ['profit' => $profit ]) }}" method="post" style="background-color: transparent;">
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
