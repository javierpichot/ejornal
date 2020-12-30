<?php $__env->startSection('titulo', 'Editar Tipo de Incidencias'); ?>

<?php $__env->startSection('main-content'); ?>

    <?php echo e(Form::model($usuario,[ 'route' => ['admin.user.update', $usuario->id], 'role' => 'form', 'method' => 'patch', 'enctype' => 'multipart/form-data', 'id' => 'form'])); ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                <?php echo $__env->make("backend.user._formulario", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             </div>
         </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-default">
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
            $('#roles').select2()
            $('#empresas').select2()


            $('#photo').fileinput({
                <?php
                    @isset($user)


                ?>
                initialPreview: ["<?php echo e(asset('storage/jornal/usuario/' . $usuario->id . '/perfil/' . $usuario->photo)); ?>"],
                initialPreviewAsData: true,
                <?php
                    @endisset
                ?>
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