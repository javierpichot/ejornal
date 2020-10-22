<div class="col-md-4 col-sm-12" style="margin-left:15px">
    <div class="row">

        <div class="file-loading">
            <input id="photo" name="photo" type="file">

	</div>


        <div class="row">
            <div class="col-md-12 col-sm-12 <?php echo e($errors->has('profesional_tipo_id') ? ' has-error' : ''); ?>">
                <div class="form-group">
                    <?php echo e(Form::label('profesional_tipo_id', "Tipo de profesional")); ?>

                    <?php echo Form::select('profesional_tipo_id', $tipo_profesional->pluck('nombre', 'id'), isset($profesional) ? $profesional->profesional_tipo_id : null, ['placeholder' => 'Seleccione tipo profesional', 'class' => 'form-control box-size']); ?>

                    <?php if($errors->has('tipo_profesional')): ?>
                    <span class="help-block">
              <strong><?php echo e($errors->first('profesional_tipo_id')); ?></strong>
            </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 <?php echo e($errors->has('user_id') ? ' has-error' : ''); ?>">
                <div class="form-group">
                    <?php echo e(Form::label('user_id', "Asociar usuario web")); ?>

                    <?php echo Form::select('user_id', $users->pluck('email', 'id'), isset($profesional) ? $profesional->user_id : null, ['placeholder' => 'Seleccione un usuario web', 'class' => 'form-control box-size', 'id' => 'usuario_id']); ?>

                    <?php if($errors->has('user_id')): ?>
                    <span class="help-block">
                <strong><?php echo e($errors->first('user_id')); ?></strong>
              </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="file-loading">
                <input id="foto_titulo" name="foto_titulo" type="file">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 <?php echo e($errors->has('documento') ? ' has-error' : ''); ?>">
                <div class="form-group">
                    <?php echo e(Form::label('documento', "Documento")); ?>

                    <?php echo e(Form::text('documento', isset($profesional) ? $profesional->documento : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXX", 'id' => "documento"])); ?>

                    <?php if($errors->has('documento')): ?>
                    <span class="help-block">
                <strong><?php echo e($errors->first('documento')); ?></strong>
              </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="file-loading">
                <input id="foto_documento" name="foto_documento" type="file">

        </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-12 col-sm-12 <?php echo e($errors->has('numero_matricula') ? ' has-error' : ''); ?>">
                <div class="form-group">
                    <?php echo e(Form::label('numero_matricula', "Matricula")); ?>

                    <?php echo e(Form::number('numero_matricula', isset($profesional) ? $profesional->numero_matricula : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX"])); ?>

                    <?php if($errors->has('numero_matricula')): ?>
                    <span class="help-block">
                <strong><?php echo e($errors->first('numero_matricula')); ?></strong>
              </span>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="file-loading">
                <input id="foto_seguro" name="foto_seguro" type="file">

      </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 <?php echo e($errors->has('poliza') ? ' has-error' : ''); ?>">
                <div class="form-group">
                    <?php echo e(Form::label('poliza', "Seguro")); ?>

                    <?php echo e(Form::text('poliza', isset($profesional) ? $profesional->poliza : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX"])); ?>

                    <?php if($errors->has('poliza')): ?>
                    <span class="help-block">
              <strong><?php echo e($errors->first('poliza')); ?></strong>
            </span>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="file-loading">
                <input id="foto_matricula" name="foto_matricula" type="file">

    </div>
        </div>


    </div>
</div>
<div class="col-md-7 col-sm-12" style="margin-left:15px">
    <div class="row">

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('nombre', "Nombre")); ?>

                <?php echo e(Form::text('nombre', isset($profesional) ? $profesional->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre"])); ?>

                <?php if($errors->has('nombre')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('nombre')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('apellido') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('apellido', "Apellido")); ?>

                <?php echo e(Form::text('apellido', isset($profesional) ? $profesional->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Apellido"])); ?>

                <?php if($errors->has('apellido')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('apellido')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('email', "Email")); ?>

                <?php echo e(Form::text('email', isset($profesional) ? $profesional->email : null, ['class' => 'form-control box-size', 'placeholder' => "email
                @correo.com",  ])); ?>

                <?php if($errors->has('email')): ?>
                <span class="help-block">
            <strong><?php echo e($errors->first('email')); ?></strong>
          </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('celular') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('celular', "Celular")); ?>

                <?php echo e(Form::text('celular', isset($profesional) ? $profesional->celular : null, ['class' => 'form-control box-size', 'placeholder' => "Nº de celular"])); ?>

                <?php if($errors->has('celular')): ?>
                <span class="help-block">
            <strong><?php echo e($errors->first('celular')); ?></strong>
          </span>
                <?php endif; ?>
            </div>
        </div>


    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('nombre_familiar') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('nombre_familiar', "Nombre familiar")); ?>

                <?php echo e(Form::text('nombre_familiar', isset($profesional) ? $profesional->nombre_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre familiar"])); ?>

                <?php if($errors->has('nombre_familiar')): ?>
                <span class="help-block">
            <strong><?php echo e($errors->first('nombre_familiar')); ?></strong>
          </span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('celular_familiar') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('celular_familiar', "Telefono familiar")); ?>

                <?php echo e(Form::text('celular_familiar', isset($profesional) ? $profesional->celular_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Telefono familiar"])); ?>

                <?php if($errors->has('celular_familiar')): ?>
                <span class="help-block">
            <strong><?php echo e($errors->first('celular_familiar')); ?></strong>
          </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('direccion') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('direccion', "Dirección")); ?>

                <?php echo e(Form::text('direccion', isset($profesional) ? $profesional->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Dirección"])); ?>

                <?php if($errors->has('direccion')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('direccion')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('localidad_id') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('localidad_id', "Localidad")); ?>

                <?php echo Form::select('localidad_id', $localidades->pluck('nombre', 'id'), isset($profesional) ? $profesional->localidad_id : null, ['placeholder' => 'Seleccione una localidad', 'class' => 'form-control box-size', 'id' => 'roles',
                ]); ?>

                <?php if($errors->has('localidad_id')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('localidad_id')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 <?php echo e($errors->has('observacion_direccion') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('observacion_direccion', "Observaciones direccion")); ?>

                <?php echo e(Form::text('observacion_direccion', isset($profesional) ? $profesional->observacion_direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de dirección"])); ?>

                <?php if($errors->has('observacion_direccion')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('observacion_direccion')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('obra_social_id') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('obra_social_id', "Obra social")); ?>

                <?php echo Form::select('obra_social_id', $obra_social->pluck('nombre', 'id'), isset($profesional) ? $profesional->obra_social_id : null, ['placeholder' => 'Seleccione una obra social', 'class' => 'form-control box-size', 'id' => 'roles',
                ]); ?>

                <?php if($errors->has('obra_social')): ?>
                <span class="help-block">
            <strong><?php echo e($errors->first('obra_social')); ?></strong>
          </span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 <?php echo e($errors->has('numero_obra_social') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('numero_obra_social ', "Nº Afiliado")); ?>

                <?php echo e(Form::text('numero_obra_social', isset($profesional) ? $profesional->numero_obra_social : null, ['class' => 'form-control box-size', 'placeholder' => "Nº afiliado obra social"])); ?>

                <?php if($errors->has('numero_obra_social')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('numero_obra_social')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 <?php echo e($errors->has('observacion_facturacion') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('observacion_facturacion', "Observaciones facturación")); ?>

                <?php echo e(Form::text('observacion_facturacion', isset($profesional) ? $profesional->observacion_facturacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de facturación"])); ?>

                <?php if($errors->has('observacion_facturacion')): ?>
                <span class="help-block">
						<strong><?php echo e($errors->first('observacion_facturacion')); ?></strong>
					</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 col-sm-12 <?php echo e($errors->has('observacion_supervision') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <?php echo e(Form::label('observacion_supervision', "Observaciones supervision")); ?>

                <?php echo e(Form::text('observacion_supervision', isset($profesional) ? $profesional->observacion_supervision : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de supervisión"])); ?>

                <?php if($errors->has('observacion_supervision')): ?>
                <span class="help-block">
              <strong><?php echo e($errors->first('observacion_supervision')); ?></strong>
            </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
