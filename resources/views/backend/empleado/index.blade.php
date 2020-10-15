@extends('layouts.app')
@section('titulo', 'Listado de Empleados')

@section('content')

 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Empleados</li>
        </ol>
    </nav>


<div class="card card-primary card-outline">
    <div class="card-header">
        <h2 class="card-title">
        	Listado de Empleados
        	@can('create empleado')
        	<a href="{{ route('empleado.create') }}" class="btn btn-primary float-right">
        		<i class="fa fa-file-o"></i>
				Nuevo
			</a>
			@endcan
        </h2>
    </div>
    <div class="card-body">
		    <div class="row">
				<div class="col-md-12">
					@can('read empleado')
					<div class="table-responsive">
					<table class="table table-striped table-bordered" id="empleado">
						<thead>
							<tr>
								<td>#</td>
								<td>C&oacute;digo</td>
								<td>C&eacute;dula</td>
								<td>Nombre</td>
								<td>Apellido</td>
								<td>Fecha de Nacimiento</td>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($empleados AS $p)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $p->empleado_code }}</td>
									<td>{{ $p->empleado_document }}</td>
									<td>{{ $p->empleado_firstname }}</td>
									<td>{{ $p->empleado_lastname }}</td>
									<td>{{ $p->empleado_firstdate }}</td>
									<td>
										@can('update empleado')
		                                 <a class="btn btn-primary" href="{{ route('empleado.edit', ['id' => $p->id]) }}">	
										 	<i class="fa fa-pencil"></i>
										 </a>	
		                            	@endcan	
		                            	@can('view empleado')
		                                 <a class="btn btn-primary" href="{{ route('empleado.show', ['id' => $p->id]) }}">	
										 	<i class="fa fa-eye"></i>
										 </a>	
		                            	@endcan	
		                            </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
					@else

					
					@endcan
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
			$(function () {
	            $('#empleado').DataTable({
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