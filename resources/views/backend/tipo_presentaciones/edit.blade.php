@extends('adminlte::layouts.app')
@section('titulo', 'Editar Tipo de Incidencias')

@section('main-content')

    {{ Form::model($presentacion_tipo,[ 'route' => ['admin.tipo-prestacion.update', $presentacion_tipo->id], 'role' => 'form', 'method' => 'patch', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.tipo-prestacion.index') }}">Cartera de servicios</a></li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body table-responsive">@include("backend.tipo_presentaciones._form")</div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('admin.tipo-prestacion.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')

@endsection
