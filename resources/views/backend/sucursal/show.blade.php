@extends('layouts.app')
@section('titulo', 'Vista de Sucursal')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('sucursal.index') }}">Listado de Sucursales</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vista de Sucursal</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n General</h3>
            </div>
            <!-- /.card-header -->    
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>C&oacute;digo</label>
                            <input name="sucursal_code" class="form-control" type="text" placeholder="Codigo de la Sucursal" value="{{ $sucursal->exists ? $sucursal->sucursal_code : $codigo }}" required="true" readonly="true" />
                        </div>                    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empresa</label>
                            <select id="empresa_id" name="empresa_id" class="form-control" required="true"  disabled="true" >
                                <option value="">Seleccione ...</option>
                                @foreach($empresas AS $e)
                                    <option value="{{ $e->id }}" {{ $sucursal->empresa_id == $e->id ? 'selected' :'' }}>{{ $e->empresa_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="sucursal_name" class="form-control" type="text" placeholder="Nombre de la Sucursal" value="{{ $sucursal->exists ? $sucursal->sucursal_name : '' }}"  required="true"  readonly="true" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Direcci&oacute;n</label>
                            <textarea name="sucursal_address" class="form-control" placeholder="Direcci&oacute;n de la Sucursal" rows="5" required="true"  readonly="true" >{{ $sucursal->exists ? $sucursal->sucursal_address : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n del Contacto</h3>
            </div>
            <!-- /.card-header -->    
            <div class="card-body">
            	 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tel&eacute;fono Principal</label>
                            <div class="input-group">
                            <input name="sucursal_phone_primary" id="sucursal_phone_primary" class="form-control" type="text" placeholder="Tel&eacute;fono Principal del Contacto" value="{{ $sucursal->exists ? $sucursal->sucursal_phone_primary : old('sucursal_phone_primary') }}"  required="true"  readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tel&eacute;fono Auxiliar</label>
                            <div class="input-group">
                            <input name="sucursal_phone_assistant" id="sucursal_phone_assistant" class="form-control" type="text" placeholder="Tel&eacute;fono Auxiliar del Contacto" value="{{ $sucursal->exists ? $sucursal->sucursal_phone_assistant : old('sucursal_phone_assistant') }}"  readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Celular Principal</label>
                            <div class="input-group">
                            <input name="sucursal_celular_phone_primary" id="sucursal_celular_phone_primary" class="form-control" type="text" placeholder="Celular Principal del Contacto" value="{{ $sucursal->exists ? $sucursal->sucursal_celular_phone_primary : old('sucursal_celular_phone_primary') }}"  required="true"  readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Celular Auxiliar</label>
                            <div class="input-group">
                            <input name="sucursal_celular_phone_assistant" id="sucursal_celular_phone_assistant" class="form-control" type="text" placeholder="Celular Auxiliar del Contacto" value="{{ $sucursal->exists ? $sucursal->sucursal_celular_phone_assistant : old('sucursal_celular_phone_assistant') }}" readonly="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
        	<div class="col-md-12">
        		<div class="float-right">
	        	    <a href="{{ route('sucursal.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>

@endsection

@section('script')
<script type="text/javascript">
    $().ready(function() {

        $('#sucursal_phone_primary').mask('(000) 000-0000');
        $('#sucursal_phone_assistant').mask('(000) 000-0000');
        $('#sucursal_celular_phone_primary').mask('(000) 000-0000');
        $('#sucursal_celular_phone_assistant').mask('(000) 000-0000');
    });
</script>
@endsection