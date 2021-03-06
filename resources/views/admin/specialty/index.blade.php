@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Especialidades</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('crear especialidades')
              <a href="{{ route('specialties.create') }}" title="Nueva">
                Agregar Nueva
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
              <th>Id</th>
              <th>Descripción</th>
              <th>Monto S</th>
              <th>Monto A</th>
              <th>Activa</th>
              <th>Orden Web</th>
              <th>Límite Ordenes</th>
              <th>Cant. Límite</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($specialties as $specialty)
                <tr>
                  <td>{{ $specialty->id }}</td>
                  <td>{{ $specialty->descripcion }}</td>
                  <td class="text-center">${{ $specialty->monto_s }}</td>
                  <td class="text-center">${{ $specialty->monto_a }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" disabled value="1" {{ $specialty->vigente ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigenteOrden" name="vigenteOrden" disabled value="1" {{ $specialty->vigenteOrden ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="limitOrders" name="limitOrders" disabled value="1" {{ $specialty->limitOrders ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">{{ $specialty->cantLimitOrders }}</td>
                  <td class="text-right d-flex">
                    @can('editar especialidades')
                      <a href="{{ route('specialties.edit', ['specialty' => $specialty ]) }}" title="Editar" class="">
                        <div class="">
                          <i class="material-icons">edit</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('eliminar especialidades')
                      <form id="formEliminar{{ $specialty->id }}" action="{{ route('specialties.destroy', ['specialty' => $specialty ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="borrarRegistro({{ $specialty->id }})">
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
