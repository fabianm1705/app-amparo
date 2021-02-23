@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm"><br>
          <header class="centrado">
            <h4>Cargar Nueva Lista de Precios</h4>
          </header>
          <div class="card-body">
            <form action="{{ route('payment_methods.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                  <label for="cant_cuotas">CuotasOld</label>
                  <input type="text" class="form-control" name="cant_cuotas" id="cant_cuotas" value="{{ old('cant_cuotas') }}">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                  <label for="percentage">%Old</label>
                  <input type="text" class="form-control" name="percentage" id="percentage" value="{{ old('percentage') }}">
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                  <div class="form-check">
                    <input type="hidden" class="form-check-input" name="activo" value="0">
                    <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ old('activo') ? 'checked="checked"' : '' }}>
                    <label class="form-check-label align-bottom" for="vigente">Activo</label>
                  </div>
                </div>
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
