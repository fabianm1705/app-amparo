@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Visor de Accesos</h5>
      </div>
      <div class="card shadow-sm mt-1">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th></th>
              <th>Socio</th>
              <th>Zona</th>
              <th>Obs</th>
              <th>Fecha</th>
              <th>Borrar</th>
            </thead>
            <tbody>
              @foreach($user_interests as $user_interest)
                <tr>
                  <td>{{ $user_interest->user->group->nroSocio }}</td>
                  <td>{{ $user_interest->user->name }}</td>
                  <td>{{ $user_interest->interest->description }}</td>
                  <td>{{ $user_interest->obs }}</td>
                  <td>{{ $user_interest->created_at }}</td>
                  <td>
                    @can('interests.destroy')
                    <form action="{{ route('user_interest.borrar', ['id' => $user_interest->id ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
                        X
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
