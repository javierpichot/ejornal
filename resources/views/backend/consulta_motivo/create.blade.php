@extends('adminlte::layouts.app')
@section('titulo', 'Crear Motivo de consulta')

@section('main-content')

    {{ Form::open(['route' => 'admin.consulta-motivo.store', 'role' => 'form', 'method' => 'post', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.consulta-motivo.index') }}">Listado de Motivos de consultas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Motivo de consulta</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.consulta_motivo._form")
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
                <a href="{{ route('admin.consulta-motivo.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('script')

@endsection
