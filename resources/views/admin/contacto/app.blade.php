@extends('layouts.app')

<script>
  function darkModeContacto(valor){
    var el41 = document.getElementById("nombre");
    var el42 = document.getElementById("tarjeta");
    var el43 = document.getElementById("correo");
    var el44 = document.getElementById("domicilio");
    var el45 = document.getElementById("telefono");
    var el46 = document.getElementById("mensaje");
    if(valor){
      el41.classList.add('text-white');
      el42.classList.add('bg-dark');
      el43.classList.add('text-white');
      el44.classList.add('text-white');
      el45.classList.add('text-white');
      el46.classList.add('text-white');
    }else{
      el41.classList.remove('text-white');
      el42.classList.remove('bg-dark');
      el43.classList.remove('text-white');
      el44.classList.remove('text-white');
      el45.classList.remove('text-white');
      el46.classList.remove('text-white');
    }
  };
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="fresh-table full-color-orange d-flex shadow-sm">
                <h5 class="card-title text-white mt-4 ml-4 mb-4">Contacto</h5>
            </div>
            <div id="tarjeta" class="card mt-1">
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
                                    <label id="nombre" for="name">Tu nombre *</label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Por favor ingresa tu nombre" required="required" data-error="El nombre es requerido.">

                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="correo" for="email">Email</label>
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
                                    <label id="domicilio" for="address">Domicilio</label>
                                    <input id="address" type="text" name="address" class="form-control" placeholder="Ingresa tu domicilio">

                                        @if($errors->has('address'))
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="telefono" for="telephone">Teléfono</label>
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
                                    <label id="mensaje" for="message">Mensaje *</label>
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
    <img onload="darkModeContacto({{ Auth::user()->darkMode }})" src="{{ asset('images/transparente.png') }}" alt="-">
</div>
@endsection
