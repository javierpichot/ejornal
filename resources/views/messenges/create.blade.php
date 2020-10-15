
<div id="new-message-dropzone" class="post-dropzone">
        {{ Form::open(['route' => 'message.store', 'role' => 'form', 'method' => 'post', 'id' => 'message_form_new', "class" => "general-form"]) }}
    <div class="modal-body clearfix">
        <div class="form-group row">
            <label for="to_user_id" class=" col-md-2">Para</label>
            <div class="col-md-10">
                <input type="text" value="" name="recipients" id="messages_users" class="validate-hidden w100p"  data-rule-required="true" data-msg-required="Este campo es requerido." placeholder="Selecciona miembros y / o equipos"  />
            </div>
        </div>
        <div class="form-group row">
            <label for="subject" class=" col-md-2">Titulo</label>
            <div class=" col-md-10">
                {{ Form::text('subject',  null, ['class' => 'form-control box-size', 'placeholder' => "Titulo", "required" => true]) }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                {{ Form::textarea('body',  null, ['class' => 'form-control box-size', "required" => true]) }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                @include('messenges.includes.dropzone_preview')
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> Subir archivo</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span>  Cerrar</button>
        <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Enviar</button>
    </div>
    {{ Form::close() }}
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#message_form_new").validate();

        get_specific_dropdown($("#messages_users"), <?php echo $users_empresa; ?>);

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

        var uploadUrl = "{{ route('message.uploadFiles') }}";
        var validationUrl = "{{ route('message.validateFiles') }}";


        var dropzone = attachDropzoneWithForm("#new-message-dropzone", uploadUrl, validationUrl);

        $(document).on('submit', 'form#message_form_new', function(event) {
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
                success: function(result) {
                    appAlert.success(result.message, {duration: 10000});

                    //we'll check if the single user chat list is open.
                    //if so, we'll assume that, this message created from the view.
                    //and we'll open the chat automatically.
                    if ($("#js-single-user-chat-list").is(":visible") && typeof window.triggerActiveChat !== "undefined") {
                        setTimeout(function () {
                            window.triggerActiveChat(result.id);
                        }, 1000);
                    }
                },
                error: function(jqXhr, json, errorThrown) {
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';

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
            });
            return false;
        });
    });
</script>