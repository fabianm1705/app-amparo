<template>
  <section>
    <select @click="checkPlans" class="custom-select mb-1 form-control" name="pacient_id" id="pacient_id">
      <option selected>Seleccione Paciente</option>
      <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
    </select>
    <select @click="getDoctors" class="custom-select mb-1" name="specialty" id="specialty">
      <option value="0" selected>Seleccione Especialidad</option>
      <option v-for="specialty in specialties" :key="specialty.id" :value="specialty.id">{{ specialty.descripcion }}</option>
    </select>
    <select @click="printCostoOrden" class="custom-select mb-2 form-control" name="doctor_id" id="doctor_id">
      <option value="0" selected>Seleccione Profesional</option>
      <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">{{ doctor.apeynom }}</option>
    </select>
    <textarea class="form-control mb-2" v-if="emiteenadmin" id="obs" name="obs" rows="2" placeholder="Observaciones" autocomplete="off"></textarea>
    <input type="hidden" class="form-control" name="estado" id="estado">
    <input type="hidden" class="form-control" name="lugarEmision" id="lugarEmision">
    <div v-if="ordenEstudio">
      <div class="row justify-content-center mb-2">
        <div class="col-md-2">
          <label for="monto_s">Monto S.</label>
          <input  type="text"
                  class="form-control"
                  name="monto_s"
                  id="monto_s"
                  v-model="montoCostoOrdenS">
        </div>
        <div class="col-md-2">
          <label for="monto_a">Monto A.</label>
          <input
                  type="text"
                  class="form-control"
                  name="monto_a"
                  id="monto_a"
                  v-model="montoCostoOrdenA">
        </div>
      </div>
    </div>
    <div v-else>
      <input
              type="hidden"
              class="form-control"
              name="monto_s"
              id="monto_s"
              v-model="montoCostoOrdenS">
      <input
              type="hidden"
              class="form-control"
              name="monto_a"
              id="monto_a"
              v-model="montoCostoOrdenA">
    </div>
    <div v-show="ordenEstudio==false">
      <div class="text-center mb-2">
          <h5 class="card-title" id="costoOrden">
            <small>{{ messageCostoOrden }}</small>{{ montoCostoOrdenS }}
          </h5>
      </div>
    </div>
    <div class="text-center">
      <input v-if="habilitaBtnOrden" class="btn btn-success btn-block" id="btnGenerarOrden" type="submit" value="Generar Orden" />
    </div>
  </section>
</template>

<script>
  export default {
    props: {
      specialties:{
        type: Array
      },
      users:{
        type: Array
      },
      lugaremision:{
        type: String
      },
      estado:{
        type: String
      },
      emiteenadmin:{
        type: Boolean
      }
    },
  data: function(){
      return{
        doctors: [],
        plans: [],
        layers: [],
        messageCostoOrden:"",
        montoCostoOrdenS:"",
        montoCostoOrdenA:"",
        outlimit:false,
        habilitaBtnOrden:false,
        ordenEstudio:false,
      }
    },
    mounted() {
      document.getElementById('estado').value = this.estado;
      document.getElementById('lugarEmision').value = this.lugaremision;
    },
    methods:{
      checkPlans(){
        var i;
        var id = document.getElementById('pacient_id').value;
        var idGroup = this.users[0].group_id;
        axios.post('/getPlans/'+idGroup)
          .then((resp)=>{
            this.plans=resp.data;
            for (i = 0; i < Object.keys(this.plans).length; i++) {
              if(this.plans[i].emiteOrden==1){
                this.habilitaAvisos(id);
                this.habilitaBtnOrden=true;
                i=Object.keys(this.plans).length;
              }
            };
            if(this.habilitaBtnOrden==false){
              axios.post('/getLayers/'+id)
                .then((resp)=>{
                  this.layers=resp.data;
                  for (i = 0; i < Object.keys(this.layers).length; i++) {
                    if(this.layers[i].emiteOrden==1){
                      this.habilitaAvisos(id);
                      this.habilitaBtnOrden=true;
                      i=Object.keys(this.layers).length;
                    }
                  };
                })
                .catch(function (error) {
                  console.log(error);
                })
            }
          })
          .catch(function (error) {
            console.log(error);
          })
      },
      habilitaAvisos(id){
        this.messageCostoOrden="";
        this.montoCostoOrdenS="";
        this.montoCostoOrdenA="";
        document.getElementById('specialty').value=0;
        document.getElementById('specialty').text="Seleccione Especialidad";
        document.getElementById('doctor_id').value=0;
        document.getElementById('doctor_id').text="Seleccione Profesional";
        axios.post('/cantOrders/'+id)
          .then((respu)=>{
            if (respu.data < 2) {
              document.getElementById('costoOrden').style.color = '#000000';
              this.outLimit=false;
            } else {
              alert("Ya ha emitido " + respu.data + " órdenes en el mes para este socio, la que está por generar tendrá un costo más elevado.");
              document.getElementById('costoOrden').style.color = '#FF0000';
              this.outLimit=true;
            }
          })
          .catch(function (error) {
            console.log(error);
          })
      },
      printCostoOrden(){
        var id = document.getElementById('specialty').value;
        var i;
        for (i = 0; i < Object.keys(this.specialties).length; i++) {
          if(this.specialties[i].id==id){
            if(this.specialties[i].vigenteOrden==0){
              this.ordenEstudio=true;
            }else{
              this.ordenEstudio=false;
            }
            this.messageCostoOrden = "Coseguro único a abonar en consultorio $";
            if (this.outLimit){
              var suma = parseInt(this.specialties[i].monto_s) + parseInt(this.specialties[i].monto_a/2);
              this.montoCostoOrdenS = suma;
              this.montoCostoOrdenA = this.specialties[i].monto_a/2;
            }else{
              this.montoCostoOrdenS = this.specialties[i].monto_s;
              this.montoCostoOrdenA = this.specialties[i].monto_a;
            }
            document.getElementById('monto_s').value=this.montoCostoOrdenS;
            document.getElementById('monto_a').value=this.montoCostoOrdenA;
            i=Object.keys(this.specialties).length;
          }
        };
      },
      getDoctors(){
        var id = document.getElementById('specialty').value;
        axios.post('/getDoctors/'+id)
          .then((resp)=>{this.doctors=resp.data;})
          .catch(function (error) {console.log(error);})
      }
    }
  }
</script>
