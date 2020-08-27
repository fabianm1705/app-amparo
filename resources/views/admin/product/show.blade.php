@extends('layouts.appClean')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-12 col-lg-9">
      <div class="card shadow-sm"><br>
        <div class="card-body">
          <div class="row">
            <div class="col-md-7 col-sm-12">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('images/products/'.$product->image_url) }}" class="d-block w-100" alt="{{ $product->modelo }}">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('images/products/'.$product->image_url2) }}" class="d-block w-100" alt="{{ $product->modelo }}">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('images/products/'.$product->image_url3) }}" class="d-block w-100" alt="{{ $product->modelo }}">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Siguiente</span>
                </a>
              </div>
            </div>
            <div class="col-md-5 col-sm-12">
              <header>
                <h4>{{ $product->modelo }}<small> - by {{ $product->empresa }}</small></h4>
              </header>
              <div class="row justify-content-server">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="descripcion">{{ $product->descripcion }}</label>
                  </div>
                  @foreach($payment_methods as $payment_method)
                    <center><div class="card shadow-sm mb-3 w-75">
                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10" id="monto">
                            @if($payment_method->cant_cuotas==1)
                              1 pago de ${{ round($product->costo / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                            @else
                              {{ $payment_method->cant_cuotas }} cuotas de ${{ round($product->costo / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                            @endif
                          </div>
                        </div>
                        <div>
                          <img class="w-100" src="{{ asset('images/'.$payment_method->image_url) }}" alt="{{ $payment_method->name }}">
                        </div>
                      </div>
                    </div></center>
                  @endforeach
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <add-to-cart-component :product="{{$product}}">
                      </add-to-cart-component>
                    </div>
                    <div class="col-md-12 mb-1">
                      <form action="{{ route('shopping_cart.cart') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <button class="btn btn-outline-dark btn-block" type="submit" name="button">
                          <div class="d-flex justify-content-center">
                            <i class="material-icons">shopping_cart</i>Ir al Carrito de Compras
                          </div>
                        </button>
                      </form>
                    </div>
                    <div class="col-md-12 mb-1">
                      <form action="{{ route('products.shopping') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <button class="btn btn-outline-dark btn-block" type="submit" name="button">
                          <div class="d-flex justify-content-center">
                            Seguir comprando
                          </div>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="">
            @if($product->longDescription)
              <textarea class="form-control mt-2 mb-2" id="longDescription" name="longDescription" rows="8">{{ $product->longDescription }}</textarea>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
