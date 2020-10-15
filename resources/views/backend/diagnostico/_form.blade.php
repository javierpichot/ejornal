<div class="col-md-6 col-sm-12 {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('consulta_motivo_id', "Consulta motivo") }}
		{!! Form::select('consulta_motivo_id', $motivo_consultas->pluck('nombre', 'id'), isset($diagnostico) ? $diagnostico->consulta_motivo_id : null, ['placeholder' => 'Seleccione motivo consulta', 'class' => 'form-control box-size']) !!}
		@if  ($errors->has('consulta_motivo_id'))
			<span class="help-block">
              <strong>{{ $errors->first('consulta_motivo_id') }}</strong>
            </span>
		@endif
	</div>
</div>

<div class="col-md-6 col-sm-12 {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('diagnostico', "Diagnostico") }}
		{{ Form::text('diagnostico',  isset($diagnostico) ? $diagnostico->diagnostico : null, ['class' => 'form-control box-size', 'placeholder' => "HTA", 'required' => 'required']) }}
		@if ($errors->has('diagnostico'))
			<span class="help-block">
				<strong>{{ $errors->first('diagnostico') }}</strong>
			</span>
		@endif
	</div>
</div>



<div class="col-md-6 col-sm-12 {{ $errors->has('tiempo') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('tiempo', "Tiempo") }}
		{{ Form::text('tiempo',  isset($diagnostico) ? $diagnostico->tiempo : null, ['class' => 'form-control box-size', 'placeholder' => "Tiempo", 'required' => 'required']) }}
		@if ($errors->has('tiempo'))
			<span class="help-block">
				<strong>{{ $errors->first('tiempo') }}</strong>
			</span>
		@endif
	</div>
</div>
<div class="col-md-12 col-sm-12 {{ $errors->has('cuidados') ? ' has-error' : '' }}">
	<div class="row">
		<div class="file-loading">
			<input id="cuidados" name="cuidados" type="file">
		</div>
	</div>
	@if ($errors->has('cuidados'))
		<span class="help-block">
				<strong>{{ $errors->first('cuidados') }}</strong>
			</span>
	@endif
</div>

<div class="col-md-12 col-sm-12 {{ $errors->has('guia') ? ' has-error' : '' }}">
	<div class="row">
		<div class="file-loading">
			<input id="guia" name="guia" type="file">
		</div>
	</div>
	@if ($errors->has('guia'))
		<span class="help-block">
				<strong>{{ $errors->first('guia') }}</strong>
			</span>
	@endif
</div>
