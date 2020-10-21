<?php if(isset($ticket)): ?>
    <?php echo e(Form::model($ticket, ['route' => ['ticket-jornals.update', $ticket->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'ticket'])); ?>

    <input type="hidden" name="user_id" value="<?php echo e($ticket->user_id); ?>">
<?php else: ?>
    <?php echo Form::open(['route' => 'ticket-jornals.store', 'id'=>'ticket']); ?>

    <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
<?php endif; ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><?php echo e(isset($ticket)?'Editar':'Crear nuevo'); ?> ticket jornals</h4>

</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="custom-control custom-checkbox">
                    <?php echo e(Form::checkbox('roles[]', $role->id, null, ['class' => "custom-control-input", 'id' => "customCheck".$role->id ])); ?>

                    <label class="custom-control-label" for="customCheck<?php echo e($role->id); ?>"><?php echo e($role->name); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 <?php echo e($errors->has('motivo') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('motivo', "Motivo")); ?>

                <?php echo e(Form::text('motivo',  isset($ticket) ? $ticket->motivo : null, ['class' => 'form-control box-size', 'placeholder' => "Hipertensión arterial", 'required' => 'required'])); ?>

                <?php if($errors->has('motivo')): ?>
                    <span class="help-block">
        				<strong><?php echo e($errors->first('motivo')); ?></strong>
        			</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 <?php echo e($errors->has('observacion') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('observacion', "Observacion")); ?>

                <?php echo e(Form::textarea('observacion',  isset($ticket) ?$ticket->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Hipertensión arterial", 'required' => 'required'])); ?>

                <?php if($errors->has('observacion')): ?>
                    <span class="help-block">
        				<strong><?php echo e($errors->first('observacion')); ?></strong>
        			</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
<?php echo e(Form::close()); ?>

