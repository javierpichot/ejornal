<?php $__env->startSection('titulo', 'Editar un profesional'); ?>

<?php $__env->startSection('main-content'); ?>

    <?php echo e(Form::model($profesional, ['route' => ['admin.profesional.update', $profesional->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'form',  'enctype' => 'multipart/form-data'])); ?>

    <nav aria-label="breadcrumb">
    				<ol class="breadcrumb">
    						<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.dashboard.index')); ?>">Gerencia de Jornal</a></li>
    						<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.profesional.index')); ?>">Listado de Profesionales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dar de alta nuevo profesional</li>
</ol>
    </nav>
    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                <?php echo $__env->make("backend.profesional._form", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <a href="<?php echo e(route('admin.proveedores.index')); ?>" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    <br>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
            $(function () {
                $("#form").validate();

                $('#photo').fileinput({
                    <?php if(isset($profesional)) { ?>
                    initialPreview: ["<?php echo e(asset('storage/profesionales/' . $profesional->id. '/' . $profesional->photo)); ?>"],
                    initialPreviewAsData: true,
                    <?php } ?>
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del profesional',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_titulo').fileinput({
                    <?php if(isset($profesional)) { ?>
                    initialPreview: ["<?php echo e(asset('img/profesional/foto_titulo/' . $profesional->foto_titulo)); ?>"],
                    initialPreviewAsData: true,
                    <?php } ?>
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del titulo',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_documento').fileinput({
                    <?php if(isset($profesional)) { ?>
                    initialPreview: ["<?php echo e(asset('img/profesional/foto_documento/' . $profesional->foto_documento)); ?>"],
                    initialPreviewAsData: true,
                    <?php } ?>
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del documento',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_seguro').fileinput({
                    <?php if(isset($profesional)) { ?>
                    initialPreview: ["<?php echo e(asset('img/profesional/foto_seguro/' . $profesional->foto_seguro)); ?>"],
                    initialPreviewAsData: true,
                    <?php } ?>
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del seguro',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_matricula').fileinput({
                    <?php if(isset($profesional)) { ?>
                    initialPreview: ["<?php echo e(asset('img/profesional/foto_matricula/' . $profesional->foto_matricula)); ?>"],
                    initialPreviewAsData: true,
                    <?php } ?>
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto de la matricula',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});


            });
        </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>