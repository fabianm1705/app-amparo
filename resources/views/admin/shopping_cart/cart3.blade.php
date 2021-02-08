@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9 col-md-12 col-sm-12 mt-2">
        <div class="fresh-table full-color-orange d-flex shadow-sm">
          <h5 class="card-title text-white mt-3 mb-3 ml-3">Carrito de Compras</h5>
        </div>
        <div class="card mt-1">
          <div class="card-body table-responsive">
            <table class="table table-shopping">
              <thead>
                <tr>
                  <th class="text-center"></th>
                  <th>Producto</th>
                  <th class="text-right">P. Unit.</th>
                  <th class="text-center">Cant.</th>
                  <th class="text-left">Total</th>
                  <th>Quitar</th>
                </tr>
              </thead>
              <tbody>
                @foreach($shopping_cart->products as $product)
                  <tr id="{{ $product->id }}">
                    <td>
                      <div class="">
                        <img class="card-img-top" style="width:100px;" src="{{ asset('images/products/'.$product->image_url) }}" alt="{{ $product->modelo }}">
                      </div>
                    </td>
                    <td class="align-middle">
                      <a href="" style="text-decoration:none;color:black;">{{ $product->modelo }}</a>
                      <br />
                      <small>by {{ $product->empresa }}</small>
                    </td>
                    <td class="text-right align-middle">
                      <small>$</small>{{ round($product->costo * (1+($porccontado/100))/10, 0) * 10 }}
                    </td>
                    <td class="align-middle">
                      1
                    </td>
                    <td class="align-middle">
                      <small>$</small>{{ round($product->costo * (1+($porccontado/100))/10, 0) * 10 }}
                    </td>
                    <td class="td-actions align-middle">
                      <form action="{{ route('out_shopping_cart.destroy', ['id' => $product->id ]) }}" method="post" style="background-color: transparent;">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="3"></td>
                  <td class="td-total">
                    Total
                  </td>
                  <td colspan="1" class="td-price">
                    <total-value-only-component
                            :products="{{ $shopping_cart->products }}"
                            :porccredito="{{ $porccontado }}">
                    </total-value-only-component>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-9 mt-2">
        @if(Auth::user()->darkMode)
          <h5 class="text-white">Seleccione su forma de pago:</h5>
        @else
          <h5>Seleccione su forma de pago:</h5>
        @endif

        <div class="">
          <form action="{{ route('shopping_cart.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm mb-2">
              <div class="card-body">
                @foreach($payment_methods as $payment_method)
                      <div class="row justify-content-center">
                        <div class="col-2">
                          <div class="radio-inline">
                              <label>
                                  <input type="radio" key="{{ $payment_method->id }}" value="{{ $payment_method->id }}" {{ $payment_method->id==1 ? 'checked="checked"' : '' }} name="payment_method_id" />
                              </label>
                          </div>
                        </div>
                        <div class="col-10" id="monto">
                          @if($payment_method->cant_cuotas==1)
                            1 pago de ${{ round($productsCost / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                          @else
                            {{ $payment_method->cant_cuotas }} cuotas de ${{ round($productsCost / 10 * (1+($payment_method->percentage/100)) / $payment_method->cant_cuotas) * 10 }}
                          @endif
                        </div>
                      </div>
                @endforeach
              </div>
            </div>
            <center><div>
              <img class="w-75 mb-3" src="{{ asset('images/cuotascasa.webp') }}" alt="Cuotas de la Casa">
            </div></center>
            <div class="text-right">
              <button class="btn btn-success btn-block btn-lg" type="submit" name="button">Finalizar Compra</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
