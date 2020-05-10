<template>
  <div class="d-flex">
    <button @click="addToCart"
          title="agregar al Carrito"
          class="btn btn-block btn-outline-dark"
          type="submit"
          name="button">
          <div class="d-flex justify-content-center">
            <i class="material-icons">add_shopping_cart</i>Agregar al Carrito de Compras
          </div>
    </button>
  </div>
</template>

<script>
    export default {
      props: { product:{ type: Object } },
      methods:{
        addToCart(){
          var product_id = this.product.id;
          axios.post('/in_shopping_cart/'+product_id)
            .then(()=>{
              this.$store.commit('increment');
            })
        }
      }
    }
</script>
