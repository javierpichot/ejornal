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

				<?php echo e(Form::text('username',  isset($usuario) ? $usuario->username : null, ['class' => 'form-control box-size', 'placeholder' => "benito_arango", 'required' => 'required'])); ?>

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

				<?php echo e(Form::text('nombre',  isset($usuario) ? $usuario->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nicolás", 'required' => 'required'])); ?>

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

				<?php echo e(Form::text('apellido',  isset($usuario) ? $usuario->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Benito Arango", 'required' => 'required'])); ?>

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

				<?php echo e(Form::text('email',  isset($usuario) ? $usuario->email : null, ['class' => 'form-control box-size', 'placeholder' => "nbenitoarango@gmail.com", 'required' => 'required'])); ?>

				<?php if($errors->has('email')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('email')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row">

		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('roles') ? ' has-error' : ''); ?>">
			<div class="form-group">
				<?php echo e(Form::label('role', "Role")); ?>

				<?php echo Form::select('roles', $roles->pluck('name', 'id'), isset($usuario) ? $usuario->roles : null, ['placeholder' => 'Seleccione un role', 'class' => 'form-control box-size', 'id' => 'roles', 'required' => 'required']); ?>

				<?php if($errors->has('roles')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('roles')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="col-md-6 col-sm-12 <?php echo e($errors->has('empresas') ? ' has-error' : ''); ?>">
			<div class="form-group">
				<?php echo e(Form::label('empresas', "Empresas")); ?>

				<?php echo Form::select('empresas[]', $empresas->pluck('nombre', 'id'), isset($usuario) ? $usuario->empresas : null, ['class' => 'form-control box-size', 'id' => 'empresas', 'required' => 'required', 'multiple' => true]); ?>

				<?php if($errors->has('empresas')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('empresas')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 <?php echo e($errors->has('telefono') ? ' has-error' : ''); ?>">
			<div class="form-group">
				<?php echo e(Form::label('telefono', "Telefono")); ?>

				<?php echo e(Form::text('telefono',  isset($usuario) ? $usuario->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "332444555"])); ?>

				<?php if($errors->has('telefono')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('telefono')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="col-md-6">
			 <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
				 <label>Password</label>
				 <?php echo e(Form::password('password',  ['class' => 'form-control box-size', 'placeholder' => "Password del Usuario", isset($usuario) ? '' : 'required'])); ?>

				 <?php if($errors->has('password')): ?>
				 	<span class="help-block">
				 		<strong><?php echo e($errors->first('password')); ?></strong>
				 	</span>
				 <?php endif; ?>
			 </div>
		 </div>
		 <div class="col-md-6">
			 <div class="form-group">
				 <label>Confirmaci&oacute;n</label>
				  <?php echo e(Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => "Confirmaci&oacute;n de Password del Usuario", isset($usuario) ? '' : 'required'])); ?>

			 </div>

		 </div>

		 <div class="col-md-12">
		  <div class="form-group">
			  <label>Contraseña de email corporativo</label>
			   <?php echo e(Form::password('password_email',  ['class' => 'form-control', 'placeholder' => "Password Email Corporativo", isset($usuario) ? '' : 'required'])); ?>

		  </div>

	  </div>
	            <?php if(Auth::user()->google2fa_secret): ?>
                <a href="<?php echo e(url('2fa/disable')); ?>" class="btn btn-warning">Desactivar 2 factor de seguridad</a>
                <?php else: ?>
                <a href="<?php echo e(url('2fa/enable')); ?>" class="btn btn-primary">Activar 2 factor de seguridad</a>
                <?php endif; ?> </div>
</div>
