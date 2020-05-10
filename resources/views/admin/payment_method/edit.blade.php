@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Método de Pago</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('payment_methods.update', ['payment_method' => $payment_method]) }}" method="post">
            @method('PUT')
            @csrf
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $payment_method->name }}">
                </div>
                <div class="row form-group">
                  <div class="col-lg-4">
                    <label for="cant_cuotas">Cant. Cuotas</label>
                    <input type="text" class="form-control" name="cant_cuotas" id="cant_cuotas" value="{{ $payment_method->cant_cuotas }}">
                  </div>
                  <div class="col-lg-4">
                    <label for="percentage">%</label>
                    <input type="text" class="form-control" name="percentage" id="percentage" value="{{ $payment_method->percentage }}">
                  </div>
                  <div class="col-lg-4">
                    <div class="form-check">
                      <input type="hidden" class="form-check-input" name="activo" value="0">
                      <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ $payment_method->activo ? 'checked="checked"' : '' }}>
                      <label class="form-check-label align-bottom" for="vigente">Activo</label>
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
