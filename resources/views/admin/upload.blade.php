@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="fresh-table full-color-orange d-flex shadow-sm">
                  <h5 class="card-title text-white mt-3 mb-3 ml-3">Selecciona los archivos a subir...</h5>
              </div>
              @if(Auth::user()->darkMode)
                <div class="card shadow-sm mt-1 bg-dark">
              @else
                <div class="card shadow-sm mt-1">
              @endif
                  <div class="card-body">
                      <form method="POST" action="{{ route('users.updatedb') }}" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="fileFacturas" class="col-md-2 col-form-label text-md-right text-white">Facturas</label>
                            @else
                              <label for="fileFacturas" class="col-md-2 col-form-label text-md-right">Facturas</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="fileFacturas" id="fileFacturas" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="fileConceptos" class="col-md-2 col-form-label text-md-right text-white">Conceptos</label>
                            @else
                              <label for="fileConceptos" class="col-md-2 col-form-label text-md-right">Conceptos</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="fileConceptos" id="fileConceptos" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="fileGrupos" class="col-md-2 col-form-label text-md-right text-white">Grupos</label>
                            @else
                              <label for="fileGrupos" class="col-md-2 col-form-label text-md-right">Grupos</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="fileGrupos" id="fileGrupos" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="fileIPlanes" class="col-md-2 col-form-label text-md-right text-white">IPlanes</label>
                            @else
                              <label for="fileIPlanes" class="col-md-2 col-form-label text-md-right">IPlanes</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="fileIPlanes" id="fileIPlanes" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="filePlanes" class="col-md-2 col-form-label text-md-right text-white">Planes</label>
                            @else
                              <label for="filePlanes" class="col-md-2 col-form-label text-md-right">Planes</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="filePlanes" id="filePlanes" class="form-control">
                              </div>
                          </div>

                          <div class="form-group row">
                            @if(Auth::user()->darkMode)
                              <label for="fileSocios" class="col-md-2 col-form-label text-md-right text-white">Socios</label>
                            @else
                              <label for="fileSocios" class="col-md-2 col-form-label text-md-right">Socios</label>
                            @endif
                              <div class="col-md-10">
                                <input type="file" name="fileSocios" id="fileSocios" class="form-control">
                              </div>
                          </div>

                          <div class="form-group mb-0">
                              <div class="col-md-8 offset-md-4">
                                @if(Auth::user()->darkMode)
                                  <button type="submit" class="btn btn-dark">
                                @else
                                  <button type="submit" class="btn">
                                @endif
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
