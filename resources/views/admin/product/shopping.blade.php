@extends('layouts.appClean')

@section('myLinks')
  <!-- Demo styles -->
  <style>
    /* html, body {
      position: relative;
      height: 100%;
    } */
    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color:#000;
      margin: 0;
      padding: 0;
    }
    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }

    :root {
      --swiper-theme-color: orange;
    }

    img {
      max-width: 100%;
      height: auto;
    }

    .swiper-slide:hover {
      transition: 250ms all;
      transform: scale(1.04);
      z-index: 1;
    }

    .swiper-wrapper {
      padding: 20px 0;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="justify-content-center">
      @foreach($categories as $category)
        <h3>{{ $category->nombre }}</h3>
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
  <!-- Swiper JS -->
  <script src="{{ asset('swiper/js/swiper.min.js') }}"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 5,
      spaceBetween: 10,
      slidesPerGroup: 2,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        100: {
          slidesPerView: 1,
          spaceBetween: 10,
          slidesPerGroup: 1,
        },
        400: {
          slidesPerView: 2,
          spaceBetween: 10,
          slidesPerGroup: 1,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 10,
          slidesPerGroup: 1,
        },
        815: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 10,
        },
      }
    });
  </script>
@endsection
