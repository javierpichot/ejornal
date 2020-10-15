@extends('adminlte::layouts.app')
@section('titulo', 'Editar Tipo de Incidencias')

@section('main-content')

    {{ Form::model($consultaTipo,[ 'route' => ['admin.consulta-tipo.update', $consultaTipo->id], 'role' => 'form', 'method' => 'patch', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.consulta-tipo.index') }}">Listado de Tipos de consultas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tipo de consulta</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.consulta_tipo._form")
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
                <a href="{{ route('admin.consulta-tipo.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')

@endsection
