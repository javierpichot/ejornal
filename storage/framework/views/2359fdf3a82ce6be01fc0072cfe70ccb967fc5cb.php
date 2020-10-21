<script type="text/javascript">
    $('body').on('click', '[data-act=fichar-entrada]', function () {
        $(this).find("span").addClass("inline-loader");
        $.ajax({
            url: '<?php echo e(route('admin.profesional.getEntradas')); ?>',
            type: 'POST',
            dataType: 'json',
            data: {empresa_id: $(this).attr('data-id')},
            success: function (response) {
                if (response.success) {
                    $("#entrada").text(response.info.fechahora_entrada);
                    toastr.success(response.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
                    jQuery(".btn-entrada").prop("disabled", "disabled")
                    $(".btn-entrada").text("Entrada fichada");
                }
            }
        });
    });


    $('body').on('click', '[data-act=fichar-salida]', function () {
        $(this).find("span").addClass("inline-loader");
        $.ajax({
            url: '<?php echo e(route('admin.profesional.getSalidas')); ?>',
            type: 'POST',
            dataType: 'json',
            data: {empresa_id: $(this).attr('data-id')},
            success: function (response) {
                if (response.success) {
                    $("#salida").text(response.info.hora_salida);
                    toastr.success(response.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
                    jQuery(".btn-entrada").prop("disabled", "disabled")
                    jQuery(".btn-salida").prop("disabled", "disabled")
                    $(".btn-salida").text("Salida fichada");
                }
            }
        });
    });
</script>
<!-- Control Sidebar -->
    <?php if(Request::is('empresa/*')): ?>
    <?php if(isset($empresa)): ?>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-home"></i></a></li>
            </ul>

            <button type="button" class="btn btn-block btn-success btn-entrada" data-act="fichar-entrada" data-id="<?php echo e($empresa->id); ?>"><b> <?php if(isset($ficho_entrada)): ?> Entrada fichada <?php endif; ?> <?php if(empty($ficho_entrada)): ?> Fichar entrada <?php endif; ?> </b></button>
            <div align="center">Último registro:<span id="entrada"> <?php echo e(isset($ultima_entrada->fechahora_entrada) ? $ultima_entrada->fechahora_entrada : ' No ha ficha su entrada aun'); ?></span></div>

            <button type="button" class="btn btn-block btn-danger btn-salida" data-act="fichar-salida" data-id="<?php echo e($empresa->id); ?>"><b>
                    <?php if(isset($ficho_salida)): ?> Salida fichada <?php endif; ?> <?php if(empty($ficho_salida)): ?> Fichar salida <?php endif; ?></b></button>
            <div align="center">Último registro:<span id="salida"><?php echo e(isset($ultima_salida->fechahora_salida) ? $ultima_salida->fechahora_salida : ' No ha ficha su salida aun'); ?></span></div>


            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <?php if(Request::is('empresa/*')): ?>
                        <ul class='control-sidebar-menu'>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Tareas puntuales
                                        <span class="label label-success pull-right"><?php echo e($historico_tareas_puntuales); ?>%</span>
                                    </h4>
                                    <div class="progress progress-xxs" align="center">
                                        <div class="progress-bar progress-bar-success" style="width: <?php echo e($historico_tareas_puntuales); ?>%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">
                                <?php $__currentLoopData = $tareas_puntuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($tarea->estado == false): ?>
                                        <div class="form-group" id="tarea_puntual_<?php echo e($tarea->id); ?>">
                                            <label class="control-sidebar-subheading">
                                                <a href="<?php echo e(route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"  alt="<?php echo e($tarea->descripcion); ?>"  title=" <?php echo e($tarea->descripcion); ?>"  style="color:white"><?php echo e(substr($tarea->nombre,0,25)); ?></a>
                                                <a href="#" title="" class="" data-id="<?php echo e($tarea->id); ?>" data-value="<?php if($tarea->estado == false): ?> to_do <?php else: ?> done <?php endif; ?>" data-act="update-todo-status-checkbox-puntuales"><span id="tarea_puntuales_<?php echo e($tarea->id); ?>" class="<?php if($tarea->estado == false): ?>checkbox-blank <?php else: ?> checkbox-checked <?php endif; ?>" style="color:white"></span></a>
                                            </label>
                                            <p>
                                            </p>
                                        </div><!-- /.form-group -->
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-puntuales]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '<?php echo e(route('todo.save_status')); ?>',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                                        success: function (response) {
                                            if (response.success) {
                                                $("#tarea_puntual_"+response.id).remove();
                                                $("#tarea_puntuales_"+response.id).removeClass('checkbox-blank');
                                                $("#tarea_puntuales_"+response.id).addClass('checkbox-checked');
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div><ul class='control-sidebar-menu'>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Tareas por turno
                                        <span class="label label-success pull-right"><?php echo e($porcentaje_turnos); ?>%</span>
                                    </h4>
                                    <div class="progress progress-xxs" align="center">
                                        <div class="progress-bar progress-bar-success" style="width: <?php echo e($porcentaje_turnos); ?>%"></div>
                                    </div>
                                </a>
                            </li> </ul>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                <?php $__currentLoopData = $tareas_turnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <a href="<?php echo e(route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"  alt="<?php echo e($tarea->descripcion); ?>"  title=" <?php echo e($tarea->descripcion); ?>"  style="color:white"><?php echo e(substr($tarea->nombre,0,25)); ?></a>
                                            <a href="#" title="" class="" data-id="<?php echo e($tarea->id); ?>" data-value="<?php if($tarea->estado == false): ?>to_do <?php else: ?> done <?php endif; ?>" data-act="update-todo-status-checkbox-turnos"><span id="tarea_turnos_<?php echo e($tarea->id); ?>" class="<?php if($tarea->estado == false): ?>checkbox-blank <?php else: ?> checkbox-checked <?php endif; ?>"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-turnos]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '<?php echo e(route('todo.save_status')); ?>',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                                        success: function (response) {
                                            if (response.success) {
                                                $("#tarea_turnos_"+response.id).removeClass('checkbox-blank');
                                                $("#tarea_turnos_"+response.id).addClass('checkbox-checked');
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div><li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Tarea diaria
                                    <span class="label label-danger pull-right"><?php echo e($porcentaje_diarios); ?>%</span>
                                </h4>
                                <div class="progress progress-xxs" align="center">
                                    <div class="progress-bar progress-bar-danger" style="width: <?php echo e($porcentaje_diarios); ?>%"></div>
                                </div>
                            </a>
                        </li>
                        <div  id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                <?php $__currentLoopData = $tareas_diarias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group" align="center">
                                        <label class="control-sidebar-subheading">
                                            <a href="<?php echo e(route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"  alt="<?php echo e($tarea->descripcion); ?>"  title=" <?php echo e($tarea->descripcion); ?>"  style="color:white"><?php echo e(substr($tarea->nombre,0,25)); ?></a>
                                            <a href="#" title="" class="" data-id="<?php echo e($tarea->id); ?>" data-value="<?php if($tarea->estado == false): ?>to_do <?php else: ?> done <?php endif; ?>" data-act="update-todo-status-checkbox-diarias"><span id="tarea_diarias_<?php echo e($tarea->id); ?>" class="<?php if($tarea->estado == false): ?>checkbox-blank <?php else: ?> checkbox-checked <?php endif; ?>"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-diarias]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '<?php echo e(route('todo.save_status')); ?>',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                                        success: function (response) {
                                            if (response.success) {
                                                $("#tarea_diarias_"+response.id).removeClass('checkbox-blank');
                                                $("#tarea_diarias_"+response.id).addClass('checkbox-checked');
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Tarea mensual
                                    <span class="label label-success pull-right"><?php echo e($pocentaje_mes); ?>%</span>
                                </h4>
                                <div class="progress progress-xxs" align="center">
                                    <div class="progress-bar progress-bar-success" style="width: <?php echo e($pocentaje_mes); ?>%"></div>
                                </div>
                            </a>
                        </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                <?php $__currentLoopData = $tareas_mensuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <a href="<?php echo e(route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"  alt="<?php echo e($tarea->descripcion); ?>"  title=" <?php echo e($tarea->descripcion); ?>"  style="color:white"><?php echo e(substr($tarea->nombre,0,25)); ?></a>
                                            <a href="#" title="" class="" data-id="<?php echo e($tarea->id); ?>" data-value="<?php if($tarea->estado == false): ?>to_do <?php else: ?> done <?php endif; ?>" data-act="update-todo-status-checkbox-mensuales"><span id="tarea_mensuales_<?php echo e($tarea->id); ?>" class="<?php if($tarea->estado == false): ?>checkbox-blank <?php else: ?> checkbox-checked <?php endif; ?>"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-mensuales]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '<?php echo e(route('todo.save_status')); ?>',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                                        success: function (response) {
                                            if (response.success) {
                                                $("#tarea_mensuales_"+response.id).removeClass('checkbox-blank');
                                                $("#tarea_mensuales_"+response.id).addClass('checkbox-checked');
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div><!-- /.tab-pane --><?php endif; ?>
                </div><!-- /.tab-pane -->
                <!-- Stats tab content -->

                <!-- Settings tab content -->

            </div>
        </aside>
        <?php endif; ?>
    <?php endif; ?>
    <div class='control-sidebar-bg'></div>
