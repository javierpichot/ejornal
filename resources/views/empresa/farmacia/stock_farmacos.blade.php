@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de trabajadores de '. $empresa->nombre)


@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection


@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Histórico movimientos farmacia</li>
        </ol>
    </nav>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                {!! Form::open(['route' => 'empresa.exportsFarmacosHistoricos']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <!-- /.box-body -->
                <button type="submit" class="btn btn-info pull-left">Exportar cvs</button>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
   					<table class="table table-striped table-bordered" id="farmaco-trabajadores">
   						<thead>
   							<tr>
   								<th>Fecha</th>
								<th>Foto</th>
                  
								<th>Trabajador</th>
   								<th>Fármaco</th>
   								<th>Cantidad</th>
           				<th>Motivo consulta</th>
   								<th>Profesional</th>
   							</tr>
   						</thead>
   						<tbody>

   						</tbody>
   					</table>
   				</div>
   			</div>
   		</div>
   	</div>

@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $('#farmaco-trabajadores').DataTable({
      "order": [[ 0, "desc" ]],
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
                            processing: true,
                            serverSide: true,
                            ajax: '/api/{{ $empresa->id }}/farmacos/get',
                            columns: [
                                     {data: 'fecha_consulta', name: 'fecha_consulta'},
                              
                            	{data: 'foto', name: 'foto', orderable: false, searchable: false},
	                          {data: 'trabajador', name: 'trabajador', orderable: false, searchable: false},
                                    {data: 'nombre_farmaco', name: 'nombre_farmaco'},
                                    {data: 'cantidad', name: 'cantidad'},
                                    {data: 'motivo_consulta', name: 'motivo_consulta'},
                                    {data: 'profesional', name: 'profesional'}


                            ],
                            columnDefs: [
                            { targets: 1,
                              render: function(data) {
                                 return $('<div>').html(data).text();
                              }
                            }
                          ],
            });
        });
    </script>
@endpush
