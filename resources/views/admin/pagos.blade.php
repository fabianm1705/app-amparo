@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <x-cabecera-naranja message="Formas de pago de la Cuota Social"></x-cabecera-naranja>
    </div>
  </div>
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

  <div class="row">
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Estado de Cuenta</h5>
        </div>
        @if(Auth::user()->darkMode)
          <div class="card shadow-sm mt-1 bg-dark">
        @else
          <div class="card shadow-sm mt-1">
        @endif
            <div class="card-body">
              @if(Auth::user()->darkMode)
                <table class="table table-hover table-sm table-responsive table-dark">
              @else
                <table class="table table-hover table-sm table-responsive">
              @endif
                  <thead>
                    <tr>
                      <th>Mes</th>
                      <th>Monto</th>
                      <th>F. Pago</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sales as $sale)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($sale->fechaEmision)->formatLocalized('%B') }}</td>
                        <td class="text-right">${{ $sale->total }}</td>
                        @if($sale->fechaPago)
                          <td>{{ \Carbon\Carbon::parse($sale->fechaPago)->format('d/m/y') }}</td>
                        @else
                          <td></td>
                        @endif
                        <td>
                          <div class="row justify-content-center d-flex">
                            <a href="{{ route('factura', ['id' => $sale->id ]) }}" title="Descargar">
                              <div class="">
                                @if(Auth::user()->darkMode)
                                  <i class="material-icons" style="color:white">get_app</i>
                                @else
                                  <i class="material-icons">get_app</i>
                                @endif
                              </div>
                            </a>
                            <a href="{{ route('factura', ['id' => $sale->id ]) }}" title="Imprimir">
                              <div class="">
                                @if(Auth::user()->darkMode)
                                  <i class="material-icons" style="color:white">print</i>
                                @else
                                  <i class="material-icons">print</i>
                                @endif
                              </div>
                            </a>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-10 col-sm-12 mt-2">
      @if(Auth::user()->darkMode)
        <div class="card shadow-sm bg-secondary">
          <div class="card-body text-white">
      @else
        <div class="card shadow-sm">
          <div class="card-body">
      @endif
          <header class="justify-content-center">
            <h4>Pagar Cuota Social con Tarjeta</h4>
          </header><hr>
          <div class="mt-2">
            <form action="{{ route('users.pagoConTarjeta') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="total">Monto a abonar</label>
                <input type="text" class="form-control" name="total" id="total" value="{{ Auth::user()->group->total }}">
                <small id="totalHelp" class="form-text text-muted">Puede modificar este importe si el saldo es diferente.</small>
              </div>
              <button class="btn btn-success btn-block btn-lg form-control" type="submit" name="button">
                <div class="d-flex justify-content-center">
                  <i class="material-icons">credit_card</i>&nbsp;Iniciar Pago
                </div>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
