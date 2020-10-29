<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo $__env->yieldContent('titulo'); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dist/css/skins/_all-skins.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/square/blue.css')); ?>">
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script src="<?php echo e(asset('js/dev.js')); ?>?<?php echo e(rand()); ?>"></script>
        <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
        <script>
            window.empresa = <?php if(isset($empresa)): ?> <?php echo json_encode($empresa, 15, 512) ?> <?php endif; ?>;
            window.user_id = <?php echo json_encode(auth()->user()->id, 15, 512) ?>;
        </script>
        
    </head>
    

<?php echo $__env->yieldPushContent('styles'); ?>
<style>
    .swal2-confirm {
        margin-left: 10px;
    }
    .swal2-cancel {
        margin-right: 10px;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">


  <?php echo $__env->make('adminlte::layouts.partials.mainheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('adminlte::layouts.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <div class="content-wrapper">
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
      </section>
  </div>
</div>
<script src="<?php echo e(asset('js/sweetalert2.all.js')); ?>" ></script>

<?php echo $__env->yieldPushContent('script-message'); ?>

<?php echo $__env->yieldPushContent('script'); ?>
</body>
</html>
