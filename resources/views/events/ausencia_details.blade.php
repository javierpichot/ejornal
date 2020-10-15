<div class="modal-body">
    <div class="table-responsive mb15">
        <div class="col-md-12">
            <h4 class="mt0">
                @php
                    $share_title = "Cita con" . ": ";

                    echo "<span title='$share_title' style='color:' class='pull-left mr10'><i class='fa fa-hospital-o'></i></span> Cita de " . $view_data['model_info']['trabajador']['nombre'] .$view_data['model_info']['trabajador']['apellido'];
                echo "<br>". $view_data['model_info']['title'];
                @endphp
            </h4>

        </div>


        <div class="col-md-12 pb10 ">
            <i class="fa fa-clock-o"></i>

            @php
                $start_date = Carbon::createFromFormat('Y-m-d',$view_data['model_info']['start_date']);
                $end_date = Carbon::createFromFormat('Y-m-d', $view_data['model_info']['end_date']);

                if ($view_data['model_info']['start_date'] == $view_data['model_info']['end_date']) {
                echo $start_date->format('l jS \\of F');
                } else {
                if (isset($view_data['model_info']['start_time'])) {
                        echo $start_date->format('l jS \\of F h:i:s A');
                    }
                }

                 if (isset($view_data['model_info']['end_time'])) {
                        echo " – ".  $end_date->format('l jS \\of F h:i:s A');
                 }
            @endphp
        </div>



        <div class="col-md-12">
            <blockquote class="font-14 text-justify" style=""><?php echo nl2br($view_data['model_info']['description']); ?></blockquote>
        </div>


        <div class="col-md-12 pt10 pb10">
            <span class="avatar avatar-xs mr10">
                <img src="{{ asset('storage/jornal/usuario/'. $view_data['model_info']['user']['id'] . '/perfil/'. $view_data['model_info']['user']['photo']) }}">
            </span>
            <span>
               Creada por:  <a href="#" class="dark strong">{{ $view_data['model_info']['user']['nombre'] }} {{ $view_data['model_info']['user']['apellido'] }}</a>
            </span>
        </div>

    </div>
</div>

<div class="modal-footer">
    @if(auth()->user()->id == $view_data['model_info']['user']['id'])

        @php
            $show_delete = true;

                if (isset($view_data['model_info']['cycle']) && $view_data['model_info']['cycle']) {
                    $show_delete = false;
                }
        @endphp
        @if($show_delete)
            <a href="#" class="btn btn-default pull-left" id="delete_event" data-encrypted_event_id="{{  $view_data['encrypted_event_id'] }}" data-original-title="" title=""><i class="fa fa-times-circle-o"></i> Borrar evento</a>
        @endif
    @endif

    @php
        if (auth()->user()->id != $view_data['model_info']['user']['id']) {
            echo  $view_data['status_button'];
        }
    @endphp

    <button type="button" class="btn btn-info close-modal" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#delete_event').confirmation({
            title: "Está seguro?",
            btnOkLabel: "Sí",
            btnCancelLabel: "No",
            onConfirm: function () {
                $('.close-modal').trigger("click");
                $.ajax({
                    url: "{{ route('event.destroy') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {encrypted_event_id: this.encrypted_event_id, empresa_id: {{ $view_data['model_info']['empresa_id'] }}},
                    success: function (result) {
                        if (result.success) {
                            $("#event-calendar").fullCalendar('refetchEvents');
                            appAlert.warning(result.message, {duration: 10000});
                        } else {
                            appAlert.error(result.message);
                        }
                    }
                });

            }
        });

        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
