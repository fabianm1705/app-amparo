@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="fresh-table full-color-orange d-flex shadow-sm">
                <h5 class="card-title text-white mt-4 ml-4 mb-4">Contacto</h5>
            </div>
            @if(Auth::user()->darkMode)
              <div class="card mt-1 bg-dark">
            @else
              <div class="card mt-1">
            @endif
              <div class="card-body">
                @if (session('estado'))
                    <div class="alert alert-success">
                        {{ session('estado') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('contacto.app') }}">
                    @csrf
                    <div class="messages"></div> <!-- mensajes de error -->

                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  @if(Auth::user()->darkMode)
                                    <label for="name" class="text-white">Tu nombre *</label>
                                  @else
                                    <label for="name">Tu nombre *</label>
                                  @endif
                                  <input id="name" type="text" name="name" class="form-control" placeholder="Por favor ingresa tu nombre" required="required" data-error="El nombre es requerido.">

                                      @if($errors->has('name'))
                                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                      @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  @if(Auth::user()->darkMode)
                                    <label for="email" class="text-white">Email</label>
                                  @else
                                    <label for="email">Email</label>
                                  @endif
                                    <input id="email" type="text" name="email" class="form-control" placeholder="Por favor ingresa tu email">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  @if(Auth::user()->darkMode)
                                    <label for="address" class="text-white">Domicilio</label>
                                  @else
                                    <label for="address">Domicilio</label>
                                  @endif
                                    <input id="address" type="text" name="address" class="form-control" placeholder="Ingresa tu domicilio">

                                        @if($errors->has('address'))
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  @if(Auth::user()->darkMode)
                                    <label for="telephone" class="text-white">Teléfono</label>
                                  @else
                                    <label for="telephone">Teléfono</label>
                                  @endif
                                    <input id="telephone" type="text" name="telephone" class="form-control" placeholder="Ingresa tu teléfono">
                                    @if($errors->has('telephone'))
                                        <div class="invalid-feedback">{{ $errors->first('telephone') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  @if(Auth::user()->darkMode)
                                    <label for="message" class="text-white">Mensaje *</label>
                                  @else
                                    <label for="message">Mensaje *</label>
                                  @endif
                                    <textarea id="message" name="message" class="form-control" placeholder="Tu mensaje" rows="4" required="required" data-error="Por favor incluye un mensaje."></textarea>
                                    @if($errors->has('message'))
                                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send text-white" value="Enviar tu mensaje">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <p class="text-muted">
                                    <strong>*</strong> Campos requeridos.</p>
                            </div>
                        </div>
                    </div>
                </form> <!-- fin - .contact-form -->
            </div> <!-- fin del componente card -->
        </div>
    </div>
</div>
@endsection
