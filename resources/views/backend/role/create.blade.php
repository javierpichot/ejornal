@extends('adminlte::layouts.app')
@section('titulo', 'Rol')

@section('main-content')

    {{ Form::open(['route' => 'admin.role.store', 'role' => 'form', 'method' => 'post', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.roles.index') }}">Listado de Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.role._formulario")
             </div>
            </div>

    </div>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">  Detalle de Asignación de Permisos</h3>
          <div class="pull-right">
                        <button type="button" class="check btn btn-primary" value="Seleccionar todos">Seleccionar todos</button>
                    </div>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                 <div class="col-12">
                                         @php
                                             $permissions = Caffeinated\Shinobi\Models\Permission::all();
                                             $sliceCount = ceil(count($permissions)/3);
                                         @endphp


                                             <div class="col-md-4 menu-arbol">
                                                 @foreach($permissions as $permission)

                                                     <div class="custom-control custom-checkbox mb-3 ml-5" id="tree">
                                                         <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ !empty($role) ? $role->can($permission->slug) ? 'checked' : '' : '' }}>
                                                         <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                     </div>
                                                     <br>

                                                 @endforeach
                                             </div>
                                     </div>
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
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default">
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
