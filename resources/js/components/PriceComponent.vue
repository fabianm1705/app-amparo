<template>
  <h6 v-if="cantcuotas==1">1 pago de ${{ formatPrice(cuota) }}</h6>
  <h6 v-else>{{ cantcuotas }} cuotas de ${{ formatPrice(cuota) }}</h6>
</template>

<script>
    export default {
      props: {
        productscost:{ type: Number },
        percentage:{ type: Number },
        cantcuotas:{ type: Number }
      },
      computed:{
        cuota: function(){
          return this.productscost*(1+(this.percentage/100))/this.cantcuotas
        }
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
