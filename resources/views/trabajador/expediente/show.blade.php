@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de ausentismo de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->
	<div class="modal fade" id="editExpediente" tabindex="-1" role="dialog" data-backdrop="static">
	 <div class="modal-dialog modal-lg" role="document">
		 <div class="modal-content" id="modal_content"></div>
	 </div>
	</div>
   <div class="modal fade" id="newExpediente" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog modal-lg" role="document">
		   <div class="modal-content">
			   @include('trabajador.expediente._form')
		   </div>
	   </div>
   </div>



	 <nav aria-label="breadcrumb">
		 <ol class="breadcrumb">
			 <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
			 <li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
										 <li class="breadcrumb-item active" aria-current="page">Listado de episodios de ausentismo</li>		 </ol>
    </nav>
 <div class="card">
			  	@include('trabajador.profile.partials.nav_menu_empresa')
				<div class="card-body">
	<div class="row">

		<div class="col-md-3">
			@include('trabajador.profile.partials.panel')
		</div>

		  <div class="col-md-9">
			  <div class="box box-info">
					<div class="box-header">
					  <h3 class="box-title">Gestion de ausentismo</h3>
						<div  class="pull-right">
							<input id="Date_search" class="form-control" type="text" placeholder="Por fecha" />
						</div>
						<div class="pull-right" style="margin-right: 10px">
							<button id="abierto" class="btn btn-default filter">Abierto</button>
							<button id="cerrado" class="btn btn-default filter">Cerrado</button>


							<button id="all" class="btn btn-default filter">Todos</button>
						</div>
					 <a href="#" style="margin-right: 10px" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newExpediente" style="margin-bottom:25px">Nuevo expediente</a>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped table-bordered" id="empresa-expedientes">
							<thead>
								<tr>
									<td>Estado</td>
									<td>Fecha</td>
									<td>Nº días</td>
									<td>Tipo de ausentismo</td>
									<td>Motivo</td>
									<td>Nº comunicacados</td>
                  <td>Nº documentos</td>
									<td>Nº consultas</td>
									<td>Nº prestaciones</td>
									<td>Indicadores</td>
									<td>Usuario</td>
									<td>Acciones</td>
								</tr>
							</thead>
							<tbody>
								@foreach($trabajador->ausentismo AS $ausentismo)

									<tr id="expediente_trabajador_{{ $ausentismo->id }}">
										<td>@if(isset($ausentismo->fecha_alta ))
											<a href="{{route('trabajador.ausentismo.dossier.view', ['id' => $ausentismo->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $ausentismo->trabajador->id ])}}" target="\&quot;_blank\&quot;"><button class="btn btn-success">Cerrado</button></a>

@else
<a href="{{route('trabajador.ausentismo.dossier.view', ['id' => $ausentismo->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $ausentismo->trabajador->id ])}}" target="\&quot;_blank\&quot;"><button class="btn btn-danger">Abierto</button></a>

@endif
</td>
										<td>{{ $ausentismo->fecha_ausente }}</td>
										<td>{{ $ausentismo->dias_ausente }}</td>
										<td>{{ $ausentismo->ausentismo_tipo->nombre }}</td>
										<td>{{ $ausentismo->motivo }}</td>
										<td>{{ $ausentismo->comunicacion->count() }}</td>
										<td>{{ $ausentismo->documentacion->count() }}</td>
										<td>{{ $ausentismo->consulta->count() }}</td>
										<td></td>
										<td>@include('trabajador.expediente.indicadores', ['fecha_ausente' => $ausentismo->fecha_ausente, 'fecha_alta' => $ausentismo->fecha_alta, 'fecha_probable_alta' => $ausentismo->fecha_probable_alta])</td>
										<td>{{ $ausentismo->user->nombre }} {{ $ausentismo->user->apellido }}</td>
										<td>
											<form method="post" id="confirm_delete">
													{!! method_field('DELETE') !!}
													@csrf
													<input type="hidden" name="trabajador_id" value="{{ $ausentismo->trabajador->id }}">
													<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
													<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $ausentismo->id}}" data-href="{{ route('trabajador.expediente.destroy', ['id' => $ausentismo->id]) }}">
														<i class="fa fa-trash"></i>
													</button>
											</form>

											<a class="btn btn-warning" title="Edit" href="#editExpediente" 		data-toggle="modal" data-href="{{route('trabajador.expediente.edit', ['id' => $ausentismo->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $ausentismo->trabajador->id ])}}"><i title="Editar expediente" class="fa fa-pencil"></i></a>

											<a class="btn btn-success" title="Edit" href="{{route('trabajador.ausentismo.dossier.view', ['id' => $ausentismo->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $ausentismo->trabajador->id ])}}"><i title="Ver dossier" class="fa fa-file-text"></i></a>

										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			  </div>
		  </div>
	  </div>
  </div>
</div>
@endsection

