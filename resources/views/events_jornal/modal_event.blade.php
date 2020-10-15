{{ Form::open(['route' => 'events_jornal.store', 'role' => 'form', 'method' => 'post', 'id' => 'frm']) }}

<div class="modal-body clearfix">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
    <div class="form-group row">
        <label for="title" class=" col-md-3">Titulo</label>
        <div class=" col-md-9">
            {{ Form::text('title',  null, ['class' => 'form-control box-size', 'placeholder' => "Titulo"]) }}

        </div>
        <span class="help-block" id="title"></span>
    </div>
    <div class="form-group row">
        <label for="description" class=" col-md-3">Descripcion</label>
        <div class=" col-md-9">
            {{ Form::textarea('description',  null, ['class' => 'form-control box-size', 'placeholder' => "Titulo"]) }}
        </div>
        <span class="help-block" id="description"></span>
    </div>

    <div class="clearfix">
        <label for="start_date" class=" col-md-3 col-sm-3">Fecha de inicio</label>
        <div class="col-md-4 col-sm-4 form-group row">

            <div class="input-group start_date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('start_date',  null, ['class' => 'form-control box-size', 'placeholder' => "Fecha de inicio", 'id' => 'start_date']) }}
                <span class="help-block" id="start_date"></span>
            </div>

        </div>
        <label for="start_time" class=" col-md-2 col-sm-2">Hora de inicio</label>
        <div class=" col-md-3 col-sm-3">
                {{ Form::text('start_time',  null, ['class' => 'form-control box-size', 'placeholder' => "Hora de inicio", "id" => "start_time"]) }}
        </div>
    </div>


    <div class="clearfix">
        <label for="end_date" class=" col-md-3 col-sm-3">Fecha final</label>
        <div class="col-md-4 col-sm-4 form-group row">

            <div class="input-group end_date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('end_date',  null, ['class' => 'form-control box-size', 'placeholder' => "Fecha final", 'id' => 'end_date']) }}
                <span class="help-block" id="end_date"></span>
            </div>

        </div>
        <label for="end_time" class=" col-md-2 col-sm-2">Tiempo final</label>
        <div class=" col-md-3 col-sm-3">
                {{ Form::text('start_time',  null, ['class' => 'form-control box-size', 'placeholder' => "Tiempo final", 'id' => "end_time"]) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="location" class=" col-md-3">Lugar</label>
        <div class=" col-md-9">
            {{ Form::text('location',  null, ['class' => 'form-control box-size', 'placeholder' => "Lugar"]) }}

        </div>
    </div>
    <div class="form-group row">
        <label for="event_labels" class=" col-md-3">Etiquetas</label>
        <div class=" col-md-9">
            {{ Form::text('labels',  null, ['class' => 'form-control box-size', 'placeholder' => "Etiquetas"]) }}
        </div>
    </div>

    <div class="form-group">
        <label for="share_with" class=" col-md-3">Compartir con</label>
        <div class=" col-md-9">
            <div>
                <input type="radio" name="share_with" value="" checked="checked" id="only_me" class="toggle_specific">
                <label for="only_me">Solo yo</label>
            </div>
            <div>
                <input type="radio" name="share_with" value="all" id="share_with_all" class="toggle_specific">
                <label for="share_with_all">Todos los miembros del equipo</label>
            </div>

            <div class="form-group mb0">
                <input type="radio" name="share_with" value="specific" id="share_with_specific_radio_button" class="toggle_specific">
                <label for="share_with_specific_radio_button">Miembros y Equipos específicos:</label>
                <div class="specific_dropdown" style="display: none;">
                    <input type="text" value="" name="share_with_specific" id="share_with_specific" class="validate-hidden w100p"  data-rule-required="true" data-msg-required="Este campo es requerido." placeholder="Selecciona miembros y / o equipos"  />
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class=" col-md-3">Color</label>
        <div class="col-md-9">
            @include('events.includes.color_plate')
        </div>
    </div>



</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span>Guardar</button>
</div>
{{ Form::close() }}

<style>
    .select2-container {
        width: 100% !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#title").focus();

        get_specific_dropdown($("#share_with_specific"), <?php echo $profesionals; ?>);

        function get_specific_dropdown(container, data) {
            setTimeout(function () {
                container.select2({
                    multiple: true,
                    formatResult: teamAndMemberSelect2Format,
                    formatSelection: teamAndMemberSelect2Format,
                    data: data
                });
            }, 100);
        }

        $(".toggle_specific").click(function () {
            toggle_specific_dropdown();
        });

        toggle_specific_dropdown();

        function toggle_specific_dropdown() {
            $(".specific_dropdown").hide().find("input").removeClass("validate-hidden");

            var $element = $(".toggle_specific:checked");
            if ($element.val() === "specific" || $element.val() === "specific_client_contacts") {
                var $dropdown = $element.closest("div").find("div.specific_dropdown");
                $dropdown.show().find("input").addClass("validate-hidden");
            }
        }

        $("#event_labels").select2({
            tags: ''
        });

        $("#event-form .select2").select2();

        //show/hide recurring fields
        $("#event_recurring").click(function () {
            if ($(this).is(":checked")) {
                $("#recurring_fields").removeClass("hide");
            } else {
                $("#recurring_fields").addClass("hide");
            }
        });

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
