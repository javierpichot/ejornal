@extends('adminlte::layouts.app')
@section('titulo', 'Cartera de prestaciones')

@section('main-content')
 



	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{ route('admin.gestion-pedidos.index') }}">Gestión de prestaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cartera de prestaciones</li>


    
	</ol>
</nav>


    <div class="box box-info">
         <div class="box-header">
           <h3 class="box-title">Cartera de prestaciones</h3>
           <a href="{{ route('admin.tipo-prestacion.create') }}" class="btn btn-primary pull-right">
               <i class="fa fa-file-o"></i>
               Nuevo
           </a>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-striped table-bordered" id="presentaciones">
                 <thead>
                     <tr>
                         <td>Prestación ofrecida</td>
                         <td>Acciones</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i=1; ?>
                     @foreach($tipo_presentaciones AS $s)
                         <tr>
                             <td>{{ $s->nombre }}</td>
                             <td>
                                 <a class="btn btn-primary" href="{{ route('admin.tipo-prestacion.edit', ['id' => $s->id]) }}">
                                    <i class="fa fa-pencil"></i>
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
            $(function () {
                $('#presentaciones').DataTable({
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
