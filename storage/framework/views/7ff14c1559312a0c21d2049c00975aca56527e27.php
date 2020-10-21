<?php $__env->startSection('titulo', 'Cartera de prestaciones'); ?>

<?php $__env->startSection('main-content'); ?>
 



	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('events_jornal.index')); ?>">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo e(route('admin.gestion-pedidos.index')); ?>">Gestión de prestaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cartera de prestaciones</li>


    
	</ol>
</nav>


    <div class="box box-info">
         <div class="box-header">
           <h3 class="box-title">Cartera de prestaciones</h3>
           <a href="<?php echo e(route('admin.tipo-prestacion.create')); ?>" class="btn btn-primary pull-right">
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
                     <?php $__currentLoopData = $tipo_presentaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <td><?php echo e($s->nombre); ?></td>
                             <td>
                                 <a class="btn btn-primary" href="<?php echo e(route('admin.tipo-prestacion.edit', ['id' => $s->id])); ?>">
                                    <i class="fa fa-pencil"></i>
                                 </a>

                             </td>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>