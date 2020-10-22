<div class="col-md-4">
    <div class="file-loading">
        <input id="logo" name="logo" type="file">
    </div>
</div>

<?php if(isset($empresa)): ?>
    <input type="hidden" name="empresa_id" value="<?php echo e($empresa->id); ?>">
<?php endif; ?>

<div class="col-md-8">
    <div class="row">
        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('nombre', "Nombre empresa")); ?>

                <?php echo e(Form::text('nombre',  isset($empresa) ? $empresa->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Carrefour", 'required' => 'required'])); ?>

                <?php if($errors->has('nombre')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('nombre')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('cuit') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('cuit', "Cuit")); ?>

                <?php echo e(Form::text('cuit',  isset($empresa) ? $empresa->cuit : null, ['class' => 'form-control box-size', 'placeholder' => "12864535", 'required' => 'required'])); ?>

                <?php if($errors->has('cuit')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('cuit')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('direccion') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('direccion', "Direccion")); ?>

                <?php echo e(Form::textarea('direccion',  isset($empresa) ? $empresa->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Camino cintura 7700", 'required' => 'required'])); ?>

                <?php if($errors->has('direccion')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('direccion')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre_categoria') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('categoria', "Categoria")); ?>

                <br>
                <?php echo e(Form::text('nombre_categoria', isset($empresa) ? implode(",", $empresa->categoria()->pluck('nombre')->toArray()) : null, ['class' => 'form-control categorias', 'placeholder' => "Sin convenio, A1", 'required' => 'required'])); ?>

                <?php if($errors->has('nombre_categoria')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('nombre_categoria')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>



        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre_sector') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('sector', "Sector")); ?>

                <?php echo e(Form::text('nombre_sector', isset($empresa) ? implode(",", $empresa->sector()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size sectors', 'placeholder' => "Producción, Administración", 'required' => 'required'])); ?>

                <?php if($errors->has('nombre_sector')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('nombre_sector')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre_turno') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('turnos', "Turno")); ?>

                <br>
                <?php echo e(Form::text('nombre_turno', isset($empresa) ? implode(",", $empresa->turno()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size turnos', 'placeholder' => "Mañana, Tarde, Noche", 'required' => 'required'])); ?>

                <?php if($errors->has('nombre_turno')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('nombre_turno')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre_tarea') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('tareas', "Tareas")); ?>

                <?php echo e(Form::text('nombre_tarea', isset($empresa) ? implode(",", $empresa->tarea()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size tareas', 'placeholder' => "Supervisor, Maquinista, Operador", 'required' => 'required'])); ?>

                <?php if($errors->has('nombre_tarea')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('nombre_tarea')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4 <?php echo e($errors->has('caducidad') ? ' has-error' : ''); ?>">
                <div class="form-group" id="caducidad">
                        <?php echo e(Form::label('caducidad', "Caducidad")); ?>

                        <div class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            <?php echo e(Form::text('caducidad',  isset($empresa) ? $empresa->caducidad : null, ['class' => 'form-control box-size', 'placeholder' => "Caducidad de la empresa", 'required' => 'required'])); ?>

                        </div>
                        <label id="orden_date-error" class="error" for="orden_date"></label>
                        <?php if($errors->has('caducidad')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('caducidad')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
        </div>
    </div>
</div>
