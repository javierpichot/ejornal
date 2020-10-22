<?php $__env->startSection('titulo', 'Empresa'); ?>

<?php $__env->startSection('main-content'); ?>
        <?php echo e(Form::model($empresa, ['route' => ['admin.empresa.update', $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'id' => 'form'])); ?>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.empresa.index')); ?>">Listado de Empresas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Empresa <?php echo e($empresa->nombre); ?></li>
            </ol>
        </nav>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informaci&oacute;n General</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <?php echo $__env->make("backend.empresa._formulario", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                        <i class="fa fa-save nav-icon"></i>
                        Guardar edicion
                    </button>
                    <a href="<?php echo e(route('admin.empresa.index')); ?>" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <style type="text/css">
        .kv-file-upload {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $().ready(function() {
            $('.select2').select2()
            $('.categorias').tagsinput();

            $('.categorias').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here
               var empresa_id =  $('input[name="empresa_id"]').val();

               if (!event.options || !event.options.preventPost) {
                   $.ajax({
                       url: '/empresa/categoria/' + empresa_id +'/destroy',
                       method: 'POST',
                       data: {
                           '_token': $('input[name="_token"]').val(),
                           'nombre':  tag,
                           '_method': "DELETE"
                       },
                       success: function(data) {

                       },
                       error: function(xhr, message) {

                       }
                   });
               }
            });


            $('.sectors').tagsinput();
            $('.sectors').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here

               var empresa_id =  $('input[name="empresa_id"]').val();

               if (!event.options || !event.options.preventPost) {
                   $.ajax({
                       url: '/empresa/sector/' + empresa_id +'/destroy',
                       method: 'POST',
                       data: {
                           '_token': $('input[name="_token"]').val(),
                           'nombre':  tag,
                           '_method': "DELETE"
                       },
                       success: function(data) {

                       },
                       error: function(xhr, message) {

                       }
                   });
               }
            });

            $('.turnos').tagsinput();
            $('.turnos').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here

               var empresa_id =  $('input[name="empresa_id"]').val();

               if (!event.options || !event.options.preventPost) {
                   $.ajax({
                       url: '/empresa/turno/' + empresa_id +'/destroy',
                       method: 'POST',
                       data: {
                           '_token': $('input[name="_token"]').val(),
                           'nombre':  tag,
                           '_method': "DELETE"
                       },
                       success: function(data) {

                       },
                       error: function(xhr, message) {

                       }
                   });
               }
            });


            $('.tareas').tagsinput();
            $('.tareas').on('beforeItemRemove', function(event) {
               var tag = event.item;

               // Do some processing here
               var empresa_id =  $('input[name="empresa_id"]').val();

               if (!event.options || !event.options.preventPost) {
                   $.ajax({
                       url: '/empresa/tarea/' + empresa_id +'/destroy',
                       method: 'POST',
                       data: {
                           '_token': $('input[name="_token"]').val(),
                           'nombre':  tag,
                           '_method': "DELETE"
                       },
                       success: function(data) {

                       },
                       error: function(xhr, message) {

                       }
                   });
               }
            });

            $('#caducidad .input-group.date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#logo').fileinput({
                <?php if(isset($empresa)) { ?>
                initialPreview: ["<?php echo e(asset('storage/empresas/' . $empresa->id . '/perfil/' .$empresa->logo)); ?>"],
                initialPreviewAsData: true,
                <?php } ?>
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            // validate the comment form when it is submitted
            $("#form").validate();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>