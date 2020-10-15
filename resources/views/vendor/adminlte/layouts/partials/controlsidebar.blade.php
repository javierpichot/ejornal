<script type="text/javascript">
    $('body').on('click', '[data-act=fichar-entrada]', function () {
        $(this).find("span").addClass("inline-loader");
        $.ajax({
            url: '{{ route('admin.profesional.getEntradas') }}',
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
            url: '{{ route('admin.profesional.getSalidas') }}',
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
    @if (Request::is('empresa/*'))
    @isset($empresa)
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-home"></i></a></li>
            </ul>

            <button type="button" class="btn btn-block btn-success btn-entrada" data-act="fichar-entrada" data-id="{{ $empresa->id }}"><b> @isset($ficho_entrada) Entrada fichada @endisset @empty($ficho_entrada) Fichar entrada @endempty </b></button>
            <div align="center">Último registro:<span id="entrada"> {{ $ultima_entrada->fechahora_entrada or  ' No ha ficha su entrada aun'}}</span></div>

            <button type="button" class="btn btn-block btn-danger btn-salida" data-act="fichar-salida" data-id="{{ $empresa->id }}"><b>
                    @isset($ficho_salida) Salida fichada @endisset @empty($ficho_salida) Fichar salida @endempty</b></button>
            <div align="center">Último registro:<span id="salida">{{ $ultima_salida->fechahora_salida or ' No ha ficha su salida aun' }}</span></div>


            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    @if (Request::is('empresa/*'))
                        <ul class='control-sidebar-menu'>
                            <li>
                                <a href='javascript::;'>
                                    <h4 class="control-sidebar-subheading">
                                        Tareas puntuales
                                        <span class="label label-success pull-right">{{ $historico_tareas_puntuales}}%</span>
                                    </h4>
                                    <div class="progress progress-xxs" align="center">
                                        <div class="progress-bar progress-bar-success" style="width: {{ $historico_tareas_puntuales}}%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">
                                @foreach($tareas_puntuales as $tarea)
                                    @if($tarea->estado == false)
                                        <div class="form-group" id="tarea_puntual_{{ $tarea->id }}">
                                            <label class="control-sidebar-subheading">
                                                <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white">{{ substr($tarea->nombre,0,25)   }}</a>
                                                <a href="#" title="" class="" data-id="{{ $tarea->id }}" data-value="@if($tarea->estado == false) to_do @else done @endif" data-act="update-todo-status-checkbox-puntuales"><span id="tarea_puntuales_{{ $tarea->id }}" class="@if($tarea->estado == false)checkbox-blank @else checkbox-checked @endif" style="color:white"></span></a>
                                            </label>
                                            <p>
                                            </p>
                                        </div><!-- /.form-group -->
                                    @endif
                                @endforeach

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-puntuales]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '{{ route('todo.save_status') }}',
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
                                        <span class="label label-success pull-right">{{ $porcentaje_turnos}}%</span>
                                    </h4>
                                    <div class="progress progress-xxs" align="center">
                                        <div class="progress-bar progress-bar-success" style="width: {{ $porcentaje_turnos}}%"></div>
                                    </div>
                                </a>
                            </li> </ul>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                @foreach($tareas_turnos as $tarea)
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white">{{ substr($tarea->nombre,0,25)   }}</a>
                                            <a href="#" title="" class="" data-id="{{ $tarea->id }}" data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-turnos"><span id="tarea_turnos_{{ $tarea->id }}" class="@if($tarea->estado == false)checkbox-blank @else checkbox-checked @endif"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                @endforeach

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-turnos]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '{{ route('todo.save_status') }}',
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
                                    <span class="label label-danger pull-right">{{ $porcentaje_diarios }}%</span>
                                </h4>
                                <div class="progress progress-xxs" align="center">
                                    <div class="progress-bar progress-bar-danger" style="width: {{ $porcentaje_diarios }}%"></div>
                                </div>
                            </a>
                        </li>
                        <div  id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                @foreach($tareas_diarias as $tarea)
                                    <div class="form-group" align="center">
                                        <label class="control-sidebar-subheading">
                                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white">{{ substr($tarea->nombre,0,25)   }}</a>
                                            <a href="#" title="" class="" data-id="{{ $tarea->id }}" data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-diarias"><span id="tarea_diarias_{{ $tarea->id }}" class="@if($tarea->estado == false)checkbox-blank @else checkbox-checked @endif"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                @endforeach

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-diarias]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '{{ route('todo.save_status') }}',
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
                                    <span class="label label-success pull-right">{{ $pocentaje_mes}}%</span>
                                </h4>
                                <div class="progress progress-xxs" align="center">
                                    <div class="progress-bar progress-bar-success" style="width: {{ $pocentaje_mes}}%"></div>
                                </div>
                            </a>
                        </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
                            <form method="post">



                                @foreach($tareas_mensuales as $tarea)
                                    <div class="form-group">
                                        <label class="control-sidebar-subheading">
                                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white">{{ substr($tarea->nombre,0,25)   }}</a>
                                            <a href="#" title="" class="" data-id="{{ $tarea->id }}" data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-mensuales"><span id="tarea_mensuales_{{ $tarea->id }}" class="@if($tarea->estado == false)checkbox-blank @else checkbox-checked @endif"></span></a>
                                        </label>
                                        <p>
                                        </p>
                                    </div><!-- /.form-group -->
                                @endforeach

                            </form>

                            <script !src="">
                                $('body').on('click', '[data-act=update-todo-status-checkbox-mensuales]', function () {
                                    $(this).find("span").addClass("inline-loader");
                                    $.ajax({
                                        url: '{{ route('todo.save_status') }}',
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
                        </div><!-- /.tab-pane -->@endif
                </div><!-- /.tab-pane -->
                <!-- Stats tab content -->

                <!-- Settings tab content -->

            </div>
        </aside>
        @endisset
    @endif
    <div class='control-sidebar-bg'></div>
