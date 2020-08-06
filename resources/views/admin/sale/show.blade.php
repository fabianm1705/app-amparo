<html>
<head>
<title>{{ 'factura_'. $sale->group->nroSocio . '_' . date('d-m-Y') }}</title>
<style type="text/css">
    .Estilo1 {
      font-family: Verdana, Arial, Helvetica, sans-serif;
      font-size: 14px;
      line-height: 2;
    }
    .wrapper {
      min-height: calc(100% - 4rem);
    }
    .footer {
      height: 4rem;
      /* background-color: #e2e2e2 */
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container wrapper">
  <div class="centrado">
    <table class="Estilo1">
      <tr>
        <td><img src="{{ public_path('/images/logo.png') }}"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center" width="200" colspan="2">Página 1 de 1 - Original<br>
          <span>FACTURA B<br>000{{ $sale->puntoContable }} - 000{{ $sale->nroFactura }}</span><br>
        </td>
      </tr>
      <tr>
      	<td colspan=2 align="center">Amparo SRL</td>
        <td align="right"></td>
      	<td align="left"></td>
    	</tr>
      <tr>
      	<td colspan=2 align="center">Cura Alvarez 615 - Paraná - Entre Ríos</td>
        <td align="right">Emisión:</td>
      	<td align="left">{{ \Carbon\Carbon::parse($sale->fechaEmision)->format('d/m/Y') }}</td>
    	</tr>
      <tr>
      	<td colspan=2 align="center">Tel.: 4235108 - 154057991</td>
        <td align="right">CUIT:</td>
      	<td align="left">30-70851738-7</td>
    	</tr>
      <tr>
      	<td colspan=2 align="center">www.amparosrl.com.ar</td>
        <td align="right">Ing. Brutos:</td>
      	<td align="left">30-70851738-7</td>
    	</tr>
      <tr>
      	<td colspan=2 align="center">IVA RESPONSABLE INSCRIPTO</td>
        <td align="right">Inicio Actividades:</td>
      	<td align="left">17/10/2003</td>
    	</tr>
    </table>
    <img src="{{ public_path('/images/divider.png') }}">
    <table class="Estilo1">
    	<tr>
      	<td align="right" width="100"><span>Socio N&ordm;:</span></td>
      	<td align="left" width="100"><span>{{ $sale->group->nroSocio }}</span></td>
        <td align="right"><span>Teléfono:</span></td>
      	<td align="left"><span>{{ $sale->group->telefono }}</span></td>
    	</tr>
    	<tr>
      	<td align="right">Nombre:</td>
        @foreach($sale->group->users as $user)
          @if($user->nroAdh=='0')
            <td align="left">{{ $user->name }}</td>
          @endif
        @endforeach
        <td align="right">Contribuyente:</td>
      	<td align="left">Consumidor Final</td>
    	</tr>
      <tr>
      	<td align="right">Dirección:</td>
      	<td align="left">{{ $sale->group->direccion }}</td>
        <td align="right">Documento:</td>
        @foreach($sale->group->users as $user)
          @if($user->nroAdh=='0')
            <td align="left">{{ $user->nroDoc }}</td>
          @endif
        @endforeach
    	</tr>
    	<tr>
      	<td align="right">Dir. Cobro:</td>
      	<td align="left">{{ $sale->group->direccionCobro }}</td>
        <td align="right">Día Cobro:</td>
      	<td align="left">{{ $sale->group->diaCobro }}</td>
    	</tr>
      <tr>
      	<td align="right">Zona:</td>
      	<td align="left"></td>
        <td align="right">Hora Cobro:</td>
      	<td align="left">{{ $sale->group->horaCobro }}</td>
    	</tr>
    </table>
    <img src="{{ public_path('/images/conceptMonto.png') }}">
    <table class="Estilo1">
      @foreach($concepts as $concept)
        <tr>
          <td colspan="3" width="350">{{ $concept->descripcion }}</td>
          <td align="center">${{ $concept->monto }}</td>
        </tr>
      @endforeach
    </table>
    <footer class="footer">
      <img src="{{ public_path('/images/divider.png') }}">
      <table class="Estilo1">
        <tr>
          <td align="right" width="100">Obs:</td>
          <td align="left" colspan="3">{{ $sale->obs }}</td>
        </tr>
        <tr>
          <td align="right" width="100">CAE:</td>
          <td align="left">{{ $sale->cae }}</td>
          <td align="right"></td>
          <td align="center"></td>
        </tr>
        <tr>
          <td align="right">Fecha CAE:</td>
          <td align="left" width="210">{{ \Carbon\Carbon::parse($sale->fechaCae)->format('d/m/Y') }}</td>
          <td colspan="3" align="right">TOTAL</td>
          <td align="center"> ${{ $sale->total }}</td>
        </tr>
      </table>
    </footer>
  </div>
</div>
</body>
</html>
