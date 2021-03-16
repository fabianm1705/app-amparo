@extends('layouts.app')

@section('content')
<div class="container"><center>
  <div class="block-heading fresh-table full-color-orange d-flex shadow-sm col-lg-6 col-md-10 col-sm-12 mt-2">
    <h5 class="card-title text-white mt-3 mb-3 ml-3">Formas de Pago</h5>
  </div></center>
  <div class="row mt-3">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-secondary">
          <div class="card-body text-white">
      @else
        <div class="card shadow-sm">
          <div class="card-body">
      @endif
          <header class="justify-content-center">
            <h4>Bancaria o domicilio</h4>
          </header><hr>
          <div class="mt-2">
            Vía CBU, <b>Débito Automático</b> con un 15% de descuento por 6 meses.
          </div>
          <div class="mt-3">
            <b>Transferencia Bancaria</b>. CBU Cta Bco Bica: 4260003300100023798015
          </div>
          <div class="mt-3">
            Cobrador a domicilio o en oficina.
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-secondary">
          <div class="card-body text-white">
      @else
        <div class="card shadow-sm">
          <div class="card-body">
      @endif
          <header>
            <center>
              <img src="{{ asset('images/pagos-electronicos.png') }}" height="77" alt="Rapipago PagoFácil">
            </center>
          </header>
          <div class="mt-4">
            <center><h4>59990 12623</h4></center>
          </div>
          <div class="mt-4 mb-2">
            Cuenta de Mercado Pago de Amparo, indicarle este código al cajero y el monto.
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-secondary">
          <div class="card-body text-white">
      @else
        <div class="card shadow-sm">
          <div class="card-body">
      @endif
          <header>
            <center>
              <img src="{{ asset('images/mp4.png') }}" height="45" alt="Mercado Pago">
            </center>
          </header>
          <div class="mt-2">
            Las suscripciones te permiten abonar la cuota social de forma recurrente, con tarjeta de crédito y débito. Es necesario tener una cuenta activa de Mercado Pago.
          </div>
          <div class="mt-2">
            <center>
              <a mp-mode="dftl" href="http://mpago.la/1iga2JA" name="MP-payButton" class='btn btn-success m-1 text-light btn-lg btn-block'>Suscribirme</a>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="alert alert-success col-12">
    <div class="d-flex">
      <div class="alert-icon">
          <i class="material-icons">check</i>
      </div>
      En breve incorporaremos la posibilidad de abonar vía tarjeta de crédito o débito desde esta misma sección.
      <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="material-icons">clear</i></span>
      </button>
    </div>
  </div>

</div>
@endsection
