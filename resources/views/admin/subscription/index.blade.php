@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Plans/Subscriptions</h5>
          <div class="ml-auto blanco mr-2 mt-2">
            @can('subscriptions.create')
            <a href="{{ route('subscriptions.create') }}" title="Nueva">
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
              <th>Grupal</th>
              <th>Sep. Estándar</th>
              <th>Sep. Plus</th>
              <th>Odontología</th>
              <th>Salud</th>
              <th>Orden Médica</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($subscriptions as $subscription)
                <tr>
                  <td>{{ $subscription->description }}</td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="grupal" name="grupal" disabled value="1" {{ $subscription->grupal ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="sepelio_estandar" name="sepelio_estandar" disabled value="1" {{ $subscription->sepelio_estandar ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="sepelio_plus" name="sepelio_plus" disabled value="1" {{ $subscription->sepelio_plus ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="odontologia" name="odontologia" disabled value="1" {{ $subscription->odontologia ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="salud" name="salud" disabled value="1" {{ $subscription->salud ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" class="form-check-input" id="orden_medica" name="orden_medica" disabled value="1" {{ $subscription->orden_medica ? 'checked="checked"' : '' }}>
                  </td>
                  <td class="text-right d-flex">
                    @can('subscriptions.show')
                    <a href="{{ route('subscriptions.show', ['subscription' => $subscription ]) }}" title="Ver" class="">
                      <div class="">
                        <i class="material-icons">search</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('subscriptions.edit')
                    <a href="{{ route('subscriptions.edit', ['subscription' => $subscription ]) }}" title="Editar" class="">
                      <div class="">
                        <i class="material-icons">edit</i>
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('subscriptions.destroy')
                    <form action="{{ route('subscriptions.destroy', ['subscription' => $subscription ]) }}" method="post" style="background-color: transparent;">
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
