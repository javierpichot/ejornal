@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de ausentismo de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de episodios de ausentismo</li>		 </ol>
    </nav>

 <div class="card">
                  @include('trabajador.profile.partials.nav_menu_empresa')
                  <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <span class="navbar-text text-black text-black-50">Filtrar datos por año</span>
                        <form action="{{ route('trabajador.estadisticas.show_post', ['id' =>  $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )}}" class="navbar-form navbar-right" role="search" method="post">
                            @csrf
                                       <div class="input-group">
                                       <input id="fecha_ausencia_anual" type="text" class="form-control" placeholder="Filtrar por año" name="fecha_ausencia_anual" value="{{ $year }}">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Filtrar!</button>
                          </span>
                        </div><!-- /input-group -->
                                      </form>
                        </div>
                      </nav>
				<div class="card-body">
	<div class="row">

		<div class="col-md-3">
			@include('trabajador.profile.partials.panel')
		</div>

        


    <div class="row">
        
        <div class="col-md-3">
            <!-- Bar chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Dias ausencias vs Naturaleza</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="ausencia_naturaleza" style="height:250px"></canvas>
                </div>
                <!-- /.box-body-->
            </div>
    </div>

            <!-- /.box -->
        <div class="col-md-5">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Dias ausencias anual</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="ausencias_anual" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>

    </div>
    <div class="row">
          <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº ausencias VS Institucion</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="documents_institucion" width="300" height="300"></canvas>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº ausencias VS facultativo</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
      <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº consultas VS naturaleza</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="consulta_naturaleza" style="height:250px"></canvas>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº consultas anual</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                  <canvas id="consultas_anual" height="450" width="600"></canvas>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº incidencias/accidentes tipos</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="incidencia_accidente_tipos" width="300" height="300"/>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">

            <!-- Donut chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>

                    <h3 class="box-title">Nº incidencias/accidentes anual</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="incidencias_accidentes_anual" width="300" height="300"></canvas>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </div>
    </div>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-calculator"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Promedio dias por ausentismo</span>
              <span class="info-box-number">{{$ausentismo_anual_widget}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-calculator"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Frecuencia ausentista</span>
              <span class="info-box-number">Cada {{$ausentismo_anual_widget2}} días</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Top dia de la semana Baja </span>
              <span class="info-box-number">Jueves</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Top día de la semana Alta</span>
              <span class="info-box-number">Sábado</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
@endsection

@push('script')
    <script src="https://www.chartjs.org/dist/2.7.3/Chart.bundle.js" charset="utf-8"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js" type="text/javascript"></script>


    <script type="text/javascript">
    
        (function ($) {
            $('#fecha_ausencia_anual').datetimepicker({
				   format: 'YYYY',
				   locale: 'es-us'
			   });
            var randomScalingFactor = function() {
                return Math.ceil(Math.random() * 10.0) * Math.pow(10, Math.ceil(Math.random() * 5));
            };

            var documents = {
        		type: 'line',
        		data: {
        			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        			datasets: [{
        				label: 'Ausencias',
        				backgroundColor: window.chartColors.orange,
        				borderColor: window.chartColors.orange,
        				fill: false,
        				data: [
        					{{ $documentacion_ausencia_ene->count() }},
        					{{ $documentacion_ausencia_feb->count() }},
        					{{ $documentacion_ausencia_mar->count() }},
        					{{ $documentacion_ausencia_abr->count() }},
        					{{ $documentacion_ausencia_may->count() }},
        					{{ $documentacion_ausencia_jun->count() }},
        					{{ $documentacion_ausencia_jul->count() }},
                            {{ $documentacion_ausencia_ago->count() }},
                            {{ $documentacion_ausencia_sep->count() }},
                            {{ $documentacion_ausencia_oct->count() }},
                            {{ $documentacion_ausencia_nov->count() }},
                            {{ $documentacion_ausencia_dic->count() }}
        				],
        			}]
        		},
        		options: {
        			responsive: true,
        			title: {
        				display: true,
        			},
        			scales: {
        				xAxes: [{
        					display: true,
        				}],
        				yAxes: [{
        					display: true,
        				}]
        			}
        		}
        	};

	var config = {
		type: 'line',
		data: {
			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			datasets: [{
				label: 'Accidentes',
				backgroundColor: window.chartColors.red,
				borderColor: window.chartColors.red,
				fill: false,
				data: [
					{{ $accidentes_enero->count() }},
					{{ $accidentes_febrero->count() }},
					{{ $accidentes_marzo->count() }},
					{{ $accidentes_abril->count() }},
					{{ $accidentes_mayo->count() }},
					{{ $accidentes_junio->count() }},
					{{ $accidentes_julio->count() }},
                    {{ $accidentes_agosto->count() }},
                    {{ $accidentes_sep->count() }},
                    {{ $accidentes_oct->count() }},
                    {{ $accidentes_nov->count() }},
                    {{ $accidentes_dic->count() }}
				],
			}, {
				label: 'Incidentes',
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				fill: false,
				data: [
					{{ $incidencia_enero->count() }},
					{{ $incidencia_febrero->count() }},
					{{ $incidencia_marzo->count() }},
					{{ $incidencia_abril->count() }},
					{{ $incidencia_mayo->count() }},
					{{ $incidencia_junio->count() }},
					{{ $incidencia_julio->count() }},
                    {{ $incidencia_agosto->count() }},
                    {{ $incidencia_sep->count() }},
                    {{ $incidencia_oct->count() }},
                    {{ $incidencia_nov->count() }},
                    {{ $incidencia_dic->count() }}
				],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: true,
			},
			scales: {
				xAxes: [{
					display: true,
				}],
				yAxes: [{
					display: true,
				}]
			}
		}
	};





        var ausencia_naturaleza = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
                        @forelse ($ausentismo_alergo as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse

                        @forelse ($ausentismo_angio as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse

                        @forelse ($ausentismo_cardio as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse

                        @forelse ($ausentismo_gastro as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse

                        @forelse ($ausentismo_derma as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_endocrino as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_hemato as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
             @forelse ($ausentismo_infecto as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_nefro as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_neumo as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
             @forelse ($ausentismo_neuro as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_odonto as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_oftalmo as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse

             @forelse ($ausentismo_otorrino as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_onco as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_procto as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse       
             @forelse ($ausentismo_psiqui as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_reumato as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse
                        @forelse ($ausentismo_trauma as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse 
        @forelse ($ausentismo_toxico as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse     
        @forelse ($ausentismo_uro as $key => $row)
                        @php
                            $startTime = Carbon::parse($row['fecha_ausente']);
                            $finishTime = Carbon::parse($row['fecha_alta']);
                        @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                        @empty
                            0,
                        @endforelse               
					],
					backgroundColor: [
            //Falta añadir 21 colores rrandom
window.chartColors.orange,
            window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.green,
						window.chartColors.blue,
                        window.chartColors.purple,
                        window.chartColors.grey
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Alergología',
					'Angiología',
					'Cardiología',
					'Gastroenterología',
					'Dermatología',
          'Endocrinología',
           'Hematologia',
	        'Infectología',
					'Nefrología',
					'Cardiología',
					'Neumología',
					'Neurología',
          'Odontología',
         'Oftalmologia',
           'Otorrinolaringología',   
         	'Oncología',
					'Proctología',
					'Psiquiatria',
					'Reumatología',
					'Traumatología',
          'Toxicología',
           'Urología'
				]
			},
        			options: {
        				responsive: true,
                   legend: {
      labels: {
        filter: function(item, chart) {
          // Logic to remove a particular legend item goes here
          return !chart.datasets[0].data[item.index] == 0;
        }
      }
    }
        			}
		};



                var consulta_naturaleza = {
        			type: 'pie',
        			data: {
        				datasets: [{
        					data: [
        					 {{ $consulta_alergo->count() }},  
        {{ $consulta_angio->count() }},  
        {{ $consulta_cardio->count() }}, 
        {{ $consulta_gastro->count() }}, 
        {{ $consulta_derma->count() }},  
        {{ $consulta_endocrino->count() }}, 
        {{ $consulta_hemato->count() }},  
        {{ $consulta_infecto->count() }}, 
        {{ $consulta_nefro->count() }}, 
        {{ $consulta_neumo->count() }},  
        {{ $consulta_neuro->count() }},          
{{ $consulta_odonto->count() }},  
        {{ $consulta_oftalmo->count() }},
        {{ $consulta_otorrino->count() }}, 
        {{ $consulta_onco->count() }},
        {{ $consulta_procto->count() }}, 
        {{ $consulta_psiqui->count() }}, 
        {{ $consulta_reumato->count() }},  
        {{ $consulta_trauma->count() }},  
        {{ $consulta_toxico->count() }}, 
        {{ $consulta_uro->count() }}
        					],
        					backgroundColor: [
        						window.chartColors.red,
        						window.chartColors.orange,
        						window.chartColors.yellow,
        						window.chartColors.green,
        						window.chartColors.blue,
                                window.chartColors.purple,
                                window.chartColors.grey
        					],
        					label: 'Dataset 1'
        				}],

				labels: [
					'Alergología',
					'Angiología',
					'Cardiología',
					'Gastroenterología',
					'Dermatología',
          'Endocrinología',
           'Hematologia',
	        'Infectología',
					'Nefrología',
					'Cardiología',
					'Neumología',
					'Neurología',
          'Odontología',
         'Oftalmologia',
           'Otorrinolaringología',   
         	'Oncología',
					'Proctología',
					'Psiquiatria',
					'Reumatología',
					'Traumatología',
          'Toxicología',
           'Urología'
				]
			},
        			options: {
        				responsive: true,
                   legend: {
      labels: {
        filter: function(item, chart) {
          // Logic to remove a particular legend item goes here
          return !chart.datasets[0].data[item.index] == 0;
        }
      }
    }
        			}
        		};




        var color = Chart.helpers.color;


        var dias_ausen = {
			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			datasets: [{
				label: 'Dias de ausencia',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
                    @isset($ausentismos_anuales[$year."-01"])
                        {{ count($ausentismos_anuales[$year."-01"]) }},
                    @endisset

                    @empty($ausentismos_anuales[$year."-01"]) 0, @endempty

                    @isset($ausentismos_anuales[$year."-02"])
                        {{ count($ausentismos_anuales[$year."-02"]) }},
                    @endisset

                    @empty($ausentismos_anuales[$year."-02"]) 0, @endempty

                    @isset($ausentismos_anuales[$year."-03"])
                        {{ count($ausentismos_anuales[$year."-03"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-03"]) 0, @endempty


                    @isset($ausentismos_anuales[$year."-04"])
                        {{ count($ausentismos_anuales[$year."-04"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-04"]) 0, @endempty



                    @isset($ausentismos_anuales[$year."-05"])
                        {{ count($ausentismos_anuales[$year."-05"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-05"]) 0, @endempty


                    @isset($ausentismos_anuales[$year."-06"])
                        {{ count($ausentismos_anuales[$year."-06"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-06"]) 0, @endempty

                    @isset($ausentismos_anuales[$year."-07"])
                        {{ count($ausentismos_anuales[$year."-07"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-07"]) 0, @endempty

                    @isset($ausentismos_anuales[$year."-08"])
                        {{ count($ausentismos_anuales[$year."-08"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-08"]) 0, @endempty

                    @isset($ausentismos_anuales[$year."-09"])
                        {{ count($ausentismos_anuales[$year."-09"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-09"]) 0, @endempty


                    @isset($ausentismos_anuales[$year."-10"])
                        {{ count($ausentismos_anuales[$year."-10"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-10"]) 0, @endempty


                    @isset($ausentismos_anuales[$year."-11"])
                        {{ count($ausentismos_anuales[$year."-11"]) }},
                    @endisset
                    @empty($ausentismos_anuales[$year."-11"]) 0, @endempty


                    @isset($ausentismos_anuales[$year."-12"])
                        {{ count($ausentismos_anuales[$year."-12"]) }}
                    @endisset
                    @empty($ausentismos_anuales[$year."-12"]) 0, @endempty
				]
			}
        ]

		};


        var consultas_anual = {
			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			datasets: [{
				label: 'Total de consultas en el paciente '+ "{{ $trabajador->nombre }}  {{ $trabajador->apellido }}",
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
        
				data: [
					{{ $consulta_ene->count() }},
					{{ $consulta_feb->count() }},
					{{ $consulta_mar->count() }},
					{{ $consulta_abr->count() }},
					{{ $consulta_may->count() }},
					{{ $consulta_jun->count() }},
					{{ $consulta_jul->count() }},
          {{ $consulta_ago->count() }},
          {{ $consulta_sep->count() }},
          {{ $consulta_oct->count() }},
          {{ $consulta_nov->count() }},
          {{ $consulta_dic->count() }}
				]
			}
        ]

		};


        var MONTHS = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

		var incidencia_accidente_tipos = {
			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			datasets: [{
				label: 'Accidente',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					{{ $accidentes_enero->count() }},
					{{ $accidentes_febrero->count() }},
					{{ $accidentes_marzo->count() }},
					{{ $accidentes_abril->count() }},
					{{ $accidentes_mayo->count() }},
					{{ $accidentes_junio->count() }},
					{{ $accidentes_julio->count() }},
          {{ $accidentes_agosto->count() }},
          {{ $accidentes_sep->count() }},
          {{ $accidentes_oct->count() }},
          {{ $accidentes_nov->count() }},
          {{ $accidentes_dic->count() }}
				]
			}, {
				label: 'Accidente in itinere',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					{{ $accidentes_iti_enero->count() }},
					{{ $accidentes_iti_febrero->count() }},
					{{ $accidentes_iti_marzo->count() }},
					{{ $accidentes_iti_abril->count() }},
					{{ $accidentes_iti_mayo->count() }},
					{{ $accidentes_iti_junio->count() }},
					{{ $accidentes_iti_julio->count() }},
                    {{ $accidentes_iti_agosto->count() }},
                    {{ $accidentes_iti_sep->count() }},
                    {{ $accidentes_iti_oct->count() }},
                    {{ $accidentes_iti_nov->count() }},
                    {{ $accidentes_iti_dic->count() }}
				]
			},
            {
				label: 'Incidente',
				backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
				borderColor: window.chartColors.purple,
				borderWidth: 1,
				data: [
					{{ $incidencia_enero->count() }},
					{{ $incidencia_febrero->count() }},
					{{ $incidencia_marzo->count() }},
					{{ $incidencia_abril->count() }},
					{{ $incidencia_mayo->count() }},
					{{ $incidencia_junio->count() }},
					{{ $incidencia_julio->count() }},
                    {{ $incidencia_agosto->count() }},
                    {{ $incidencia_sep->count() }},
                    {{ $incidencia_oct->count() }},
                    {{ $incidencia_nov->count() }},
                    {{ $incidencia_dic->count() }}
				]
			}
        ]

		};





	window.onload = function() {
		var ctx = document.getElementById('incidencias_accidentes_anual').getContext('2d');
		window.myLine = new Chart(ctx, config);

        var doc = document.getElementById('documents_institucion').getContext('2d');
		window.myLine = new Chart(doc, documents);


        var ausencias_nat = document.getElementById('ausencia_naturaleza').getContext('2d');
		window.myPie = new Chart(ausencias_nat, ausencia_naturaleza);

        var consulta_nat = document.getElementById('consulta_naturaleza').getContext('2d');
		window.consulta_natural = new Chart(consulta_nat, consulta_naturaleza);


        var ausencias_anual = document.getElementById('ausencias_anual').getContext('2d');
			window.myBar = new Chart(ausencias_anual, {
				type: 'bar',
				data: dias_ausen,
							options: {
                scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true,
                 userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }

                 },
             }
         }],
     },
					responsive: true,
		
  legend: {
    display: false,
      labels: {
        display: false
      }
  
}  
				}
			});


        var consul_anual = document.getElementById('consultas_anual').getContext('2d');
			window.myBar = new Chart(consul_anual, {
				type: 'bar',
				data: consultas_anual,
				options: {
          scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true,
                 userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }

                 },
             }
         }],
     },
					responsive: true,
		
  legend: {
    display: false,
      labels: {
        display: false
      }
  
}  
				}
			});


        var incidencia_accidente_tip = document.getElementById('incidencia_accidente_tipos').getContext('2d');
			window.myBar = new Chart(incidencia_accidente_tip, {
				type: 'bar',
				data: incidencia_accidente_tipos,
				options: {
          scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true,
                 userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }

                 },
             }
         }],
     },
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Tipos de accidentes'
					}
				}
			});
        /*var ctx = document.getElementById('ausencias_anual').getContext('2d');
    			window.myBar = new Chart(ctx, {
    				type: 'bar',
    				data: barChartData,
    				options: {
    					title: {
    						display: true,
    						text: 'Dias ausente por mes durante el año ' + {{ Carbon\Carbon::now()->format('Y') }}
    					},
    					tooltips: {
    						mode: 'index',
    						intersect: false
    					},
    					responsive: true,
    					scales: {
    						xAxes: [{
    							stacked: true,
    						}],
    						yAxes: [{
    							stacked: true
    						}]
    					}
    				}
    			});*/

	};


        })(jQuery);

    </script>
@endpush