@push('script')
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script type="text/javascript">
			$(function () {

				var table = $('#empresa-expedientes').DataTable({
					"dom": 'Bfrtip',
					"buttons": [
						'excelHtml5',
						'pdfHtml5'
					],
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

				$(document).on('click', 'a.page-link', function (event) {
				    event.preventDefault();
				    ajaxLoad($(this).attr('href'));
				});

                $(document).on('submit', 'form#expediente', function(event) {
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
                        success: function(data) {
                            toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
                            $('.is-invalid').removeClass('is-invalid');
                            $('#newExpediente').modal('hide');
                            $('#editExpediente').modal('hide');

                            setTimeout(function() {
                                window.location.reload(data.redirect_url);
                            }, 3000);

                        },
                        error: function(jqXhr, json, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = '';

                            for (control in errors['errors']) {
                                var inputField = $('[name=' + control + ']');
                                var parentDiv = inputField.closest('.form-group');
                                // apply has-error class
                                parentDiv.addClass('has-error');
                                $('input[name=' + control + ']').addClass('is-invalid');
                                console.log(errors['errors'][control][0]);
                                $('span#' + control).html(errors['errors'][control][0]);
                            }
                        }
                    });
                    return false;
                });

				$('#fecha_ausente').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#fecha_probable_alta').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#fecha_alta').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#abierto').on('click', function () {
					$('#empresa-trabajadores').DataTable().columns(0).search("Abierto").draw();
				});
				$('#cerrado').on('click', function () {
					$('#empresa-trabajadores').DataTable().columns(0).search("Cerrado").draw();
				});
				$('#all').on('click', function () {
					$('#empresa-trabajadores').DataTable().columns(0).search("").draw();
				});

				minDateFilter = "";
				maxDateFilter = "";
				$.fn.dataTableExt.afnFiltering.push(
						function(oSettings, aData, iDataIndex) {
							if (typeof aData._date == 'undefined') {
								aData._date = new Date(aData[5]).getTime();
							}

							if (minDateFilter && !isNaN(minDateFilter)) {
								if (aData._date < minDateFilter) {
									return false;
								}
							}

							if (maxDateFilter && !isNaN(maxDateFilter)) {
								if (aData._date > maxDateFilter) {
									return false;
								}
							}

							return true;
						}
				);
				$(document).ready(function() {
					$("#Date_search").val("");
				});

				$("#Date_search").daterangepicker({
					"locale": {
						"format": "YYYY-MM-DD",
						"separator": " to ",
						"applyLabel": "Apply",
						"cancelLabel": "Cancel",
						"fromLabel": "From",
						"toLabel": "To",
						"customRangeLabel": "Custom",
						"weekLabel": "W",
						"daysOfWeek": [
							"Su",
							"Mo",
							"Tu",
							"We",
							"Th",
							"Fr",
							"Sa"
						],
						"monthNames": [
							"January",
							"February",
							"March",
							"April",
							"May",
							"June",
							"July",
							"August",
							"September",
							"October",
							"November",
							"December"
						],
						"firstDay": 1
					},
					"opens": "center",
				}, function(start, end, label) {
					maxDateFilter = end;
					minDateFilter = start;
					table.draw();
				});

				$('.delete-confirm').on('click', function(e) {
				   e.preventDefault();

				   const swalWithBootstrapButtons = swal.mixin({
					   confirmButtonClass: 'btn btn-success',
					   cancelButtonClass: 'btn btn-danger',
					   buttonsStyling: false,
				   })

				   swalWithBootstrapButtons({
						 title: 'Eliminar episodio',
 	 			 	 text: "¿Desea eliminar esta episodio de ausentismo?",
 	 			 	 type: 'warning',
 	 			 	 showCancelButton: true,
 	 			 	 confirmButtonText: 'Si, eliminar',
 	 			 	 cancelButtonText: 'No, cancelar',
 	 			 	 reverseButtons: true
				   }).then((result) => {
					   if (result.value) {
						   $.ajax({
							   url: $(this).attr('data-href'),
							   method: 'POST',
							   dataType: 'JSON',
							   data: {
								   '_token': $('input[name="_token"]').val(),
								   'id': $(this).attr('data-id'),
								   '_method': $('input[name="_method"]').val()
							   },
							   success: function(data) {
								   if( data.status == 'success' ) {
									   $('#expediente_trabajador_' + data.id).fadeOut();
									   sweetAlert('Eliminado', data.message, 'success');
								   } else {
									   sweetAlert('Uppsss...', data.message, 'error');
								   }
							   },
							   error: function(xhr, message) {

							   }
						   });
					   } else if (
						   // Read more about handling dismissals
						   result.dismiss === swal.DismissReason.cancel
					   ) {
						   swalWithBootstrapButtons(
							   'Cancelada',
							   'La operacion ha sido cancelada',
							   'error'
						   )
					   }
				   })

			   });

				$('#editExpediente').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#editExpediente').on('shown.bs.modal', function () {
					$('#fecha_ausente').datetimepicker({
						format: 'YYYY-MM-DD',
						locale: 'es-us'
					});

					$('#fecha_probable_alta').datetimepicker({
						format: 'YYYY-MM-DD',
						locale: 'es-us'
					});

					$('#fecha_alta').datetimepicker({
						format: 'YYYY-MM-DD',
						locale: 'es-us'
					});
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

		});
	</script>

@endpush
