@extends('adminlte::layouts.app')
@section('titulo', 'Crear diagnostico')

@section('main-content')

    {{ Form::open(['route' => 'admin.diagnostico.store', 'role' => 'form', 'method' => 'post', 'id' => 'form', 'enctype' => 'multipart/form-data']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.diagnostico.index') }}">Listado de diagnosticos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear diagnostico</li>
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
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre los documentos',
            allowedFileExtensions: ['pdf'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });

        $('#cuidados').fileinput({
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre los documentos',
            allowedFileExtensions: ['pdf'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });
    </script>
@endpush

