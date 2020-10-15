@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de prestaciones de '. $empresa->nombre)


@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@push('styles')
    <style>

        body{
            background:#f9f9fb;
        }
        .view-account{
            background:#FFFFFF;
            margin-top:20px;
        }
        .view-account .pro-label {
            font-size: 13px;
            padding: 4px 5px;
            position: relative;
            top: -5px;
            margin-left: 10px;
            display: inline-block
        }

        .view-account .side-bar {
            padding-bottom: 30px
        }

        .view-account .side-bar .user-info {
            text-align: center;
            margin-bottom: 15px;
            padding: 30px;
            color: #616670;
            border-bottom: 1px solid #f3f3f3
        }

        .view-account .side-bar .user-info .img-profile {
            width: 120px;
            height: 120px;
            margin-bottom: 15px
        }

        .view-account .side-bar .user-info .meta li {
            margin-bottom: 10px
        }

        .view-account .side-bar .user-info .meta li span {
            display: inline-block;
            width: 100px;
            margin-right: 5px;
            text-align: right
        }

        .view-account .side-bar .user-info .meta li a {
            color: #616670
        }

        .view-account .side-bar .user-info .meta li.activity {
            color: #a2a6af
        }

        .view-account .side-bar .side-menu {
            text-align: center
        }

        .view-account .side-bar .side-menu .nav {
            display: inline-block;
            margin: 0 auto
        }

        .view-account .side-bar .side-menu .nav>li {
            font-size: 14px;
            margin-bottom: 0;
            border-bottom: none;
            display: inline-block;
            float: left;
            margin-right: 15px;
            margin-bottom: 15px
        }

        .view-account .side-bar .side-menu .nav>li:last-child {
            margin-right: 0
        }

        .view-account .side-bar .side-menu .nav>li>a {
            display: inline-block;
            color: #9499a3;
            padding: 5px;
            border-bottom: 2px solid transparent
        }

        .view-account .side-bar .side-menu .nav>li>a:hover {
            color: #616670;
            background: none
        }

        .view-account .side-bar .side-menu .nav>li.active a {
            color: #40babd;
            border-bottom: 2px solid #40babd;
            background: none;
            border-right: none
        }

        .theme-2 .view-account .side-bar .side-menu .nav>li.active a {
            color: #6dbd63;
            border-bottom-color: #6dbd63
        }

        .theme-3 .view-account .side-bar .side-menu .nav>li.active a {
            color: #497cb1;
            border-bottom-color: #497cb1
        }

        .theme-4 .view-account .side-bar .side-menu .nav>li.active a {
            color: #ec6952;
            border-bottom-color: #ec6952
        }

        .view-account .side-bar .side-menu .nav>li .icon {
            display: block;
            font-size: 24px;
            margin-bottom: 5px
        }

        .view-account .content-panel {
            padding: 30px
        }

        .view-account .content-panel .title {
            margin-bottom: 15px;
            margin-top: 0;
            font-size: 18px
        }

        .view-account .content-panel .fieldset-title {
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeaf1;
            margin-bottom: 30px;
            color: #616670;
            font-size: 16px
        }

        .view-account .content-panel .avatar .figure img {
            float: right;
            width: 64px
        }

        .view-account .content-panel .content-header-wrapper {
            position: relative;
            margin-bottom: 30px
        }

        .view-account .content-panel .content-header-wrapper .actions {
            position: absolute;
            right: 0;
            top: 0
        }

        .view-account .content-panel .content-utilities {
            position: relative;
            margin-bottom: 30px
        }

        .view-account .content-panel .content-utilities .btn-group {
            margin-right: 5px;
            margin-bottom: 15px
        }

        .view-account .content-panel .content-utilities .fa {
            font-size: 16px;
            margin-right: 0
        }

        .view-account .content-panel .content-utilities .page-nav {
            position: absolute;
            right: 0;
            top: 0
        }

        .view-account .content-panel .content-utilities .page-nav .btn-group {
            margin-bottom: 0
        }

        .view-account .content-panel .content-utilities .page-nav .indicator {
            color: #a2a6af;
            margin-right: 5px;
            display: inline-block
        }

        .view-account .content-panel .mails-wrapper .mail-item {
            position: relative;
            padding: 10px;
            border-bottom: 1px solid #f3f3f3;
            color: #616670;
            overflow: hidden
        }

        .view-account .content-panel .mails-wrapper .mail-item>div {
            float: left
        }

        .view-account .content-panel .mails-wrapper .mail-item .icheck {
            background-color: #fff
        }

        .view-account .content-panel .mails-wrapper .mail-item:hover {
            background: #f9f9fb
        }

        .view-account .content-panel .mails-wrapper .mail-item:nth-child(even) {
            background: #fcfcfd
        }

        .view-account .content-panel .mails-wrapper .mail-item:nth-child(even):hover {
            background: #f9f9fb
        }

        .view-account .content-panel .mails-wrapper .mail-item a {
            color: #616670
        }

        .view-account .content-panel .mails-wrapper .mail-item a:hover {
            color: #494d55;
            text-decoration: none
        }

        .view-account .content-panel .mails-wrapper .mail-item .checkbox-container,
        .view-account .content-panel .mails-wrapper .mail-item .star-container {
            display: inline-block;
            margin-right: 5px
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa {
            color: #a2a6af;
            font-size: 16px;
            vertical-align: middle
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa.fa-star {
            color: #f2b542
        }

        .view-account .content-panel .mails-wrapper .mail-item .star-container .fa:hover {
            color: #868c97
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-to {
            display: inline-block;
            margin-right: 5px;
            min-width: 120px
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject {
            display: inline-block;
            margin-right: 5px
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label {
            margin-right: 5px
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label:last-child {
            margin-right: 10px
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a,
        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label a:hover {
            color: #fff
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-1 {
            background: #f77b6b
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-2 {
            background: #58bbee
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-3 {
            background: #f8a13f
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-4 {
            background: #ea5395
        }

        .view-account .content-panel .mails-wrapper .mail-item .mail-subject .label-color-5 {
            background: #8a40a7
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container {
            display: inline-block;
            position: absolute;
            right: 10px;
            top: 10px;
            color: #a2a6af;
            text-align: left
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .attachment-container {
            display: inline-block;
            color: #a2a6af;
            margin-right: 5px
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .time {
            display: inline-block;
            text-align: right
        }

        .view-account .content-panel .mails-wrapper .mail-item .time-container .time.today {
            font-weight: 700;
            color: #494d55
        }

        .drive-wrapper {
            padding: 15px;
            background: #f5f5f5;
            overflow: hidden
        }

        .drive-wrapper .drive-item {
            width: 130px;
            margin-right: 15px;
            display: inline-block;
            float: left
        }

        .drive-wrapper .drive-item:hover {
            box-shadow: 0 1px 5px rgba(0, 0, 0, .1);
            z-index: 1
        }

        .drive-wrapper .drive-item-inner {
            padding: 15px
        }

        .drive-wrapper .drive-item-title {
            margin-bottom: 15px;
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .drive-wrapper .drive-item-title a {
            color: #494d55
        }

        .drive-wrapper .drive-item-title a:hover {
            color: #40babd
        }

        .theme-2 .drive-wrapper .drive-item-title a:hover {
            color: #6dbd63
        }

        .theme-3 .drive-wrapper .drive-item-title a:hover {
            color: #497cb1
        }

        .theme-4 .drive-wrapper .drive-item-title a:hover {
            color: #ec6952
        }

        .drive-wrapper .drive-item-thumb {
            width: 100px;
            height: 80px;
            margin: 0 auto;
            color: #616670
        }

        .drive-wrapper .drive-item-thumb a {
            -webkit-opacity: .8;
            -moz-opacity: .8;
            opacity: .8
        }

        .drive-wrapper .drive-item-thumb a:hover {
            -webkit-opacity: 1;
            -moz-opacity: 1;
            opacity: 1
        }

        .drive-wrapper .drive-item-thumb .fa {
            display: inline-block;
            font-size: 36px;
            margin: 0 auto;
            margin-top: 20px
        }

        .drive-wrapper .drive-item-footer .utilities {
            margin-bottom: 0
        }

        .drive-wrapper .drive-item-footer .utilities li:last-child {
            padding-right: 0
        }

        .drive-list-view .name {
            width: 60%
        }

        .drive-list-view .name.truncate {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .drive-list-view .type {
            width: 15px
        }

        .drive-list-view .date,
        .drive-list-view .size {
            max-width: 60px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .drive-list-view a {
            color: #494d55
        }

        .drive-list-view a:hover {
            color: #40babd
        }

        .theme-2 .drive-list-view a:hover {
            color: #6dbd63
        }

        .theme-3 .drive-list-view a:hover {
            color: #497cb1
        }

        .theme-4 .drive-list-view a:hover {
            color: #ec6952
        }

        .drive-list-view td.date,
        .drive-list-view td.size {
            color: #a2a6af
        }

        @media (max-width:767px) {
            .view-account .content-panel .title {
                text-align: center
            }
            .view-account .side-bar .user-info {
                padding: 0
            }
            .view-account .side-bar .user-info .img-profile {
                width: 60px;
                height: 60px
            }
            .view-account .side-bar .user-info .meta li {
                margin-bottom: 5px
            }
            .view-account .content-panel .content-header-wrapper .actions {
                position: static;
                margin-bottom: 30px
            }
            .view-account .content-panel {
                padding: 0
            }
            .view-account .content-panel .content-utilities .page-nav {
                position: static;
                margin-bottom: 15px
            }
            .drive-wrapper .drive-item {
                width: 100px;
                margin-right: 5px;
                float: none
            }
            .drive-wrapper .drive-item-thumb {
                width: auto;
                height: 54px
            }
            .drive-wrapper .drive-item-thumb .fa {
                font-size: 24px;
                padding-top: 0
            }
            .view-account .content-panel .avatar .figure img {
                float: none;
                margin-bottom: 15px
            }
            .view-account .file-uploader {
                margin-bottom: 15px
            }
            .view-account .mail-subject {
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }
            .view-account .content-panel .mails-wrapper .mail-item .time-container {
                position: static
            }
            .view-account .content-panel .mails-wrapper .mail-item .time-container .time {
                width: auto;
                text-align: left
            }
        }

        @media (min-width:768px) {
            .view-account .side-bar .user-info {
                padding: 0;
                padding-bottom: 15px
            }
            .view-account .mail-subject .subject {
                max-width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }
        }

        @media (min-width:992px) {
            .view-account .content-panel {
                min-height: 800px;
                border-left: 1px solid #f3f3f7;
                margin-left: 200px
            }
            .view-account .mail-subject .subject {
                max-width: 280px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }
            .view-account .side-bar {
                position: absolute;
                width: 200px;
                min-height: 600px
            }
            .view-account .side-bar .user-info {
                margin-bottom: 0;
                border-bottom: none;
                padding: 30px
            }
            .view-account .side-bar .user-info .img-profile {
                width: 120px;
                height: 120px
            }
            .view-account .side-bar .side-menu {
                text-align: left
            }
            .view-account .side-bar .side-menu .nav {
                display: block
            }
            .view-account .side-bar .side-menu .nav>li {
                display: block;
                float: none;
                font-size: 14px;
                border-bottom: 1px solid #f3f3f7;
                margin-right: 0;
                margin-bottom: 0
            }
            .view-account .side-bar .side-menu .nav>li>a {
                display: block;
                color: #9499a3;
                padding: 10px 15px;
                padding-left: 30px
            }
            .view-account .side-bar .side-menu .nav>li>a:hover {
                background: #f9f9fb
            }
            .view-account .side-bar .side-menu .nav>li.active a {
                background: #f9f9fb;
                border-right: 4px solid #40babd;
                border-bottom: none
            }
            .theme-2 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #6dbd63
            }
            .theme-3 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #497cb1
            }
            .theme-4 .view-account .side-bar .side-menu .nav>li.active a {
                border-right-color: #ec6952
            }
            .view-account .side-bar .side-menu .nav>li .icon {
                font-size: 24px;
                vertical-align: middle;
                text-align: center;
                width: 40px;
                display: inline-block
            }
        }
        .module {
            border: 1px solid #f3f3f3;
            border-bottom-width: 2px;
            background: #fff;
            margin-bottom: 30px;
            position: relative;
            border-radius: 4px;
            background-clip: padding-box;
        }
        .module .module-footer {
            background: #fff;
            border-top: 1px solid #f3f3f7;
            padding: 15px;
        }
        .module .module-footer a {
            color: #9499a3;
        }
    </style>

@endpush

@section('main-content')
    <div class="row">
        @include('web_mail.panel_mail', ['aFolders' => $aFolders])

        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{ $oMessage->getSubject() }}</h3>
                <h5>From: {{ $oMessage->getFrom()[0]->mail }}
                  <span class="mailbox-read-time pull-right"></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  {{ Form::open(['route' => ['empresa.mail.destroy', 'empresa_id' => $empresa->id, 'nombre' => $empresa->nombre, 'folder' => $folder, 'message_id' => $oMessage->getUid()]]) }}
                  {!! method_field('DELETE') !!}
                  <button type="submit" class="btn btn-default btn-sm delete-confirm" data-toggle="tooltip" data-container="body" title="Delete"  data-id="{{  $oMessage->getUid() }}">
                    <i class="fa fa-trash-o"></i></button>
                  {{ Form::close() }}
                </div>

              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{!! $oMessage->parseBody()->bodies['html']->content or '' !!}</p>

              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->

            <div class="box-footer">

                <div class="drive-wrapper drive-grid-view">
                    <div class="grid-items-wrapper">
                        @if($oMessage->hasAttachments())


                            @php
                                $k = 0;
                            @endphp
                            @foreach($oMessage->getAttachments() as $key => $attach)

                                @php
                                    $filename = str_replace(' ', '', $attach->name);
                                    $filepath = 'public/empresas/'.$empresa->id.'/adjuntos/'.$filename;
                                    $attachments[$k]['getPath'] = $filepath;
                                    $pullfile = \Illuminate\Support\Facades\Storage::put($filepath, $attach->content, 'public');
                                    $k++;
                                @endphp

                                <div class="drive-item module text-center">
                                    <div class="drive-item-inner module-inner">
                                        <div class="drive-item-title"><a href="#">{{ $attach->name }}</a></div>
                                        <div class="drive-item-thumb">
                                            <a href="#">
                                                @if(pathinfo($attach->getName(), PATHINFO_EXTENSION) =='txt')
                                                    <i class="fa fa-file-text-o text-primary"></i>
                                                    @elseif(pathinfo($attach->getName(), PATHINFO_EXTENSION) =='pdf')
                                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                                @elseif(pathinfo($attach->getName(), PATHINFO_EXTENSION) =='jpg' or pathinfo($attach->getName(), PATHINFO_EXTENSION) =='png' or pathinfo($attach->getName(), PATHINFO_EXTENSION) =='gif')
                                                    <div class="drive-item-thumb">
                                                        <a href="#"><img class="img-responsive" src="{{ asset('storage/empresas/'. $empresa->id. '/adjuntos/'. $filename) }}" alt="{{ $filename }}"></a>
                                                    </div>
                                                @elseif(pathinfo($attach->getName(), PATHINFO_EXTENSION) =='doc' or pathinfo($attach->getName(), PATHINFO_EXTENSION) =='docx')
                                                    <i class="fa fa-file-word-o text-primary"></i>
                                                @elseif(pathinfo($attach->getName(), PATHINFO_EXTENSION) =='xls')
                                                    <i class="fa fa-file-excel-o text-primary"></i>
                                                @else
                                                    <i class="fa fa-file-zip-o text-primary"></i>
                                                @endif

                                            </a>
                                        </div>
                                    </div>
                                    <div class="drive-item-footer module-footer">
                                        <ul class="utilities list-inline">
                                            <li><a href="{{ asset('storage/empresas/'. $empresa->id. '/adjuntos/'. $filename) }}" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><i class="fa fa-download"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                            @endforeach

                        @endif

                    </div>
                </div>


            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
             {{--  <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
              </div> --}}

              <div class="pull-right">
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
          </div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            @if($oMessage->hasAttachments())
            $('#attac_files').fileinput({
                uploadAsync: false,
                minFileCount: 2,
                maxFileCount: 5,
                overwriteInitial: false,
                    initialPreview: [
                        @foreach($oMessage->getAttachments() as $key => $attach)
                           "{{ asset('storage/empresas/'. $empresa->id. '/adjuntos/'. $attach->name) }}",
                        @endforeach
                    ],
                initialPreviewAsData: true, // defaults markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below

                    initialPreviewConfig: [
                        {
                            @foreach($oMessage->getAttachments() as $key => $attach)
                            type: "{{ $attach->content_type }}", caption: "{{ $attach->name }}", url: "{{ asset('storage/empresas/'. $empresa->id. '/adjuntos/'. $attach->name) }}", key: "{{ $attach->id }}"
                            @if($loop->iteration)
                                ,
                            @endif
                            @endforeach
                             },
                    ],
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': '<i class="fas fa-file-word text-primary"></i>',
                    'application/vnd.ms-excel': '<i class="fas fa-file-excel text-success"></i>',
                    'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
                    'application/pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                    'zip': '<i class="fas fa-file-archive text-muted"></i>',
                    'htm': '<i class="fas fa-file-code text-info"></i>',
                    'text/plain': '<i class="fas fa-file-alt text-info"></i>',
                    'mov': '<i class="fas fa-file-video text-warning"></i>',
                    'mp3': '<i class="fas fa-file-audio text-warning"></i>',
                    // note for these file types below no extension determination logic
                    // has been configured (the keys itself will be used as extensions)
                    'image/jpg': '<i class="fas fa-file-image text-danger"></i>',
                    'image/gif': '<i class="fas fa-file-image text-muted"></i>',
                    'image/png': '<i class="fas fa-file-image text-primary"></i>'
                },
                previewFileExtSettings: { // configure the logic for determining icon file extensions
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': function(ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'application/vnd.ms-excel': function(ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function(ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function(ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function(ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function(ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                    },
                    'mov': function(ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function(ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                }

            });
            @endif

            $('.delete-confirm').on('click', function(e) {
                e.preventDefault();

                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                    title: 'Desea eliminar la documentacion?',
                    text: "Al eliminar esto no hay vuelta atras!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'No, cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: $(this).attr('data-href'),
                            method: 'POST',
                            dataType: 'JSON',
                            data: {
                                '_token': $('input[name="_token"]').val(),
                                'message_id': $(this).attr('data-id'),
                                '_method': $('input[name="_method"]').val()
                            },
                            success: function(data) {
                                if( data.status == 'success' ) {
                                    sweetAlert('Eliminado', data.message, 'success');
                                    setTimeout(function() {
                                        window.location.reload(data.redirect_url);
                                    }, 3000);
                                } else {
                                    sweetAlert('Uppsss...', data.message, 'error');
                                }
                            },
                            error: function(xhr, message) {

                            }
                        });
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelada',
                            'La operacion a sido cancelada',

                            'error'
                        )
                    }
                })

            });
        });
    </script>

@endpush
