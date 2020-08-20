@extends('layouts.app')

@section('myLinks')
  <script>
  function OcultaPlanes(){
    document.getElementById("divNecesitaSalud").style.display = "none";
    document.getElementById("divNecesitaSalud2").style.display = "none";
    document.getElementById("divNecesitaOdontologia").style.display = "none";
    document.getElementById("divNecesitaOdontologia2").style.display = "none";
    document.getElementById("divCarenciaSalud").style.display = "none";
    document.getElementById("divCarenciaOdonto").style.display = "none";
    document.getElementById("oftalmologiaOptions").style.display = "none";
    @auth
      @foreach (Auth::user()->roles as $role)
        @if($role->slug=='dev')
          document.getElementById("obs").style.display = "block";
        @elseif($role->slug=='admin')
          document.getElementById("obs").style.display = "block";
        @elseif($role->slug=='socio')
          document.getElementById("obs").style.display = "none";
        @endif
      @endforeach
    @endauth
  }
  </script>
  <script>
    function checkSocio(){
      var id = document.getElementById('user_id').value;
      axios.post('/getDataUser/'+id)
        .then((resp)=>{
          console.log(resp.data);
          document.getElementById("cant_orders_salud").value = resp.data.cant_orders_salud;
          document.getElementById("cant_orders_odonto").value = resp.data.cant_orders_odonto;
          var f = new Date(resp.data.carencia_salud);
          document.getElementById("carencia_salud").innerText = (f.getDate()+1) + "/"+ (f.getMonth()+1) +"/" +f.getFullYear();
          var g = new Date(resp.data.carencia_odonto);
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
          @auth
            @foreach (Auth::user()->roles as $role)
              @if($role->slug=='dev' || $role->slug=='admin')
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
              @elseif($role->slug=='socio')
                obs.style.display = "none";
                monto_s.style.display = "none";
                monto_a.style.display = "none";
                // msg_monto_s.style.display = "none";
                // msg_monto_a.style.display = "none";
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
              @endif
            @endforeach
          @endauth

          var specialties = document.getElementById("specialty_id");
          for (let i = specialties.options.length; i >= 0; i--) {
            specialties.remove(i);
          }
          var option = document.createElement('option');
          option.value = "0";
          option.text = "Seleccione Especialidad";
          option.dataset.limitOrders = "0";
          option.dataset.cantlimitorders = "2";
          specialties.appendChild(option);
          for (i = 0; i < Object.keys(resp.data.specialties).length; i++) {
            var option = document.createElement('option');
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
  </script>
  <script>
    function getDoctors(){
            var id = document.getElementById('specialty_id').value;
            axios.post('/getCoseguro/'+id)
              .then((resp)=>{
                // Odontología
                if(resp.data.id == 19){
                  document.getElementById("oftalmologiaOptions").style.display = "none";
                  if(document.getElementById("cant_orders_odonto").value>1){
                    btnGenerarOrden.style.display = "none";
                    Swal.fire({
                      icon: 'warning',
                      text: 'El límite odontológico es de 2 órdenes mensuales'
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
                    @auth
                      @foreach (Auth::user()->roles as $role)
                        @if($role->slug=='socio')
                          document.getElementById("obs").style.display = "none";
                        @endif
                      @endforeach
                    @endauth
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
                var doctors = document.getElementById("doctor_id");
                for (let i = doctors.options.length; i >= 0; i--) {
                  doctors.remove(i);
                }
                axios.post('/getDoctors/'+id)
                  .then((resp)=>{
                    var doctors = document.getElementById("doctor_id");
                    for (i = 0; i < Object.keys(resp.data).length; i++) {
                      var option = document.createElement('option');
                      option.value = resp.data[i].id;
                      option.text = resp.data[i].apeynom;
                      doctors.appendChild(option);
                    }
                  })
                  .catch(function (error) {console.log(error);})
              })
              .catch(function (error) {console.log(error);})
          }
  </script>
  <script>
    function obsSwitch(entrada){
      obs = document.getElementById("obs");
      obs.value = entrada;
    }
  </script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9 col-lg-6 mt-2">
      <form action="{{ route('orders.store') }}" method="post">
          @csrf
          <div class="fresh-table full-color-orange shadow-sm">
            <div class="row">
              <h5 class="card-title text-white mt-3 mb-3 ml-4">&nbsp;&nbsp;Emisión de Órdenes</h5><br>
            </div>
            <div class="col-md-12">
              <select class="custom-select mb-1" name="user_id" id="user_id" onchange="checkSocio()">
                <option value="0" selected>Seleccione Paciente</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">
                      {{ $user->name }}
                  </option>
                @endforeach
              </select>
              <select class="custom-select mb-1" name="specialty_id" id="specialty_id" onchange="getDoctors()">
                <option value="0" selected>Seleccione Especialidad</option>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}"
                          data-limit-orders="{{ $specialty->limitOrders }}"
                          data-cantlimitorders="{{ $specialty->cantLimitOrders }}">
                      {{ $specialty->descripcion }}
                  </option>
                @endforeach
              </select>
              <select class="custom-select" name="doctor_id" id="doctor_id">
                <option value="0" selected>Seleccione Profesional</option>
                @foreach($doctors as $doctor)
                  <option value="{{ $doctor->id }}">
                      {{ $doctor->apeynom }}
                  </option>
                @endforeach
              </select><br><br>
            </div>
          </div>

          <center>
            <div class="btn-group btn-group-toggle mt-2" id="oftalmologiaOptions" data-toggle="buttons">
              <label class="btn btn-success active">
                <input type="radio" name="options" id="oftalmologiaConsulta" checked onclick="obsSwitch('Orden de Consulta')"> Orden de Consulta
              </label>
              <label class="btn btn-success">
                <input type="radio" name="options" id="oftalmologiaEstudio" onclick="obsSwitch('Orden de Estudio')"> Orden de Estudio
              </label>
            </div>
          </center>
          <textarea class="form-control mt-2 mb-2" id="obs" name="obs" rows="2" placeholder="Observaciones" autocomplete="off"></textarea>

          @if($emiteOficina)
            <div>
              <div class="row justify-content-center mb-2">
                <div class="col-md-2">
                  <label for="monto_s" id="msg_monto_s">Monto S.</label>
                  <input type="text" class="form-control" name="monto_s" id="monto_s">
                </div>
                <div class="col-md-2">
                  <label for="monto_a" id="msg_monto_a">Monto A.</label>
                  <input type="text" class="form-control" name="monto_a" id="monto_a">
                </div>
              </div>
            </div>
          @else
            <div>
              <input type="hidden" class="form-control" name="monto_s" id="monto_s">
              <input type="hidden" class="form-control" name="monto_a" id="monto_a">
            </div>
          @endif
          <div class="mt-4">
            <input type="hidden" name="cant_orders_salud" id="cant_orders_salud">
            <input type="hidden" name="cant_orders_odonto" id="cant_orders_odonto">
            <h5 class="card-title d-flex justify-content-center">
              <small><label id="msgCoseguro"></label></small><label id="coseguro"></label>
            </h5>
          </div>
          <div class="text-center" id="divBtnGenerarOrden">
            <input class="btn btn-success btn-block btn-lg" id="btnGenerarOrden" type="submit" value="Generar Orden" />
          </div>
      </form>
    </div>
  </div>
  <br>
  <center>
    <div id="divCarenciaOdonto" class="alert alert-warning mt-2 col-md-9 col-lg-6">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Carencia activa del plan odontológico hasta el &nbsp;<label id="carencia_odonto"></label>

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
    <div id="divCarenciaSalud" class="alert alert-warning mt-2 col-md-9 col-lg-6">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Carencia activa del plan salud hasta el &nbsp;<label id="carencia_salud"></label>

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>

    <div id="divNecesitaSalud" class="col-md-9 col-lg-6 alert alert-warning text-justify mt-2">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Puedes activar el Plan Salud para poder utilizar nuestra red de consultorios, haciéndolo ahora mismo puedes comenzar a utilizarlo de inmediato!

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
    <div id="divNecesitaOdontologia" class="col-md-9 col-lg-6 alert alert-warning text-justify mt-2">
      <div class="d-flex">
        <div class="alert-icon">
            <i class="material-icons">check</i>
        </div>
        Puedes activar el Plan Odontológico para atenderte con nuestros profesionales, haciéndolo ahora mismo puedes comenzar a utilizarlo de inmediato!

        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
      </div>
    </div>
  </center>
  <div class="row justify-content-center">
      <div id="divNecesitaSalud2" class="col-md-4 card shadow-sm fresh-table full-color-orange ml-4 mr-4 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Salud</h5>
          <h1 class="card-title">
            @if($usersCount===1)
              <small class="text-white">$</small><strong>600</strong><small class="text-white"> /mes</small>
            @else
              <small class="text-white">$</small><strong>900</strong><small class="text-white"> Grupo Fliar</small>
            @endif
          </h1><br>
          Cobertura Ambulatoria Integral<hr>
          Consultorios Externos, Laboratorio<hr>
          Farmacia, Ambulancia, Emergencias<hr>
          Estudios, Radiografías, Ecografías y más.<br><br>
          @if($usersCount===1)
            <form action="{{ route('activar.salud') }}" method="post">
              @csrf
              <button class="btn btn-lg" type="submit" name="button">Activar</button>
            </form>
          @else
            <form action="{{ route('activar.plan') }}" method="post">
              @csrf
              <button class="btn btn-lg" type="submit" name="button">Activar</button>
            </form>
          @endif
        </div>
      </div>
      <div id="divNecesitaOdontologia2" class="col-md-4 card shadow-sm fresh-table full-color-orange ml-4 mr-4 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Odontológico</h5>
          <h1 class="card-title">
            <small class="text-white">$</small><strong>220</strong><small class="text-white"> /ind.</small>
          </h1><br>
          + $180 por Adherente<hr>
          Cobertura Odontológica Integral<hr>
          Odontólogos distribuidos por la ciudad<hr>
          Turnos rápidos, coseguros muy económicos<br><br>
          <form action="{{ route('activar.odontologia') }}" method="post">
            @csrf
            <button class="btn btn-lg" type="submit" name="button">Activar</button>
          </form>
        </div>
      </div>
  </div>
  <img onload="OcultaPlanes()" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
