@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Profesionales</h5>
          <ul class="nav justify-content-end ml-auto mr-2 mt-2">
              <li class="nav-item ml-2 blanco">
                @can('crear profesionales')
                <a href="{{ route('doctors.create') }}" title="Nuevo">Agregar Nuevo</a>
                @endcan
              </li>
          </ul>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>ID</th>
              <th>Nombre</th>
              <th>Consultorio</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Especialidad</th>
              <th>Activo</th>
              <th>Orden Web</th>
              <th>Coseguro</th>
              <th>Acciones</th>
            </thead>
            <tbody id="tableDoctors">
              @foreach($doctors as $doctor)
                <tr>
                  <td>{{ $doctor->id }}</td>
                  <td>{{ $doctor->apeynom }}</td>
                  <td>{{ $doctor->direccion }}</td>
                  <td class="text-center">{{ $doctor->telefono }}</td>
                  <td>{{ $doctor->email }}</td>
                  <td>{{ $doctor->specialty->descripcion }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" disabled value="1" {{ $doctor->vigente ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="ordenWeb" name="ordenWeb" disabled value="1" {{ $doctor->ordenWeb ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="coseguroConsultorio" name="coseguroConsultorio" disabled value="1" {{ $doctor->coseguroConsultorio ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('editar profesionales')
                    <a href="{{ route('doctors.edit', ['doctor' => $doctor ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('eliminar profesionales')
                    <form id="formEliminar{{ $doctor->id }}" action="{{ route('doctors.destroy', ['doctor' => $doctor ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $doctor->id }})">
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
