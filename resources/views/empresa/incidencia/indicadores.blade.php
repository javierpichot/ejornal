@php
    $fechas_feriado = App\Models\Calendario::where('tipo', true)->get();
    $raya = [];
@endphp

@foreach ($fechas_feriado as $key => $fecha)
    @php
        $raya[] = $fecha->fecha_feriado
    @endphp
@endforeach

@if (in_array($fecha_ausente,$raya))
    Baja postferiado/Fin de semana
@endif


@if (in_array($fecha_probable_alta,$raya))
    Probable alta feriado/Fin de semana
@endif

@if (in_array($fecha_alta,$raya))
    Alta feriado/Fin de semana
@endif
