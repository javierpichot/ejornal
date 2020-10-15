@extends('layouts.app')
@section('titulo', 'Crear Motivo de consulta')

@section('content')
    {{ Form::model($documentacion_jornal,[ 'route' => ['admin.documento_jornal.update', $documentacion_jornal->id], 'role' => 'form', 'method' => 'patch', 'id' => 'form', 'enctype' => 'multipart/form-data']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.documento_jornal.index') }}">Listado de documentos internos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Documentos internos</li>
        </ol>
    </nav>

    <div class="card card-primary card-outline col-md-12">
        <div class="card-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- /.card-header -->
                @include("backend.documentacion_jornal._form")
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('admin.documento_jornal.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')
    <script type="text/javascript">
    $('#documentos').fileinput({
        <?php if(isset($documentacion_jornal)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
        initialPreview: ["{{ asset('jornal/' . $documentacion_jornal->url) }}"],
        initialPreviewAsData: true,
        initialPreviewDownloadUrl: "{{ asset('jornal/' . $documentacion_jornal->url) }}",
        <?php } ?>
        theme: 'fa',
        language: 'es',
        uploadUrl: '#',
        allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
        browseClass: "btn btn-primary btn-block",
        showCaption: false,
        showRemove: false,
        showUpload: false,

    });
    </script>
@endsection
