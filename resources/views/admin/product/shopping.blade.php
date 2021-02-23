@extends('layouts.appClean')

@section('myLinks')
  <link href="{{ asset('css/products.shopping.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="justify-content-center">
      @foreach($categories as $category)
        @if(Auth::user()->darkMode)
          <h3 class="text-white">{{ $category->nombre }}</h3>
        @else
          <h3>{{ $category->nombre }}</h3>
        @endif
        <div class="swiper-container">
          <div class="swiper-wrapper">
            @foreach ($category->products->where('vigente', 1) as $product)
              <div class="swiper-slide">
                <a href="/admin/products/{{ $product->id }}" style="text-decoration:none;">
                  <div class="card shadow-sm">
                    <div class="">
                      @if($product->stock)
                        <img src="{{ asset('images/entregainmediata.png') }}" alt="Entrega Inmediata!">
                      @else
                        <img src="{{ asset('images/entregainmediatablanco.png') }}" alt="Entrega Inmediata!">
                      @endif
                    </div>
                    <img src="{{ asset('images/products/'.$product->image_url) }}" alt="{{ $product->modelo }}">
                    <div class="card-body text-center textoDescripcion" style="height: 120px;overflow:auto;">
                      {{ $product->modelo }}<small> - {{ $product->descripcion }}</small>
                    </div>
                    <h5 class="">
                      <div class="mt-1">
                        @foreach ($product->payment_method->payment_method_items->where('activo', 1) as $payment_method_item)
                          <div class="col-10" id="monto">
                              <small>$</small>{{ round($product->costo / 10 * (1+($payment_method_item->percentage/100)) / $payment_method_item->cuotas) * 10 }}<small> x {{ $payment_method_item->cuotas }}</small>
                          </div>
                        @endforeach
                      </div>
                    </h5>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
          <!-- Add Arrows -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      @endforeach
    </div>
  </div>
@endsection

@section('myScripts')
  <script src="{{ asset('swiper/js/swiper.min.js') }}"></script>
  <script src="{{ asset('js/products.shopping.js') }}"></script>
@endsection
