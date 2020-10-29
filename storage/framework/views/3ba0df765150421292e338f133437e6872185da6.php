<!-- Profile Image -->
<div class="modal fade" id="newCita" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo $__env->make('trabajador.profile.partials.modal_event', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body box-profile">
        <img data-src="<?php echo e(asset('img/avatar5.png')); ?>" class="profile-user-img img-responsive img-circle"
             src="<?php echo e(($trabajador->photo!="") ? asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' )); ?>"
             alt="<?php echo e($empresa->nombre); ?>">
        <h3 class="profile-username text-center"><?php echo e($trabajador->nombre); ?> <?php echo e($trabajador->apellido); ?></h3>
        <div align="center">
            <?php
                $ausente = App\Models\Ausentismo::with(['ausentismo_tipo'])->where( 'trabajador_id', $trabajador->id)->whereNull('fecha_alta')->get();
                $fecha_actual = Carbon\Carbon::now();
                $cita = App\Models\Event::whereDate('start_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))->where('trabajador_id', $trabajador->id)->first();
          
            ?>

            <?php if($ausente->count() >=1): ?>
                <button class="btn btn-danger"></button>
                <?php $__currentLoopData = $ausente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($row->ausentismo_tipo->nombre); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($ausente->sum('dias_ausente')); ?> días
            <?php else: ?>
                <button class="btn btn-success"></button> Trabajando
                <?php endif; ?>
                <br/><br/>
                <?php if(isset($cita->start_date)): ?>
                
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                Proxima cita: <?php echo e(isset($cita->start_date) ? $cita->start_date : ''); ?>


                <?php endif; ?>
                
                <div align="center"><a data-toggle="modal" data-target="#newCita" class="btn btn-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> <b> Nueva
                            cita</b> </a></div>
        </div><br/>
        <div align="center">
            <a title="Sector"><?php echo e(isset($trabajador->sector->nombre) ? $trabajador->sector->nombre : ''); ?></a> / <a
                    title="tarea"><?php echo e(isset($trabajador->tarea->nombre) ? $trabajador->tarea->nombre : ''); ?> </a>/ <a
                    title="Turno"> <?php echo e(isset($trabajador->turno->nombre) ? $trabajador->turno->nombre : ''); ?></a>
        </div>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Documento:</b> <a class="pull-right"><?php echo e(isset($trabajador->documento) ? $trabajador->documento : 'No disponible'); ?></a>
            </li>
            <li class="list-group-item">
                <b><?php echo e(isset($trabajador->obrasocial->nombre) ? $trabajador->obrasocial->nombre : 'No disponible'); ?>:</b> <a
                        class="pull-right"><?php echo e(isset($trabajador->numero_afiliado) ? $trabajador->numero_afiliado : 'No disponible'); ?></a>
            </li>
            <li class="list-group-item">
                <b>Direccion: </b> <a
                        class="pull-right"><?php echo e(isset($trabajador->observacion_direccion) ? $trabajador->observacion_direccion : 'No disponible'); ?> <?php echo e(isset($trabajador->localidad->nombre) ? $trabajador->localidad->nombre : ''); ?></a>
            </li>
            <li class="list-group-item">
                <b>Celular: </b> <a class="pull-right"><?php echo e(isset($trabajador->celular) ? $trabajador->celular : 'No disponible'); ?></a>
            </li>
            <li class="list-group-item">
                <b>Telefono: </b> <a class="pull-right"><?php echo e(isset($trabajador->telefono) ? $trabajador->telefono : 'No disponible'); ?></a>
            </li>
            <li class="list-group-item">
                <b>Agentes de riesgo declarados según puesto: </b>
                <?php if(!empty($trabajador->tarea->agente_riesgo_tarea)): ?>
                    <?php $__currentLoopData = $trabajador->tarea->agente_riesgo_tarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agente_riesgo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button"
                                class="btn btn-block btn-warning btn-sm"><?php echo e(isset($agente_riesgo['agente_riesgo']) ? $agente_riesgo['agente_riesgo'] : ''); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </li>
        </ul>
       <div align="center"> <a href="#modalForm" data-toggle="modal"
           data-href="<?php echo e(route('empresa.trabajadores.edit', ['id' => $trabajador->id, 'id_empresa' => $empresa->id ])); ?>"
           class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> <b>Editar</b></a>
    </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        $(function () {
            $("#frm").validate();
            $(document).on('click', 'a.page-link', function (event) {
                event.preventDefault();
                ajaxLoad($(this).attr('href'));
            });

            $(document).on('submit', 'form#cita', function (event) {
                event.preventDefault();
                var form = $(this);
                var data = new FormData($(this)[0]);
                var url = form.attr("action");
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('#newCita').modal('hide');
                        setTimeout(function () {
                            window.open(data.redirect_url, '_blank');
                        }, 3000);
                    },
                    error: function (jqXhr, json, errorThrown) {
                      console.log(jqXhr)
                        var errors = jqXhr.responseJSON;
                        var errorsHtml = '';

                        if (jqXhr.status == 401) {
                          $('span#cita_exitente').html(errors['text']);
                        } else {
                          for (control in errors['errors']) {
                            var inputField = $('[name=' + control + ']');
                            var parentDiv = inputField.closest('.form-group');
                            // apply has-error class
                            parentDiv.addClass('has-error');
                            $('input[name=' + control + ']').addClass('is-invalid');
                            console.log(errors['errors'][control][0]);
                            $('span#' + control).html(errors['errors'][control][0]);
                        }
                        }

                        
                    }
                });
                return false;
            });

            $('#modalForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                ajaxLoad(button.data('href'), 'modal_content');
            });

            $('#modalForm').on('shown.bs.modal', function () {
                $('#focus').trigger('focus')
            });

            function ajaxLoad(filename, content) {
                content = typeof content !== 'undefined' ? content : 'content';
                // $('.loading').show();
                $.ajax({
                    type: "GET",
                    url: filename,
                    contentType: false,
                    success: function (data) {
                        $("#" + content).html(data);
                        //  $('.loading').hide();
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
