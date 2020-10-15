@extends('adminlte::layouts.app')
@section('titulo', 'Empresa')

@section('content')

        {{ Form::open(['route' => 'empresa.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'form']) }}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.index') }}">Listado de Empresas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Empresa</li>
            </ol>
        </nav>

        <div class="card card-primary card-outline col-md-12">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n General</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- /.card-header -->
                    @include("backend.empresa._formulario")
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                        <i class="fa fa-save nav-icon"></i>
                        Guardar
                    </button>
                    <a href="{{ route('empresa.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
@endsection

@section('script')
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

            // Bootstrap datepicker
            $.fn.datepicker.defaults.format = "yyyy-mm-dd";
            $('#caducidad .input-group.date').datepicker({
                todayBtn: "linked",
                dateFormat: 'yy-mm-dd',
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
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
@endsection
