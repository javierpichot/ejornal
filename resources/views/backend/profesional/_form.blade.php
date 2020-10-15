<div class="col-md-4 col-sm-12" style="margin-left:15px">
    <div class="row">

        <div class="file-loading">
            <input id="photo" name="photo" type="file">

	</div>


        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('profesional_tipo_id') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('profesional_tipo_id', "Tipo de profesional") }}
                    {!! Form::select('profesional_tipo_id', $tipo_profesional->pluck('nombre', 'id'), isset($profesional) ? $profesional->profesional_tipo_id : null, ['placeholder' => 'Seleccione tipo profesional', 'class' => 'form-control box-size']) !!}
                    @if  ($errors->has('tipo_profesional'))
                    <span class="help-block">
              <strong>{{ $errors->first('profesional_tipo_id') }}</strong>
            </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('user_id') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('user_id', "Asociar usuario web") }}
                    {!! Form::select('user_id', $users->pluck('email', 'id'), isset($profesional) ? $profesional->user_id : null, ['placeholder' => 'Seleccione un usuario web', 'class' => 'form-control box-size', 'id' => 'usuario_id']) !!}
                    @if  ($errors->has('user_id'))
                    <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
              </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="file-loading">
                <input id="foto_titulo" name="foto_titulo" type="file">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('documento') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('documento', "Documento") }}
                    {{ Form::text('documento', isset($profesional) ? $profesional->documento : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXX", 'id' => "documento"]) }}
                    @if  ($errors->has('documento'))
                    <span class="help-block">
                <strong>{{ $errors->first('documento') }}</strong>
              </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="file-loading">
                <input id="foto_documento" name="foto_documento" type="file">

        </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('numero_matricula') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('numero_matricula', "Matricula") }}
                    {{ Form::number('numero_matricula', isset($profesional) ? $profesional->numero_matricula : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX"]) }}
                    @if  ($errors->has('numero_matricula'))
                    <span class="help-block">
                <strong>{{ $errors->first('numero_matricula') }}</strong>
              </span>
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="file-loading">
                <input id="foto_seguro" name="foto_seguro" type="file">

      </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('poliza') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('poliza', "Seguro") }}
                    {{ Form::text('poliza', isset($profesional) ? $profesional->poliza : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX"]) }}
                    @if  ($errors->has('poliza'))
                    <span class="help-block">
              <strong>{{ $errors->first('poliza') }}</strong>
            </span>
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="file-loading">
                <input id="foto_matricula" name="foto_matricula" type="file">

    </div>
        </div>


    </div>
</div>
<div class="col-md-7 col-sm-12" style="margin-left:15px">
    <div class="row">

        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('nombre', "Nombre") }}
                {{ Form::text('nombre', isset($profesional) ? $profesional->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre"]) }}
                @if  ($errors->has('nombre'))
                <span class="help-block">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('apellido') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('apellido', "Apellido") }}
                {{ Form::text('apellido', isset($profesional) ? $profesional->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Apellido"]) }}
                @if  ($errors->has('apellido'))
                <span class="help-block">
						<strong>{{ $errors->first('apellido') }}</strong>
					</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('email', "Email") }}
                {{ Form::text('email', isset($profesional) ? $profesional->email : null, ['class' => 'form-control box-size', 'placeholder' => "email
                @correo.com",  ]) }}
                @if  ($errors->has('email'))
                <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-12 {{ $errors->has('celular') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('celular', "Celular") }}
                {{ Form::text('celular', isset($profesional) ? $profesional->celular : null, ['class' => 'form-control box-size', 'placeholder' => "Nº de celular"]) }}
                @if  ($errors->has('celular'))
                <span class="help-block">
            <strong>{{ $errors->first('celular') }}</strong>
          </span>
                @endif
            </div>
        </div>


    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre_familiar') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('nombre_familiar', "Nombre familiar") }}
                {{ Form::text('nombre_familiar', isset($profesional) ? $profesional->nombre_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre familiar"]) }}
                @if  ($errors->has('nombre_familiar'))
                <span class="help-block">
            <strong>{{ $errors->first('nombre_familiar') }}</strong>
          </span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('celular_familiar') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('celular_familiar', "Telefono familiar") }}
                {{ Form::text('celular_familiar', isset($profesional) ? $profesional->celular_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Telefono familiar"]) }}
                @if  ($errors->has('celular_familiar'))
                <span class="help-block">
            <strong>{{ $errors->first('celular_familiar') }}</strong>
          </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 {{ $errors->has('direccion') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('direccion', "Dirección") }}
                {{ Form::text('direccion', isset($profesional) ? $profesional->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Dirección"]) }}
                @if  ($errors->has('direccion'))
                <span class="help-block">
						<strong>{{ $errors->first('direccion') }}</strong>
					</span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('localidad_id') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('localidad_id', "Localidad") }}
                {!! Form::select('localidad_id', $localidades->pluck('nombre', 'id'), isset($profesional) ? $profesional->localidad_id : null, ['placeholder' => 'Seleccione una localidad', 'class' => 'form-control box-size', 'id' => 'roles',
                ]) !!}
                @if  ($errors->has('localidad_id'))
                <span class="help-block">
						<strong>{{ $errors->first('localidad_id') }}</strong>
					</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 {{ $errors->has('observacion_direccion') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('observacion_direccion', "Observaciones direccion") }}
                {{ Form::text('observacion_direccion', isset($profesional) ? $profesional->observacion_direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de dirección"]) }}
                @if  ($errors->has('observacion_direccion'))
                <span class="help-block">
						<strong>{{ $errors->first('observacion_direccion') }}</strong>
					</span>
                @endif
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 {{ $errors->has('obra_social_id') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('obra_social_id', "Obra social") }}
                {!! Form::select('obra_social_id', $obra_social->pluck('nombre', 'id'), isset($profesional) ? $profesional->obra_social_id : null, ['placeholder' => 'Seleccione una obra social', 'class' => 'form-control box-size', 'id' => 'roles',
                ]) !!}
                @if  ($errors->has('obra_social'))
                <span class="help-block">
            <strong>{{ $errors->first('obra_social') }}</strong>
          </span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('numero_obra_social') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('numero_obra_social ', "Nº Afiliado") }}
                {{ Form::text('numero_obra_social', isset($profesional) ? $profesional->numero_obra_social : null, ['class' => 'form-control box-size', 'placeholder' => "Nº afiliado obra social"]) }}
                @if  ($errors->has('numero_obra_social'))
                <span class="help-block">
						<strong>{{ $errors->first('numero_obra_social') }}</strong>
					</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 {{ $errors->has('observacion_facturacion') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('observacion_facturacion', "Observaciones facturación") }}
                {{ Form::text('observacion_facturacion', isset($profesional) ? $profesional->observacion_facturacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de facturación"]) }}
                @if  ($errors->has('observacion_facturacion'))
                <span class="help-block">
						<strong>{{ $errors->first('observacion_facturacion') }}</strong>
					</span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 col-sm-12 {{ $errors->has('observacion_supervision') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('observacion_supervision', "Observaciones supervision") }}
                {{ Form::text('observacion_supervision', isset($profesional) ? $profesional->observacion_supervision : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de supervisión"]) }}
                @if  ($errors->has('observacion_supervision'))
                <span class="help-block">
              <strong>{{ $errors->first('observacion_supervision') }}</strong>
            </span>
                @endif
            </div>
        </div>
    </div>
