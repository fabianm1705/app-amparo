<template>
    <tr :key="product.id">
      <td>
        <div class="">
          <img class="card-img-top" style="width:100px;" :src="'../images/products/'+product.image_url" :alt="product.modelo">
        </div>
      </td>
      <td class="align-middle">
        <a href="" style="text-decoration:none;color:black;">{{ product.modelo }}</a>
        <br />
        <small>by {{ product.empresa }}</small>
      </td>
      <td class="text-right align-middle">
        <small>$</small>{{ formatPrice(product.costo * (1+(porccredito/100))) }}
      </td>
      <td class="align-middle">
        1
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-secondary active">
            <input type="radio" name="options" id="option1" checked> -
          </label>
          <label class="btn btn-secondary">
            <input type="radio" name="options" id="option2"> +
          </label>
        </div>
      </td>
      <td class="align-middle">
        <small>$</small>{{ formatPrice(product.costo * (1+(porccredito/100))) }}
      </td>
      <td class="td-actions align-middle">
          <button @click="deleteOfCart(product.id)" class="btn btn-sm" onclick="return confirm('Quiere quitar el producto del carrito?')" title="Quitar producto">
            <i class="material-icons">close</i>
          </button>
      </td>
    </tr>
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
            },
            deleteOfCart(product_id){
              axios.post('/deleteOfCart/'+product_id)
                .then(()=>{
                  this.$emit("update", product_id);
                  this.$store.commit('decrement');
                })
            }
        }
    }
</script>
