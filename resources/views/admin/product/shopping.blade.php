@extends('layouts.app')

@section('myLinks')
  <script>
      function cargarProductos(porc_cuotas){
        var id = document.getElementById('category').value;
        axios.post('/getProductsXCategory/'+id)
          .then((resp)=>{
            while (document.getElementById( "borrar" )) {
              document.getElementById("borrar").remove();
            }
            for (i = 0; i < Object.keys(resp.data).length; i++) {
              var valor = Math.round(resp.data[i].costo / 10 * (1+(porc_cuotas/100)) / resp.data[i].cantidadCuotas) * 10;
              var productos = document.getElementById("productos");
              productos.insertAdjacentHTML("beforeend","<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6 mt-1 mb-1' id='borrar'><a href='/admin/products/"+resp.data[i].id+"' style='text-decoration:none;'><div class='card card-product card-plain shadow-sm'><div class='card-header-image'><img class='card-img-top' src='/images/products/"+resp.data[i].image_url+"'></div><div class='card-body text-center'><div class='card-description' style='height: 70px;overflow:auto;'>"+resp.data[i].modelo+" <small> - "+resp.data[i].descripcion+"</small></div></div><h4 class='card-title text-center'><small>"+resp.data[i].cantidadCuotas+" cuotas de $</small>"+valor+"<br></h4></div></a></div>");
            }
          })
          .catch(function (error) {console.log(error);})
      }
  </script>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="fresh-table full-color-orange shadow-sm">
          <!--
            Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
          -->
          <div class="row">
            <div class="col-md-5 vertical-align-bottom">
              <h5 class="text-white text-center mt-3 mb-2">
                Seleccione categoría
              </h5>
            </div>
            <div class="col-md-7">
              <div class="m-2">
                <select class="custom-select"
                        name="category"
                        id="category"
                        onchange="cargarProductos({{ $porccuotas }})">
                  <option selected>Seleccione categoría</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->nombre }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-2">
        <div class="row" id="productos">
          @foreach($products as $product)
            <product-in-shopping-component
                    :product="{{ json_encode($product) }}"
                    :key="{{ $product->id }}"
                    :value="{{ $product->id }}"
                    :porccuotas="{{ $porccuotas }}"
                    :porccredito="{{ $porccredito }}">
            </product-in-shopping-component>
          @endforeach
        </div>
    </div>
  </div>
@endsection
