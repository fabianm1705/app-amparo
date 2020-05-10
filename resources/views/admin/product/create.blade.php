@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm"><br>
          <header class="centrado">
            <h4>Cargar Nuevo Producto</h4>
          </header>
          <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="content">Categoría</label>
                <select class="custom-select" name="category_id" id="category_id">
                  <option selected>Seleccione Categoría</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" name="modelo" id="modelo" value="{{ old('modelo') }}">
                  </div>
                </div>
                <div class="col-sm-4 align-self-center">
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="vigente" value="0">
                    <input type="checkbox" class="form-check-input" id="vigente" name="vigente" value="1" {{ old('vigente') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="vigente">Activo</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="empresa">Empresa</label>
                <input type="text" class="form-control" name="empresa" id="empresa" value="{{ old('empresa') }}">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="costo">Costo</label>
                    <input type="text" class="form-control" name="costo" id="costo" value="{{ old('costo') }}">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="image_url">Seleccione una imagen</label>
                <input type="file" class="form-control" name="image_url">
              </div>
              <div class="form-group">
                <label for="image_url2">Seleccione una imagen</label>
                <input type="file" class="form-control" name="image_url2">
              </div>
              <div class="form-group">
                <label for="image_url2">Seleccione una imagen</label>
                <input type="file" class="form-control" name="image_url3">
              </div>
              <div class="text-right">
                <button class="btn btn-dark text-light" type="submit" name="button">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
