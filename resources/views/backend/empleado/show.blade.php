@extends('layouts.app')
@section('titulo', 'Vista de Empleado')

@section('content')

 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empleado.index') }}">Listado de Empleados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vista de Empleado</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n General</h3>
            </div>
            <!-- /.card-header -->    
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-6 col-sm-12 {{ $errors->has('empleado_code') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>C&oacute;digo</label>
                            <input name="empleado_code" class="form-control" type="text" placeholder="Codigo del Empleado" value="{{ $empleado->exists ? $empleado->empleado_code : $codigo }}" readonly="true" required="true" readonly="true" />
                            @if ($errors->has('empleado_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_code') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 {{ $errors->has('empleado_document') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>C&eacute;dula</label>
                            <input name="empleado_document" class="form-control" type="text" placeholder="C&eacute;dula del Empleado" value="{{ $empleado->exists ? $empleado->empleado_document : '' }}" required="true" readonly="true" />
                            @if ($errors->has('empleado_document'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_document') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>                    
                    <div class="col-md-6 col-sm-12 {{ $errors->has('empleado_firstdate') ? ' has-error' : '' }}">
                            <div class="form-group" id="date_1">
                                    <label class="font-normal">Fecha de Nacimiento</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" name="empleado_firstdate" type="text" placeholder="Fecha de Nacimiento del Empleado"  value="{{ $empleado->exists ? $empleado->empleado_firstdate : '' }}" data-date-format="yyyy-mm-dd" readonly="true" required="true" readonly="true" />
                                    </div>     
                                    <label id="empleado_firstdate-error" class="error" for="empleado_firstdate"></label>                               
                                    @if ($errors->has('empleado_firstdate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('empleado_firstdate') }}</strong>
                                        </span>
                                    @endif
                                </div>          
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 {{ $errors->has('empleado_firstname') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="empleado_firstname" class="form-control" type="text" placeholder="Nombre del Empleado" value="{{ $empleado->exists ? $empleado->empleado_firstname : '' }}" required="true" readonly="true" />
                            @if ($errors->has('empleado_firstname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_firstname') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                    <div class="col-md-6  col-sm-12  {{ $errors->has('empleado_lastname') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input name="empleado_lastname" class="form-control" type="text" placeholder="Apellido del Empleado" value="{{ $empleado->exists ? $empleado->empleado_lastname : '' }}" required="true" readonly="true" />
                            @if ($errors->has('empleado_lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_lastname') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12 col-sm-12 {{ $errors->has('sucursal_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Sucursal</label>
                            <select id="sucursal_id" name="sucursal_id" class="form-control" required="true" disabled="true">
                                <option value="">Seleccione ...</option>
                                @foreach($sucursales AS $s)
                                    <option value="{{ $s->id }}" {{ $empleado->sucursal_id == $s->id ? 'selected' :'' }}>{{ $s->sucursal_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6  col-sm-12  {{ $errors->has('genero_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Genero</label>
                          	<select id="genero_id" name="genero_id" class="form-control" required="true" disabled="true">
                          		<option value="">Seleccione ... </option>
                          		@if($gen_det)
		                          	@foreach($gen_det AS $g)
		                          		<option value="{{ $g->id }}" {{ $empleado->genero_id == $g->id ? 'selected' :'' }}>
                                            {{ $g->catalogo_detalle_name }}
                                        </option>
		                          	@endforeach
		                        @endif
                          	</select>
                            @if ($errors->has('genero_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('genero_id') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                    <div class="col-md-6  col-sm-12 {{ $errors->has('cargo_id') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Cargo</label>
                            <select id="cargo_id" name="cargo_id" class="form-control" required="true" disabled="true">
                          		<option value="">Seleccione ...</option>
                          		@if($car_det)
		                          	@foreach($car_det AS $c)
		                          		<option value="{{ $c->id }}"  {{ $empleado->cargo_id == $c->id ? 'selected' :'' }}>
                                            {{ $c->catalogo_detalle_name }}
                                        </option>
		                          	@endforeach
		                        @endif
                          	</select>
                            @if ($errors->has('cargo_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cargo_id') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12  {{ $errors->has('empleado_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Direcci&oacute;n</label>
                          	<textarea class="form-control" id="empleado_address" name="empleado_address" rows="5" placeholder="Direcci&oacute;n del Empleado" required="true" readonly="true" >{{ $empleado->exists ? $empleado->empleado_address : '' }}</textarea>
                            @if ($errors->has('empleado_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_address') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos de Contacto</h3>
            </div>
            <!-- /.card-header -->    
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-6 col-sm-12 {{ $errors->has('empleado_phone_principal') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Tel&eacute;fono Principal</label>
                            <div class="input-group">
                            <input name="empleado_phone_principal" id="empleado_phone_principal" class="form-control" type="text" placeholder="Tel&eacute;fono Principal del Empleado" value="{{ $empleado->exists ? $empleado->empleado_phone_principal : '' }}" required="true" readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                            @if ($errors->has('empleado_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_phone_principal') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                    <div class="col-md-6  col-sm-12 {{ $errors->has('empleado_celular_principal') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Celular Principal</label>
                            <div class="input-group">
                            <input name="empleado_celular_principal" id="empleado_celular_principal" class="form-control" type="text" placeholder="Celular Principal del  del Empleado" value="{{ $empleado->exists ? $empleado->empleado_celular_principal : '' }}" required="true" readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                            @if ($errors->has('empleado_celular_principal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empleado_celular_principal') }}</strong>
                                </span>
                            @endif
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12  col-sm-12 {{ $errors->has('empleado_email') ? ' has-error' : '' }}">
                    	<label>Correo Electr&oacute;nico</label>
                        <input name="empleado_email" class="form-control" type="email" placeholder="Correo Electr&oacute;nico del  del Empleado" value="{{ $empleado->exists ? $empleado->empleado_email : '' }}" required="true"  readonly="true" />
                        @if ($errors->has('empleado_email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('empleado_email') }}</strong>
                            </span>
                        @endif
                    </div>
                 </div>
            </div>
        </div>
        <br/>
        <div class="card card-primary card-outline">
            <!-- /.card-header -->    
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-12 col-sm-12 ">
                    	<label>Observaciones</label>
                        <textarea class="form-control" id="empleado_observacion" name="empleado_observacion" rows="5" placeholder="Observaciones del Empleado" readonly="true" >{{ $empleado->exists ? $empleado->empleado_observacion : '' }}</textarea>
                    </div>
                 </div>
            </div>
        </div>
        <br/>
        <div class="row">
        	<div class="col-md-12 col-sm-12">
        		<div class="float-right">
	        	    <a href="{{ route('empleado.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            
            $('#empleado_phone_principal').mask('(000) 000-0000');
            $('#empleado_celular_principal').mask('(000) 000-0000');
        });
    </script>
@endsection