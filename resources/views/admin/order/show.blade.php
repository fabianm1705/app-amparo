  <title>{{ 'orden-'.$order->id.'.pdf' }}</title>
  <style type="text/css">
      .Estilo1 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 14px;
        line-height: 2;
      }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <div class="container">
    <div class="centrado">
      <table class="Estilo1">
        <tr>
          <td><img src="{{ asset('/images/logo.png') }}" width="200px"></td>
          <td></td>
          <td><center>
            <span>Lugar de Emisión: Sede Amparo</span><br>
            <span>Emisión: {{ \Carbon\Carbon::parse($order->fecha)->format('d/m/Y') }}</span><br>
            <span>Impresión: {{ \Carbon\Carbon::parse($order->fechaImpresion)->format('d/m/Y') }}</span><br>
            <span>N° Orden: {{ $order->id+5000 }}</span></center>
          </td>
        </tr>
        <tr>
          <td colspan="3" align="center">
            <br>
            <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate(strval($order->id))) }} ">
          </td>
        </tr>
      	<tr>
        	<td align="right"><span>Socio N&ordm;:</span></td>
        	<td >&nbsp;</td>
        	<td align="left"><span>{{ $order->user->group->nroSocio }}</span></td>
      	</tr>
      	<tr>
        	<td align="right">Paciente:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->user->name }}</td>
      	</tr>
        <tr>
        	<td align="right">Documento:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->user->nroDoc }}</td>
      	</tr>
      	<tr>
        	<td align="right">Fecha Nacimiento:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ \Carbon\Carbon::parse($order->user->fechaNac)->format('d/m/Y') }}</td>
      	</tr>
      	<tr>
        	<td align="right">Domicilio:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->user->group->direccion }}</td>
      	</tr>
      	<tr>
        	<td colspan=3>
        		<hr>
        	</td>
      	</tr>
      	<tr>
        	<td align="right">Especialidad:</td>
        	<td align="right">&nbsp;</td>
        	<td class="alignLeft">{{ $order->doctor->specialty->descripcion }}</td>
      	</tr>
      	<tr>
        	<td align="right">Profesional:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->doctor->apeynom }}</td>
      	</tr>
      	<tr>
        	<td align="right">Consultorio:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->doctor->direccion }}</td>
      	</tr>
        <tr>
        	<td align="right">Teléfono:</td>
        	<td align="right">&nbsp;</td>
        	<td align="left">{{ $order->doctor->telefono }}</td>
      	</tr>
      	<tr>
        	<td align="right">Obs:</td>
        	<td align="right">&nbsp;</td>
        	<td class="alignLeft">{{ $order->obs }}</td>
      	</tr>
        <tr>
        	<td align="center" colspan="3" style="font-size:14;">
           {{ $coseguro }}
          </td>
      	</tr>
      	<tr>
        	<td height="38" colspan="3">
        	 <div>
              <table  width="551" align="center">
                <tr>
                  <td colspan="3"><br><br><br></td>
                </tr>
                <tr>
                  <td>_______________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paciente</td>
                  <td>&nbsp;</td>
                  <td>_______________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profesional</td>
                </tr>
          	  </table>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
