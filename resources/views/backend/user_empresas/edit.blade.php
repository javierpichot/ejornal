@extends('adminlte::layouts.app')
@section('titulo', 'Editar Tipo de Incidencias')

@section('main-content')

    {{ Form::model($user_empresa, [ 'route' => ['empresa.usuario.update', $user_empresa->id], 'role' => 'form', 'method' => 'patch', 'enctype' => 'multipart/form-data', 'id' => 'form']) }}
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.usuarios.index', ['id' => $empresa , 'nombre' => $empresa->nombre]) }}">Listado de usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar usuario</li>
                  </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.user_empresas._form")
             </div>
         </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('empresa.usuarios.index', ['id' => $empresa , 'nombre' => $empresa->nombre]) }}" class="btn btn-default">
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
            $('#roles').select2()
            $('#empresas').select2()


            $('#photo').fileinput({
                @php
                    @isset($user_empresa)


                @endphp
                initialPreview: ["{{ asset('storage/jornal/usuario/' . $user_empresa->id . '/perfil/' . $user_empresa->photo) }}"],
                initialPreviewAsData: true,
                @php
                    @endisset
                @endphp
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
