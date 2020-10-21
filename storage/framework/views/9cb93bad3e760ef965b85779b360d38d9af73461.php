<?php $__env->startSection('titulo',  'Listado de documentos internos'); ?>

<?php $__env->startSection('main-content'); ?>



	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('events_jornal.index')); ?>">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.profesional.index')); ?>">Gestión de profesionales</a></li>

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
                 <?php $__currentLoopData = $profesional_fichadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesional_fichada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <tr id="documentacion_jornal_<?php echo e($profesional_fichada->id); ?>">
                    <td><?php echo e(isset($profesional_fichada->fechahora_entrada) ? $profesional_fichada->fechahora_entrada : ''); ?></td>
                     <td><?php echo e(date('H:i', strtotime($profesional_fichada->fechahora_entrada))); ?></td>

                   <td><?php echo e(isset($profesional_fichada->profesional->nombre) ? $profesional_fichada->profesional->nombre : ''); ?> <?php echo e(isset($profesional_fichada->profesional->apellido) ? $profesional_fichada->profesional->apellido : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->profesional->profesional_tipo->nombre) ? $profesional_fichada->profesional->profesional_tipo->nombre : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->empresa->nombre) ? $profesional_fichada->empresa->nombre : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->localizacion_entrada) ? $profesional_fichada->localizacion_entrada : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->IP_entrada) ? $profesional_fichada->IP_entrada : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->navegador_entrada) ? $profesional_fichada->navegador_entrada : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->fechahora_salida) ? $profesional_fichada->fechahora_salida : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->localizacion_salida) ? $profesional_fichada->localizacion_salida : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->IP_salida) ? $profesional_fichada->IP_salida : ''); ?></td>
                     <td><?php echo e(isset($profesional_fichada->navegador_salida) ? $profesional_fichada->navegador_salida : ''); ?></td>

                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
         </table>
     </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>