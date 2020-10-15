@extends('adminlte::layouts.vue')
@section('titulo', 'Gestion de comunicaciones de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->
   <div class="modal fade" id="newComunicacion" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog modal-lg" role="document">
		   <div class="modal-content">
			   @include('trabajador.comunicacion._form')
		   </div>
	   </div>
   </div>

   <div class="modal fade" id="editComunicacion" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog" role="document">
		   <div class="modal-content" id="modal_content"></div>
	   </div>
   </div>

	 <nav aria-label="breadcrumb">
		 <ol class="breadcrumb">
			 <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
	 		<li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
	 <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
	 									<li class="breadcrumb-item active" aria-current="page">Listado de comunicación</li>		 </ol>
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
					 <h3 class="box-title">Gestion de comunicaciones</h3>
             <div class="btn-group pull-right">
                  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="modal" data-target="#newComunicacion">Nueva comunicacion</button>

                </div>

				   </div>

					 <div class="box-header">
						 <h3 class="box-title">Descargar reporte</h3>
						 <div class="btn-group pull-right">
							 {!! Form::open(['route' => 'trabajador.getReporteComunicacion']) !!}
							 <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
							 <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
							<div class="col-xs-4">
								{{ Form::label('fecha_inicio', "Fecha inicio") }}
								 <div id="fecha_cita" class="input-group date">
										 <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
										 {{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio']) }}
									 <span class="help-block" id="fecha_inicio"></span>
								 </div>
							</div>

							<div class="col-xs-4">
								{{ Form::label('fecha_fin', "Fecha inicio") }}
								 <div id="fecha_fin" class="input-group date">
										 <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
										 {{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin']) }}
									 <span class="help-block" id="fecha_fin"></span>
								 </div>
							</div>

							<div class="col-xs-4" style="margin-top: 24px">
								<button type="submit" class="btn btn-primary">Descargar reporte</button>
							</div>
							{{ Form::close() }}

						 </div>
					 </div>


				   <div class="box-body table-responsive">
					   <table class="table table-striped table-bordered" id="empresa-comunicacion">
					   	<thead>
					   		<tr>
					   			<td>Fecha y hora</td>
					   			<td>Remitente</td>
					   			<td>Modo</td>
					   			<td>Motivo</td>
					   			<td>Aporto documentacion</td>
					   			<td>Contenido</td>
					   			<td>Usuario</td>
					   			<td>acciones</td>
					   		</tr>
					   	</thead>
					   	<tbody>
					   		@foreach($trabajador->comunicacion AS $c)

					   			<tr id="comunicacion_trabajador_{{ $c->id }}">

					   				<td>{{ $c->created_at }}</td>
					   				<td>{{ $c->remitente->nombre }}</td>
					   				<td>{{ $c->modo_comunicacion->nombre or '' }}</td>
					   				<td>{{ $c->motivo_comunicacion->nombre or ''}}</td>
					   				<td>
					   					@isset($c->documentacion_id)
					   						Si
					   					@endisset

					   					@empty ($c->documentacion_id)
					   						No
					   					@endempty
					   				</td>
					   				<td>{{ $c->contenido }}</td>
					   				<td>{{ $c->user->nombre }} {{ $c->user->apellido }}</td>
					   				<td>


										<button class="btn btn-warning" title="Edit" href="#editComunicacion" 		data-toggle="modal" data-href="{{route('trabajador.comunicacion.edit', ['id' => $c->id, 'id_empresa' => $empresa->id, 'empleado_id' => $c->trabajador->id ])}}"><i title="Editar Comunicacion" class="fa fa-pencil"></i>
										</button>
										<form method="post" id="confirm_delete" class="pull-right">
												{!! method_field('DELETE') !!}
												@csrf
												<input type="hidden" name="trabajador_id" value="{{ $c->trabajador->id }}">
												<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
												<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $c->id}}" data-href="{{ route('trabajador.comunicacion.destroy', ['id' => $c->id]) }}">
													<i class="fa fa-trash"></i>
												</button>
										</form>

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
	<script type="text/javascript">
			$(function () {
				$(document).on('click', 'a.page-link', function (event) {
				    event.preventDefault();
				    ajaxLoad($(this).attr('href'));
				});

                $(document).on('submit', 'form#comunicacion', function(event) {
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
                            $('#newComunicacion').modal('hide');
                            $('#editComunicacion').modal('hide');

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

				$('.delete-confirm').on('click', function(e) {
				   e.preventDefault();

				   const swalWithBootstrapButtons = swal.mixin({
					   confirmButtonClass: 'btn btn-success',
					   cancelButtonClass: 'btn btn-danger',
					   buttonsStyling: false,
				   })

				   swalWithBootstrapButtons({
					   title: 'Desea eliminar la empresa?',
					   text: "Al eliminar esto no hay vuelta atras!",
					   type: 'warning',
					   showCancelButton: true,
					   confirmButtonText: 'Si, eliminar!',
					   cancelButtonText: 'No, cancelar!',
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
									   $('#comunicacion_trabajador_' + data.id).fadeOut();
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
							   'La operacion a sido :)',
							   'error'
						   )
					   }
				   })

			   });

				$('#editComunicacion').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#editComunicacion').on('shown.bs.modal', function () {
				    $('#focus').trigger('focus')
				});

				$('#fecha_inicio').datetimepicker({
					 format: 'YYYY-MM-DD',
					 locale: 'es-us'
				 });

				 $('#fecha_fin').datetimepicker({
						format: 'YYYY-MM-DD',
						locale: 'es-us'
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
	            $('#empresa-comunicacion').DataTable({
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

@endpush
