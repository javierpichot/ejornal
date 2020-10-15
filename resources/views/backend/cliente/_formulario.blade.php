@extends('layouts.app')
@section('titulo', 'Clientes')

@section('content')

<form action="{{ $cliente ? route('cliente.update', ['cliente' => $cliente->id]) : route('cliente.store') }}" method="post" id="form">
    {{ $cliente->exists ? method_field('PUT') : '' }}
    {{ csrf_field() }}

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('cliente.index') }}">Listado de Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cliente</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
       <div class="card-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
        </div>
        <!-- /.card-header -->    
        <div class="card-body">

        	<div class="row">
                    <div class="col-md-6 {{ $errors->has('cliente_code') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>C&oacute;digo</label>
                            <input name="cliente_code" class="form-control" type="text" placeholder="C&oacute;digo del Cliente" value="{{ $cliente->exists ? $cliente->cliente_code : $codigo }}" readonly="true" required="true"/>
                             @if ($errors->has('cliente_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_code') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                    <div class="col-md-6 {{ $errors->has('cliente_ruc') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>R.U.C.</label>
                            <input name="cliente_ruc" class="form-control" type="text" placeholder="R.U.C. del Cliente" value="{{ $cliente->exists ? $cliente->cliente_ruc : '' }}" required="true"/>
                            @if ($errors->has('cliente_ruc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_ruc') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('cliente_name') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="cliente_name" class="form-control" type="text" placeholder="Nombre del Cliente" value="{{ $cliente->exists ? $cliente->cliente_name : '' }}" required="true"/>
                            @if ($errors->has('cliente_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_name') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('cliente_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Direcci&oacute;n</label>
                          	<textarea class="form-control" id="cliente_address" name="cliente_address" rows="5" placeholder="Direcci&oacute;n del Cliente" required="true">{{ $cliente->exists ? $cliente->cliente_address : '' }}</textarea>
                            @if ($errors->has('cliente_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_address') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('cliente_email') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Correo Electr&oacute;nico</label>
                            <input name="cliente_email" class="form-control" type="email" placeholder="Correo Electr&oacute;nico del Cliente" value="{{ $cliente->exists ? $cliente->cliente_email : '' }}"  required="true"/>
                            @if ($errors->has('cliente_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_email') }}</strong>
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
                    <div class="col-md-6 {{ $errors->has('cliente_phone') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Tel&eacute;fono Principal</label>
                            <div class="input-group">
                            <input name="cliente_phone" id="cliente_phone" class="form-control" type="text" placeholder="Tel&eacute;fono Principal del Cliente" value="{{ $cliente->exists ? $cliente->cliente_phone : old('cliente_phone') }}"  required="true"/>
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                              <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                            @if ($errors->has('cliente_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_phone') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                    <div class="col-md-6 {{ $errors->has('cliente_celular') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Celular Principal</label>
                            <div class="input-group">
                            <input name="cliente_celular" id="cliente_celular" class="form-control" type="text" placeholder="Celular Principal del  del Cliente" value="{{ $cliente->exists ? $cliente->cliente_celular : old('cliente_celular') }}" required="true" />
                            <span class="input-group-text"> 
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                              <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                            @if ($errors->has('cliente_celular'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cliente_celular') }}</strong>
                                </span>
                            @endif 
                        </div>                    
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>P&aacute;gina WEB</label>
                            <input name="cliente_web" class="form-control" type="text" placeholder="P&aacute;gina WEB del Cliente" value="{{ $cliente->exists ? $cliente->cliente_web : '' }}" />
                        </div>                    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input name="cliente_facebook" class="form-control" type="text" placeholder="Facebook del Cliente" value="{{ $cliente->exists ? $cliente->cliente_facebook : '' }}" />
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input name="cliente_instagram" class="form-control" type="text" placeholder="Instagram del Cliente" value="{{ $cliente->exists ? $cliente->cliente_instagram : '' }}" />
                        </div>                    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Twitter</label>
                            <input name="cliente_twitter" class="form-control" type="text" placeholder="Twitter del Cliente" value="{{ $cliente->exists ? $cliente->cliente_twitter : '' }}" />
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    <br/>
        <div class="row">
        	<div class="col-md-12">
        		<div class="float-right">
	        	    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
	        	        <i class="fa fa-save nav-icon"></i>
	        	        Guardar
	        	    </button>
	        	    <a href="{{ route('cliente.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){    
        $('#cliente_phone').mask('(000) 000-0000');
        $('#cliente_celular').mask('(000) 000-0000');
        $("#form").validate();
    });
</script>
@endsection