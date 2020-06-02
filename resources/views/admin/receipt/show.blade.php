<html>
<head>
<title>{{ 'Recibo_'. $receipt->user->group->nroSocio . '_' . date('d-m-Y') }}</title>
<style type="text/css">
    .Estilo1 {
      font-family: Verdana, Arial, Helvetica, sans-serif;
      font-size: 14px;
      line-height: 2;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="centrado">
    <table class="Estilo1">
      <tr>
        <td><img src="{{ public_path('/images/logo.png') }}"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
          <span>RECIBO {{ $receipt->id+5000 }}</span><br>
          <span>Emisión: {{ \Carbon\Carbon::parse($receipt->created_at)->format('d/m/Y') }}</span><br>
        </td>
      </tr>
    	<tr>
      	<td align="right"><br><br><span>Socio N&ordm;:</span></td>
      	<td >&nbsp;</td>
      	<td align="left"><br><br><span>{{ $receipt->user->group->nroSocio }}</span></td>
    	</tr>
    	<tr>
      	<td align="right">Nombre:</td>
      	<td align="right">&nbsp;</td>
      	<td align="left">{{ $receipt->user->name }}</td>
    	</tr>
      <tr>
      	<td align="right">Documento:</td>
      	<td align="right">&nbsp;</td>
      	<td align="left">{{ $receipt->user->nroDoc }}</td>
    	</tr>
    	<tr>
      	<td align="right">Domicilio:</td>
      	<td align="right">&nbsp;</td>
      	<td align="left">{{ $receipt->user->group->direccion }}</td>
    	</tr>
    	<tr>
      	<td colspan=3>
      		<hr>
      	</td>
    	</tr>
    </table>
    <table class="Estilo1">
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">Monto: ${{ $receipt->monto }} - {{ $num_en_letras }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center">{{ $receipt->concepto }}</td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
