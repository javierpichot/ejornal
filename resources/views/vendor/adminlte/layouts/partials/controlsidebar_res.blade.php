    @isset ($empresa) 
<!-- Control Sidebar -->
  @if (Request::is('empresa/*'))
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-home">3 horas</i></a></li>
    </ul>
       <ul class='control-sidebar-menu'>
        <li>
<div align="center"> <a href="{{ route('admin.profesional-fichar.fichar_entrada') }}"><button type="button" class="btn btn btn-success"><b>Fichar entrada</b></button></a> 
               <p>Último registro: 20/09/2018 08:00</p></div>
  
 <div align="center"<a href="{{ route('admin.profesional-fichar.fichar_salida') }}">   <button type="button" class="btn btn btn-danger"><b>Fichar salida</b></button></a> 
               <p>Último registro: 20/09/2018 08:00</p></div></li>
    </ul>
    @endif
  
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
                            <span class="label label-success pull-right">{{$porcentaje_puntuales}}%</span>
                        </h4>
                        <div class="progress progress-xxs" align="center">
                            <div class="progress-bar progress-bar-success" style="width: {{$porcentaje_puntuales}}%"></div>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->
            
          <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
            <form method="post">



                @foreach($tareas_puntuales as $tarea)

                    @isset($tarea->revision_periodica)
                    <div class="form-group" id="tarea_puntual_{{ $tarea->id }}">
                        <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> 
                            <small>
                                {{ substr($tarea->nombre,0,25)   }}
                                <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-puntual"><span id="tarea_puntual_check{{ $tarea->id }}" class="checkbox-checked"  style="color:white"></span></a>
                            </small>
                    </div>
                    @endisset
     
                @endforeach

            </form>

                <script !src="">
                    $('body').on('click', '[data-act=update-todo-status-checkbox-puntual]', function () {
                        $(this).find("span").addClass("inline-loader");
                        $.ajax({
                            url: '{{ route('todo.save_status') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                            success: function (response) {
                                if (response.success) {
                                    $("#tarea_puntual_"+response.id).remove();
                                    $("#tarea_puntual_check"+response.id).removeClass('checkbox-blank');
                                    $("#tarea_puntual_check"+response.id).addClass('checkbox-checked');
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
                    @isset($tarea->revision_periodica)
                        <div class="form-group" id="tarea_turno_{{ $tarea->id }}">
                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> 
                                <small>
                                        {{ substr($tarea->nombre,0,25)   }}
                                            <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-turno"><span id="tarea_turno_check{{ $tarea->id }}" class="checkbox-checked"  style="color:white"></span></a>
                                </small>
                        </div>
                    @endisset

                    @empty($tarea->revision_periodica)
                        <div class="form-group" id="tarea_turno_{{ $tarea->id }}">
                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> 
                                <small>
                                    {{ substr($tarea->nombre,0,25)   }}
                                    <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-turno"><span id="tarea_turno_check{{ $tarea->id }}" class="checkbox-checked"  style="color:white"></span></a>
                                </small>
                    
                        </div> 
                    @endempty
                @endforeach

            </form>

                <script !src="">
                    $('body').on('click', '[data-act=update-todo-status-checkbox-puntual]', function () {
                        $(this).find("span").addClass("inline-loader");
                        $.ajax({
                            url: '{{ route('todo.save_status') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                            success: function (response) {
                                if (response.success) {
                                    $("#tarea_puntual_"+response.id).remove();
                                    $("#tarea_puntual_check"+response.id).removeClass('checkbox-blank');
                                    $("#tarea_puntual_check"+response.id).addClass('checkbox-checked');
                                }
                            }
                        });
                    });
                </script>
      </div> 
      
      
      <ul class='control-sidebar-menu'>
      <li>
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
          </ul><!-- /.control-sidebar-menu -->  
          <div class="tab-pane" id="control-sidebar-settings-tab" align="center">
            <form method="post">



                @foreach($tareas_diarias as $tarea)
                    @isset($tarea->revision_periodica)
                        <div class="form-group" id="tarea_diaria_{{ $tarea->id }}">
                                <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> <small>
                            {{ substr($tarea->nombre,0,25)   }}
                            <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-diaria"><span id="tarea_diaria_check{{ $tarea->id }}" class="checkbox-blank"  style="color:white"></span></a>
                                </small></a>
                
                        </div>
                    @endisset

                    @empty($tarea->revision_periodica)
                        <div class="form-group" id="tarea_diaria_{{ $tarea->id }}">
                                <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> <small>
                            {{ substr($tarea->nombre,0,25)   }}
                            <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-diaria"><span id="tarea_diaria_check{{ $tarea->id }}" class="checkbox-checked"  style="color:white"></span></a>
                                </small></a>
                
                        </div> 
                    @endempty
                @endforeach

            </form>

                <script>
                    $('body').on('click', '[data-act=update-todo-status-checkbox-diaria]', function () {
                        $(this).find("span").addClass("inline-loader");
                        $.ajax({
                            url: '{{ route('todo.save_status') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                            success: function (response) {
                                if (response.success) {
                                    $("#tarea_diaria_"+response.id).remove();
                                    $("#tarea_diaria_check"+response.id).removeClass('checkbox-blank');
                                    $("#tarea_diaria_check"+response.id).addClass('checkbox-checked');
                                }
                            }
                        });
                    });
                </script>
      </div>
      
      <ul class='control-sidebar-menu'>
      
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

                    @isset($tarea->revision_periodica)
                        <div class="form-group" id="tarea_mensual_{{ $tarea->id }}">
    <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> <small>
                                    {{ substr($tarea->nombre,0,25)   }}
                                    <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-mensual"><span id="tarea_mensual_check{{ $tarea->id }}" class="checkbox-checked" style="color:white" ></span></a>
                    </small>
                                <p>
                                </p>
                        </div>
                    @endisset

                    @empty($tarea->revision_periodica)
                        <div class="form-group" id="tarea_mensual_{{ $tarea->id }}">
                            <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"  alt="{{$tarea->descripcion}}"  title=" {{$tarea->descripcion}}"  style="color:white"> <small>
                                                        {{ substr($tarea->nombre,0,25)   }}
                            <a href="#" class="" data-id="{{ $tarea->id }}"  data-value="@if($tarea->estado == false)to_do @else done @endif" data-act="update-todo-status-checkbox-mensual"><span id="tarea_mensual_check{{ $tarea->id }}" class="checkbox-checked"  style="color:white"></span></a>
                        </div>
                    @endempty  
                @endforeach

            </form>

                <script !src="">
                    $('body').on('click', '[data-act=update-todo-status-checkbox-mensual]', function () {
                        $(this).find("span").addClass("inline-loader");
                        $.ajax({
                            url: '{{ route('todo.save_status') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {id: $(this).attr('data-id'), status: $(this).attr('data-value')},
                            success: function (response) {
                                if (response.success) {
                                    $("#tarea_mensual_"+response.id).remove();
                                    $("#tarea_mensual_check"+response.id).removeClass('checkbox-blank');
                                    $("#tarea_mensual_check"+response.id).addClass('checkbox-checked');
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
<div class='control-sidebar-bg'></div>

 @endisset   