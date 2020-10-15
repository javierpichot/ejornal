@extends('layouts.app')
@section('titulo', 'Vista de Usuario')

@section('content')
  
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('usuario.index') }}">Listado de Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vista de Usuario</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
        </div>
        <!-- /.card-header -->    
        <div class="card-body">
            <input type="hidden" name="user_photo" value="{{ $usuario->user_photo }}" />
        	<div class="row">
                    <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="name" class="form-control" type="text" placeholder="Nombre del Usuario" value="{{ $usuario->exists ? $usuario->name : '' }}" required="true" readonly="true" />
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                    <div class="col-md-6 {{ $errors->has('empleado_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Empleado</label>
                            <select id="empleado_id" name="empleado_id" class="form-control" required="true" disabled="true">
                          		<option value="">Seleccione ... </option>
	                           	@foreach($empleado AS $e)
				                    <option value="{{ $e->id }}" {{ $usuario->empleado_id == $e->id ? 'selected' :'' }}>
		                            	{{ $e->empleado_firstname }} {{ $e->empleado_lastname }}
		                           	</option>
				                @endforeach
				            </select>
                            @if ($errors->has('empleado_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_id') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('pregunta_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Pregunta Secreta</label>
                            <select id="pregunta_id" name="pregunta_id" class="form-control" required="true" disabled="true">
                          		<option value="">Seleccione ... </option>
	                            @if($pre_det)
			                          	@foreach($pre_det AS $g)
			                          		<option value="{{ $g->id }}" {{ $usuario->pregunta_id == $g->id ? 'selected' :'' }}>
	                                            {{ $g->catalogo_detalle_name }}
	                                        </option>
			                          	@endforeach
			                        @endif
			                </select>
                            @if ($errors->has('pregunta_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pregunta_id') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                    <div class="col-md-6 {{ $errors->has('respuesta') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Respuesta</label>
                            <input name="respuesta" class="form-control" type="text" placeholder="Respuesta del Usuario" value="{{ $usuario->exists ? $usuario->respuesta : '' }}"  required="true" readonly="true" />
                            @if ($errors->has('respuesta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('respuesta') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('rol_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Rol</label>
                            <select id="rol_id" name="rol_id" class="form-control"  required="true" disabled="true">
                          		<option value="">Seleccione ... </option>
			                    @foreach($roles AS $r)
			                    	<option value="{{ $r->id }}" {{ $usuario->rol_id == $r->id ? 'selected' :'' }}>{{ $r->name }}</option>
			                    @endforeach
			                </select>
                            @if ($errors->has('rol_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rol_id') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
        </div>
    </div>
      <br/>
        <div class="row">
        	<div class="col-md-12">
        		<div class="float-right">
	        	    <a href="{{ route('usuario.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>

@endsection

@section('script')
<script type="text/javascript">
    $(function(){    
        $("#form").validate();
    });
</script>
@endsection