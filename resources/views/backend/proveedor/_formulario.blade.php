<div class="col-md-4 col-sm-12 {{ $errors->has('presentacion_tipo_id') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('prestacion_tipo_id', "Presentacion tipo") }}
		{!! Form::select('prestacion_tipo_id', $prestacion_tipo->pluck('nombre', 'id'), null, ['placeholder' => 'Seleccione una presentacion', 'class' => 'form-control box-size', 'required' => 'required']) !!}
		@if ($errors->has('presentacion_tipo_id'))
			<span class="help-block">
				<strong>{{ $errors->first('presentacion_tipo_id') }}</strong>
			</span>
		@endif
	</div>
</div>
<div class="col-md-4 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre proveedor") }}
		{{ Form::text('nombre',  isset($proveedor) ? $proveedor->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre del proveedor", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>


<div class="col-md-4 col-sm-12 {{ $errors->has('telefono') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('numero', "Telefono de contacto") }}
		{{ Form::text('telefono',  isset($proveedor) ? $proveedor->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "Numero de telefono", 'required' => 'required']) }}
		@if ($errors->has('telefono'))
			<span class="help-block">
				<strong>{{ $errors->first('telefono') }}</strong>
			</span>
		@endif
	</div>
</div>



<div class="col-md-6 col-sm-12 {{ $errors->has('email') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('email', "E-mail") }}
		{{ Form::text('email',  isset($proveedor) ? $proveedor->email : null, ['class' => 'form-control box-size', 'placeholder' => "E-mail", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="col-md-6 col-sm-12 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('descripcion', "Descripcion proveedor") }}
		{{ Form::textarea('descripcion',  isset($proveedor) ? $proveedor->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripción de los servicios que presta, e información para localizarle.", 'required' => 'required']) }}
		@if ($errors->has('descripcion'))
			<span class="help-block">
				<strong>{{ $errors->first('descripcion') }}</strong>
			</span>
		@endif
	</div>
</div>
