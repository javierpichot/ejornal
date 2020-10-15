@extends('adminlte::layouts.app')
@section('titulo', 'Listado de certificados entregados de '. $empresa->nombre)

@section('menu-empresa')
@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')


<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Listado de certificados entregados</li>
	</ol>
</nav>




<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">
					Listado de certificados entregados </h3>
				<div class="box-tools pull-right">

				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">


				<table class="table table-striped table-bordered" id="empresa_documentacion">
					<thead>
						<tr>
							<td>Foto</td>
							<td>Nombres y apellidos</td>
							<td>Medico</td>
							<td>Servicio</td>
							<td>Documento</td>
							<td>Tipo documento</td>
							<td>Estado</td>
							<td>Fecha de baja</td>
							<td>Numero de dias</td>
							<td>Observaciones</td>
							<td>Usuario</td>
						</tr>
					</thead>
					<tbody>

						@forelse ($certificaciones as $key => $certificacion)
						@php //dd($certificacion);
						@endphp
						<tr>
							<td>
								<a href="{{ route('trabajador.show', ['id' => $certificacion->trabajador->id, 'name' => $certificacion->trabajador->nombre, 'empresa_id' => $empresa->id]) }}">
									<img data-src="{{ asset('img/avatar5.png')}}"
										src="{{ isset($certificacion->trabajador->photo) ? asset('storage/empresas/'.$empresa->id.'/trabajadores/'.$certificacion->trabajador->id.'/perfil/'. $certificacion->trabajador->photo ) : '' }}" alt=""
										class="img-circle elevation-2" width="55px">
								</a>
							</td>
							<td><a href="{{ route('trabajador.show', ['id' => $certificacion->trabajador->id, 'name' => $certificacion->trabajador->nombre, 'empresa_id' => $empresa->id]) }}"> {{ $certificacion->trabajador->nombre or '' }}
									{{ $certificacion->trabajador->apellido or '' }}</a></td>
							<td>{{ $certificacion->medico or '' }}</td>
							<td>{{ $certificacion->consulta->consulta_motivo->nombre or '' }}</td>
							<td><a
									href="{{ route('trabajador.documentacion.generate',['trabajador_id' => $certificacion->trabajador->id, 'documentacion_id' => $certificacion->id,'empresa_id' => $empresa->id,  'type' => 'documentacion_laboral','filename' => $certificacion->url] ) }}">{{ $certificacion->url }}</a>
							</td>
							<td>{{ $certificacion->documentacion_tipo->nombre }}</td>
							<td>
								@include('trabajador.documentacion.estado', ['documentacion' => $certificacion])</td>
							<td>{{ $certificacion->created_at }}</td>
							<td>{{ $certificacion->reposo }}</td>
							<td>{{ $certificacion->observacion }}</td>
							<td>{{ $certificacion->user->nombre }} {{ $certificacion->user->apellido }}</td>
						</tr>

						@empty

						@endforelse

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
		$('#empresa_documentacion').DataTable({
			"dom": 'Bfrtip',
			"buttons": [
				'excelHtml5',
				'pdfHtml5'
			],
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