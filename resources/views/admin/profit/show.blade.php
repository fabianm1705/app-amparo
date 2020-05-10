@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm"><br>
        <header class="centrado">
          <h4>Ver Porcentaje</h4>
        </header>
        <div class="card-body">
          <div class="row justify-content-server">
            <div class="col-sm-9">
              <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ $profit->description }}">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="percentage">%</label>
                <input type="text" class="form-control" name="percentage" id="percentage" value="{{ $profit->percentage }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
