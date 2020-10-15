@extends('adminlte::layouts.app')
@section('titulo',  'Gestion de incidecias de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
@include('empresa.partials.menu_empresa',  ['empresa' => $empresa])
@endsection

@section('main-content')
	<div class="modal fade in" id="editIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content"></div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="newIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				@include('trabajador.incidencia._form')
			</div>
		</div>
	</div>



<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
		<li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
									<li class="breadcrumb-item active" aria-current="page">Listado de incidencias</li>	</ol>
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
					<h3 class="box-title">Gestion de incidencias</h3>
					<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newIncidencia" style="margin-bottom:25px">Nueva incidencia</a>
				  </div>
				  <div class="box-body table-responsive">
					  <table class="table table-striped table-bordered" id="empresa-incidencia">
						  <thead>
							  <tr>
								  <td>Fecha</td>
								  <td>Tipo</td>
								  <td>Lugar</td>
								  <td>Tarea desarrollada</td>
								  <td>Usuario</td>
								  <td style="width:  20%">acciones</td>
							  </tr>
						  </thead>
						  <tbody>
							  @foreach($trabajador->incidencia AS $c)

								  <tr id="incidencia_trabajador_{{ $c->id }}">
									  <td>{{ $c->fecha }}</td>
									  <td>{{ $c->tipo }}</td>
									  <td>{{ $c->lugar }}</td>
									  <td>{{ $c->tarea }}</td>
									  <td>{{ $c->user->nombre }} {{ $c->user->apellido }}</td>
									  <td>
										   {!! method_field('DELETE') !!}
										   @csrf
										   <input type="hidden" name="trabajador_id" value="{{ $c->trabajador->id }}">
										   <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
										   <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $c->id}}" data-href="{{ route('trabajador.incidencia.destroy', ['id' => $c->id]) }}">
												   <i class="fa fa-trash"></i>
											   </button>

										  <a class="btn btn-warning" title="Edit" href="#editIncidencia" 		data-toggle="modal" data-href="{{route('trabajador.incidencia.edit', ['id' => $c->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $c->trabajador->id ])}}"><i title="Editar incidencia" class="fa fa-pencil"></i></a>
										    <a class="btn btn-primary" title="Edit" href="{{route('trabajador.incidencias.view', ['id' => $c->id, 'trabajador_id' => $c->trabajador->id, 'id_empresa' => $empresa->id, ])}}"><i title="Editar incidencia" class="fa fa-eye"></i></a>

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
	$(function() {
		$(document).on('click', 'a.page-link', function(event) {
			event.preventDefault();
			ajaxLoad($(this).attr('href'));
		});

		$(document).on('submit', 'form#incidencia', function(event) {
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
					$('#newIncidencia').modal('hide');
					$('#editIncidencia').modal('hide');

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

		$('#fecha_incidencia').datetimepicker({
		   format: 'YYYY-MM-DD hh:mm:ss',
		   locale: 'es-us'
	   });

		$('.delete-confirm').on('click', function(e) {
			e.preventDefault();

			const swalWithBootstrapButtons = swal.mixin({
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false,
			})

			swalWithBootstrapButtons({
				title: 'Eliminar incidencia',
			text: "¿Desea eliminar esta incidencia?",
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
							if (data.status == 'success') {
								$('#incidencia_trabajador_' + data.id).fadeOut();
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

		$('#fotos_escenario').fileinput({
			maxFileCount: 5,
			theme: 'fa',
			language: 'es',
			uploadUrl: '#',
			dropZoneTitle: 'Suba o arrastre las fotos del escenario',
			allowedFileExtensions: ['jpg', 'png', 'gif'],
			browseClass: "btn btn-primary btn-block",
			showCaption: false,
			showRemove: false,
			showUpload: false
		});
		$('#declaracion_accidente').fileinput({
			maxFileCount: 5,
			theme: 'fa',
			language: 'es',
			uploadUrl: '#',
			dropZoneTitle: 'Suba o arrastre las fotos de la declaración de accidente manuscrita por el trabajador, supervisor o compañero con firma y aclaración.',
			allowedFileExtensions: ['jpg', 'png', 'gif'],
			browseClass: "btn btn-primary btn-block",
			showCaption: false,
			showRemove: false,
			showUpload: false
		});
		$('#fotos_lesiones').fileinput({
			maxFileCount: 5,
			theme: 'fa',
			language: 'es',
			uploadUrl: '#',
			dropZoneTitle: 'Suba o arrastre las fotos de la lesion',
			allowedFileExtensions: ['jpg', 'png', 'gif'],
			browseClass: "btn btn-primary btn-block",
			showCaption: false,
			showRemove: false,
			showUpload: false
		});

		$('#editIncidencia').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			ajaxLoad(button.data('href'), 'modal_content');
		});

		$('#editIncidencia').on('shown.bs.modal', function() {
			$('#focus').trigger('focus')
		});

		function ajaxLoad(filename, content) {
			content = typeof content !== 'undefined' ? content : 'content';
			// $('.loading').show();
			$.ajax({
				type: "GET",
				url: filename,
				contentType: false,
				success: function(data) {
					$("#" + content).html(data);
					//  $('.loading').hide();
				},
				error: function(xhr, status, error) {
					alert(xhr.responseText);
				}
			});
		}
		$('#empresa-incidencia').DataTable({
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
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
