<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<?php $__env->startSection('htmlheader'); ?>
    <?php echo $__env->make('adminlte::layouts.partials.htmlheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>
<script src="<?php echo e(asset('js/dev.js')); ?>"></script>
<script>
    window.empresa = <?php if(isset($empresa)): ?> <?php echo json_encode($empresa, 15, 512) ?> <?php endif; ?>;
    window.user_id = <?php echo json_encode(auth()->user()->id, 15, 512) ?>;
</script>
<?php echo $__env->yieldPushContent('styles'); ?>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('adminlte::layouts.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>

<div class="wrapper">

  <?php echo $__env->make('adminlte::layouts.partials.mainheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('adminlte::layouts.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
          <?php echo $__env->yieldContent('main-content'); ?>
          <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Plazo vencido</h5>
                      </div>
                      <div class="modal-body">
                          La empresa ya no cuenta con un plan para su uso en nuestra web
                      </div>
                  </div>
              </div>
          </div>
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php echo $__env->make('adminlte::layouts.partials.controlsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('adminlte::layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div><!-- ./wrapper -->


<?php echo $__env->make('adminlte::layouts.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldPushContent('script-message'); ?>

<?php echo $__env->yieldPushContent('script'); ?>
<?php echo $__env->make('messenges.chat.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('vendor.adminlte.layouts.partials.modal_index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
