@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="fresh-table full-color-orange d-flex shadow-sm">
                  <h5 class="card-title text-white mt-3 mb-3 ml-3">Selecciona los archivos a subir...</h5>
              </div>
              <div class="card shadow-sm mt-1">
                  <div class="card-body">
                      <form method="POST" action="{{ route('users.updatedb') }}">
                          @csrf

                          <div class="form-group row">
                              <label for="fileToUpload" class="col-md-2 col-form-label text-md-right">Facturas</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="fileToUpload2" class="col-md-2 col-form-label text-md-right">Grupos</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload2" id="fileToUpload2" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="fileToUpload3" class="col-md-2 col-form-label text-md-right">IPlanes</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload3" id="fileToUpload3" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="fileToUpload4" class="col-md-2 col-form-label text-md-right">Planes</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload4" id="fileToUpload4" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="fileToUpload5" class="col-md-2 col-form-label text-md-right">Socios</label>
                              <div class="col-md-10">
                                <input type="file" name="fileToUpload5" id="fileToUpload5" class="form-control">
                              </div>
                          </div>

                          <div class="form-group mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-dark">
                                      Subir y Actualizar
                                  </button>

                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
