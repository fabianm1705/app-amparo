@extends('layouts.app')

@section('myLinks')
  <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
  <script src="{{ asset('js/mp2.js') }}" defer></script>
  <link href="{{ asset('css/mp.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" crossorigin="anonymous"></script>
@endsection

@section('content')
  <!-- Shopping Cart -->
  <section class="shopping-cart dark">
    <div class="container" id="container">
      <x-cabecera-naranja message="Pagar Cuota Social con Tarjeta"></x-cabecera-naranja>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="items">
                <div class="product">
                <div class="info">
                  <div class="product-details">
                    <div class="row justify-content-md-center">
                      <div class="col-md-3 col-sm-12">
                      </div>
                      <div class="col-md-5 col-sm-12 product-detail">
                        <h5>Detalle</h5>
                        <div class="product-info">
                          <p><b><span id="product-description">Cuota Social Amparo</span></b><br>
                          <b>Monto:</b> $ <span id="unit-price">{{ $total }}</span></p>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-4 product-detail">
                        <label for="quantity"><h5>Cant</h5></label>
                        <input type="number" id="quantity" value="1" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <div class="summary">
              <h3>Cuota Social Amparo</h3>
              <div class="summary-item"><span class="text">Subtotal</span><span class="price" id="cart-total"><b>{{ $total }}</b></span></div>
              <button class="btn btn-primary btn-lg btn-block d-flex justify-content-center" id="checkout-btn">
                <i class="material-icons">credit_card</i>&nbsp;Comenzar Pago
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Payment -->
  <section class="payment-form dark">
    <div class="container_payment container col-md-6">
      <div class="block-heading fresh-table full-color-orange d-flex shadow-sm">
        <h5 class="card-title text-white mb-3 ml-3">Pago Cuota Social con Tarjeta</h5>
      </div>
      <div class="form-payment">
        <div class="products">
          <h2 class="title">Sumario</h2>
            <div class="item">
              <span class="price" id="unit-price">{{ $total }}</span>
              <p class="item-name">Cuota Social Amparo</p>
            </div>
          <div class="total">Total<span class="price" id="summary-total"><b>{{ $total }}</b></span></div>
        </div>
        <div class="payment-details">
          <form action="/process_payment" method="post" id="paymentForm">
              @csrf
              <h3 class="title">Detalles del Socio</h3>
              <div class="row">
                <div class="form-group col">
                  <label for="email">E-Mail</label>
                  <input id="email" value="{{ Auth::user()->email }}" name="email" type="text" class="form-control"></select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-5">
                  <label for="docType">Tipo de Documento</label>
                  <select id="docType" name="docType" data-checkout="docType" type="text" class="form-control"></select>
                </div>
                <div class="form-group col-sm-7">
                  <label for="docNumber">Número de Documento</label>
                  <input id="docNumber" value="{{ Auth::user()->nroDoc }}" name="docNumber" data-checkout="docNumber" type="text" class="form-control"/>
                </div>
              </div>
              <br>
              <h3 class="title">Detalles de la Tarjeta</h3>
              <div class="row">
                <div class="form-group col-sm-8">
                  <label for="cardholderName">Titular de la Tarjeta</label>
                  <input id="cardholderName" data-checkout="cardholderName" type="text" class="form-control">
                </div>
                <div class="form-group col-sm-4">
                  <label for="">Fecha de Vencimiento</label>
                  <div class="input-group expiration-date">
                    <input type="text" class="form-control" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                      onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                    <span class="date-separator">/</span>
                    <input type="text" class="form-control" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                      onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                  </div>
                </div>
                <div class="form-group col-sm-8">
                  <label for="cardNumber">Número de Tarjeta</label>
                  <input type="text" class="form-control input-background" id="cardNumber" data-checkout="cardNumber"
                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                </div>
                <div class="form-group col-sm-4">
                  <label for="securityCode">Código de Seguridad</label>
                  <input id="securityCode" data-checkout="securityCode" type="text" class="form-control"
                    onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                </div>
                <div id="issuerInput" class="form-group col-sm-12 hidden">
                  <label for="issuer">Banco emisor</label>
                  <select id="issuer" name="issuer" data-checkout="issuer" class="form-control"></select>
                </div>
                <div class="form-group col-sm-12">
                  <label for="installments">Cuotas</label>
                  <select type="text" id="installments" name="installments" class="form-control"></select>
                </div>
                <div class="form-group col-sm-12">
                  <input type="hidden" name="transactionAmount" id="amount" value="10" />
                  <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                  <input type="hidden" name="description" id="description" />
                  <br>
                  <button type="submit" class="btn btn-primary btn-block btn-lg d-flex justify-content-center">
                    <i class="material-icons">credit_card</i>&nbsp;Pagar
                  </button>
                  <br>
                  <a id="go-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 10 10" class="chevron-left">
                      <path fill="#009EE3" fill-rule="nonzero"id="chevron_left" d="M7.05 1.4L6.2.552 1.756 4.997l4.449 4.448.849-.848-3.6-3.6z"></path>
                    </svg>
                    Volver
                  </a>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </section>
@endsection
