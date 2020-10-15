@extends('adminlte::layouts.app')
@section('titulo', 'Listado  de documentos internos')

@section('main-content')

 <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
         <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.dashboard.index') }}">Equipo Jornal</a></li>
         <li class="breadcrumb-item active" aria-current="page">Listado de documentos de Jornal</li>
     </ol>
 </nav>
 <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Listado de documentos de Jornal</h3>
        <a href="{{ route('admin.documento_jornal.create') }}" class="btn btn-primary pull-right">
              		<i class="fa fa-file-o"></i>
      				Nuevo
      			</a>
      </div>

      <div class="box-body table-responsive">
          <table class="table table-striped table-bordered" id="documentos_jornal">
              <thead>
                  <tr>
                      <td>Titulo documento</td>
                      <td>Tipo documento</td>
                      <td>Url</td>
                      <td>Usuario</td>
                      <td>Acciones</td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($documentacion_jornals AS $documentacion_jornal)
                      <tr id="documentacion_jornal_{{ $documentacion_jornal->id }}">
                          <td>{{ $documentacion_jornal->nombre }}</td>
                          <td>{{ $documentacion_jornal->documentacion_empresa_tipo->nombre}}</td>
                          <td>
                              <a href="{{ Storage::url('jornal/documentacion/'. $documentacion_jornal->id ."/". $documentacion_jornal->url) }}" target="_blank">{{ $documentacion_jornal->nombre }}</a>
                          </td>
                          <td>{{ $documentacion_jornal->user->nombre }}</td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                  <a class="btn btn-primary" href="{{ route('admin.documento_jornal.edit', ['id' => $documentacion_jornal->id]) }}">
                                     <i class="fa fa-pencil"></i>
                                  </a>

                                  <form method="post" id="confirm_delete">
                                          {!! method_field('DELETE') !!}
                                          @csrf
                                          <input type="hidden" name="profesional_id" value="{{ $documentacion_jornal->id }}">
                                          <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $documentacion_jornal->id }}" data-href="{{ route('admin.documento_jornal.destroy', ['id' => $documentacion_jornal->id]) }}">
                                              <i class="fa fa-trash"></i>
                                          </button>
                                  </form>
                              </div>

                          </td>
                      </tr>
                  @endforeach
              </tbody>
  </table>
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
									if (data.status == 'success') {
										$('#profesional_' + data.id).fadeOut();
										sweetAlert('Eliminada', data.message, 'success');
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
								'La operacion fue cancelada :)',
								'error'
							)
						}
					})

				});

		$('#documentos_jornal').DataTable({
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
