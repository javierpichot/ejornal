<?php $__env->startSection('titulo', 'Listado de administradores'); ?>

<?php $__env->startSection('main-content'); ?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('events_jornal.index')); ?>">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo e(route('admin.ajustes.index')); ?>">Administración web</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listado administradores</li>


    
	</ol>
</nav>

    <div class="box box-info">
         <div class="box-header">
           <h3 class="box-title">Listado de usuarios</h3>
           <a href="<?php echo e(route('admin.user.create')); ?>" class="btn btn-primary pull-right">
               <i class="fa fa-file-o"></i>
               Nuevo
           </a>
         </div>
         <div class="box-body table-responsive">
           <table class="table table-striped table-bordered" id="usuario">
               <thead>
                   <tr>
                                                <td>Foto</td>

                         <td>Usuario</td>
                         <td>Telefono</td>
     <td>Email</td>
                         <td>Rol</td>
                         <td>Empresa/s</td>
                         <td>Acciones</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i=1; ?>
                   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                             $canImpersonate = Auth::user()->can('impersonate', $s);
                             $formIdImpersonate = 'impersonateForm_'.$s->id;
                         ?>
                         <tr>
                                              
                           
                           
                           
                           
                           <td><img  class="img-circle elevation-2" width="55px" height="55px"src="<?php echo e(asset('storage/jornal/usuario/'. $s->id . '/perfil/'. $s->photo )); ?>" alt="<?php echo e($s->photo); ?>"></td>
<td><?php echo e($s->nombre); ?> <?php echo e($s->apellido); ?></td>
                             <td><?php echo e($s->telefono); ?></td>
 <td><?php echo e($s->email); ?></td>
                             <td>
                                 <?php $__currentLoopData = $s->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo e($role->name); ?>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </td>
                             <td>
                                 <?php $__currentLoopData = $s->empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo e($loop->first ? '' : ', '); ?>

                                     <?php echo e($empresa->nombre); ?>

                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </td>
                             <td>

                                 
                                 
                                 
                                 
                                 <a class="btn btn-primary" href="<?php echo e(route('admin.user.edit', ['id' => $s->id, 'empresa_id' => $s->id])); ?>">
                                    <i class="fa fa-pencil"></i>
                                 </a>
                                  <a class="btn btn-primary" title="Edit" href="<?php echo e(route('empresa.usuario.show', ['id' => $s->id, 'empresa_id' => $s->id])); ?>"><i title="Editar usuario" class="fa fa-eye"></i></a>
                                  <a href="#" class="btn btn-warning btn-primary"
                                     onclick="event.preventDefault(); document.getElementById('<?php echo e($formIdImpersonate); ?>').submit();">
                                      <i class="fa fa-user-secret"></i>
                                  </a>
                                  <form id="<?php echo e($formIdImpersonate); ?>" action="<?php echo e(route('impersonate', $s->id)); ?>" method="POST" style="display: none;">
                                      <?php echo e(csrf_field()); ?>

                                  </form>
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
                $('.delete-confirm').on('click', function(e) {
                    e.preventDefault();

                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                        title: 'Eliminar profesional',
                        text: "¿Desea eliminar esta profesional?",
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
                $('#usuario').DataTable({
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