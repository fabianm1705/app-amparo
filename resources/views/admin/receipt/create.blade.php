@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="fresh-table full-color-orange d-flex shadow-sm">
              <h5 class="card-title text-white mt-4 ml-4 mb-4">Recibo</h5>
          </div>
          <div class="card mt-1">
            <div class="card-body">
              <form action="{{ route('receipt.store', ['user' => $user]) }}" method="post">
                @csrf
                <div class="row justify-content-server">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="nroSocio">Nro. Socio</label>
                          <input type="text" class="form-control text-center" name="nroSocio" id="nroSocio" value="{{ $user->group->nroSocio }}/{{ $user->nroAdh }}" readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="name">Nombre</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="nroDoc">Documento</label>
                          <input type="text" class="form-control text-center" name="nroDoc" id="nroDoc" value="{{ $user->nroDoc }}" readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="direccion">Domicilio</label>
                          <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $user->group->direccion }}" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="monto">Monto</label>
                          <input type="text" class="form-control" name="monto" id="monto" onfocusout="cargarLetras(this.value)">
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="num_en_letras">En Letras</label>
                          <input class="form-control" id="num_en_letras" name="num_en_letras" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <textarea class="form-control" id="concepto" name="concepto" rows="1" placeholder="Concepto" autocomplete="off"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-dark text-light" type="submit" name="button">Generar Recibo</button>
                  </div>
                </div>
              </form>
            </div>
          </div> <!-- fin del componente card -->
      </div>
  </div>
</div>
@endsection

@section('myScripts')
  <script>

    function cargarLetras(nume){
      document.getElementById("num_en_letras").value=NumeroALetras(nume);
      document.getElementById("concepto").focus();
    }

  function Unidades(num){

    switch(num)
    {
      case 1: return "UN";
      case 2: return "DOS";
      case 3: return "TRES";
      case 4: return "CUATRO";
      case 5: return "CINCO";
      case 6: return "SEIS";
      case 7: return "SIETE";
      case 8: return "OCHO";
      case 9: return "NUEVE";
    }

    return "";
  }

  function Decenas(num){

    decena = Math.floor(num/10);
    unidad = num - (decena * 10);

    switch(decena)
    {
      case 1:
        switch(unidad)
        {
          case 0: return "DIEZ";
          case 1: return "ONCE";
          case 2: return "DOCE";
          case 3: return "TRECE";
          case 4: return "CATORCE";
          case 5: return "QUINCE";
          default: return "DIECI" + Unidades(unidad);
        }
      case 2:
        switch(unidad)
        {
          case 0: return "VEINTE";
          default: return "VEINTI" + Unidades(unidad);
        }
      case 3: return DecenasY("TREINTA", unidad);
      case 4: return DecenasY("CUARENTA", unidad);
      case 5: return DecenasY("CINCUENTA", unidad);
      case 6: return DecenasY("SESENTA", unidad);
      case 7: return DecenasY("SETENTA", unidad);
      case 8: return DecenasY("OCHENTA", unidad);
      case 9: return DecenasY("NOVENTA", unidad);
      case 0: return Unidades(unidad);
    }
  }//Unidades()

  function DecenasY(strSin, numUnidades){
    if (numUnidades > 0)
      return strSin + " Y " + Unidades(numUnidades)

    return strSin;
  }//DecenasY()

  function Centenas(num){

    centenas = Math.floor(num / 100);
    decenas = num - (centenas * 100);

    switch(centenas)
    {
      case 1:
        if (decenas > 0)
          return "CIENTO " + Decenas(decenas);
        return "CIEN";
      case 2: return "DOSCIENTOS " + Decenas(decenas);
      case 3: return "TRESCIENTOS " + Decenas(decenas);
      case 4: return "CUATROCIENTOS " + Decenas(decenas);
      case 5: return "QUINIENTOS " + Decenas(decenas);
      case 6: return "SEISCIENTOS " + Decenas(decenas);
      case 7: return "SETECIENTOS " + Decenas(decenas);
      case 8: return "OCHOCIENTOS " + Decenas(decenas);
      case 9: return "NOVECIENTOS " + Decenas(decenas);
    }

    return Decenas(decenas);
  }//Centenas()

  function Seccion(num, divisor, strSingular, strPlural){
    cientos = Math.floor(num / divisor)
    resto = num - (cientos * divisor)

    letras = "";

    if (cientos > 0)
      if (cientos > 1)
        letras = Centenas(cientos) + " " + strPlural;
      else
        letras = strSingular;

    if (resto > 0)
      letras += "";

    return letras;
  }//Seccion()

  function Miles(num){
    divisor = 1000;
    cientos = Math.floor(num / divisor)
    resto = num - (cientos * divisor)

    strMiles = Seccion(num, divisor, "MIL", "MIL");
    strCentenas = Centenas(resto);

    if(strMiles == "")
      return strCentenas;

    return strMiles + " " + strCentenas;

    //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
  }//Miles()

  function Millones(num){
    divisor = 1000000;
    cientos = Math.floor(num / divisor)
    resto = num - (cientos * divisor)

    strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
    strMiles = Miles(resto);

    if(strMillones == "")
      return strMiles;

    return strMillones + " " + strMiles;

    //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
  }//Millones()

  function NumeroALetras(num,centavos){
    var data = {
      numero: num,
      enteros: Math.floor(num),
      centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
      letrasCentavos: "",
    };
    if(centavos == undefined || centavos==false) {
      data.letrasMonedaPlural="PESOS";
      data.letrasMonedaSingular="PESO";
    }else{
      data.letrasMonedaPlural="CENTAVOS";
      data.letrasMonedaSingular="CENTAVO";
    }

    if (data.centavos > 0)
      data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);

    if(data.enteros == 0)
      return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
    if (data.enteros == 1)
      return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
    else
      return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  }//NumeroALetras()
  </script>
@endsection
