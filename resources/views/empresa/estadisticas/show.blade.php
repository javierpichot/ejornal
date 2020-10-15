@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de ausentismo de '. $empresa->nombre)

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard
                    de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Estadisticas</a>
            </li>
        </ol>
    </nav>

    <nav class="navbar navbar-default">
            <div class="container-fluid">
                <span class="navbar-text text-black text-black-50">Filtrar datos por año</span>
            <form action="{{ route('empresa.estadisticas.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}" class="navbar-form navbar-right" role="search" method="post">
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

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    @include('empresa.profile.partials.panel')
                </div>

                


                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-user-times"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ausentismo actual</span>
                            <span class="info-box-number">{{number_format($ausentismo_actual,2,',','.')}}% ({{$numero_ausentistas}} personas)</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-calculator"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Promedio dias por ausentismo</span>
                            <span class="info-box-number">{{number_format($promedio,2,',','.')}} días</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
<div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">IT por accidente laboral</span>
                            <span class="info-box-number">@isset($total_trabajadores_ausentes)
                                    {{$ausentismo_por_accidente}}
                                @endisset personas</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>






                <div class="col col-md-9">
                    <!-- Donut chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Ausentismos evolución comparativa</h3>

                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="canvas" style="height:540px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="row">
                <div class="col-md-3">


                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top 10 ausentistas (frec) </h3>

                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 250px; overflow-y: scroll;">
                            <ul class="products-list product-list-in-box">
                                @foreach ($top_ten_trabajadores_veces as $key => $trabajador)

                                    <li class="item">
                                        <div class="product-img">
                                            <a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">
                                                <img src="{{ isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo . '') : asset('img/avatar5.png')}}"
                                                     height="40" alt="Product Image" class="img-circle elevation-2"
                                                     width="35px"</a>
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)"
                                               class="product-title">{{$trabajador-> nombre}} {{$trabajador-> apellido}}
                                                <span class="label label-warning pull-right">{{$trabajador->ausentismo_count}}</span></a>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.box-body -->


                    <!-- /.item -->
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-3">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top 10 ausentistas (acum) </h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 250px; overflow-y: scroll;">
                            <ul class="products-list product-list-in-box">
                                @foreach ($top_ten_trabajadores->values()->all() as $key => $trabajador)
                                    <li class="item">
                                        <div class="product-img">
                                            <a href="{{ route('trabajador.show', ['id' => $trabajador->trabajador->id, 'name' => $trabajador->trabajador->nombre, 'empresa_id' => $empresa->id]) }}">
                                                <img src="{{ isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->trabajador->id . '/perfil/'. $trabajador->trabajador->photo . '') : asset('img/avatar5.png')}}"
                                                     height="40" alt="Product Image" class="img-circle elevation-2"
                                                     width="35px"</a>
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)"
                                               class="product-title">{{$trabajador->trabajador->nombre}} {{$trabajador->trabajador->apellido}}
                                                <span class="label label-warning pull-right">{{ $trabajador->dias_ausente }}</span></a>

                                        </div>
                                    </li>
                            @endforeach
                            <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.box-body -->


                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>

                    <!-- /.box -->

                <div class="col-md-3">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top facultativos (Nº días otorgados) </h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 300px; overflow-y: scroll;">
                            <ul class="products-list product-list-in-box">
                                @foreach ($top_facultativos as $key => $facultativo)
                                    <li class="item">
                                        <div class="product-img">
                                            <a href="">
                                                <img src="{{asset('img/md.jpg')}}" height="40" alt="Product Image"
                                                     class="img-circle elevation-2" width="35px"></a>
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">{{$facultativo->medico}}
                                                <span class="label label-warning pull-right">{{$facultativo->reposa}}</span></a>

                                        </div>
                                    </li>
                            @endforeach
                            <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.box-body -->


                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top instituciones (Nº días otorgados)</h3>

                       
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 300px; overflow-y: scroll;">
                            <ul class="products-list product-list-in-box">
                                @foreach ($top_institucion as $key => $institucion)
                                    <li class="item">
                                        <div class="product-img">
                                            <a href="">
                                                <img src="{{asset('img/institucion.jpg')}}" height="40"
                                                     alt="Product Image" class="img-circle elevation-2" width="35px"</a>
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)"
                                               class="product-title">{{$institucion->institucion}}
                                                <span class="label label-warning pull-right">{{$institucion->reposi}}</span></a>

                                        </div>
                                    </li>
                            @endforeach
                            <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.box-body -->


                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
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

                <div class="col-md-4">

                    <!-- Donut chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Nº ausencias por especialidad</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="ausencia_por_consulta" width="300" height="300"></canvas>
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

                            <h3 class="box-title">Nº ausencias por tipo</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="ausencia_por_tipo" width="300" height="300"></canvas>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </div>

                <!--<div class="col col-md-12">

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

                    </div>

                </div>-->


                


                

            </div>
            </div>

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
            var color = Chart.helpers.color;
            var MONTHS = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            var COLORS = [
                '#4dc9f6',
                '#f67019',
                '#f53794',
                '#537bc4',
                '#acc236',
                '#166a8f',
                '#00a950',
                '#58595b',
                '#8549ba',
                '#7c8f47',
                '#00ffd2',
                '#fee'
            ];

            var ausencias_pato = {
                type: 'line',
                data: {
                    labels: MONTHS,
                    datasets: [{
                        label: 'Total de ausencias por patologia',
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        fill: false,
                        data: [
                            {{ $ausentismo_patologico_ene->count() }},
                            {{ $ausentismo_patologico_feb->count() }},
                            {{ $ausentismo_patologico_mar->count() }},
                            {{ $ausentismo_patologico_abr->count() }},
                            {{ $ausentismo_patologico_may->count() }},
                            {{ $ausentismo_patologico_jun->count() }},
                            {{ $ausentismo_patologico_jul->count() }},
                            {{ $ausentismo_patologico_ago->count() }},
                            {{ $ausentismo_patologico_sep->count() }},
                            {{ $ausentismo_patologico_oct->count() }},
                            {{ $ausentismo_patologico_nov->count() }},
                            {{ $ausentismo_patologico_dic->count() }}
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

            var patologia_duracion = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            @forelse ($ausentismo_patologico_duracion as $key => $row)
                            @php
                                $startTime = Carbon\Carbon::parse($row['fecha_ausente']);
                                $finishTime = Carbon\Carbon::parse($row['fecha_alta']);

                            @endphp
                           @if($finishTime)
                            {{ $finishTime->diffInDays($startTime) }},
                            @else
                                    @php
                                        $finishTime = \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m-d'));
                                    @endphp
                            {{ $finishTime->diffInDays($startTime) }},
                            @endif

                            @empty
                                0,
                            @endforelse
                        ],
                        backgroundColor: [
                            window.chartColors.green
                        ],
                        label: 'Duracion patologica'
                    }],
                    labels: [
                        'Duracion'
                    ]
                },
                options: {
                    responsive: true
                }
            };

            var config = {
                type: 'line',
                data: {
                    labels: MONTHS,
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
            }

            var accidentes = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [
                            {{ $ausentismo_anual_ene->count() }},
                            {{ $ausentismo_anual_feb->count() }},
                            {{ $ausentismo_anual_mar->count() }},
                            {{ $ausentismo_anual_abr->count() }},
                            {{ $ausentismo_anual_may->count() }},
                            {{ $ausentismo_anual_jun->count() }},
                            {{ $ausentismo_anual_jul->count() }},
                            {{ $ausentismo_anual_ago->count() }},
                            {{ $ausentismo_anual_sep->count() }},
                            {{ $ausentismo_anual_oct->count() }},
                            {{ $ausentismo_anual_nov->count() }},
                            {{ $ausentismo_anual_dic->count() }}
                        ],
                        backgroundColor: COLORS
                    }],
                    labels: MONTHS
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Ausentismo anual por mes (Cantidad)'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };

            var chartData = {
                labels: [
                    @forelse ($ausemcias_del_mes as $key => $row)
                    "{{ \Jenssegers\Date\Date::parse($key)->format('D') }} {{ \Jenssegers\Date\Date::parse($key)->format('d') }}",
                    @empty
                        0,
                    @endforelse
                ],
                datasets: [
                    {
                        type: 'bar',
                        label: 'Ausentismo durante el mes de {{ \Jenssegers\Date\Date::now()->format('F') }} filtrados por días',
                        backgroundColor: window.chartColors.red,
                        data: [
                            @forelse ($ausemcias_del_mes as $key => $row)
                                {{ $row }},
                            @empty
                                0,
                            @endforelse
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]

            };

            var ausentismo_por_consulta = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            @forelse ($ausemcias_por_consultas as $key => $row)
                                {{ $row->ausentismo_count }},
                            @empty
                                0,
                            @endforelse
                        ],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.yellow,
                            window.chartColors.green,
                            window.chartColors.blue,
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        @forelse ($ausemcias_por_consultas as $key => $row)
                            "{{ $row->nombre }}",
                        @empty
                            0,
                        @endforelse
                    ]
                },
                options: {
                    responsive: true
                }
            };


            var ausencia_tipo = {
        			data: {
        				datasets: [{
        					data: [
                    @foreach ($ausentismo_tipo as $key => $row)
                      {{ $row->ausentismo_count }},
                    @endforeach
        					],
        					backgroundColor: [
        						color(chartColors.red).alpha(0.5).rgbString(),
        						color(chartColors.orange).alpha(0.5).rgbString(),
        						color(chartColors.yellow).alpha(0.5).rgbString(),
        						color(chartColors.green).alpha(0.5).rgbString(),
        						color(chartColors.blue).alpha(0.5).rgbString(),
        					],
        					label: 'Tipo ausencia' // for legend
        				}],
        				labels: [
        					@forelse ($ausentismo_tipo as $key => $tipo)
                    "{{ $tipo->nombre }}",
                  @empty
                    "None"
                  @endforelse
        				]
        			},
        			options: {
        				responsive: true,
        				legend: {
        					position: 'right',
        				},
        				title: {
        					display: true,
        					text: 'Tipo de ausencias'
        				},
        				scale: {
        					ticks: {
        						beginAtZero: true
        					},
        					reverse: false
        				},
        				animation: {
        					animateRotate: false,
        					animateScale: true
        				}
        			}
        		};

            var barChartData = {
                labels: MONTHS,
                datasets: [{
                    label: 'Ausencias {{ $year - 1 }}',
                    backgroundColor: color(window.chartColors.grey).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.grey,
                    borderWidth: 1,
                    data: [
                        {{ $ausentismo_anual_ene_anter->count() }},
                        {{ $ausentismo_anual_feb_anter->count() }},
                        {{ $ausentismo_anual_mar_anter->count() }},
                        {{ $ausentismo_anual_abr_anter->count() }},
                        {{ $ausentismo_anual_may_anter->count() }},
                        {{ $ausentismo_anual_jun_anter->count() }},
                        {{ $ausentismo_anual_jul_anter->count() }},
                        {{ $ausentismo_anual_ago_anter->count() }},
                        {{ $ausentismo_anual_sep_anter->count() }},
                        {{ $ausentismo_anual_oct_anter->count() }},
                        {{ $ausentismo_anual_nov_anter->count() }},
                        {{ $ausentismo_anual_dic_anter->count() }}
                    ]
                }, {
                    label: 'Ausencias {{ $year }}',
                    backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.yellow,
                    borderWidth: 1,
                    data: [
                        {{ $ausentismo_anual_ene->count() }},
                        {{ $ausentismo_anual_feb->count() }},
                        {{ $ausentismo_anual_mar->count() }},
                        {{ $ausentismo_anual_abr->count() }},
                        {{ $ausentismo_anual_may->count() }},
                        {{ $ausentismo_anual_jun->count() }},
                        {{ $ausentismo_anual_jul->count() }},
                        {{ $ausentismo_anual_ago->count() }},
                        {{ $ausentismo_anual_sep->count() }},
                        {{ $ausentismo_anual_oct->count() }},
                        {{ $ausentismo_anual_nov->count() }},
                        {{ $ausentismo_anual_dic->count() }}
                    ]
                }]

            };

            window.onload = function() {



                var ctx = document.getElementById('incidencias_accidentes_anual').getContext('2d');
                window.myLine = new Chart(ctx, config);
 

                var ausentismo_round = document.getElementById('ausencia_por_consulta').getContext('2d');
                window.myPie = new Chart(ausentismo_round, ausentismo_por_consulta);

                var ausencia_t = document.getElementById('ausencia_por_tipo');
			          window.myPolarArea = Chart.PolarArea(ausencia_t, ausencia_tipo);

                var ctx_data = document.getElementById('canvas').getContext('2d');
                window.myBar = new Chart(ctx_data, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },

                    }
                });
            };



        })(jQuery);

    </script>
@endpush
