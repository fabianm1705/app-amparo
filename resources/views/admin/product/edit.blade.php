@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Producto</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('products.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12 col-md-6 col-lg-2">
                <div class="form-group">
                  <label for="content">Categoría</label>
                  <select class="custom-select" name="category_id" id="category_id">
                    @foreach($categories as $category)
                      @if($product->category_id == $category->id)
                        <option selected value="{{ $category->id }}">{{ $category->nombre }}</option>
                      @else
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="form-group">
                  <label for="modelo">Modelo</label>
                  <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $product->modelo }}">
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
                <div class="form-group">
                  <label for="empresa">Empresa</label>
                  <input type="text" class="form-control" name="empresa" id="empresa" value="{{ $product->empresa }}">
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
                <div class="form-group">
                  <label for="costo">Costo</label>
                  <input type="text" class="form-control" name="costo" id="costo" value="{{ $product->costo }}">
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="form-group">
                  <label for="content">Lista de Precios</label>
                  <select class="custom-select" name="payment_method_id" id="payment_method_id">
                    @foreach($payment_methods as $payment_method)
                      @if($payment_method->id==$product->payment_method_id)
                        <option value="{{ $payment_method->id }}" selected>{{ $payment_method->name }}</option>
                      @else
                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $product->descripcion }}">
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="form-check">
                  <input type="hidden" class="form-check-input" name="vigente" value="0">
                  <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ $product->vigente ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="vigente">Activo</label>
                </div>
                <div class="form-check">
                  <input type="hidden" class="form-check-input" name="stock" value="0">
                  <input type="checkbox" class="form-check-input" id="stock" name="stock" value="1" {{ $product->stock ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="stock">Stock</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="longDescription">Descripción larga</label>
                  <textarea class="form-control mt-2 mb-2" id="longDescription" name="longDescription" rows="6" placeholder="Descripción larga">{{ $product->longDescription }}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <label for="image_url">Seleccione una imagen</label>
                <input type="file" class="form-control" id="image_url" name="image_url">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <label for="image_url2">Seleccione una imagen</label>
                <input type="file" class="form-control" id="image_url2" name="image_url2">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <label for="image_url2">Seleccione una imagen</label>
                <input type="file" class="form-control" id="image_url3" name="image_url3">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <img src="{{ asset('images/products/'.$product->image_url) }}" alt="{{ $product->modelo }}">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <img src="{{ asset('images/products/'.$product->image_url2) }}" alt="{{ $product->modelo }}">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-4">
                <img src="{{ asset('images/products/'.$product->image_url3) }}" alt="{{ $product->modelo }}">
              </div>
            </div>
            <div class="col-sm-12 text-right">
              <button class="btn btn-dark text-light" type="submit" name="button">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
