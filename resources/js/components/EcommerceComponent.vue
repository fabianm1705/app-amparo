<template>
<section>
<div class="row">
  <div class="col-md-3">

    <ul class="list-group shadow-sm">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="radio-inline">
            <label>
                <input type="radio" checked="checked" name="categorias" value="0" />
                <span>Todos</span>
            </label>
        </div>
        <span class="badge badge-warning badge-pill"></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center"
          v-for="category in categoriesConTotal">
        <div class="radio-inline">
            <label>
                <input type="radio" :key="category.id" :value="category.id" name="categorias" />
                <span>{{ category.nombre }}</span>
            </label>
        </div>
        <span class="badge badge-success badge-pill">{{ category.total }}</span>
      </li>
    </ul>
    <br>
    <div class="text-right">
      <button @click="getProductsXCategory" class="btn btn-success" type="submit" name="button">Actualizar Filtro</button>
    </div>
    <br>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-6" v-for="product in products" :key="product.id" :value="product.id">
        <img class="card-img-top" :src="'../images/'+product.image_url" :alt="product.modelo">
        <div class="card card-product card-plain shadow-sm">
          <div class="card-header-image">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title">{{ product.modelo }}</h5>
            <div class="card-description" style="height: 70px;overflow:auto;"><small>{{ product.descripcion }}</small></div>
          </div>
          <h5 class="card-title text-center"><small>{{ product.cantidadCuotas }} cuotas de $</small>{{ product.montoCuota }}</h5>
        </div><br>
      </div>
    </div>
  </div>
</div>
</section>
</template>


<script>
    export default {
      props: {
        categories:{
          type: Array
        },
        contados:{
          type: Array
        }
      },
      data: function(){
        return{
          products: []
          }
        },
      mounted() {
        axios.post('/getProductsXCategory/'+0).then(response=>{
          this.products = response.data;
        }).catch(function (error) {
          console.log(error)
        });
      },
      computed: {
          categoriesConTotal: function () {
            // utilizando map se agrega la propiedad total por cada elemento del array categories
            let categoriesConTotal = this.categories.map(p => {
              p.total = this.contados.find( (el) => { return el.nombre === p.nombre } ).products_count
              return p
            })
            return categoriesConTotal
          }
        },
      methods:{
        getProductsXCategory(){
          var radios=document.getElementsByName('categorias');
          var i;
          for(i=0; i<radios.length; i++){
            if(radios[i].checked){
              var id=radios[i].value;
              axios.post('/getProductsXCategory/'+id)
                .then((resp)=>{
                  this.products=resp.data;
                }).catch(function (error) {
                  console.log(error);
                })
            }
          }
        }
      }
    }
</script>
