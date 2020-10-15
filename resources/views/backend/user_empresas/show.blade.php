@extends('adminlte::layouts.app')
@section('titulo', 'Informacion General de'. $user->nombre )

@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profesional {{ $user->nombre }} detalles</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
                Informaci&oacute;n General de {{ $user->nombre }}
            </h3>
          </div>
          <div class="box-body">
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
              				{{ Form::text('username',  isset($user) ? $user->username : null, ['class' => 'form-control box-size', 'placeholder' => "benito_arango", 'required' => 'required', 'disabled' => true]) }}
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
              				{{ Form::text('nombre',  isset($user) ? $user->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nicolás", 'required' => 'required', 'disabled' => true]) }}
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
              				{{ Form::text('apellido',  isset($user) ? $user->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Benito Arango", 'required' => 'required', 'disabled' => true]) }}
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
              				{{ Form::text('email',  isset($user) ? $user->email : null, ['class' => 'form-control box-size', 'placeholder' => "nbenitoarango@gmail.com", 'required' => 'required', 'disabled' => true]) }}
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
              				{!! Form::select('empresas[]', $empresas->pluck('nombre', 'id'),  isset($user) ? $user->empresas : null, ['placeholder' => 'Seleccione una empresa', 'class' => 'form-control box-size', 'id' => 'empresas', 'required' => 'required', 'multiple' => true, 'disabled' => true]) !!}
              				@if ($errors->has('empresas'))
              					<span class="help-block">
              						<strong>{{ $errors->first('empresas') }}</strong>
              					</span>
              				@endif
              			</div>
              		</div>

              		<div class="col-md-6 col-sm-12 {{ $errors->has('roles') ? ' has-error' : '' }}">
              			<div class="form-group">
              				{{ Form::label('role', "Role") }}
              				{!! Form::select('roles', $roles->pluck('name', 'id'), isset($user) ? $user->roles : null, ['placeholder' => 'Seleccione una empresa', 'class' => 'form-control box-size', 'id' => 'roles', 'required' => 'required', 'disabled' => true]) !!}
              				@if ($errors->has('roles'))
              					<span class="help-block">
              						<strong>{{ $errors->first('roles') }}</strong>
              					</span>
              				@endif
              			</div>
              		</div>
              	</div>

              	<div class="row">
              		<div class="col-md-12 col-sm-12 {{ $errors->has('telefono') ? ' has-error' : '' }}">
              			<div class="form-group">
              				{{ Form::label('telefono', "Telefono") }}
              				{{ Form::text('telefono',  isset($user) ? $user->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "332444555", 'required' => 'required', 'disabled' => true]) }}
              				@if ($errors->has('telefono'))
              					<span class="help-block">
              						<strong>{{ $errors->first('telefono') }}</strong>
              					</span>
              				@endif
              			</div>
              		</div>
              	</div>
            </div>

          </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $('#photo').fileinput({
                <?php if(isset($user)) { ?>
                initialPreview: ["{{ asset('storage/user_empresa/'. $user->id . '/' . $user->photo) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las foto del profesional',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

        });
    </script>
@endpush
