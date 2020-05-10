@extends('layouts.app')

@section('myLinks')
  <script>
    function cargarProfesionales(){
      var id = document.getElementById('specialty').value;
      axios.post('/getDoctors/'+id)
        .then((resp)=>{
            var cont = document.getElementById("tablaprofesionales").rows.length;
            for (i = 0; i < (cont); i++) {
                document.getElementById("borrar").remove();
            }
            for (i = 0; i < Object.keys(resp.data).length; i++) {
                $('<tr id="borrar"><td>' + resp.data[i].apeynom + '</td><td>' + resp.data[i].direccion + '</td><td>' + resp.data[i].telefono + '</td></tr>').appendTo('#tablaprofesionales');
            }
        })
        .catch(function (error) {console.log(error);})
    }
  </script>
@endsection

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="fresh-table full-color-orange shadow-sm">
          <!--
            Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
          -->
          <div class="row">
            <h5 class="card-title text-white mt-3 mb-3 ml-4">&nbsp;&nbsp;Profesionales</h5><br>
          </div>
          <div class="col-md-12">
            <select class="custom-select mb-4" name="specialty" id="specialty" onchange="cargarProfesionales()">
              <option selected>Seleccione especialidad</option>
              @foreach($specialties as $specialty)
                <option value="{{ $specialty->id }}">
                    {{ $specialty->descripcion }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-body">
            <table class="table table-hover table-sm table-responsive">
              <thead>
                <th>Nombre</th>
                <th>Consultorio</th>
                <th>Teléfono</th>
              </thead>
              <tbody id="tablaprofesionales">
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
