@extends('adminlte::layouts.app')
@section('titulo',  'Listado de documentos internos')

@section('main-content')



	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.profesional.index') }}">Gestión de profesionales</a></li>

    <li class="breadcrumb-item active" aria-current="page">Listado de fichadas</li>
    
	</ol>
</nav>


<div class="box box-info">
     <div class="box-header">
       <h3 class="box-title">Listado de fichadas</h3>

     </div>
     <div class="box-body table-responsive">
         <table class="table table-striped table-bordered" id="profesionales_fichadas">
             <thead>
                 <tr>
                     <td>Día</td>
                     <td>Hora de entrada</td>                  
                     <td>Nombre</td>
                     <td>Profesional</td>
                     <td>Empresa</td>
                     <td>Localizacion</td>
                     <td>IP entrada</td>
                     <td>Navegador entrada</td>
                     <td>Hora de salida</td>
                     <td>Localizacion salida</td>
                     <td>IP salida</td>
                     <td>Navegador salida</td>

                 </tr>
             </thead>
             <tbody>
                 @foreach($profesional_fichadas  AS $profesional_fichada)
                 <tr id="documentacion_jornal_{{ $profesional_fichada->id }}">
                    <td>{{   $profesional_fichada->fechahora_entrada  or ''}}</td>
                     <td>{{ date('H:i', strtotime($profesional_fichada->fechahora_entrada))}}</td>

                   <td>{{ $profesional_fichada->profesional->nombre or ''}} {{ $profesional_fichada->profesional->apellido or ''}}</td>
                     <td>{{ $profesional_fichada->profesional->profesional_tipo->nombre or '' }}</td>
                     <td>{{ $profesional_fichada->empresa->nombre or ''}}</td>
                     <td>{{ $profesional_fichada->localizacion_entrada or '' }}</td>
                     <td>{{ $profesional_fichada->IP_entrada  or ''}}</td>
                     <td>{{ $profesional_fichada->navegador_entrada  or ''}}</td>
                     <td>{{ $profesional_fichada->fechahora_salida  or ''}}</td>
                     <td>{{ $profesional_fichada->localizacion_salida or '' }}</td>
                     <td>{{ $profesional_fichada->IP_salida or '' }}</td>
                     <td>{{ $profesional_fichada->navegador_salida  or ''}}</td>

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
	            $('#profesionales_fichadas').DataTable({
                      "order": [[ 0, "desc" ]],

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
                title: 'Desea eliminar el profesional?',
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
                                $('#profesionales_fichadas' + data.id).fadeOut();
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

    });
</script>
@endpush
