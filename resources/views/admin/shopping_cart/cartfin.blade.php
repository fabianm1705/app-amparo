@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-7 col-sm-11 alert alert-success">
          Gracias por tu compra! En breve nos pondremos en contacto para coordinar envío...
      </div>
    </div>
    <div class="row justify-content-center">
      @foreach($shopping_cart->products as $product)
        <div class="card card-product card-plain mr-2 mb-2 shadow-sm col-lg-6 col-md-7 col-sm-11">
          <div class="card-header-image">
            <img class="card-img-top w-100" src="{{ asset('images/products/'.$product->image_url) }}" alt="{{ $product->modelo }}">
          </div>
          <div class="card-body text-center">
            <div class="card-description" style="height: 70px;overflow:auto;">
              {{ $product->modelo }}<small> - {{ $product->descripcion }}</small>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row justify-content-center">
      @foreach($payment_methods as $payment_method)
        <div class="card shadow-sm mr-2 mb-2 col-lg-4 col-md-7 col-sm-9">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-12 text-center" id="monto">
                @if($payment_method->cant_cuotas==1)
                  1 pago de ${{ round($productsCost / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                @else
                  {{ $payment_method->cant_cuotas }} cuotas de ${{ round($productsCost / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
