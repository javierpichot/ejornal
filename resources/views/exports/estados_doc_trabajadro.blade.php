@php
    $fechas_feriado = App\Models\Calendario::where('tipo', true)->get();
    $raya = [];
    $entrega = '';
    $alt = '';
    $fecha_cobertura= date('Y-m-d', strtotime("+".$documentacion->reposo." day", strtotime($documentacion->fecha_documento)));

    foreach ($fechas_feriado as $key => $fecha) {
      $raya[] = $fecha->fecha_feriado;
    }

    while (in_array($fecha_cobertura, $raya)) {
        $fecha_cobertura = date('Y-m-d', strtotime("+ 1 day", strtotime($fecha_cobertura)));
    }

    if ($documentacion->documentacion_tipo_id == 1) {

      if ((new DateTime($fecha_cobertura) >= new DateTime($documentacion->fecha_incorporacion)) or ($documentacion->fecha_incorporacion == "")) {
        $cubierto = true;
      } else {
        $cubierto = false;
        $alt = 'Incorporacion posterior a fecha de cobertura certificado.';
      }

      if (($documentacion->fecha_entrega<=$documentacion->fecha_incorporacion) or ($documentacion->fecha_incorporacion=="")) {
        $entrega = true;
      } else {
        $entrega = false;
        $alt = "Fecha de entrega posterior a fecha de incorporacion.";
      }

      if ($documentacion->institucion == '') {
        $alt = "Certificado sin aval institucional. ";
      }

      if ($documentacion->medico == '') {
        $alt = "Certificado sin firma o sello de médico. ";
      }

      if ($documentacion->diagnostico == '') {
        $alt = "Certificado sin diagnostico. ";
      }
@endphp
@if ($documentacion->documentacion_tipo_id == 1)

    @if ($documentacion->diagnostico != "" && $documentacion->medico != "" && $documentacion->institucion != ""  && $cubierto == true  && $entrega == true)
        <button class="btn btn-success" type="button" name="button" title=" @php
            print $alt;
        @endphp">Regular</button>
    @else
        <button class="btn btn-danger" type="button" name="button" title=" @php
            print $alt;
        @endphp">Irregular</button>
    @endif

@endif
@php
    }
@endphp
