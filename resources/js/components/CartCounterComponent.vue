<template>
  <div id="carrito" class="d-flex">
    <div style="vertical-align: top">Carrito</div>
    <i class="material-icons" id="iconCarrito">shopping_cart</i>{{ productsCount }}
  </div>
</template>

<script>
    export default {
      props: ['count'],
      created(){
        this.$store.commit('set',this.count);
      },
      computed:{
        productsCount(){
          return this.$store.state.productsCount;
        }
      }
    }
</script>
