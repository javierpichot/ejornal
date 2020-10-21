<?php $__env->startSection('titulo', 'Listado de Profesionales'); ?>

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
             Listado de profesionales
         </h3>
         <div class="box-tools pull-right">
    <a href="<?php echo e(route('admin.profesional.create')); ?>" class="btn btn-primary pull-right">
          		<i class="fa fa-file-o"></i>
  				Nuevo
  			</a>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">
           <table id="profesional" class="table table-bordered table-hover">
						<thead>
							<tr>
								<td>Foto</td>
								<td>Nombre y Apellido</td>
								<td>Documento</td>
								<td>Profesion</td>
								<td>Telefono celular</td>
								<td>E-mail</td>
								<td>Observaciones supervisión</td>
								<td>Estado</td>
								<td style="width: 20%">Acciones</td>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $profesionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr id="profesional_<?php echo e($profesional->id); ?>">
								<td>
									<img src="<?php echo e(isset($profesional->photo) ? asset('storage/profesionales/'. $profesional->id . '/perfil/' . $profesional->photo ) : asset('img/avatar5.png')); ?>" alt="<?php echo e($profesional->nombre); ?> <?php echo e($profesional->apellido); ?>" class="rounded-circle" width="35px">
								</td>
								<td>
									<?php echo e($profesional->nombre); ?> <?php echo e($profesional->apellido); ?>

								</td>
								<td><?php echo e($profesional->documento); ?></td>
								<td><?php echo e(isset($profesional->profesional_tipo->nombre) ? $profesional->profesional_tipo->nombre : ''); ?></td>
								<td><?php echo e($profesional->celular); ?></td>
								<td><?php echo e($profesional->email); ?></td>
								<td><?php echo e($profesional->observacion_supervision); ?></td>
								<td></td>
								<td>
                                    <?php echo method_field('DELETE'); ?>

                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="profesional_id" value="<?php echo e($profesional->id); ?>">
                                    <button type="submit" class="btn btn-danger delete-confirm" data-id="<?php echo e($profesional->id); ?>" data-href="<?php echo e(route('admin.profesional.destroy', ['id' => $profesional->id])); ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a class="btn btn-warning" title="Edit" href="<?php echo e(route('admin.profesional.edit', ['id' => $profesional->id])); ?>"><i title="Editar ticket" class="fa fa-pencil"></i></a>

                                      <a class="btn btn-primary" title="Edit" href="<?php echo e(route('admin.profesional.show', ['id' => $profesional->id])); ?>"><i title="Editar incidencia" class="fa fa-eye"></i></a>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
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