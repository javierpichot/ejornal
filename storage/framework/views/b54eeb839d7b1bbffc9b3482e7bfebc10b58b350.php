<?php $__env->startSection('titulo', 'Crear Tipo de Incidencias'); ?>

<?php $__env->startSection('main-content'); ?>

    <?php echo e(Form::open(['route' => 'admin.tipo-prestacion.store', 'role' => 'form', 'method' => 'post', 'id' => 'form'])); ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.tipo-prestacion.index')); ?>">Listado de Tipo de Presentaciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tipo de Presentaciones</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body table-responsive"><?php echo $__env->make("backend.tipo_presentaciones._form", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="<?php echo e(route('admin.tipo-prestacion.index')); ?>" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>