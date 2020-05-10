@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Profesionales</h5>
          <ul class="nav justify-content-end ml-auto mr-2 mt-2">
              <li class="nav-item ml-2 blanco">
                @can('doctors.create')
                <a href="{{ route('doctors.create') }}" title="Nuevo">Agregar Nuevo</a>
                @endcan
              </li>
          </ul>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nombre</th>
              <th>Consultorio</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Especialidad</th>
              <th>Activo</th>
              <th>Coseguro</th>
              <th>Acciones</th>
            </thead>
            <tbody id="tableDoctors">
              @foreach($doctors as $doctor)
                <tr>
                  <td>{{ $doctor->apeynom }}</td>
                  <td>{{ $doctor->direccion }}</td>
                  <td class="text-center">{{ $doctor->telefono }}</td>
                  <td>{{ $doctor->email }}</td>
                  <td>{{ $doctor->specialty->descripcion }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" disabled value="1" {{ $doctor->vigente ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="coseguroConsultorio" name="coseguroConsultorio" disabled value="1" {{ $doctor->coseguroConsultorio ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('doctors.show')
                    <a href="{{ route('doctors.show', ['doctor' => $doctor ]) }}" title="Ver" class="">
                      <div class="">
                        <i class="material-icons">search</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('doctors.edit')
                    <a href="{{ route('doctors.edit', ['doctor' => $doctor ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('doctors.destroy')
                    <form action="{{ route('doctors.destroy', ['doctor' => $doctor ]) }}" method="post" style="background-color: transparent;">
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
