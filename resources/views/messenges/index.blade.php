@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de stock de farmacia de '. $empresa->nombre)

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@push('styles')
    <style>
        /*message*/
        .box-content {
            display: table-cell;
            vertical-align: top;
            height: 100%;
            float: none;
            overflow-x: hidden;
        }
        .box {
            display: table;
            table-layout: fixed;
            border-spacing: 0;
            width: 100%;
        }
        .message-row {
            padding: 8px 15px;
        }

        .message-row.unread {
            border-left: 3px solid #337ab7;
        }

        .message-row.unread strong,
        .message-row.unread span {
            color: #337ab7;
        }

        .message-button-list {
            width: 150px;
            padding-left: 10px;
        }

        .message-button-list .list-group .list-group-item {
            border-radius: 0 !important;
            border: none !important;
            background: transparent;
            color: #4e5e6a;
        }

        .message-button-list .list-group-item:hover,
        .message-button-list .list-group-item.active {
            background: rgba(0, 0, 0, 0.02);
        }
    </style>

@endpush
@section('main-content')
    <div>
        <div class="box-content message-view" >
            <div class="col-sm-12 col-md-5">
                <a href="#" class="btn btn-success pull-right" data-act="ajax-modal" data-title="Enviar mensaje" data-action-url="{{ route('message.create') }}" data-post-empresa_id="{{ $empresa->id }}">
                    Crear un mensaje
                </a>
                <div id="message-list-box" class="panel panel-default">
                    <div class="table-responsive">
                        <table id="message-table" class="display no-thead no-padding clickable" cellspacing="0" width="100%">
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div id="message-details-section" class="panel panel-default">
                    <div id="empty-message" class="text-center mb15 box">
                        <div class="box-content" style="vertical-align: middle; height: 100%">
                            <div></div>
                            <span class="fa fa-envelope-o" style="font-size: 1100%; color:#f6f8f8"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var autoSelectIndex = "";
            jQuery("#message-table").appTable({
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                lengthChange: true,
                columnShowHideOption: false,
                source: '/messages/list_data/inbox',
                order: [[1, "desc"]],
                columns: [
                    {title: 'Mensaje'},
                    {targets: [1], visible: false}
                ],
                onInitComplete: function () {
                    if (autoSelectIndex) {
                        //automatically select the message
                        var $tr = $("[data-index=" + autoSelectIndex + "]").closest("tr");
                        if ($tr.length)
                            $tr.trigger("click");
                    }

                    var $message_list = $("#message-list-box"),
                        $empty_message = $("#empty-message");
                    if ($empty_message.length && $message_list.length) {
                        $empty_message.height($message_list.height());
                    }
                }
            });

            var messagesTable = $('#message-table').DataTable();
            $('#search-messages').keyup(function () {
                messagesTable.search($(this).val()).draw();
            });


            /*load a message details*/
            $("body").on("click", "tr", function () {
                //remove unread class
                $(this).find(".unread").removeClass("unread");

                //don't load this message if already has selected.
                if (!$(this).hasClass("active")) {
                    var message_id = $(this).find(".message-row").attr("data-id"),
                        reply = $(this).find(".message-row").attr("data-reply");
                    if (message_id) {
                        $("tr.active").removeClass("active");
                        $(this).addClass("active");
                        $.ajax({
                            url: "/message/" + message_id + "/inbox/" + reply,
                            dataType: "json",
                            success: function (result) {
                                if (result.success) {
                                    $("#message-details-section").html(result.data);
                                } else {
                                    appAlert.error(result.message);
                                }
                            }
                        });
                    }

                    //add index with tr for dlete the message
                    $(this).addClass("message-container-" + $(this).find(".message-row").attr("data-index"));

                }
            });

        });


    </script>
@endpush
