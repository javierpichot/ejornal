<div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre') ? ' has-error' : ''); ?>">
	<div class="form-group">
		<?php echo e(Form::label('nombre', "Nombre tipo presentacion")); ?>

		<?php echo e(Form::text('nombre',  isset($presentacion_tipo) ? $presentacion_tipo->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Medico a domicilio", 'required' => 'required'])); ?>

		<?php if($errors->has('nombre')): ?>
			<span class="help-block">
				<strong><?php echo e($errors->first('nombre')); ?></strong>
			</span>
		<?php endif; ?>
	</div>
</div>

<div class="col-md-6 col-sm-12 <?php echo e($errors->has('tipo') ? ' has-error' : ''); ?>">
	<div class="form-group">
		<?php echo e(Form::label('tipo', "Tipo")); ?>

		<?php echo Form::select('tipo', $tipos->getTipos(), isset($presentacion_tipo) ? $presentacion_tipo->tipo : null, ['placeholder' => 'Seleccione el tipo', 'class' => 'form-control box-size', 'required' => 'required']); ?>

		<?php if($errors->has('tipo')): ?>
			<span class="help-block">
				<strong><?php echo e($errors->first('tipo')); ?></strong>
			</span>
		<?php endif; ?>
	</div>
</div>
