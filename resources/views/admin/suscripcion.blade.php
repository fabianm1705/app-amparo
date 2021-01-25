@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="mt-2 col-md-12 col-lg-6">
      <center>
        <img src="{{ asset('images/mercadopago.webp') }}" class="d-block" width="250" alt="Medios de pago"><br>
      </center>
      @if(Auth::user()->darkMode)
        <div class="card text-center text-white shadow-sm bg-secondary">
      @else
        <div class="card text-center shadow-sm">
      @endif
      <div class="card-body">
        Las suscripciones de Mercado Pago te permiten abonar la cuota social de forma recurrente, con tarjeta de crédito y débito.
        <br>Es necesario tener una cuenta activa de Mercado Pago.
        <br>
        Por dudas consultanos, whatsapp: 155-508247<br>
        <br>
        <center>
          <a mp-mode="dftl" href="http://mpago.la/1iga2JA" name="MP-payButton" class='btn btn-success m-1 text-light btn-lg'>Suscribirme</a>
        </center>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script type="text/javascript">
      (function() {
          function $MPC_load() {
              window.$MPC_loaded !== true && (function() {
                  var s = document.createElement("script");
                  s.type = "text/javascript";
                  s.async = true;
                  s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                  var x = document.getElementsByTagName('script')[0];
                  x.parentNode.insertBefore(s, x);
                  window.$MPC_loaded = true;
              })();
          }
          window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
      })();
  </script>
@endsection
