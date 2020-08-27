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
                    <img src="{{ asset('images/products/'.$product->image_url) }}" alt="{{ $product->modelo }}">
                    <div class="card-body text-center textoDescripcion" style="height: 120px;overflow:auto;">
                      {{ $product->modelo }}<small> - {{ $product->descripcion }}</small>
                    </div>
                    <h4 class="card-title text-center mt-1">
                      <small>{{ $product->cantidadCuotas }} cuotas de $</small>{{ $product->precio($product->costo,$porccuotas,$product->cantidadCuotas) }}<br>
                    </h4>
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
