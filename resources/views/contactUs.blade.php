@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="fresh-table full-color-orange d-flex shadow-sm">
                <h5 class="card-title text-white mt-4 ml-4 mb-4">Contacto</h5>
            </div>
            <div class="card mt-1">
              <div class="card-body">
                @if (session('estado'))
                    <div class="alert alert-success">
                        {{ session('estado') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('contactus.store') }}">
                    @csrf
                    <div class="messages"></div> <!-- mensajes de error -->

                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tu nombre *</label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Por favor ingresa tu nombre" required="required" data-error="El nombre es requerido.">

                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
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
                                    <label for="address">Domicilio</label>
                                    <input id="address" type="text" name="address" class="form-control" placeholder="Ingresa tu domicilio">

                                        @if($errors->has('address'))
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone">Teléfono</label>
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
                                    <label for="message">Mensaje *</label>
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
