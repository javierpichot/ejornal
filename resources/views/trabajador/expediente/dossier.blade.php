@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de expediente')

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    <!-- INICIO Breadcrumb-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard
                    de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado
                    de trabajadores</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil
                    de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dossier de ausentismo</li>
        </ol>
    </nav>

    <!-- FIN Breadcrumb-->

    <!-- INICIO DOSSIER AUSENTISMO-->

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="user-block">
                        <img class="img-circle"
                             src="{{ '/storage/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id.'/perfil/'. $trabajador->photo}}"
                             alt="{{ $trabajador->nombre }}">
                        <span class="username"><a
                                    href="#">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></span>

                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-body">
                    <p>Documento: {{ $trabajador->documento }}</p>
                    <p>Dossier ausentismo # {{ $ausentismo->id }} {{ $ausentismo->motivo }}
                        ( {{ $ausentismo->ausentismo_tipo->nombre }} )</p>
                    <p>Antigüedad empresa: {{ $trabajador->fecha_contrato or ''}}</p>
                    <p>Carga laboral episodio</p>
                    <p>Inicio: {{ $ausentismo->fecha_ausente }} Fin: {{ $ausentismo->fecha_alta }}</p>
                    <p>
                        Indicadores: @include('trabajador.expediente.indicadores', ['fecha_ausente' => $ausentismo->fecha_ausente, 'fecha_alta' => $ausentismo->fecha_alta, 'fecha_probable_alta' => $ausentismo->fecha_probable_alta])</p>
                    <p>Carga laboral acumulada:</p>
                </div>
            </div>
        </div>
        <!-- FIN DOSSIER AUSENTISMO-->

        <!-- INICIO TIME LINE-->
    @php
        //Obtiene los dias de ausencia y los mete en un array $dias o $dias_print

        $period=    new DatePeriod(
                    new DateTime($ausentismo->fecha_ausente),
                    new DateInterval('P1D'),
                    new DateTime($ausentismo->fecha_alta));

        foreach ($period as $key => $value)
        {
          $dias[] = $value->format('Y-m-d');
          $dias_print[] = $value->format('d/m/Y');
        }
        $cobertura_dias = Array();
        //Obtiene los días de feriado Pana habira que ver si tiene en cuenta la empresa creo que no
                    $feriados=['2018-09-04','2018-09-05'];
        //Obtiene los dias que le cubre por certificados y regularidad. Llamar a las funcion.
;
  function in_array_r($item , $array){
return preg_match('/"'.preg_quote($item, '/').'"/i' , json_encode($array));
}
    @endphp


    <!-- EMPIEZA EL RECORRIDO POR EL TIME LINE-->
        <div class="col-md-9">
            <ul class="timeline">
            @foreach ($dias as $key => $dia)


                <!-- EMPIEZA LA IMPRESION DE EVENTOS-->

                    <!-- IMPRIMEN LOS DOCUMENTOS ASOCIADOS AL EPISODIO DE AUSENTISMO-->
                    @foreach ($ausentismo->documentacion as $key => $documentacion)


                        @if ($documentacion->documentacion_tipo_id == 1)

                            @php

                                $comprobar = new App\Helpers\ComprobarDocumentacion();

                                $array_cobertura[]= $comprobar->array_cobertura($documentacion->fecha_documento,$documentacion->reposo, $documentacion->documentacion_tipo_id,$documentacion->fecha_incorporacion,$documentacion->fecha_entrega,$documentacion->institucion,$documentacion->medico,$documentacion->diagnostico);

  $estado[$documentacion->fecha_documento] = $comprobar->comprobar_regularidad($documentacion->fecha_documento,$documentacion->reposo, $documentacion->documentacion_tipo_id,$documentacion->fecha_incorporacion,$documentacion->fecha_entrega,$documentacion->institucion,$documentacion->medico,$documentacion->diagnostico);


