<template>
<section>
  <material-transition-group-component tag="div" class="row">
      <product-in-shopping-component
              v-for="(product,index) in products"
              :data-index="index"
              :key="product.id"
              :value="product.id"
              :porccuotas="porccuotas"
              :porccredito="porccredito"
              :product="product"
              class="col-md-3 col-sm-6 col-xs-6">
      </product-in-shopping-component>
  </material-transition-group-component>
</section>
</template>

<script>
    export default {
      props: {
        product:{ type: Object },
        porccuotas:{ type: Number },
        porccredito:{ type: Number },
        products:{ type: Array},
      }
    }
</script>
