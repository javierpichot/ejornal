@extends('layouts.app')
@section('titulo', 'Listado de Clientes')

@section('content')

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Clientes</li>
        </ol>
    </nav>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h2 class="card-title">
        	Listado de Clientes
            @can('create cliente')
        	<a href="{{ route('cliente.create') }}" class="btn btn-primary float-right">
        		<i class="fa fa-file-o"></i>
				Nuevo
			</a>
            @endcan
        </h2>
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col-md-12">
                    @can('read cliente')
                    <table class="table table-striped table-bordered" id="cliente">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>C&oacute;digo</td>
                                <td>Nombre</td>
                                <td>Correo Electr&oacute;nico</td>
                                <td>Direcci&oacute;n</td>
                                <td>Telef&oacute;no Habitaci&oacute;n</td>
                                <td>Telef&oacute;no Celular</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $i=1; ?>
                            @foreach($clientes AS $c)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $c->cliente_code }}</td>
                                    <td>{{ $c->cliente_name }}</td>
                                    <td>{{ $c->cliente_email }}</td>
                                    <td>{{ $c->cliente_address }}</td>
                                    <td>{{ $c->cliente_phone }}</td>
                                    <td>{{ $c->cliente_celular }}</td>
                                   <td>
                                    @can('update ingreso')
                                         <a class="btn btn-primary " href="{{ route('cliente.edit', ['id' => $c->id]) }}">   
                                            <i class="fa fa-pencil"></i>
                                         </a>   
                                        @endcan
                                        @can('view ingreso')
                                         <a class="btn btn-primary " href="{{ route('cliente.show', ['id' => $c->id]) }}">   
                                            <i class="fa fa-eye"></i>
                                         </a>   
                                        @endcan
                                    </td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                $('#cliente').DataTable({
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