if(in_array_r($dia , $array_cobertura)){
$fondo= "bg-green";}else{
  $fondo="bg-red";
  }

                            @endphp

                        @endif
                    @endforeach


                    <li class="time-label">
                        <!-- SI TIENE CUBIERTO EL DIA SE PINTA DE VERDE-->
                        <span class="  {{ $fondo or 'bg-red' }}">
			                      {{ $dia }}
                                  <!-- SI EL DIA ES FERIADO APARECE UNA CAMA COMO ICONO-->
                                      @if (in_array($dia,$feriados))
                                          <i class="fa fa-hotel" aria-hidden="true" title="Feriado"></i>
                                      @else
                                          <i class="fa fa-wrench" aria-hidden="true" title="Dia laboral"></i>
                                      @endif
			                </span>
                    </li>
                    @foreach ($ausentismo->documentacion as $key => $documentacion)

                    <!-- ARREGLO PARA QUE SOLO MUESTRE EL DOCUMENTO EN SU DIA-->
                        @if (\Carbon\Carbon::parse($documentacion->fecha_documento)->format('Y-m-d') == $dia)
                            <li>
                                <i class="fa fa-camera bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i
                                                class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($documentacion->created_at)->format('H:i') }}</span>

                                    <h3 class="timeline-header"><a
                                                href="#">{{ $documentacion->user->nombre }} {{ $documentacion->user->apellido }}
                                            registró nueva documentación</a></h3>

                                    <div class="timeline-body">
                                        <b>{{ $documentacion->documentacion_tipo->nombre }}:</b>

                                        @if ($estado[$dia]!="") @php print "Irregular: ".$estado[$dia] @endphp @else
                                            Regular @endif
                                        <br><b>Fecha de emision:</b> {{ $documentacion->fecha_documento }}
                                        <br><b>Fecha de incorporacion:</b> {{ $documentacion->fecha_incorporacion }}
                                        <br><b>Fecha de entrega:</b> {{ $documentacion->fecha_entrega }}

                                        <br><b>Días de reposo:</b> {{ $documentacion->reposo }}
                                        <br><b>Diagnostico:</b> {{ $documentacion->diagnostico }}
                                        <br><b>Institucion::</b> {{ $documentacion->institucion }}
                                        <br><b>Facultativo:</b> {{ $documentacion->medico }}
                                        (MN: {{ $documentacion->matricula_nacional }})
                                        (MP: {{ $documentacion->matricula_provincial }})
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach


                <!-- IMPRIMEN LAS COMUNICACIONES ASOCIADAS AL EPISODIO DE AUSENTISMO-->
                    @foreach ($ausentismo->comunicacion as $key => $comunicacion)
                    <!-- ARREGLO PARA QUE SOLO MUESTRE LA COMUNICACION EN SU DIA-->
                        @if (\Carbon\Carbon::parse($comunicacion->created_at)->format('Y-m-d') == $dia)
                            <li>
                                <i class="fa fa-comments bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i
                                                class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($comunicacion->created_at)->format('H:i') }}</span>
                                    <h3 class="timeline-header"><a
                                                href="#">{{ $comunicacion->user->nombre }} {{ $comunicacion->user->apellido }}
                                            registró nueva comunicación</a></h3>
                                    <div class="timeline-body">
                                        <b>Remitente:</b> {{ $comunicacion->remitente->nombre }}
                                        <br><b>Modo de comunicación:</b> {{ $comunicacion->modo_comunicacion->nombre }}
                                        <br><b>Motivo de
                                            comunicación:</b> {{ $comunicacion->motivo_comunicacion->nombre }}
                                        <br><b>Contenido comunicación:</b> <i>{{ $comunicacion->contenido }}</i>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach


                <!-- IMPRIMEN LAS CONSULTAS ASOCIADAS AL EPISODIO DE AUSENTISMO-->
                    @foreach ($ausentismo->consulta as $key => $consulta)
                    <!-- ARREGLO PARA QUE SOLO MUESTRE LA COMUNICACION EN SU DIA-->
                        @if (\Carbon\Carbon::parse($consulta->created_at)->format('Y-m-d') == $dia)
                            <li>
                                <i class="fa fa-user-md bg-green"></i>

                                <div class="timeline-item">
                                    <span class="time"><i
                                                class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($consulta->created_at)->format('H:i') }}</span>

                                    <h3 class="timeline-header"><a
                                                href="#">{{ $consulta->user->nombre }} {{ $consulta->user->apellido }}
                                            registró nueva consulta</a></h3>

                                    <div class="timeline-body">
                                        <b>Diagnóstico:</b> {{ $consulta->diagnostico }}
                                        <br><b>Reposo:</b> {{ $consulta->consulta_reposo}}
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                <!-- FIN DE MOSTRAR EVENTOS ASOCIADOS A AUSENTISMOS -->
                @endforeach
            </ul>
        </div>
    </div>
@endsection
