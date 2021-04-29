function getDoctors(socio){
  let id = document.getElementById('specialty_id').value;
  axios.post('/getCoseguro/'+id)
    .then((resp)=>{
      // Odontología
      if(resp.data.id == 19){
        document.getElementById("oftalmologiaOptions").style.display = "none";
        if(document.getElementById("cant_orders_odonto").value>1){
          btnGenerarOrden.style.display = "none";
          Swal.fire({
            icon: 'warning',
            text: 'El límite odontológico es de 2 órdenes mensuales',
            confirmButtonColor: '#FF7F00',
          });
        }else{
          document.getElementById("msgCoseguro").innerText = "Coseguro variable en consultorio de acuerdo al arreglo";
          document.getElementById("monto_s").value = "";
        }
      }else{
        // Oftalmologia
        if(resp.data.id == 13){
          document.getElementById("oftalmologiaOptions").style.display = "block";
          document.getElementById("obs").style.display = "block";
          document.getElementById("obs").value = "";
        }else{
          document.getElementById("oftalmologiaOptions").style.display = "none";
          document.getElementById("obs").value = "";
          if(socio){
            document.getElementById("obs").style.display = "none";
          }else{
            document.getElementById("obs").style.display = "block";
          }
        }
        document.getElementById("msgCoseguro").innerText = "Coseguro único a abonar en consultorio $";
        if(document.getElementById("cant_orders_salud").value<2){
          document.getElementById('coseguro').style.color = '#000000';
          document.getElementById("coseguro").innerText = resp.data.monto_s;
          document.getElementById("monto_s").value = resp.data.monto_s;
          document.getElementById("monto_a").value = resp.data.monto_a;
        }else{
          document.getElementById('coseguro').style.color = '#FF0000';
          document.getElementById("coseguro").innerText = resp.data.monto_s+(resp.data.monto_a/2);
          document.getElementById("monto_s").value = resp.data.monto_s+(resp.data.monto_a/2);
          document.getElementById("monto_a").value = resp.data.monto_a/2;
        }
      }
      let doctors = document.getElementById("doctor_id");
      for (let i = doctors.options.length; i >= 0; i--) {
        doctors.remove(i);
      }
      axios.post('/getDoctors/'+id)
        .then((resp)=>{
          let doctors = document.getElementById("doctor_id");
          for (let i = 0; i < Object.keys(resp.data).length; i++) {
            var option = document.createElement('option');
            option.value = resp.data[i].id;
            option.text = resp.data[i].apeynom + " (" + resp.data[i].direccion + ")";
            doctors.appendChild(option);
          }
        })
        .catch(function (error) {console.log(error);})
    })
    .catch(function (error) {console.log(error);})
};

function obsSwitch(entrada){
  obs = document.getElementById("obs");
  obs.value = entrada;
};

function checkSocio(socio){
  let id = document.getElementById('user_id').value;
  axios.post('/getDataUser/'+id)
    .then((resp)=>{
      document.getElementById("cant_orders_salud").value = resp.data.cant_orders_salud;
      document.getElementById("cant_orders_odonto").value = resp.data.cant_orders_odonto;
      let f = new Date(resp.data.carencia_salud);
      document.getElementById("carencia_salud").innerText = (f.getDate()+1) + "/"+ (f.getMonth()+1) +"/" +f.getFullYear();
      let g = new Date(resp.data.carencia_odonto);
      document.getElementById("carencia_odonto").innerText = (g.getDate()+1) + "/"+ (g.getMonth()+1) +"/" +g.getFullYear();
      needSalud = document.getElementById("divNecesitaSalud");
      needSalud2 = document.getElementById("divNecesitaSalud2");
      needOdontologia = document.getElementById("divNecesitaOdontologia");
      needOdontologia2 = document.getElementById("divNecesitaOdontologia2");
      carenciaSalud = document.getElementById("divCarenciaSalud");
      carenciaOdonto = document.getElementById("divCarenciaOdonto");
      btnGenerarOrden = document.getElementById("divBtnGenerarOrden");
      obs = document.getElementById("obs");
      monto_a = document.getElementById("monto_a");
      msg_monto_a = document.getElementById("msg_monto_a");
      msg_monto_s = document.getElementById("msg_monto_s");
      monto_s = document.getElementById("monto_s");
      coseguro = document.getElementById("coseguro");
      if(socio){
        // es socio logueado
        obs.style.display = "none";
        monto_s.style.display = "none";
        monto_a.style.display = "none";
        if(resp.data.necesita_odonto && resp.data.necesita_salud){
          btnGenerarOrden.style.display = "none";
          needOdontologia.style.display = "block";
          needOdontologia2.style.display = "block";
          needSalud.style.display = "block";
          needSalud2.style.display = "block";
        }else if(resp.data.necesita_odonto){
          needOdontologia.style.display = "block";
          needOdontologia2.style.display = "block";
          if(resp.data.carencia_salud){
            carenciaSalud.style.display = "block";
            btnGenerarOrden.style.display = "none";
          }
        }else if(resp.data.necesita_salud){
          needSalud.style.display = "block";
          needSalud2.style.display = "block";
          if(resp.data.carencia_odonto){
            carenciaOdonto.style.display = "block";
            btnGenerarOrden.style.display = "none";
          }else if(document.getElementById("cant_orders_odonto").value<2){
            btnGenerarOrden.style.display = "block";
          }else{
            btnGenerarOrden.style.display = "none";
            Swal.fire({
              icon: 'warning',
              text: 'El límite odontológico es de 2 órdenes mensuales'
            });
          }
        }else{
          btnGenerarOrden.style.display = "block";
        }
      }else{
        // es admin o dev
        btnGenerarOrden.style.display = "block";
        if(resp.data.necesita_odonto){
          needOdontologia.style.display = "block";
        }else if(resp.data.carencia_odonto){
          carenciaOdonto.style.display = "block";
        }
        if(resp.data.necesita_salud){
          needSalud.style.display = "block";
        }else if(resp.data.carencia_salud){
          carenciaSalud.style.display = "block";
        }
      }

      let specialties = document.getElementById("specialty_id");
      for (let i = specialties.options.length; i >= 0; i--) {
        specialties.remove(i);
      }
      let option = document.createElement('option');
      option.value = "0";
      option.text = "Seleccione Especialidad";
      option.dataset.limitOrders = "0";
      option.dataset.cantlimitorders = "2";
      specialties.appendChild(option);
      for (let i = 0; i < Object.keys(resp.data.specialties).length; i++) {
        let option = document.createElement('option');
        option.value = resp.data.specialties[i].id;
        option.text = resp.data.specialties[i].descripcion;
        option.dataset.limitOrders = resp.data.specialties[i].limitOrders;
        option.dataset.cantlimitorders = resp.data.specialties[i].cantLimitOrders;
        specialties.appendChild(option);
      }
    })
    .catch(function (error) {
      console.log(error);
    })
}
