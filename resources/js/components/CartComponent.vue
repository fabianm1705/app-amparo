<template>
  <div class="row justify-content-center">
    <div class="col-12 col-md-9">
      <div class="card shadow-sm">
        <div class="card-header bgOrange d-flex blanco">
          <h5 class="card-title text-white">Carrito de Compras</h5>
          <br/>
        </div>
        <div class="table-responsive">
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
              <product-in-cart-component
                  v-for="(product,index) in products"
                  @update="deleteOfCarrito"
                  :data-index="index"
                  :key="product.id"
                  :value="product.id"
                  :porccuotas="porccuotas"
                  :porccredito="porccredito"
                  :product="product"
                  class="col-md-4 col-sm-6 col-xs-6">
              </product-in-cart-component>
              <tr>
                <td colspan="3"></td>
                <td class="td-total">
                  Total
                </td>
                <td colspan="1" class="td-price">
                  ${{ formatPrice(total) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3">
      <h5>Seleccione su medio de pago:</h5>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="row align-items-center justify-content-center">
            <div class="col-3">
              <img class="w-100" src="/images/favicon.png" alt="">
            </div>
            <div class="col-9">
              <h6>6 cuotas de ${{ formatPrice(cuota) }}</h6>
            </div>
          </div>
          <div class="mt-2">
            <div class="text-right">
              <button class="btn btn-outline-success btn-block" type="submit" name="button">Finalizar Compra</button>
            </div>
          </div>
        </div>
      </div>

      <div class="card shadow-sm mt-2">
        <div class="card-body">
          <div><center>
            Crédito en 1 pago de ${{ formatPrice(total) }}<br>
          </center>
        </div><hr>
          <div class="justify-content-center">
            <center><img class="card-img-top w-100" src="/images/mercadopago.png" alt="Todos los medios de pago"></center>
          </div>
          <div class="mt-2">
              <div class="text-right">
                <button class="btn btn-outline-success btn-block" type="submit" name="button">Finalizar Compra</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      props: {
        porccuotas:{ type: Number },
        porccredito:{ type: Number },
        products:{ type: Array }
      },
      computed:{
        total: function(){
          let cents = this.products.reduce((acumulator,currentObj)=>{
            return acumulator + (currentObj.costo * (1+(this.porccredito/100)));
          },0);
          return `${cents}`;
        },
        cuota: function(){
          let cents = this.products.reduce((acumulator,currentObj)=>{
            return acumulator + (currentObj.costo * (1+(this.porccuotas/100)) / currentObj.cantidadCuotas);
          },0);
          return `${cents}`;
        }
      },
      methods:{
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        deleteOfCarrito(product_id){
          var i;
          for (i = 0; i < Object.keys(this.products).length; i++) {
            if(this.products[i].id==product_id){
              this.products.splice(i, 1);
              this.$forceUpdate();
            }
          };
        }
      }
    }
</script>
