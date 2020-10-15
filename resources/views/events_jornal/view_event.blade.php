<div class="modal-body">
    <div class="table-responsive mb15">
        <div class="col-md-12">
            <h4 class="mt0">
                @php
                $share_title = "Compartir con" . ": ";
                if (!$model_info['model_info']['share_with']) {
                    $share_title .=  "Solo yo";
                } else if ($model_info['model_info']->share_with == "all") {
                    $share_title .= "Todos los miembros del equipo";
                } else {
                    $share_title .=  "Miembros y Equipos específicos";
                }

                echo "<span title='$share_title' style='color:" .  $model_info['event_icon'] . "' class='pull-left mr10'><i class='fa ".$model_info['event_icon']." '></i></span> " . $model_info['model_info']['title'];
                @endphp
            </h4>

        </div>
        <?php if ($model_info['status']) { ?>
        <div class="col-md-12 pb10">
            <?php echo $model_info['status']; ?>
        </div>
        <?php } ?>


        <div class="col-md-12 pb10 ">
            <i class="fa fa-clock-o"></i>
            @include('events.includes.event_time', ['model_info' => $model_info['model_info']])
        </div>

        <div class="col-md-12 pb10">
            <?php echo $model_info['labels']; ?>
        </div>

        <div class="col-md-12">
            <blockquote class="font-14 text-justify" style=""><?php echo nl2br($model_info['model_info']['description']); ?></blockquote>
        </div>





        <?php if ($model_info['model_info']['location']) { ?>
            <div class="col-md-12 mt5">
                <div class="font-14"><i class="fa fa-map-marker"></i> <?php echo nl2br($model_info['model_info']['location']); ?></div>
            </div>
        <?php }
        ?>


        <div class="col-md-12 pt10 pb10">
            <span class="avatar avatar-xs mr10">
                <img src="{{ asset('storage/jornal/usuario/'. $model_info['model_info']['user']['id'] . '/perfil/'. $model_info['model_info']['user']['photo']) }}">
            </span>
            <span>
                <a href="#" class="dark strong">{{ $model_info['model_info']['user']['nombre'] }} {{ $model_info['model_info']['user']['apellido'] }}</a>
            </span>
        </div>



        @if($model_info['confirmed_by'])
            <div class="col-md-12 clearfix">
                <div class="col-md-1 p0">
                    <span title="Confirmado" class='confirmed-by-logo'><i class='fa fa-check-circle'></i></span>
                </div>
                <div class="col-md-11 pt10 pl0">
{!! $model_info['confirmed_by'] !!}
                </div>
            </div>
        @endif

        @if($model_info['rejected_by'])
            <div class="col-md-12 clearfix">
                <div class="col-md-1 p0">
                    <span title="" class="rejected-by-logo"><i class="fa fa-times-circle"></i></span>
                </div>
                <div class="col-md-11 pt10 pl0">
                    {!!  $model_info['rejected_by'] !!}
                </div>
            </div>
        @endif




    </div>
</div>

<div class="modal-footer">
    @if(auth()->user()->id == $model_info['model_info']['user']['id'])

        @php
            $show_delete = true;

                if (isset($model_info['model_info']['cycle']) && $model_info['model_info']['cycle']) {
                    $show_delete = false;
                }
        @endphp
        @if($show_delete)
            <a href="#" class="btn btn-default pull-left" id="delete_event" data-encrypted_event_id="{{  $model_info['encrypted_event_id'] }}" data-original-title="" title=""><i class="fa fa-times-circle-o"></i> Borrar evento</a>
        @endif
    @endif

    @php
        if (auth()->user()->id != $model_info['model_info']['user']['id']) {
            echo  $model_info['status_button'];
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
                    data: {encrypted_event_id: this.encrypted_event_id, user_id: {{ $model_info['model_info']['user_id'] }}},
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
