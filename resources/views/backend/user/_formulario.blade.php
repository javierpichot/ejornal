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
				{{ Form::text('username',  isset($usuario) ? $usuario->username : null, ['class' => 'form-control box-size', 'placeholder' => "benito_arango", 'required' => 'required']) }}
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
				{{ Form::text('nombre',  isset($usuario) ? $usuario->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nicolás", 'required' => 'required']) }}
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
				{{ Form::text('apellido',  isset($usuario) ? $usuario->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Benito Arango", 'required' => 'required']) }}
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
				{{ Form::text('email',  isset($usuario) ? $usuario->email : null, ['class' => 'form-control box-size', 'placeholder' => "nbenitoarango@gmail.com", 'required' => 'required']) }}
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>
	<div class="row">

		<div class="col-md-6 col-sm-12 {{ $errors->has('roles') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('role', "Role") }}
				{!! Form::select('roles', $roles->pluck('name', 'id'), isset($usuario) ? $usuario->roles : null, ['placeholder' => 'Seleccione un role', 'class' => 'form-control box-size', 'id' => 'roles', 'required' => 'required']) !!}
				@if ($errors->has('roles'))
					<span class="help-block">
						<strong>{{ $errors->first('roles') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="col-md-6 col-sm-12 {{ $errors->has('empresas') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('empresas', "Empresas") }}
				{!! Form::select('empresas[]', $empresas->pluck('nombre', 'id'), isset($usuario) ? $usuario->empresas : null, ['class' => 'form-control box-size', 'id' => 'empresas', 'required' => 'required', 'multiple' => true]) !!}
				@if ($errors->has('empresas'))
					<span class="help-block">
						<strong>{{ $errors->first('empresas') }}</strong>
					</span>
				@endif
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 {{ $errors->has('telefono') ? ' has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('telefono', "Telefono") }}
				{{ Form::text('telefono',  isset($usuario) ? $usuario->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "332444555"]) }}
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
				 {{ Form::password('password',  ['class' => 'form-control box-size', 'placeholder' => "Password del Usuario", isset($usuario) ? '' : 'required']) }}
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
				  {{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => "Confirmaci&oacute;n de Password del Usuario", isset($usuario) ? '' : 'required']) }}
			 </div>

		 </div>

		 <div class="col-md-12">
		  <div class="form-group">
			  <label>Contraseña de email corporativo</label>
			   {{ Form::password('password_email',  ['class' => 'form-control', 'placeholder' => "Password Email Corporativo", isset($usuario) ? '' : 'required']) }}
		  </div>

	  </div>
	            @if (Auth::user()->google2fa_secret)
                <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Desactivar 2 factor de seguridad</a>
                @else
                <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Activar 2 factor de seguridad</a>
                @endif </div>
</div>
