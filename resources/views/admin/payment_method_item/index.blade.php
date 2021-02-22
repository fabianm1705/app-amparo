@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Item Método de Pago</h5>
          <ul class="nav justify-content-end ml-auto mr-2 mt-2">
              <li class="nav-item ml-2 blanco">
                @can('payment_method_items.create')
                <a href="{{ route('payment_method_items.create') }}" title="Nuevo">Agregar Nuevo</a>
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
              <th>Cuotas</th>
              <th>%</th>
              <th>Método de Pago</th>
              <th>Activo</th>
              <th>Acciones</th>
            </thead>
            <tbody id="tablePaymentMethodItems">
              @foreach($payment_method_items as $payment_method_item)
                <tr>
                  <td>{{ $payment_method_item->id }}</td>
                  <td>{{ $payment_method_item->name }}</td>
                  <td class="text-center">{{ $payment_method_item->cuotas }}</td>
                  <td class="text-center">{{ $payment_method_item->percentage }}</td>
                  <td>{{ $payment_method_item->payment_method->name }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="activo" name="activo" disabled value="1" {{ $payment_method_item->activo ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('payment_method_items.show')
                    <a href="{{ route('payment_method_items.show', ['payment_method_item' => $payment_method_item ]) }}" title="Ver" class="">
                      <div class="">
                        <i class="material-icons">search</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('payment_method_items.edit')
                    <a href="{{ route('payment_method_items.edit', ['payment_method_item' => $payment_method_item ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('payment_method_items.destroy')
                    <form id="formEliminar{{ $payment_method_item->id }}" action="{{ route('payment_method_items.destroy', ['payment_method_item' => $payment_method_item ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $payment_method_item->id }})">
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
