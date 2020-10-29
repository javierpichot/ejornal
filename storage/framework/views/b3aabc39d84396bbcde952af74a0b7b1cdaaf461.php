<?php echo e(Form::open(['route' => 'trabajador.cita.store', 'role' => 'form', 'method' => 'post', 'id' => 'cita'])); ?>

<input type="hidden" name="trabajador_id" value="<?php echo e($trabajador->id); ?>">
<input type="hidden" name="empresa_id" value="<?php echo e($empresa->id); ?>" />
<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="exampleModalLabel">Nueva cita</h4>

</div>

<strong><span id="cita_exitente" class="text-danger"></span></strong>

<div class="clearfix">
        <label for="start_date" class=" col-md-3 col-sm-3">Fecha de inicio</label>
        <div class="col-md-4 col-sm-4 form-group row">

            <div class="input-group start_date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                <?php echo e(Form::text('start_date',  null, ['class' => 'form-control box-size', 'placeholder' => "Fecha de inicio", 'id' => 'start_date'])); ?>

                <span class="help-block" id="start_date"></span>
            </div>

        </div>
        <label for="start_time" class=" col-md-2 col-sm-2" align="right">Hora </label>
        <div class=" col-md-3 col-sm-3">
            <?php echo e(Form::text('start_time',  null, ['class' => 'form-control box-size', 'placeholder' => "Hora de inicio", "id" => "start_time"])); ?>

        </div>
    </div>


<div class="modal-body clearfix">

        <label for="description" class=" col-md-3">Descripcion</label>
        <div class=" col-md-9">
            <?php echo e(Form::textarea('description',  null, ['class' => 'form-control box-size', 'placeholder' => "Descripción"])); ?>

        </div>
        <span class="help-block" id="description"></span>


    

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span>Guardar</button>
</div>
<?php echo e(Form::close()); ?>


<style>
    .select2-container {
        width: 100% !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#title").focus();
        $('[data-toggle="tooltip"]').tooltip();
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-us'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-us'
        });

        $('#start_time').datetimepicker({
            format: 'LT'
        });

        $('#end_time').datetimepicker({
            format: 'LT'
        });
    });
</script>
