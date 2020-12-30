@extends('adminlte::layouts.app')
@section('titulo', 'Listado de administradores')

@section('main-content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
		<li class="breadcrumb-item " aria-current="page"><a href="{{ route('admin.ajustes.index') }}">Administración web</a></li>
		<li class="breadcrumb-item active" aria-current="page">Listado administradores</li>



	</ol>
</nav>

<div class="box box-info">
	<div class="box-header">
		<h3 class="box-title">Listado de usuarios</h3>
		<a href="{{ route('admin.user.create') }}" class="btn btn-primary pull-right">
			<i class="fa fa-file-o"></i>
			Nuevo
		</a>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-striped table-bordered" id="usuario">
			<thead>
				<tr>
					<td>Foto</td>

					<td>Usuario</td>
					<td>Telefono</td>
					<td>Email</td>
					<td>Rol</td>
					<td>Empresa/s</td>
					<td>Acciones</td>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				@foreach($users AS $s)
				@php
				$canImpersonate = Auth::user()->can('impersonate', $s);
				$formIdImpersonate = 'impersonateForm_'.$s->id;
				@endphp
				<tr>





					<td><img class="img-circle elevation-2" width="55px" height="55px" src="{{ asset('storage/jornal/usuario/'. $s->id . '/perfil/'. $s->photo ) }}" alt="{{ $s->photo }}"></td>
					<td>{{ $s->nombre }} {{ $s->apellido }}</td>
					<td>{{ $s->telefono }}</td>
					<td>{{ $s->email }}</td>
					<td>
						@foreach ($s->roles as $key => $role)
						{{ $role->name }}
						@endforeach
					</td>
					<td>
						@foreach ($s->empresas as $key => $empresa)
						{{ $loop->first ? '' : ', ' }}
						{{ $empresa->nombre }}
						@endforeach
					</td>
					<td>





						<a class="btn btn-primary" href="{{ route('admin.user.edit', ['id' => $s->id, 'empresa_id' => $s->id]) }}">
							<i class="fa fa-pencil"></i>
						</a>
						<a class="btn btn-primary" title="Edit" href="{{route('empresa.usuario.show', ['id' => $s->id, 'empresa_id' => $s->id])}}"><i title="Editar usuario" class="fa fa-eye"></i></a>
						<a href="#" class="btn btn-warning btn-primary" onclick="event.preventDefault(); document.getElementById('{{$formIdImpersonate}}').submit();">
							<i class="fa fa-user-secret"></i>
						</a>
						<form id="{{$formIdImpersonate}}" action="{{ route('impersonate', $s->id) }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
						<a data-id="{{$s->id}}" data-href="{{ route('admin.user.destroy', ['id' => $s->id]) }}" class="delete-confirm btn btn-danger" href="#">
							{{ csrf_field() }}
							<i class="fa fa-trash"></i>
						</a>
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
				title: 'Eliminar profesional',
				text: "¿Desea eliminar esta profesional?",
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Si, eliminar',
				cancelButtonText: 'No, cancelar',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					console.log($('input[name="_token"]').val());
					console.log($(this).attr('data-id'));
					$.ajax({
						url: $(this).attr('data-href'),
						method: 'POST',
						dataType: 'JSON',
						// type: 'DELETE',
						data: {
							'_token': $('input[name="_token"]').val(),
							'id': $(this).attr('data-id'),
							'_method': 'DELETE'
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
							console.log(xhr + 'y tambien' + message);
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
		$('#usuario').DataTable({
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
