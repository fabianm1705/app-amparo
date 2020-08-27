@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Recibos</h5>
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
              <th>Socio</th>
              <th>Fecha</th>
              <th>Monto</th>
              <th>Concepto</th>
              <th>Acciones</th>
            </thead>
            <tbody>
              @foreach($receipts as $receipt)
                <tr>
                  <td>{{ $receipt->user->name }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($receipt->created_at)->format('d/m/Y') }}</td>
                  <td class="text-right">${{ $receipt->monto }}</td>
                  <td>${{ $receipt->concepto }}</td>
                  <td class="text-right d-flex">
                    <input type="hidden" class="form-control" id="num_en_letras" name="num_en_letras">
                    @can('receipts.show')
                    <a href="{{ route('receipts.show',['id' => $receipt->id]) }}" title="Ver">
                      <div>
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">search</i>
                        @else
                          <i class="material-icons">search</i>
                        @endif
                      </div>
                    </a>&nbsp;
                    @endcan
                    @can('receipts.destroy')
                    <form id="formEliminar{{ $receipt->id }}" action="{{ route('receipts.destroy', ['receipt' => $receipt ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="borrarRegistro({{ $receipt->id }})">
                        @if(Auth::user()->darkMode)
                          <i class="material-icons" style="color:white">delete</i>
                        @else
                          <i class="material-icons">delete</i>
                        @endif
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
