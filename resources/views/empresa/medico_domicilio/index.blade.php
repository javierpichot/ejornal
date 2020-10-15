@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de incidencias de '. $empresa->nombre)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')
    <nav aria-label="breadcrumb">
    	<ol class="breadcrumb">
    		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
    		<li class="breadcrumb-item active" aria-current="page">Listado de incidencias</li>
    	</ol>
    </nav>
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <div class="box-header">
             <h3 class="box-title">
                 Listado de reportes de medicos a domicilios
             </h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body table-responsive">

    						<table class="table table-striped table-bordered" id="medico_domicilio">
    							<thead>
    								<tr>
    									<td>Fecha</td>
    									<td>Foto</td>
    									<td>Nombre</td>
    									<td>Orden de servicio</td>
    									<td>Reporte de servicio</td>
    								</tr>
    							</thead>
    							<tbody>

                                    @foreach ($prestaciones as $key => $prestacion)
                                        <tr>
                                            <td>{{ $prestacion->created_at }}</td>
                                            <td>{{ $prestacion->reporte_url }}</td>
                                            <td>{{ $prestacion->reporte }}</td>
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
    		$('#medico_domicilio').DataTable({
    			"dom": 'Bfrtip',
    		"buttons": [
    		'excelHtml5',
    		'pdfHtml5'
    		],"language": {
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
