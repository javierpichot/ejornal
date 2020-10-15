<div class="col-md-4 col-sm-12">
	<div class="file-loading">
		<input id="photo" name="photo" type="file">
	</div>
</div>
<div class="col-md-8 col-sm-12">
	<div class="row">
		<div class="col-md-6 col-sm-12 {{ $errors->has('username') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('username', "User name") }}
				{{ Form::text('username',  isset($user_empresa) ? $user_empresa->username : null, ['class' => 'form-control box-size', 'placeholder' => "benito_arango", 'required' => 'required']) }}
				@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
				@endif
			</div>
		</div>


		<div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('nombre', "Nombre") }}
				{{ Form::text('nombre',  isset($user_empresa) ? $user_empresa->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "nombre", 'required' => 'required']) }}
				@if ($errors->has('nombre'))
					<span class="help-block">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-6 col-sm-12 {{ $errors->has('apellido') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('apellido', "Apellido") }}
				{{ Form::text('apellido',  isset($user_empresa) ? $user_empresa->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Apellidos", 'required' => 'required']) }}
				@if ($errors->has('apellido'))
					<span class="help-block">
						<strong>{{ $errors->first('apellido') }}</strong>
					</span>
				@endif
			</div>
		</div>


		<div class="col-md-6 col-sm-12 {{ $errors->has('email') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('email', "Email") }}
				{{ Form::text('email',  isset($user_empresa) ? $user_empresa->email : null, ['class' => 'form-control box-size', 'placeholder' => "email@email.com", 'required' => 'required']) }}
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 {{ $errors->has('empresas') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('email', "Empresa") }}
				{!! Form::select('empresas[]', $empresas->pluck('nombre', 'id'),  isset($user_empresa) ? $user_empresa->empresas : null, ['class' => 'form-control box-size', 'id' => 'empresas', 'required' => 'required', 'multiple' => true]) !!}
				@if ($errors->has('empresas'))
					<span class="help-block">
						<strong>{{ $errors->first('empresas') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="col-md-6 col-sm-12 {{ $errors->has('roles') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('role', "Rol") }}
				{!! Form::select('roles', $roles->pluck('name', 'id'), isset($user_empresa) ? $user_empresa->roles : null, ['class' => 'form-control box-size', 'id' => 'roles', 'required' => 'required']) !!}
				@if ($errors->has('roles'))
					<span class="help-block">
						<strong>{{ $errors->first('roles') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="col-md-6 col-sm-12 {{ $errors->has('telefono') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('telefono', "Telefono") }}
				{{ Form::text('telefono',  isset($user_empresa) ? $user_empresa->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "332444555", 'required' => 'required']) }}
				@if ($errors->has('telefono'))
					<span class="help-block">
						<strong>{{ $errors->first('telefono') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="col-md-6">
			 <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
				 <label>Password</label>
				 {{ Form::password('password',  ['class' => 'form-control box-size', 'placeholder' => "Password del Usuario", isset($user_empresa) ? '' : 'required']) }}
				 @if ($errors->has('password'))
				 	<span class="help-block">
				 		<strong>{{ $errors->first('password') }}</strong>
				 	</span>
				 @endif
			 </div>
		 </div>
		 <div class="col-md-6">
			 <div class="form-group">
				 <label>Confirmaci&oacute;n</label>
				  {{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => "Confirmaci&oacute;n de Password del Usuario", isset($user_empresa) ? '' : 'required']) }}
			 </div>

		 </div>
		

	            @if (Auth::user()->google2fa_secret)
                <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Desactivar 2 factor de seguridad</a>
                @else
                <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Activar 2 factor de seguridad</a>
                @endif </div>



</div>
