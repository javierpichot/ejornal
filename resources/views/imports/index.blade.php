@extends('adminlte::layouts.app')

@section('titulo', 'Gestion de reportes '. $empresa->nombre)




@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Importacion de trabajadores</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Importar CVS</h3>
                </div>
                <a target="_blank" href="{{ asset('storage/export/example-import.csv') }}">Descargar Cvs importación <i class="fa fa-file-excel-o"></i> </a>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'empresa.trabajadores.import', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="box-body">
                    <div class="col-xs-4">
                        {{ Form::label('importar', "Importar") }}
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Importar cvs</button>
                </div>
                <!-- /.box-footer -->
                {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>

    </div>
@endsection
