@extends('adminlte::layouts.app')
@section('titulo', 'Empresa')

@section('main-content')

        {{ Form::open(['route' => 'admin.empresa.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'form']) }}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.empresa.index') }}">Listado de Empresas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Empresa</li>
            </ol>
        </nav>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Informaci&oacute;n General</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    @include("backend.empresa._formulario")
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                        <i class="fa fa-save nav-icon"></i>
                        Guardar
                    </button>
                    <a href="{{ route('admin.empresa.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
@endsection

@push('script')
    <style type="text/css">
        .kv-file-upload {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $().ready(function() {
            $('.select2').select2()
            $('.categorias').tagsinput();
            $('.sectors').tagsinput();
            $('.turnos').tagsinput();
            $('.tareas').tagsinput();


            $('#caducidad .input-group.date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#logo').fileinput({
                <?php if(isset($empresa)) { ?>
                initialPreview: ["{{ asset('img/empresa/' . $empresa->logo) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
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
