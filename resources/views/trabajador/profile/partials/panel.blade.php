<!-- Profile Image -->
<div class="modal fade" id="newCita" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @include('trabajador.profile.partials.modal_event')
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body box-profile">
        <img data-src="{{ asset('img/avatar5.png')}}" class="profile-user-img img-responsive img-circle"
             src="{{ ($trabajador->photo!="") ? asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' ) }}"
             alt="{{ $empresa->nombre }}">
        <h3 class="profile-username text-center">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</h3>
        <div align="center">
            @php
                $ausente = App\Models\Ausentismo::with(['ausentismo_tipo'])->where( 'trabajador_id', $trabajador->id)->whereNull('fecha_alta')->get();
                $fecha_actual = Carbon\Carbon::now();
                $cita = App\Models\Event::whereDate('start_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))->where('trabajador_id', $trabajador->id)->first();
          
            @endphp

            @if($ausente->count() >=1)
                <button class="btn btn-danger"></button>
                @foreach($ausente as $row)
                    {{ $row->ausentismo_tipo->nombre }}
                @endforeach
                {{  $ausente->sum('dias_ausente') }} días
            @else
                <button class="btn btn-success"></button> Trabajando
                @endif
                <br/><br/>
                @if(isset($cita->start_date))
                
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                Proxima cita: {{ $cita->start_date or '' }}

                @endif
                
                <div align="center"><a data-toggle="modal" data-target="#newCita" class="btn btn-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> <b> Nueva
                            cita</b> </a></div>
        </div><br/>
        <div align="center">
            <a title="Sector">{{ $trabajador->sector->nombre or '' }}</a> / <a
                    title="tarea">{{ $trabajador->tarea->nombre or '' }} </a>/ <a
                    title="Turno"> {{ $trabajador->turno->nombre or '' }}</a>
        </div>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Documento:</b> <a class="pull-right">{{ $trabajador->documento or 'No disponible'}}</a>
            </li>
            <li class="list-group-item">
                <b>{{ $trabajador->obrasocial->nombre or 'No disponible'}}:</b> <a
                        class="pull-right">{{ $trabajador->numero_afiliado or 'No disponible'}}</a>
            </li>
            <li class="list-group-item">
                <b>Direccion: </b> <a
                        class="pull-right">{{ $trabajador->observacion_direccion or 'No disponible'}} {{ $trabajador->localidad->nombre  or ''}}</a>
            </li>
            <li class="list-group-item">
                <b>Celular: </b> <a class="pull-right">{{ $trabajador->celular or 'No disponible'}}</a>
            </li>
            <li class="list-group-item">
                <b>Telefono: </b> <a class="pull-right">{{ $trabajador->telefono or 'No disponible'}}</a>
            </li>
            <li class="list-group-item">
                <b>Agentes de riesgo declarados según puesto: </b>
                @if (!empty($trabajador->tarea->agente_riesgo_tarea))
                    @foreach($trabajador->tarea->agente_riesgo_tarea as $agente_riesgo)
                        <button type="button"
                                class="btn btn-block btn-warning btn-sm">{{$agente_riesgo['agente_riesgo'] or ''}}</button>
                    @endforeach
                @endif
            </li>
        </ul>
       <div align="center"> <a href="#modalForm" data-toggle="modal"
           data-href="{{ route('empresa.trabajadores.edit', ['id' => $trabajador->id, 'id_empresa' => $empresa->id ]) }}"
           class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> <b>Editar</b></a>
    </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

@push('script')
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
@endpush
