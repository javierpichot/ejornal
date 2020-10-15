@extends('adminlte::layouts.app')
@section('titulo',  'Histórico de tareas realizadas de '. $empresa->nombre)


@section('menu-empresa')
@include('empresa.partials.menu_empresa',  ['empresa' => $empresa])
@endsection

@section('main-content')

<div class="modal fade in" id="editRevision" tabindex="-1" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="modal_content"></div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="newRevision" tabindex="-1" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			@include('empresa.revision-periodica._form')
		</div>
	</div>
</div>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Histórico de tareas realizadas</li>
	</ol>
</nav>
<div class="row">

	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">
					Histórico de tareas realizadas
				</h3>
				<div class="box-tools pull-right">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newRevision" style="margin-bottom:25px">Cargar histórico de tarea</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-striped table-bordered" id="empresa-revisones">
					<thead>
					<tr>
					  <td>Fecha</td>
  					<td>Usuario</td>

						<td>Tarea</td>
            <td>Tipo</td>
						<td>Informe</td>
						<td>Observaciones</td>
						<td>Archivo pdf</td>
						<td>Acciones</td>
					</tr>
					</thead>
					<tbody>
					@foreach  ($revision_periodicas as $key => $revision_periodica)
						<tr id="revision_periodica_{{ $revision_periodica->id }}">
						<td>  {{ $revision_periodica->created_at->diffForHumans() }}</td>
							<td>{{ $revision_periodica->user->nombre }} {{ $revision_periodica->user->apellido }}</td>
							<td>{{ $revision_periodica->revision_periodica_entidad ->nombre}}</td>
							<td>{{ $revision_periodica->revision_periodica_entidad ->tipo_tarea->nombre}}</td>
							<td>{{ $revision_periodica->informe }}</td>
							<td>{{ $revision_periodica->observaciones }}</td>
							<td>
								<a href="{{ route('empresa.documentacion.empresa.generate',['empresa_id' => $revision_periodica->revision_periodica_entidad->empresa->id, 'filename' => $revision_periodica->fotos,  'documentacion_pedido' => $revision_periodica->id, 'type' => 'revisiones_periodicas'] ) }}">{{ $revision_periodica->fotos }}</a>
							</td>

							<td>
								{!! method_field('DELETE') !!}
								@csrf
								<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
								<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $revision_periodica->id}}" data-href="{{ route('empresa.revision-periodica.destroy', ['id' => $revision_periodica->id]) }}">
									<i class="fa fa-trash"></i>
								</button>

								<a class="btn btn-warning" title="Edit" href="#editRevision" data-toggle="modal" data-href="{{route('empresa.revision-periodica.edit', ['id' => $revision_periodica->id, 'id_empresa' => $empresa->id])}}"><i title="Editar documentacion" class="fa fa-pencil"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
@endsection

@push('script')
<script type="text/javascript">
	$(function() {
		$('.delete-confirm').on('click', function(e) {
			e.preventDefault();

			const swalWithBootstrapButtons = swal.mixin({
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false,
			})

			swalWithBootstrapButtons({
				title: 'Desea eliminar este movimiento?',
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
							if (data.status == 'success') {
								$('#revision_periodica_' + data.id).fadeOut();
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
						'La operacion a sido cancelada',

						'error'
					)
				}
			})

		});



		$("#frm").validate();
		$(document).on('click', 'a.page-link', function(event) {
			event.preventDefault();
			ajaxLoad($(this).attr('href'));
		});

		$(document).on('submit', 'form#frm', function(event) {
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
					$('#newRevision').modal('hide');
					$('#editRevision').modal('hide');

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

		$('#nuevo_control').datetimepicker({
		   format: 'YYYY-MM-DD',
		   locale: 'es-us'
	   	});

        $('#fotos').fileinput({
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre las fotos del movimiento',
            allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });

		$('#editRevision').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			ajaxLoad(button.data('href'), 'modal_content');
		});

		$('#editRevision').on('shown.bs.modal', function() {
			$('#nuevo_control').datetimepicker({
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
				success: function(data) {
					$("#" + content).html(data);
					//  $('.loading').hide();
				},
				error: function(xhr, status, error) {
					alert(xhr.responseText);
				}
			});
		}
		$('#empresa-revisones').DataTable({
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
