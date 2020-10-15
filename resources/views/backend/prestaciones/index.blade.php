@extends('adminlte::layouts.app')
@section('titulo', 'Listado de Profesionales')

@section('main-content')


	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestión de prestaciones</li>

    
	</ol>
</nav>






 <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
         <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Listado de prestaciones</li>
     </ol>
 </nav>

 <div class="row">
   <div class="col-xs-12">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">
             Listado de prestaciones
         </h3>

       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">
           <table id="profesional" class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <td>Empresa</td>
                               <td>Fecha</td>
                               <td>Prestacion tipo</td>
                               <td>Relativo a</td>
                               <td>Descripcion</td>
                               <td>Estado</td>
                               <td>Observaciones</td>
                               <td>Usuario</td>                             
                               <td>Acciones</td>


                           </tr>
                       </thead>
                       <tbody>
                           @foreach  ($prestaciones_pedidos as $key => $prestacion_pedido)
                               <tr id="incidencia_{{ $prestacion_pedido->id }}">
                                   <td>
<a href="{{ route('empresa.prestacion.pedido.index', ['id' =>$prestacion_pedido->empresa->id, 'name' => $prestacion_pedido->empresa->nombre] )}}">      {{ $prestacion_pedido->empresa->nombre }}</a>
</td>
                                   <td>{{ $prestacion_pedido->created_at }}</td>
                                   <td>{{ $prestacion_pedido->prestacion_tipo->nombre }}</td>
                                   <td>
                                       @isset($prestacion_pedido->trabajador)
<a href="{{ route('trabajador.prestacion.pedido.index', ['id' =>$prestacion_pedido->trabajador->id, 'name' => $prestacion_pedido->trabajador->nombre,'empresa_id' => $prestacion_pedido->empresa->id] )}}">
                                             {{ $prestacion_pedido->trabajador->nombre or '' }} {{ $prestacion_pedido->trabajador->apellido or '' }}</a>
                                       @endisset
                                       @empty ($prestacion_pedido->trabajador)
                                       <a href="{{ route('empresa.show', ['id' =>$prestacion_pedido->empresa->id, 'name' => $prestacion_pedido->empresa->nombre] )}}">      {{ $prestacion_pedido->empresa->nombre }}</a>
                                       @endempty
                                   </td>
                                   <td>{{ $prestacion_pedido->descripcion or '' }}</td>
                                   <td>@include('empresa.prestacion.estado')</td>

                                   <td>{{ $prestacion_pedido->observaciones or '' }}</td>
                                   <td>{{ $prestacion_pedido->user->nombre or ''}} {{ $prestacion_pedido->user->apellido or ''}}</td>
                                     
                                <td>  <a href="{{ route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $prestacion_pedido->empresa->id]) }}" target="_blank"><button class="btn btn-success"><i title="Ver pedido" class="fa fa-eye"></i></button></a></td>
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
         						title: 'Eliminar prestación',
         						text: "¿Desea eliminar esta prestación?",
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
                               'La operacion a sido :)',
                               'error'
                           )
                       }
                   })

               });

       $('#profesional').DataTable({
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
          "dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
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
