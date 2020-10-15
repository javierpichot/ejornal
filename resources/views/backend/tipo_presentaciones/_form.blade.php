<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre tipo presentacion") }}
		{{ Form::text('nombre',  isset($presentacion_tipo) ? $presentacion_tipo->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Medico a domicilio", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>

<div class="col-md-6 col-sm-12 {{ $errors->has('tipo') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('tipo', "Tipo") }}
		{!! Form::select('tipo', $tipos->getTipos(), isset($presentacion_tipo) ? $presentacion_tipo->tipo : null, ['placeholder' => 'Seleccione el tipo', 'class' => 'form-control box-size', 'required' => 'required']) !!}
		@if ($errors->has('tipo'))
			<span class="help-block">
				<strong>{{ $errors->first('tipo') }}</strong>
			</span>
		@endif
	</div>
</div>
