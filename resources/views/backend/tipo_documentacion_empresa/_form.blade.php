<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre tipo documentacion") }}
		{{ Form::text('nombre',  isset($documentacion_tipo_empresa) ? $documentacion_tipo_empresa->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Médica", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>
