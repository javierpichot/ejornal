@extends('adminlte::layouts.app')
@section('titulo', 'Informacion General de'. $profesional->nombre )

@section('main-content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profesional {{ $profesional->nombre }} detalles</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
                Informaci&oacute;n General de {{ $profesional->nombre }}
            </h3>
          </div>
          <div class="box-body">
              <div class="col-md-4 col-sm-12" style="margin-left:15px">
                  <div class="row">

                      <div class="file-loading">
                          <input id="photo" name="photo" type="file">

              	</div>


                      <div class="row">
                          <div class="col-md-12 col-sm-12 {{ $errors->has('profesional_tipo_id') ? ' has-error' : '' }}">
                              <div class="form-group">
                                  {{ Form::label('profesional_tipo_id', "Tipo de profesional") }}
                                  {!! Form::select('profesional_tipo_id', $tipo_profesional->pluck('nombre', 'id'), isset($profesional) ? $profesional->profesional_tipo_id : null, ['placeholder' => 'Seleccione tipo profesional', 'class' => 'form-control box-size', 'disabled' => true]) !!}
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
                                  {!! Form::select('user_id', $users->pluck('email', 'id'), isset($profesional) ? $profesional->user_id : null, ['placeholder' => 'Seleccione un usuario web', 'class' => 'form-control box-size', 'id' => 'usuario_id', 'disabled' => true]) !!}
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
                                  {{ Form::text('documento', isset($profesional) ? $profesional->documento : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXX", 'id' => "documento", 'disabled' => true]) }}
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
                                  {{ Form::number('numero_matricula', isset($profesional) ? $profesional->numero_matricula : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX", 'disabled' => true]) }}
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
                                  {{ Form::text('poliza', isset($profesional) ? $profesional->poliza : null, ['class' => 'form-control box-size', 'placeholder' => "XXXXXXXX", 'disabled' => true]) }}
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
                              {{ Form::text('nombre', isset($profesional) ? $profesional->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre", 'disabled' => true]) }}
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
                              {{ Form::text('apellido', isset($profesional) ? $profesional->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Apellido", 'disabled' => true]) }}
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
                              @correo.com", 'disabled' => true ]) }}
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
                              {{ Form::text('celular', isset($profesional) ? $profesional->celular : null, ['class' => 'form-control box-size', 'placeholder' => "Nº de celular", 'disabled' => true]) }}
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
                              {{ Form::text('nombre_familiar', isset($profesional) ? $profesional->nombre_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre familiar", 'disabled' => true]) }}
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
                              {{ Form::text('celular_familiar', isset($profesional) ? $profesional->celular_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Telefono familiar", 'disabled' => true]) }}
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
                              {{ Form::text('direccion', isset($profesional) ? $profesional->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Dirección", 'disabled' => true]) }}
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
                              {!! Form::select('localidad_id', $localidades->pluck('nombre', 'id'), isset($profesional) ? $profesional->localidad_id : null, ['placeholder' => 'Seleccione una localidad', 'class' => 'form-control box-size', 'id' => 'roles', 'disabled' => true
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
                              {{ Form::text('observacion_direccion', isset($profesional) ? $profesional->observacion_direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de dirección", 'disabled' => true]) }}
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
                              {!! Form::select('obra_social_id', $obra_social->pluck('nombre', 'id'), isset($profesional) ? $profesional->obra_social_id : null, ['placeholder' => 'Seleccione una obra social', 'class' => 'form-control box-size', 'id' => 'roles', 'disabled' => true
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
                              {{ Form::text('numero_obra_social', isset($profesional) ? $profesional->numero_obra_social : null, ['class' => 'form-control box-size', 'placeholder' => "Nº afiliado obra social", 'disabled' => true]) }}
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
                              {{ Form::text('observacion_facturacion', isset($profesional) ? $profesional->observacion_facturacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de facturación", 'disabled' => true]) }}
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
                              {{ Form::text('observacion_supervision', isset($profesional) ? $profesional->observacion_supervision : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de supervisión", 'disabled' => true]) }}
                              @if  ($errors->has('observacion_supervision'))
                              <span class="help-block">
                            <strong>{{ $errors->first('observacion_supervision') }}</strong>
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
                <?php if(isset($profesional)) { ?>
                initialPreview: ["{{ asset('storage/profesionales/'. $profesional->id . '/' . $profesional->photo) }}"],
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

            $('#foto_titulo').fileinput({
                <?php if(isset($profesional)) { ?>
                initialPreview: ["{{ asset('storage/profesionales/'. $profesional->id . '/' . $profesional->foto_titulo) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las foto del titulo',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            $('#foto_documento').fileinput({
                <?php if(isset($profesional)) { ?>
                initialPreview: ["{{ asset('storage/profesionales/'. $profesional->id . '/' . $profesional->foto_documento) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las foto del documento',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            $('#foto_seguro').fileinput({
                <?php if(isset($profesional)) { ?>
                initialPreview: ["{{ asset('storage/profesionales/'. $profesional->id . '/' .$profesional->foto_seguro) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las foto del seguro',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            $('#foto_matricula').fileinput({
                <?php if(isset($profesional)) { ?>
                initialPreview: ["{{ asset('storage/profesionales/'. $profesional->id . '/' .$profesional->foto_matricula) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las foto de la matricula',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });
        });
    </script>
@endpush
