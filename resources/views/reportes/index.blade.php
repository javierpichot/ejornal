@extends('adminlte::layouts.app')

    @section('titulo', 'Gestion de reportes '. $empresa->nombre)




@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection


@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de reportes</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de comunicación</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteComunicacion']) !!}
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <div class="box-body">
                        <div class="col-xs-4">
                            {{ Form::label('fecha_inicio', "Fecha inicio") }}
                            <div id="fecha_cita" class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio']) }}
                                <span class="help-block" id="fecha_inicio"></span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            {{ Form::label('fecha_fin', "Fecha fín") }}
                            <div id="fecha_fin" class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin']) }}
                                <span class="help-block" id="fecha_fin"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                    </div>
                    <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de documentacion recibida</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteDocumetacionTrabajadores']) !!}
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <div class="box-body">
                        <div class="col-xs-4">
                            {{ Form::label('fecha_inicio', "Fecha inicio") }}
                            <div id="fecha_cita" class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio_trabajador']) }}
                                <span class="help-block" id="fecha_inicio"></span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            {{ Form::label('fecha_fin', "Fecha fín") }}
                            <div id="fecha_fin" class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin_trabajador']) }}
                                <span class="help-block" id="fecha_fin"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                    </div>
                    <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de consultas de trabajadores</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteConsultas']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="box-body">
                    <div class="col-xs-4">
                        {{ Form::label('fecha_inicio', "Fecha inicio") }}
                        <div id="fecha_cita" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_inicio"></span>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('fecha_fin', "Fecha fín") }}
                        <div id="fecha_fin" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_fin"></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                </div>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de médico a domicilio</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteConsultas']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="box-body">
                    <div class="col-xs-4">
                        {{ Form::label('fecha_inicio', "Fecha inicio") }}
                        <div id="fecha_cita" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_inicio"></span>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('fecha_fin', "Fecha fín") }}
                        <div id="fecha_fin" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_fin"></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                </div>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de medicacion</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'empresa.exportsFarmacosHistoricos']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

                <!-- /.box-body -->
               <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteConsultas']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="box-body">
                    <div class="col-xs-4">
                        {{ Form::label('fecha_inicio', "Fecha inicio") }}
                        <div id="fecha_cita" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_inicio"></span>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('fecha_fin', "Fecha fín") }}
                        <div id="fecha_fin" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_fin"></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                </div>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
      <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Reportes de salidas</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'empresa.exportsFarmacosHistoricos']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

                <!-- /.box-body -->
               <!-- form start -->
                {!! Form::open(['route' => 'reporte.downloadReporteConsultas']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="box-body">
                    <div class="col-xs-4">
                        {{ Form::label('fecha_inicio', "Fecha inicio") }}
                        <div id="fecha_cita" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_inicio"></span>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        {{ Form::label('fecha_fin', "Fecha fín") }}
                        <div id="fecha_fin" class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin_trabajador_consulta']) }}
                            <span class="help-block" id="fecha_fin"></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Descargar reporte</button>
                </div>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
    </div>



@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $('#fecha_inicio').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_fin').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_inicio_empresa').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_fin_empresa').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_inicio_trabajador').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_fin_trabajador').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_inicio_trabajador_consulta').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#fecha_fin_trabajador_consulta').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });
        });
    </script>
@endpush
