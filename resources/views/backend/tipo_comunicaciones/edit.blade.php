@extends('adminlte::layouts.app')
@section('titulo', 'Editar Tipo de Comunicacion')

@section('main-content')

    {{ Form::model($comunicacionTipo,[ 'route' => ['admin.comunicacion-tipo.update', $comunicacionTipo->id], 'role' => 'form', 'method' => 'patch', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.tipo-incidencias.index') }}">Listado de Tipo de Presentaciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tipo de Presentaciones</li>
        </ol>
    </nav>
    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                 @include("backend.tipo_presentaciones._form")
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
                <a href="{{ route('admin.comunicacion-tipo.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')

@endsection
