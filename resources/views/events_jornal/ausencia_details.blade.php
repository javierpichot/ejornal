<style>
    .bg-white {
        background: #fff !important;
    }
    .m0 {
        margin: 0;
    }
    .media p, .media div {
        word-break: break-all;
        word-break: break-word;
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
    }
    /*avatar*/
    .avatar {
        display: inline-block;
        white-space: nowrap;
    }

    .avatar-lg {
        width: 125px;
        height: 125px;
    }

    .avatar-md {
        width: 80px;
        height: 80px;
    }

    .avatar-sm {
        width: 50px;
        height: 50px;
    }

    .avatar-xs {
        width: 30px;
        height: 30px;
    }

    .avatar img {
        height: auto;
        max-width: 100%;
        border-radius: 50%;
    }
    .w100p {
        width: 100%;
    }

    .pt5 {
        padding-top: 5px !important;
    }
    .media-heading {
        margin-top: 0;
        margin-bottom: 5px;
    }
</style>
<div class="modal-body">
    <div class="row">
        <div class="p10 clearfix">
            <div class="media m0 bg-white">
                <div class="media-left">
                    <span class="avatar avatar-sm">
                        {!!  $data->applicant_meta !!}
                    </span>
                </div>
                <div class="media-body w100p pt5">
                    <div class="media-heading m0">
                      <a href="{{route('trabajador.show', ['id' => $data->trabajador->id, 'name' => $data->trabajador->nombre, 'empresa_id' => $data->empresa->id])}}" > {{ $data->trabajador->nombre }} {{ $data->trabajador->apellido }} </a>
                    </div>
                    <p><span class='label label-info'></span> </p>
                </div>
            </div>
        </div>
        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                <tr>
                    <td class="w100"> Tipo de ausencia</td>
                    <td>{{ $data->tipo_ausencia }}</td>
                </tr>
                <tr>
                    <td> Fecha</td>
                    <td>{{ $data->fecha_ausente }}</td>
                </tr>
                <tr>
                    <td> Dias</td>
                    <td>{{ $data->dias_ausente }}</td>
                </tr>
                <tr>
                    <td> Motivo</td>
                    <td>{{ $data->motivo }}</td>
                </tr>
                <tr>
                    <td> Estado</td>
                    <td>
                        @if(isset($data->fecha_alta ))
                            <a href="{{route('trabajador.ausentismo.dossier.view', ['id' => $data->id, 'id_empresa' => $data->empresa_id, 'trabajador_id' => $data->trabajador->id ])}}" target="\&quot;_blank\&quot;"><button class="btn btn-success">Cerrado</button></a>

                        @else
                            <a href="{{route('trabajador.ausentismo.dossier.view', ['id' => $data->id, 'id_empresa' =>  $data->empresa_id, 'trabajador_id' => $data->trabajador->id ])}}" target="\&quot;_blank\&quot;"><button class="btn btn-danger">Abierto</button></a>

                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $(".update-leave-status").click(function() {
            $("#leave_status_input").val($(this).attr("data-status"));
        });

        $("#leave-status-form").appForm({
            onSuccess: function() {
                location.reload();
            }
        });

    });
</script>