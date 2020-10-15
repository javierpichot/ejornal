@extends('adminlte::layouts.app')
@section('titulo', 'Dashboard de '. $empresa->nombre )

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->
   <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog" role="document">
		   <div class="modal-content" id="modal_content"></div>
	   </div>
   </div>

	 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
					<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
        </ol>
    </nav>
		<div class="card">
					 <div class="card-body">
		 <div class="row">

			 <div class="col-md-3">
				 @include('empresa.profile.partials.panel')
			 </div>
		 <div id="row">
	 <div class="col-lg-9 col-xs-12">
				 <div class="alert alert-warning alert-dismissible">
												 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												 <h4><i class="icon fa fa-info"></i> Alerta!</h4>
												 La subscripción esta a punto de caducar. Pongase en contacto con coordinación de Jornal.
											 </div>

		</div>
	</div>


							 <div class="col-lg-3 col-xs-6">
							 										<!-- small box -->
							 										<div class="small-box bg-green">
							 											<div class="inner">
							 												<h3>{{ $total_trabajadores }}</h3>

							 												<p>Trabajadores</p>
							 											</div>
							 											<div class="icon">
							 												<i class="ion ion-person-stalker
"></i>
							 											</div>
							 											<a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}" class="small-box-footer">
							 												Más info <i class="fa fa-arrow-circle-right"></i>
							 											</a>
							 										</div>
							 									</div>




								 <div class="col-lg-3 col-xs-6">
																		 <!-- small box -->
																		 <div class="small-box bg-green">
																			 <div class="inner">
																				 <h3>{{$total_ausentismo_abiertos}}</h3>

																				 <p>Ausentismo</p>
																			 </div>
																			 <div class="icon">
																				 <i class="ion ion-close-circled"></i>
																			 </div>
																			 <a href="{{ route('empresa.ausentismos.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}" class="small-box-footer">
																				 Más info <i class="fa fa-arrow-circle-right"></i>
																			 </a>
																		 </div>
																	 </div>
	<div class="col-lg-3 col-xs-6">
											<!-- small box -->
											<div class="small-box bg-green">
												<div class="inner">
													<h3>{{ $total_consultas }}</h3>

													<p>Consultas hoy</p>
												</div>
												<div class="icon">
													<i class="ion ion-medkit"></i>
												</div>
												<a href="{{ route('empresa.consultas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}" class="small-box-footer">
													Más info <i class="fa fa-arrow-circle-right"></i>
												</a>
											</div>
										</div>       
																	
					 </div>
				 </div>
		 </div>
@endsection

@section('script')
	<script type="text/javascript">
			$(function () {
				$(document).on('click', 'a.page-link', function (event) {
				    event.preventDefault();
				    ajaxLoad($(this).attr('href'));
				});

				$(document).on('submit', 'form#frm', function (event) {
				    event.preventDefault();
				    var form = $(this);
				    var data = new FormData($(this)[0]);
				    var url = form.attr("action");
				    $.ajax({
				        type: form.attr('method'),
				        url: url,
				        data: data,
				        cache: false,
				        contentType: false,
				        processData: false,
				        success: function (data) {
				            $('.is-invalid').removeClass('is-invalid');
				            if (data.fail) {
				                for (control in data.errors) {
				                    $('input[name=' + control + ']').addClass('is-invalid');
				                    $('#error-' + control).html(data.errors[control]);
				                }
				            } else {
				                $('#modalForm').modal('hide');
				                ajaxLoad(data.redirect_url);
				            }
				        },
				        error: function (xhr, textStatus, errorThrown) {
				            alert("Error: " + errorThrown);
				        }
				    });
				    return false;
				});

				$('#modalForm').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#modalForm').on('shown.bs.modal', function () {
				    $('#focus').trigger('focus')
				});

				function ajaxLoad(filename, content) {
				    content = typeof content !== 'undefined' ? content : 'content';
				   // $('.loading').show();
				    $.ajax({
				        type: "GET",
				        url: filename,
				        contentType: false,
				        success: function (data) {
				            $("#" + content).html(data);
				          //  $('.loading').hide();
				        },
				        error: function (xhr, status, error) {
				            alert(xhr.responseText);
				        }
				    });
				}
	            $('#empresa-ticket').DataTable({
	                "language": {
	                    "sProcessing":     "Procesando...",
	                    "sLengthMenu":     "Mostrar _MENU_ registros",
	                    "sZeroRecords":    "No se encontraron resultados",
	                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	                    "sInfoPostFix":    "",
	                    "sSearch":         "Buscar:",
	                    "sUrl":            "",
	                    "sInfoThousands":  ",",
	                    "sLoadingRecords": "Cargando...",
	                    "oPaginate": {
	                        "sFirst":    "Primero",
	                        "sLast":     "Último",
	                        "sNext":     "Siguiente",
	                        "sPrevious": "Anterior"
	                    },
	                    "oAria": {
	                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	                    }
	                },
	                "paging": true,
	                "lengthChange": true,
	                "searching": true,
	                "ordering": true,
	                "info": true,
	                "autoWidth": false,
	                "responsive": true
	            });
		});
	</script>
@endsection
