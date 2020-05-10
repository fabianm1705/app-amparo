@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Especialidades</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('specialties.create')
              <a href="{{ route('specialties.create') }}" title="Nueva">
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
              <th>Monto S</th>
              <th>Monto A</th>
              <th>Activa</th>
              <th>Orden Web</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($specialties as $specialty)
                <tr>
                  <td>{{ $specialty->descripcion }}</td>
                  <td class="text-center">${{ $specialty->monto_s }}</td>
                  <td class="text-center">${{ $specialty->monto_a }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" disabled value="1" {{ $specialty->vigente ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigenteOrden" name="vigenteOrden" disabled value="1" {{ $specialty->vigenteOrden ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('specialties.show')
                      <a href="{{ route('specialties.show', ['specialty' => $specialty ]) }}" title="Ver" class="">
                        <div class="">
                          <i class="material-icons">search</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('specialties.edit')
                      <a href="{{ route('specialties.edit', ['specialty' => $specialty ]) }}" title="Editar" class="">
                        <div class="">
                          <i class="material-icons">edit</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('specialties.destroy')
                      <form action="{{ route('specialties.destroy', ['specialty' => $specialty ]) }}" method="post" style="background-color: transparent;">
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
