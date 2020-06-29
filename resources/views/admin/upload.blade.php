@extends('layouts.app')

@section('myLinks')
  <script>
    function darkModeUpload(valor){
      var el41 = document.getElementById("tarjeta");
      var el42 = document.getElementById("lblFacturas");
      var el43 = document.getElementById("lblGrupos");
      var el44 = document.getElementById("lblIPlaness");
      var el45 = document.getElementById("lblPlanes");
      var el46 = document.getElementById("lblSocios");
      var el47 = document.getElementById("btnSubir");
      if(valor){
        el41.classList.add('bg-dark');
        el42.classList.add('text-white');
        el43.classList.add('text-white');
        el44.classList.add('text-white');
        el45.classList.add('text-white');
        el46.classList.add('text-white');
        el47.classList.add('btn-success');
        el47.classList.remove('btn-dark');
      }else{
        el41.classList.remove('bg-dark');
        el42.classList.remove('text-white');
        el43.classList.remove('text-white');
        el44.classList.remove('text-white');
        el45.classList.remove('text-white');
        el46.classList.remove('text-white');
        el47.classList.remove('btn-success');
        el47.classList.add('btn-dark');
      }
    };
  </script>
@endsection

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="fresh-table full-color-orange d-flex shadow-sm">
                  <h5 class="card-title text-white mt-3 mb-3 ml-3">Selecciona los archivos a subir...</h5>
              </div>
              <div id="tarjeta" class="card shadow-sm mt-1">
                  <div class="card-body">
                      <form method="POST" action="{{ route('users.updatedb') }}" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group row">
                              <label id="lblFacturas" for="fileToUpload" class="col-md-2 col-form-label text-md-right">Facturas</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label id="lblGrupos" for="fileToUpload2" class="col-md-2 col-form-label text-md-right">Grupos</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload2" id="fileToUpload2" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label id="lblIPlaness" for="fileToUpload3" class="col-md-2 col-form-label text-md-right">IPlanes</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload3" id="fileToUpload3" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label id="lblPlanes" for="fileToUpload4" class="col-md-2 col-form-label text-md-right">Planes</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload4" id="fileToUpload4" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label id="lblSocios" for="fileToUpload5" class="col-md-2 col-form-label text-md-right">Socios</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload5" id="fileToUpload5" class="form-control">
                              </div>
                          </div>

                          <div class="form-group mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button id="btnSubir" type="submit" class="btn">
                                      Subir y Actualizar
                                  </button>

                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <img onload="darkModeUpload({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
  </div>
@endsection
