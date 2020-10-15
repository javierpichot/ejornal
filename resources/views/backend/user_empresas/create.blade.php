@extends('adminlte::layouts.app')
@section('titulo', 'Crear Tipo de Incidencias')

@section('main-content')

    {{ Form::open(['route' => 'empresa.usuario.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.usuarios.index') }}">Listado de usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuario</li>
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
            <div class="float-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('empresa.usuarios.index') }}" class="btn btn-default">
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
            $("#form").validate({
              rules: {
                password: "required",
                password_again: {
                  equalTo: "#password"
                }
              }
            });
        });
    </script>
@endpush
