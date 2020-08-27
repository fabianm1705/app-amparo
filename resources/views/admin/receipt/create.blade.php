@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="fresh-table full-color-orange d-flex shadow-sm">
              <h5 class="card-title text-white mt-4 ml-4 mb-4">Recibo</h5>
          </div>
          <div class="card mt-1">
            <div class="card-body">
              <form action="{{ route('receipts.store', ['user' => $user]) }}" method="post">
                @csrf
                <div class="row justify-content-server">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="nroSocio">Nro. Socio</label>
                          <input type="text" class="form-control text-center" name="nroSocio" id="nroSocio" value="{{ $user->group->nroSocio }}/{{ $user->nroAdh }}" readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="name">Nombre</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="nroDoc">Documento</label>
                          <input type="text" class="form-control text-center" name="nroDoc" id="nroDoc" value="{{ $user->nroDoc }}" readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="direccion">Domicilio</label>
                          <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->group->direccion }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="monto">Monto</label>
                          <input type="text" class="form-control" name="monto" id="monto" onfocusout="cargarLetras(this.value)">
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="num_en_letras">En Letras</label>
                          <input class="form-control" id="num_en_letras" name="num_en_letras" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <textarea class="form-control" id="concepto" name="concepto" rows="1" placeholder="Concepto" autocomplete="off"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-dark text-light" type="submit" name="button">Generar Recibo</button>
                  </div>
                </div>
              </form>
            </div>
          </div> <!-- fin del componente card -->
      </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script src="{{ asset('js/numALet.js') }}" defer></script>
@endsection
