<?php $__env->startSection('titulo', 'Informacion General de'. $user->nombre ); ?>

<?php $__env->startSection('main-content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profesional <?php echo e($user->nombre); ?> detalles</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
                Informaci&oacute;n General de <?php echo e($user->nombre); ?>

            </h3>
          </div>
          <div class="box-body">
              <div class="col-md-4 col-sm-12">
              	<div class="file-loading">
              		<input id="photo" name="photo" type="file">
              	</div>
              </div>
              <div class="col-md-8 col-sm-12">
              	<div class="row">
              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('username', "User name")); ?>

              				<?php echo e(Form::text('username',  isset($user) ? $user->username : null, ['class' => 'form-control box-size', 'placeholder' => "benito_arango", 'required' => 'required', 'disabled' => true])); ?>

              				<?php if($errors->has('username')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('username')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>


              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('nombre', "Nombre")); ?>

              				<?php echo e(Form::text('nombre',  isset($user) ? $user->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nicolás", 'required' => 'required', 'disabled' => true])); ?>

              				<?php if($errors->has('nombre')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('nombre')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>

              	</div>

              	<div class="row">
              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('apellido') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('apellido', "Apellido")); ?>

              				<?php echo e(Form::text('apellido',  isset($user) ? $user->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Benito Arango", 'required' => 'required', 'disabled' => true])); ?>

              				<?php if($errors->has('apellido')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('apellido')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>


              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('email', "Email")); ?>

              				<?php echo e(Form::text('email',  isset($user) ? $user->email : null, ['class' => 'form-control box-size', 'placeholder' => "nbenitoarango@gmail.com", 'required' => 'required', 'disabled' => true])); ?>

              				<?php if($errors->has('email')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('email')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('empresas') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('email', "Empresa")); ?>

              				<?php echo Form::select('empresas[]', $empresas->pluck('nombre', 'id'),  isset($user) ? $user->empresas : null, ['placeholder' => 'Seleccione una empresa', 'class' => 'form-control box-size', 'id' => 'empresas', 'required' => 'required', 'multiple' => true, 'disabled' => true]); ?>

              				<?php if($errors->has('empresas')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('empresas')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>

              		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('roles') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('role', "Role")); ?>

              				<?php echo Form::select('roles', $roles->pluck('name', 'id'), isset($user) ? $user->roles : null, ['placeholder' => 'Seleccione una empresa', 'class' => 'form-control box-size', 'id' => 'roles', 'required' => 'required', 'disabled' => true]); ?>

              				<?php if($errors->has('roles')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('roles')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>
              	</div>

              	<div class="row">
              		<div class="col-md-12 col-sm-12 <?php echo e($errors->has('telefono') ? ' has-error' : ''); ?>">
              			<div class="form-group">
              				<?php echo e(Form::label('telefono', "Telefono")); ?>

              				<?php echo e(Form::text('telefono',  isset($user) ? $user->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "332444555", 'required' => 'required', 'disabled' => true])); ?>

              				<?php if($errors->has('telefono')): ?>
              					<span class="help-block">
              						<strong><?php echo e($errors->first('telefono')); ?></strong>
              					</span>
              				<?php endif; ?>
              			</div>
              		</div>
              	</div>
            </div>

          </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        $(function () {
            $('#photo').fileinput({
                <?php if(isset($user)) { ?>
                initialPreview: ["<?php echo e(asset('storage/user_empresa/'. $user->id . '/' . $user->photo)); ?>"],
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

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>