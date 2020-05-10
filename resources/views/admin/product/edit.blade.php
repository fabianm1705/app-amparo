@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Producto</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('products.update', ['product' => $product]) }}" method="post">
            @method('PUT')
            @csrf
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
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="modelo">Modelo</label>
                  <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $product->modelo }}">
                </div>
                <div class="form-group">
                  <label for="empresa">Empresa</label>
                  <input type="text" class="form-control" name="empresa" id="empresa" value="{{ $product->empresa }}">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $product->descripcion }}">
                </div>
                <div class="row d-flex">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="costo">Costo</label>
                      <input type="text" class="form-control" name="costo" id="costo" value="{{ $product->costo }}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-check">
                      <input type="hidden" class="form-check-input" name="vigente" value="0">
                      <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ $product->vigente ? 'checked="checked"' : '' }}>
                      <label class="form-check-label" for="vigente">Activo</label>
                    </div>
                  </div>
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
</div>
@endsection
