@extends('adminlte::layouts.app')
@section('titulo', 'Editar Proveedor')

@section('main-content')
        {{ Form::model($proveedor, ['route' => ['admin.proveedor.update', $proveedor->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'form'])
        }}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.sucursales.index') }}">Listado de Proveedores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Proveedor {{ $proveedor->nombre }}</li>
            </ol>
        </nav>

        <div class="box box-info">
             <div class="box-header">
              <h3 class="card-title">Informaci&oacute;n General</h3>
             </div>
             <div class="box-body">
                 <div class="row">
                     <!-- /.card-header -->
                    @include("backend.proveedor._formulario")
                 </div>
                </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                        <i class="fa fa-save nav-icon"></i>
                        Guardar edicion
                    </button>
                    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
@endsection
