<template>
  <div id="borrar" class="col-md-3 col-sm-6 col-xs-12 mt-1 mb-1">
    <a :href="'/admin/products/'+product.id" style="text-decoration:none;">
      <div class="card card-product card-plain shadow-sm">
        <div class="card-header-image">
          <img class="card-img-top" :src="'../images/products/'+product.image_url" :alt="product.modelo">
        </div>
        <div class="card-body text-center">
          <div class="card-description" style="height: 70px;overflow:auto;">
            {{ product.modelo }}<small> - {{ product.descripcion }}</small>
          </div>
        </div>
        <h4 class="card-title text-center">
          <small>{{ product.cantidadCuotas }} cuotas de $</small>{{ formatPrice(product.costo * (1+(porccuotas/100)) / product.cantidadCuotas) }}<br>
        </h4>
      </div>
    </a>
  </div>
</template>

<script>
    export default {
        props: {
            product:{ type: Object },
            porccuotas:{ type: Number },
            porccredito:{ type: Number }
        },
        methods:{
            formatPrice(value) {
                    let val = (value/10).toFixed(0).replace('.', ',')
                    val = val * 10
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>
