<?php $__env->startSection('titulo', 'Listado de Empresas'); ?>

<?php $__env->startSection('main-content'); ?>

	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('events_jornal.index')); ?>">Gerencia de Jornal</a></li>
         <li class="breadcrumb-item active" aria-current="page">Listado de Empresas</li>
    
	</ol>
</nav>


 <div class="row">
   <div class="col-xs-12">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">
             Listado de Empresas
         </h3>
         <div class="box-tools pull-right">
             <a href="<?php echo e(route('admin.empresa.create')); ?>" class="btn btn-primary pull-right">
          		<i class="fa fa-file-o"></i>
  				Nuevo
  			</a>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">
           <table id="empresa" class="table table-bordered table-hover">
             <thead>
                 <tr>
                     <td>Nombre</td>
                     <td>Cuit</td>
                     <td>Direcci&oacute;n</td>
                     <td>Caducidad</td>
                     <td>Acciones</td>
                 </tr>
             </thead>
             <tbody>
                 <?php $__currentLoopData = $empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                         <td><?php echo e($p->nombre); ?></td>
                         <td><?php echo e($p->cuit); ?></td>
                         <td><?php echo e($p->direccion); ?></td>
                         <td><?php echo e($p->caducidad); ?></td>
                         <td>

                              <a class="btn btn-primary" href="<?php echo e(route('admin.empresa.edit', ['id' => $p->id])); ?>">
                                 <i class="fa fa-pencil"></i>
                              </a>
                             <a class="btn btn-primary" href="<?php echo e(route('empresa.show', ['id' =>  $p->id, 'name' => $p->nombre] )); ?>">
                                 <i class="fa fa-globe"></i>
                              </a>
                         </td>
                     </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
     	</table>
				</div>

			</div>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
	<script type="text/javascript">
			$(function () {
	            $('#empresa').DataTable({
	                 "dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
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