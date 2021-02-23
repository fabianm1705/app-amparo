@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Modificar Item Lista de Precios</h4>
        </header>
        <div class="card-body">
          <form action="{{ route('payment_method_items.update', ['payment_method_item' => $payment_method_item]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="row justify-content-server">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $payment_method_item->name }}">
                  <label for="cuotas">Cuotas</label>
                  <input type="text" class="form-control" name="cuotas" id="cuotas" value="{{ $payment_method_item->cuotas }}">
                  <label for="percentage">%</label>
                  <input type="text" class="form-control" name="percentage" id="percentage" value="{{ $payment_method_item->percentage }}">
                  <label for="content">Especialidad</label>
                  <select class="custom-select" name="payment_method_id" id="payment_method_id">
                    <option selected>Seleccione Método de Pago</option>
                    @foreach($payment_methods as $payment_method)
                      @if($payment_method_item->payment_method_id == $payment_method->id)
                        <option selected value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                      @else
                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-check">
                  <input type="hidden" class="form-check-input" name="activo" value="0">
                  <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" {{ $payment_method_item->activo ? 'checked="checked"' : '' }}>
                  <label class="form-check-label" for="activo">Activo</label>
                </div>
              </div>
              <div class="col-sm-12 text-right"><br>
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
