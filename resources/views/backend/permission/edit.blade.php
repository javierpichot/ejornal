@extends('adminlte::layouts.app')
@section('titulo', 'Crear permiso')

@section('main-content')

    {{ Form::model($permission, ['route' => ['admin.permission.update', $permission->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'form'])
    }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.permissions.index') }}">Listado de Permisos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar permiso</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.permission._formulario")
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
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){

        });
    </script>
@endsection
