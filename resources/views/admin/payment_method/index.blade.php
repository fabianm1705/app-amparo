@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Métodos de Pago</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('payment_methods.create')
              <a href="{{ route('payment_methods.create') }}" title="Nuevo">
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
              <th>Cant. Cuotas</th>
              <th>%</th>
              <th class="text-center">Activo</th>
              <th class="text-center">Acciones</th>
            </thead>
            <tbody>
              @foreach($payment_methods as $payment_method)
                <tr>
                  <td>{{ $payment_method->name }}</td>
                  <td class="text-center">${{ $payment_method->cant_cuotas }}</td>
                  <td class="text-center">${{ $payment_method->percentage }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="activo" name="activo" disabled value="1" {{ $payment_method->activo ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('payment_methods.edit')
                      <a href="{{ route('payment_methods.edit', ['payment_method' => $payment_method ]) }}" title="Editar" class="">
                        <div class="">
                          <i class="material-icons">edit</i>
                        </div>
                      </a>&nbsp;
                    @endcan
                    @can('payment_methods.destroy')
                      <form action="{{ route('payment_methods.destroy', ['payment_method' => $payment_method ]) }}" method="post" style="background-color: transparent;">
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
