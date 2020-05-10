@extends('layouts.app')

@section('myLinks')
  <script>
    function cargarCarrito(id){
      const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0
          })
      axios.post('/getProducts/'+id)
        .then((resp)=>{
            var cont = document.getElementById("tablaproductos").rows.length;
            for (i = 0; i < (cont); i++) {
                document.getElementById("borrar").remove();
            }
            var monto = 0;
            var total = 0;
            var cuotas = 1;
            for (i = 0; i < Object.keys(resp.data).length; i++) {
                monto = Math.round(resp.data[i].costo/resp.data[i].cantidadCuotas*(1+({{ $porccuotas/100 }}))/10)*10;
                total = total + monto;
                cuotas = resp.data[i].cantidadCuotas;
                $('<tr id="borrar"><td>' + resp.data[i].modelo + '</td><td class="text-center">1</td><td class="text-right">' + formatter.format(monto) + '</td></tr>').appendTo('#tablaproductos');
            }
            $('<tr id="borrar"><td></td><td class="text-center"></td><td>' + cuotas + ' cuotas de ' + formatter.format(total) + '</td></tr>').appendTo('#tablaproductos');
        })
        .catch(function (error) {console.log(error);})
    }
  </script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Nro. Socio</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th class="text-center">Mostrar</th>
            </thead>
            <tbody>
              @foreach($shopping_carts as $shopping_cart)
                <tr>
                  <td class="align-middle">{{ $shopping_cart->user->group->nroSocio }}</td>
                  <td class="align-middle">{{ $shopping_cart->user->name }}</td>
                  <td class="align-middle">{{ $shopping_cart->fecha }}</td>
                  <td class="d-flex">
                    <button class="btn btn-sm" onclick="cargarCarrito({{ $shopping_cart->id }})" style="background-color: transparent;">
                      <div class="">
                        <i class="material-icons">double_arrow</i>
                      </div>
                    </button>
                    <form action="{{ route('shopping_cart.destroy', ['id' => $shopping_cart->id ]) }}" method="post" style="background-color: transparent;">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-sm" onclick="return confirm('Está seguro de eliminar el registro?')">
                        Borrar
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body centrado">
          <table class="table table-hover table-sm table-responsive">
            <thead>
              <th>Producto</th>
              <th>Cantidad</th>
              <th class="text-center">Costo</th>
            </thead>
            <tbody id="tablaproductos">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
