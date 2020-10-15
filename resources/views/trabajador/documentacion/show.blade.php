@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de documentaciones de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<div class="modal fade" id="editComunicacion" tabindex="-1" role="dialog" data-backdrop="static">
 	   <div class="modal-dialog modal-lg" role="document">
 		   <div class="modal-content" id="modal_content"></div>
 	   </div>
    </div>

	<!-- Modal -->
   <div class="modal fade" id="newDocumentacionLaboral" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog modal-lg" role="document">
		   <div class="modal-content">
			   @include('trabajador.documentacion._form')
		   </div>
	   </div>
   </div>



	 <nav aria-label="breadcrumb">
		 <ol class="breadcrumb">
			 <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
			 <li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
										 <li class="breadcrumb-item active" aria-current="page">Listado de documentación entregada</li>	 </ol>
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
					<h3 class="box-title">Gestion de documentaciones</h3>
					<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newDocumentacionLaboral" style="margin-bottom:25px">Nueva documentacion</a>
 				   <br>
				  </div>
				  <div class="box-body table-responsive">
					  <table class="table table-striped table-bordered" id="empresa-comunicacion">
					  	<thead>
					  		<tr>
					  			<td>Fecha y hora</td>
					  			<td>Nombre y apellido</td>
					  			<td>Estado</td>
					  			<td>Vinc. Ausentismo</td>
					  			<td>Tipo documentacion</td>
					  			<td>Fecha E.</td>
					  			<td>Aviso Adecua.</td>
					  			<td>Diagnostico</td>
					  			<td>Fecha baja</td>
					  			<td>Dias reposo</td>
					  			<td>Instituto</td>
					  			<td>Medico</td>
					  			<td>MN</td>
					  			<td>MP</td>
					  			<td>Observaciones</td>
					  			<td>Usuario</td>
					  			<td style="width:  20%">Acciones</td>
					  		</tr>
					  	</thead>
					  	<tbody>
					  		@foreach($trabajador->documentacion AS $documentacion)

					  			<tr id="documentacion_{{ $documentacion->id }}">

					  				<td>{{ $documentacion->created_at }}</td>
					  				<td>{{ $documentacion->trabajador->nombre }} {{ $documentacion->trabajador->apellido }}</td>
					  				<td>
					  					@include('trabajador.documentacion.estado', ['documentacion' => $documentacion])
					  				</td>
					  				<td>
					  					@if ($documentacion->ausentismo_id)
					  						<i class="fa fa-check" style="font-size:25px;color:green"></i>
					  						@else
					  							<i class="fa fa-remove" style="font-size:30px;color:red"></i>
					  					@endif
					  				</td>

					  				<td>{{ $documentacion->documentacion_tipo->nombre or '' }}</td>
					  				<td>{{ $documentacion->created_at }}</td>
					  				<td>{{ ($documentacion->notifico == true) ? 'SI' : 'NO' }}</td>
					  				<td>{{ $documentacion->diagnostico or ''}}</td>
					  				<td>{{ $documentacion->fecha_documento or ''}}</td>
					  				<td>{{ $documentacion->reposo or ''}}</td>
					  				<td>{{ $documentacion->institucion or ''}}</td>
					  				<td>{{ $documentacion->medico or ''}}</td>
					  				<td>{{ $documentacion->matricula_nacional or ''}}</td>
					  				<td>{{ $documentacion->matricula_provincial or ''}}</td>
					  				<td>{{ $documentacion->observaciones or ''}}</td>
					  				<td>{{ $documentacion->user->nombre }} {{ $documentacion->user->apellido }}</td>
					  				<td style="width:  20%">
					  					<form method="post" id="confirm_delete">
					  							{!! method_field('DELETE') !!}
					  							@csrf
					  							<input type="hidden" name="trabajador_id" value="{{ $documentacion->trabajador->id }}">
					  							<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
					  							<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $documentacion->id}}" data-href="{{ route('trabajador.documentacion.destroy', ['id' => $documentacion->id]) }}">
					  								<i class="fa fa-trash"></i>
					  							</button>
					  					</form>

					  					<a class="btn btn-warning" title="Edit" href="#editComunicacion" 		data-toggle="modal" data-href="{{route('trabajador.documentacion.edit', ['id' => $documentacion->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $documentacion->trabajador->id ])}}"><i title="Editar documentacion" class="fa fa-pencil"></i></a>
<a class="btn btn-success" href="{{ route('trabajador.documentacion.generate',['trabajador_id' => $documentacion->trabajador->id, 'documentacion_id' => $documentacion->id,'empresa_id' => $empresa->id,  'type' => $documentacion->documentacion_tipo_id,'filename' => $documentacion->url] ) }}"><i title="Editar documentacion" class="fa fa-eye"></i></a>
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

				$('#fecha_entrega').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#fecha_documento').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#fecha_incorporacion').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
				});

				$('#documentos').fileinput({
	                theme: 'fa',
	                language: 'es',
	                uploadUrl: '#',
	                allowedFileExtensions: ['jpg', 'png', 'gif'],
	                browseClass: "btn btn-primary btn-block",
	                showCaption: false,
	                showRemove: false,
	                showUpload: false
	            });


                $(document).on('submit', 'form#documento_laboral', function (event) {
                    event.preventDefault();
                    var form = $(this);
					var this_master = $(this);
					//FIX CHECKBOX SEND TRUE OR FALSE IN JS VDJKELLY
				    this_master.find('input[type="checkbox"]').each( function () {
				        var checkbox_this = $(this);
				        if( checkbox_this.is(":checked") == true ) {
				            checkbox_this.attr('value','1');
				        } else {
				            checkbox_this.prop('checked',true);

				            checkbox_this.attr('value','0');
				        }
				    })
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
                            toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
 						   $('#newDocumentacionLaboral').modal('hide');
                           $('#editComunicacion').modal('hide');

                           setTimeout(function () {
                               window.location.reload(data.redirect_url);
                           }, 3000);

                        },
 					   error: function(jqXhr, json, errorThrown){
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
						 title: 'Eliminar documentación',
 	 			 	 text: "¿Desea eliminar esta documentación?",
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
									   $('#documentacion_' + data.id).fadeOut();
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

				$('#editComunicacion').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#editComunicacion').on('shown.bs.modal', function () {
					$('#fecha_entrega').datetimepicker({
						format: 'YYYY-MM-DD',
						locale: 'es-us'
					});

					$('#fecha_documento').datetimepicker({
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
