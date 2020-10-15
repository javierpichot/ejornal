<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre tipo incidencia") }}
		{{ Form::text('nombre',  isset($tipo_incidencias) ? $tipo_incidencias->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Incidencia", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>
