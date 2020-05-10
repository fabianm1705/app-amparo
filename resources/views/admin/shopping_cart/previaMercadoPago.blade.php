@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <p>Has elegido abonar con otros medios de pago, presiona "Comprar" y serás redirigido al sitio de MercadoPago donde podrás confirmar el pago con cualquiera de los siguientes medios de pago:</p>
        <img class="card-img-top w-100" src="{{ asset('images/mp.jpg') }}" alt="Todos los medios de pago">
        <hr>
        <div>
          <form action="/procesar-pago" method="POST">
            <script
             src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
             data-preference-id="{{ $preference->id }}">
            </script>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
