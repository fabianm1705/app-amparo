<template>
  <div class="">
    <button @click="addToCart"
          class="btn btn-success btn-block"
          type="submit"
          name="button">
          <div class="d-flex justify-content-center">
            <i class="material-icons">shopping_cart</i>Comprar
          </div>
    </button>
  </div>
</template>

<script>
    export default {
      props: {
          product:{ type: Object }
      },
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
