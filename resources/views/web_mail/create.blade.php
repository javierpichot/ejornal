@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de prestaciones de '. $empresa->nombre)


@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@push('styles')
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>

@endpush
@section('main-content')
    <div class="row">
    @include('web_mail.panel_mail', ['aFolders' => $aFolders])
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Compose New Message</h3>
                </div>
                <!-- /.box-header -->
                {{ Form::open(['route' => ['empresa.mail.store', $empresa->id, $empresa->nombre], 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'form']) }}
                <div class="box-body">
                    <div class="form-group">
                        <input class="form-control to" style="width: 100%" name="to" placeholder="Para:" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="subject" placeholder="Subject:">
                    </div>
                    <div class="form-group">

                        <textarea class="form-control" name="message" style="height: 365px;" required></textarea>

                    </div>
                    <div class="form-group">
                        <div class="file-loading">
                            <input id="files" name="files[]" type="file" multiple>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                    </div>
                </div>
            {{ Form::close() }}
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@endsection

@push('script')
    <style type="text/css">
        .kv-file-upload {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $().ready(function() {

            $('.to').tagsinput();

            $('#files').fileinput({
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                allowedFileTypes: ['image', 'html', 'text', 'video', 'audio', 'flash', 'object'],
                allowedFileExtensions: ['jpg', 'png', 'doc', 'docx', 'xls', 'ppt'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            // validate the comment form when it is submitted
            $("#form").validate();
        });
    </script>
@endpush