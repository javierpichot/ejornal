<div class="col-md-6 col-sm-12 {{ $errors->has('empresa_id') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre empresa") }}
		{!! Form::select('empresa_id', $empresas->pluck('nombre', 'id'), null, ['placeholder' => 'Seleccione una empresa', 'class' => 'form-control box-size', 'required' => 'required']) !!}
		@if ($errors->has('empresa_id'))
			<span class="help-block">
				<strong>{{ $errors->first('empresa_id') }}</strong>
			</span>
		@endif
	</div>
</div>


<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('nombre', "Nombre surcusal") }}
		{{ Form::text('nombre',  isset($sucursal) ? $sucursal->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Sucursal Carrefour", 'required' => 'required']) }}
		@if ($errors->has('nombre'))
			<span class="help-block">
				<strong>{{ $errors->first('nombre') }}</strong>
			</span>
		@endif
	</div>
</div>


<div class="col-md-12 col-sm-12 {{ $errors->has('direccion') ? ' has-error' : '' }}">
	<div class="form-group">
		{{ Form::label('direccion', "Direccion surcusal") }}
		{{ Form::textarea('direccion',  isset($sucursal) ? $sucursal->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Calle 01092", 'required' => 'required']) }}
		@if ($errors->has('direccion'))
			<span class="help-block">
				<strong>{{ $errors->first('direccion') }}</strong>
			</span>
		@endif
	</div>
</div>
<br>



@section('script')
<script type="text/javascript">
    $().ready(function() {

        $('#sucursal_phone_primary').mask('(000) 000-0000');
        $('#sucursal_phone_assistant').mask('(000) 000-0000');
        $('#sucursal_celular_phone_primary').mask('(000) 000-0000');
        $('#sucursal_celular_phone_assistant').mask('(000) 000-0000');

        // validate the comment form when it is submitted
        $("#form").validate();
    });
</script>
@endsection
