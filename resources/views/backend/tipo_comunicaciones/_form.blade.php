<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre tipo comunicacion") }}
		{{ Form::text('nombre',  isset($comunicacionTipo) ? $comunicacionTipo->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Médica", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>
