<template>
  <section>
    <h4 class="title text-center">
        Órdenes Anteriores
    </h4>
    <table class="table table-sm">
      <thead>
        <tr>
          <th class="text-center">Fecha</th>
          <th>Profesional</th>
          <th>Obs.</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td>{{ order.fecha }}</td>
          <td>{{ order.doctor.apeynom }}</td>
          <td>{{ order.obs }}</td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
    export default {
      props: {
        id:{
          type: Number
        }
      },
      mounted() {
        axios.post('/getOnlyOrders/'+id)
        .then((resp)=>{
          this.orders=resp.data;
          console.log(this.orders);
        })
        .catch(function (error) {
          console.log(error);
        })
      },
      data: function(){
        return{
          orders: [],
        }
      }
    }
</script>
