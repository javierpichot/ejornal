@extends('adminlte::layouts.app')
@section('titulo', 'Editar Tipo de Incidencias')

@section('main-content')

    {{ Form::model($diagnostico,[ 'route' => ['admin.diagnostico.update', $diagnostico->id], 'role' => 'form', 'method' => 'patch', 'id' => 'form', 'enctype' => 'multipart/form-data']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.diagnostico.index') }}">Listado de diagnosticos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar diagnostico ( {{ $diagnostico->diagnostico }} )</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.diagnostico._form")
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
                <a href="{{ route('admin.diagnostico.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@push('script')
    <script type="text/javascript">
        $('#guia').fileinput({
            <?php if(isset($diagnostico)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview: ["{{ asset('storage/jornal/guia/' . $diagnostico->id . '/'. $diagnostico->guia) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl: "{{ asset('storage/jornal/guia/' . $diagnostico->id . '/'. $diagnostico->guia) }}",
            <?php } ?>
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            allowedFileExtensions: ['pdf'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false,
            autoReplace: false

        });


        $('#cuidados').fileinput({
            <?php if(isset($diagnostico)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview: ["{{ asset('storage/jornal/guia/' . $diagnostico->id . '/'. $diagnostico->guia) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl: "{{ asset('storage/jornal/guia/' . $diagnostico->id . '/'. $diagnostico->guia) }}",
            <?php } ?>
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            allowedFileExtensions: ['pdf'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false,
            autoReplace: false

        });
    </script>
@endpush