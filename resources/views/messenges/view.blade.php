<script src="{{ asset('js/app.js') }}"></script>
@php $count = ""  @endphp
@foreach($thread->messages()->latest()->get() as $message)
    @php $count = $message->count();  @endphp
@endforeach
<div class="message-container-{{ $thread->id }}" data-total_messages="{{ $count }}">

    <div class="media b-b p15 m0 bg-white">
        <div class="media-left">
            <span class="avatar avatar-sm">
                <img src="{{ asset('storage/jornal/usuario/'. $thread->creator()->id . '/perfil/' . $thread->creator()->photo) }}" alt="..." />
            </span>
        </div>
        <div class="media-body w100p">
            <div class="media-heading clearfix">
                <label class="label label-success large">De:</label>
                <a href="#" class="dark strong">{{  $thread->creator()->nombre }} {{  $thread->creator()->apellido }}</a>
                <span class="text-off pull-right">{{  $thread->created_at->diffForHumans() }}</span>

                <span class="pull-right dropdown" style="position: absolute; right: 30px; margin-top: 15px;">
                    <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" >
                        <i class="fa fa-chevron-down clickable"></i>
                    </div>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"></li>
                    </ul>
                </span>
            </div>
            <p class="pt5 pb10 b-b">
                Titulo: {!! $thread->subject !!}
            </p>
        </div>

    </div>

    <?php if ($count > 5) {
    ?>
    <div id="load-messages" class="b-b">
        <a href="#" class="btn btn-default no-border w100p" title="Cargar más" id="load-more-messages-link">Cargar más</a>
    </div>
    <div id="load-more-messages-container"></div>
<?php
    } ?>


    @foreach($thread->conversationMessages as $row)

        <div class="media b-b p15 m0 bg-white js-message-reply" data-message_id="{{ $row->id }}" href="#reply-{{ $row->id }}" >
            <div class="media-left">
        <span class="avatar avatar-sm">
            <img src="{{ asset('storage/jornal/usuario/'. $row->user->id . '/perfil/' . $row->user->photo) }}" alt="..." />
        </span>
            </div>
            <div class="media-body w100p">
                <div class="media-heading">
                    <strong>{{  $row->user->nombre }} {{ $row->user->apellido }}
                    </strong>
                    <span class="text-off pull-right">{{  $row->created_at->diffForHumans() }}</span>
                </div>
                <p><?php echo nl2br($row->body); ?></p>

                <p>
                        @php
                            $files = unserialize($row->files);
                            $total_files = count($files);
                        @endphp

                    @if($total_files)
                            <i class='fa fa-paperclip pull-left font-16'></i>
                            <a href="" class="" title="Descargar {{ $total_files }}">Descargar {{ $total_files }}</a>
                    @endif

                </p>


            </div>
        </div>
    @endforeach

    <div id="reply-form-container">



            <div id="reply-form-dropzone" class="post-dropzone">
                {{ Form::model($thread, ['route' => ['message.update', $thread->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'message_reply_form',  "class" => "general-form"])
   }}
                <div class="p15 box b-b">
                    <div class="box-content avatar avatar-md pr15">
                        <img src="{{ asset('storage/jornal/usuario/'. auth()->user()->id . '/perfil/' . auth()->user()->photo) }}" alt="..." />
                    </div>
                    <div class="box-content form-group">
                        <textarea name="reply_message" cols="40" rows="10" id="reply_message" class="form-control" placeholder="Escriba una respuesta..." data-rule-required="1" data-msg-required="Este campo es requerido." aria-required="true"></textarea>

                        <div class="post-file-dropzone-scrollbar hide">
                            <div class="post-file-previews clearfix b-t">
                                <div class="post-file-upload-row dz-image-preview dz-success dz-complete pull-left">
                                    <div class="preview" style="width:85px;">
                                        <img data-dz-thumbnail class="upload-thumbnail-sm" />
                                        <span data-dz-remove="" class="delete">×</span>
                                        <div class="progress progress-striped upload-progress-sm active m0" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <footer class="panel-footer b-a clearfix ">

                            <button class="btn btn-default upload-file-button pull-left btn-sm round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> Subir archivo</button>
                            <button class="btn btn-primary pull-right btn-sm" type="submit"><i class='fa fa-reply'></i> Responder</button>
                        </footer>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

    </div>


</div>

<script type="text/javascript">



    $(document).ready(function () {
        var uploadUrl = "{{ route('message.uploadFiles') }}";
        var validationUrl = "{{ route('message.validateFiles') }}";


        var dropzone = attachDropzoneWithForm("#reply-form-dropzone", uploadUrl, validationUrl);

        $(document).on('submit', 'form#message_reply_form', function(event) {
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
                    $("#reply_message").val("");
                    $(result.data).insertBefore("#reply-form-container");
                    appAlert.success(result.message, {duration: 10000});
                    if (dropzone) {
                        dropzone.removeAllFiles();
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



        $("#load-more-messages-link").click(function () {
            loadMoreMessages();
        });


    });

    function loadMoreMessages(callback) {
        $("#load-more-messages-link").addClass("inline-loader");
        var $topMessageDiv = $(".js-message-reply").first();

        $.ajax({
            url: "",
            type: "POST",
            data: {
                message_id: "",
                top_message_id: $topMessageDiv.attr("data-message_id")
            },
            success: function (response) {
                if (response) {
                    $("#load-more-messages-container").prepend(response);
                    $("#load-more-messages-link").removeClass("inline-loader");
//
//                        var target = $topMessageDiv.parents(".mCustomScrollbar");
//                        if (target.length) {
//                            setTimeout(function () {
//                               target.mCustomScrollbar("scrollTo", $topMessageDiv.offset().top);
//                            }, 200);
//                        }

                    if (callback) {
                        callback(); //has more data?
                    }
                } else {
                    $("#load-more-messages-link").remove(); //no more messages left
                }

            }
        });
    }
</script>