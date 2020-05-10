@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Ver Categoría</h4>
        </header>
        <div class="card-body">
          <div class="row justify-content-server">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $category->nombre }}">
              </div>
              <div class="col-lg-6">
                <div class="form-check">
                  <input type="hidden" class="form-check-input" name="activa" value="0">
                  <input type="checkbox" class="form-check-input" id="activa" name="activa" value="1" {{ $category->activa ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="activa">Activa</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
