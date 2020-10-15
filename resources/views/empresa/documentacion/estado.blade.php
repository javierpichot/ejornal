@php
    $fechas_feriado = App\Models\Calendario::where('tipo', true)->get();
    $raya = [];
    $entrega = '';
    $alt = '';
    $fecha_cobertura= date('Y-m-d', strtotime("+".$documentacion->reposo." day", strtotime($documentacion->fecha_baja)));
@endphp

@foreach ($fechas_feriado as $key => $fecha)
    @php
        $raya[] = $fecha->fecha_feriado
    @endphp
@endforeach

@if ($documentacion->documentacion_tipo_id == 1)
    @if ((new DateTime($fecha_cobertura) >= new DateTime($documentacion->fecha_incorporacion)) or ($documentacion->fecha_incorporacion == ""))
        @php
            $cubierto = true;
        @endphp

        @else

            @php
                $cubierto = false;
                $alt = 'Incorporacion posterior a fecha de cobertura certificado.';
            @endphp
    @endif

    @if (($documentacion->created_at<=$documentacion->fecha_incorporacion) or ($documentacion->fecha_incorporacion==""))
        @php
            $entrega = true;
        @endphp

        @else

            @php
                $entrega = false;
                $alt = "Fecha de entrega posterior a fecha de incorporacion.";
            @endphp
    @endif


    @if ($documentacion->institucion == '')
        @php
            $alt = "Certificado sin aval institucional. ";
        @endphp
    @endif

    @if ($documentacion->medico == '')
        @php
            $alt = "Certificado sin firma o sello de médico. ";
        @endphp
    @endif

    @if ($documentacion->diagnostico == '')
        @php
            $alt = "Certificado sin diagnostico. ";
        @endphp
    @endif

    @if ($documentacion->notifico == true && $documentacion->diagnostico != "" && $documentacion->medico != "" && $documentacion->institucion != ""  && $cubierto == true  && $entrega == true)
            <button class="btn btn-success" type="button" name="button">Regular</button>
        @else
            <button class="btn btn-danger" type="button" name="button">Irregular</button>
    @endif

@endif
