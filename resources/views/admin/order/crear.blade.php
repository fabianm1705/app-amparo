@extends('layouts.app')

@section('myLinks')
  <script>
    function iniciaEmision(){
        document.getElementById("divNecesitaSalud").style.display = "none";
        document.getElementById("divNecesitaSalud2").style.display = "none";
        document.getElementById("divNecesitaOdontologia").style.display = "none";
        document.getElementById("divBtnGenerarOrden").style.display = "none";
      }
  </script>
  <script>
    function getDoctors(){
            var id = document.getElementById('specialty').value;
            axios.post('/getCoseguro/'+id)
              .then((resp)=>{
                document.getElementById("msgCoseguro").innerText = "Coseguro único a abonar en consultorio $";
                if(document.getElementById("cant_orders").value<2){
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
                var doctors = document.getElementById("doctor_id");
                for (let i = doctors.options.length; i >= 0; i--) {
                  doctors.remove(i);
                }
                var id = document.getElementById('specialty').value;
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
    function checkSocio(){
      var id = document.getElementById('pacient_id').value;
      axios.post('/checkSocio/'+id)
        .then((resp)=>{
          document.getElementById("cant_orders").value = resp.data.cant_orders;
          needSalud = document.getElementById("divNecesitaSalud");
          needSalud2 = document.getElementById("divNecesitaSalud2");
          needOdontologia = document.getElementById("divNecesitaOdontologia");
          btnGenerarOrden = document.getElementById("divBtnGenerarOrden");
          specialty = document.getElementById("specialty");
          doctor_id = document.getElementById("doctor_id");
          obs = document.getElementById("obs");
          monto_a = document.getElementById("monto_a");
          msg_monto_a = document.getElementById("msg_monto_a");
          msg_monto_s = document.getElementById("msg_monto_s");
          monto_s = document.getElementById("monto_s");
          coseguro = document.getElementById("coseguro");
          if(resp.data.salud){
            needSalud.style.display = "block";
            needSalud2.style.display = "block";
            btnGenerarOrden.style.display = "none";
            specialty.style.display = "none";
            doctor_id.style.display = "none";
            obs.style.display = "none";
            monto_s.style.display = "none";
            monto_a.style.display = "none";
            msg_monto_s.style.display = "none";
            msg_monto_a.style.display = "none";
          }else{
            btnGenerarOrden.style.display = "block";
            specialty.style.display = "block";
            doctor_id.style.display = "block";
            needSalud.style.display = "none";
            needSalud2.style.display = "none";
          }
          if(resp.data.odontologia){
            needOdontologia.style.display = "block";
          }else{
            needOdontologia.style.display = "none";
          }
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  </script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="{{ route('orders.store') }}" method="post">
          @csrf
          <div class="fresh-table full-color-orange shadow-sm">
            <div class="row">
              <h5 class="card-title text-white mt-3 mb-3 ml-4">&nbsp;&nbsp;Emisión de Órdenes</h5><br>
            </div>
            <div class="col-md-12">
              <select class="custom-select mb-1" name="pacient_id" id="pacient_id" onchange="checkSocio()">
                <option value="0" selected>Seleccione Paciente</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}">
                      {{ $user->name }}
                  </option>
                @endforeach
              </select>
              <select class="custom-select mb-1" name="specialty" id="specialty" onchange="getDoctors()">
                <option value="0" selected>Seleccione Especialidad</option>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}">
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

          @if($emiteOficina)
            <textarea class="form-control mt-2 mb-2" id="obs" name="obs" rows="2" placeholder="Observaciones" autocomplete="off"></textarea>
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
              <input type="hidden" class="form-control" name="obs" id="obs">
              <input type="hidden" class="form-control" name="monto_s" id="monto_s">
              <input type="hidden" class="form-control" name="monto_a" id="monto_a">
            </div>
          @endif
          <div class="mt-4">
            <input type="hidden" name="cant_orders" id="cant_orders">
              <h5 class="card-title d-flex justify-content-center">
                <small><label id="msgCoseguro"></label></small><label id="coseguro"></label>
              </h5>
          </div>
          <div class="text-center" id="divBtnGenerarOrden">
            <input class="btn btn-success btn-block" id="btnGenerarOrden" type="submit" value="Generar Orden" />
          </div>
      </form>
    </div>
  </div>
  <div id="divNecesitaSalud" class="col-md-8 container alert alert-warning text-justify">
    <h5>Debes activar el Plan Salud para poder utilizar nuestra red de consultorios, puedes hacerlo ahora mismo y a un precio preferencial por ser socio, y comenzar a utilizarlo de inmediato!</h5>
  </div>
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
      <div id="divNecesitaOdontologia" class="col-md-4 card shadow-sm fresh-table full-color-orange ml-4 mr-4 mt-2">
        <div class="title text-center text-white mb-4"><br>
          <h5 class="fontAmparo">Plan Odontológico</h5>
          <h1 class="card-title">
            <small class="text-white">$</small><strong>200</strong><small class="text-white"> /ind.</small>
          </h1><br>
          + $150 por Adherente<hr>
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
</div>
@endsection
