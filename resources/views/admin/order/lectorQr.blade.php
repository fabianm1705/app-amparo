@extends('layouts.app')

@section('myLinks')
  <script type="text/javascript" src="{{ asset('js/lector-qr/jsqrscanner.nocache.js') }}"></script>
  <link type="text/css" rel="stylesheet" href="{{ asset('css/JsQRScanner.css') }}">
@endsection

@section('content')
  <div class="container">
    <div class="row-element-set row-element-set-QRScanner">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <x-cabecera-naranja message="Acerque el QR a la cámara"></x-cabecera-naranja>
        </div>
      </div>
      <center><div class="row-element mt-1">
        <div class="qrscanner" id="scanner">
        </div>
      </div></center>
      <form id="formOk" action="{{ route('home') }}" method="get" enctype="multipart/form-data" style="background-color: transparent;">
      </form>
    </div>
  </div>
@endsection

@section('myScripts')
  <script type="text/javascript" src="{{ asset('js/lector-qr/funciones.js') }}"></script>
@endsection
