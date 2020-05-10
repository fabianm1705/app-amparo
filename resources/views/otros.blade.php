@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 card shadow-sm margenTotal">
        <div class="title text-center"><br>
          <div class="fontAmparo">
            Formas de Pago<hr>
          </div>
          * Débito automático vía CBU (15% de descuento por 6 meses).<br>
          * Transferencia bancaria.<br>
          CBU Cta Bco Bica: 4260003300100023798015
          <br><br>
        </div>
      </div>
      <div class="col-md-3 card shadow-sm margenTotal">
        <div class="title text-center"><br>
          <div class="fontAmparo">
            Administración<hr>
          </div>
          Oficina Cura Alvarez 615, Paraná<br>
          Horario: Lun. a Vie. 8:30 a 18:00hs<br>
          Sepelio: 4235108 / 154-057991<br>
          SOS Emerg.: 4222322 / 4233333<br><br>
        </div>
      </div>
      <div class="col-md-3 card shadow-sm margenTotal">
        <div class="title text-center"><br>
          <div class="fontAmparo">
            Farmacia<hr>
          </div>
          Farmacia Nueva Farma<br>
          30% de descuento sobre vademecum<br>
          Provincias Unidas 589<br>
          Tel.: 4344451<br><br>
        </div>
      </div>
    </div><br>
    <div class="fresh-table full-color-orange d-flex shadow-sm" style="height: 45px;">
      <div class=" mt-2 ml-4">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item blanco">
            <a class="nav-link active" href="#sos" data-toggle="tab">Ambulancia</a>
          </li>
          <li class="nav-item blanco">
            <a class="nav-link" href="#sepelio" data-toggle="tab">Sepelio</a>
          </li>
          <li class="nav-item blanco">
            <a class="nav-link" href="#asistencia" data-toggle="tab">Viajero</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card text-center shadow-sm">
      <div class="card-body">
        <div class="tab-content text-justify">
            <div class="tab-pane active" id="sos">
                <p>
                  Teléfonos SOS EMERGENCIAS: 4233333 o 4222322. Al llamar mencionar que se trata de un socio de Amparo, de tal manera te buscarán en nuestro padrón.<br><br>
                  • CASOS DE URGENCIAS: Se trata de casos extremos en los que <b>corre peligro la vida</b> de una persona. Por ejemplo un accidente en la vía pública con heridos, persona con pérdida de conocimiento o en paro cardiorrespiratorio,
                  etc. Aquí la atención es inmediata en donde se encuentre la persona.<br><br> • ENFERMERIA Y MEDICINA DOMICILIARIA: Se atiende a personas que realizan una consulta médica con la particularidad de que el médico o bien el
                  enfermero (para prácticas de enfermería programada) se desplaza al domicilio del paciente para la atención. Por ejemplo, atención de pacientes que padecen enfermedades crónicas como hipertensión, también cuando se consulta
                  por cuadros que provocan malestar como fiebre, tos, etc. Se trata de casos donde no existe riesgo de vida para la persona y la atención médica puede ser programada con períodos de espera razonable. En estos casos se cobra
                  un coseguro en domicilio.<br>
                </p>
            </div>
            <div class="tab-pane" id="sepelio">
                <p>
                  • En cualquier horario llamar a Amparo Servicios Sociales para comunicar el fallecimiento al teléfono 4235108. En su defecto al celular 154-057991.<br><br> Nuestro operador verifica si el asociado reúne los requisitos para
                  recibir el servicio, o sea, si cumplió el período de espera y está al día con la cuota. En caso afirmativo se debe presentar:<br><br> • Original y 3 fotocopias del DNI del fallecido.<br><br> • Original y 3 fotocopias del
                  certificado de defunción.<br> Verificada la documentación se despacha el servicio con la cochería y el cementerio respectivamente.<br><br>

                  <b>IMPORTANTE: No concurrir directamente a la sala de velatorio</b>.<br>
                </p>
            </div>
            <div class="tab-pane" id="asistencia">
                <p>
                  Cobertura Para el Grupo Familiar y Afiliados<br> Cantidad de Días por viaje: 60<br> Área de cobertura: A partir del km 100 del domicilio declarado.<br> • Asistencia Médica – HASTA $ 15.000 en la Argentina.<br>                                • Atención en consultorio o domicilio.<br> • Consultas con especialistas.<br> • Exámenes médicos complementarios.<br> • Internaciones clínicas o quirúrgicas.<br> • Intervenciones quirúrgicas.<br> • Terapia intensiva y unidad
                  coronaria.
                  <br> • Odontología – HASTA $ 300 Nacional.<br> • Medicamentos- HASTA $500- Nacional.<br> • Gastos de hotelería del beneficiario por convalecencia.<br>
                  <br> Traslados:
                  <br> • Traslados sanitarios.<br> • Traslado hasta el lugar de internación y gastos de hotel del familiar del beneficiario. (internaciones mayores de 4 días)<br> • Traslado de restos en caso de fallecimiento.<br> • Traslado
                  de beneficiarios acompañantes del familiar fallecido.<br> • Traslado urgente de beneficiarios a su lugar de residencia por fallecimiento de familiar hasta 2º grado.<br> • Traslado urgente del titular por ocurrencia de siniestro
                  en su domicilio.<br> Puesta a disposición de un pasaje por enfermedad o accidente del beneficiario, que le imposibilite el retorno con las condiciones del pasaje adquirido. Acompañamiento de menores de 15 años o de beneficiarios
                  mayores de 80 años.<br> Asistencia para localización de equipaje extraviado o robado a nivel nacional.<br> Asistencia por pérdida de documentos o tarjeta de crédito y transmisión de mensajes urgentes. Cantidad de días y
                  topes asistenciales son por viaje y por persona. Recuerde ante cualquier imprevisto debe comunicarse a los siguientes números:
                  <br> ARGENTINA - BUENOS AIRES<br>
                  <b>0800-999-6400, 011-4323-7700/7777</b><br>
                </p>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
