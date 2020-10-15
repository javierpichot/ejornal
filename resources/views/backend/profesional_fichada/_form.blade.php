<div class="col-md-4 col-sm-12">
    <div class="row">
        <div class="file-loading">
            <input id="documentos" name="documentos[]" type="file" multiple>
        </div>
    </div>
</div>

<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

<div class="col-md-8 col-sm-12">
    <div class="row">
        <div class="col-md-12 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('nombre', "Nombre") }}
                {{ Form::text('nombre', isset($documentacion_jornal) ? $documentacion_jornal->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre"]) }}
                @if  ($errors->has('nombre'))
                <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
          </span>
                @endif
            </div>
        </div>

        <div class="col-md-12 col-sm-12 {{ $errors->has('documentacion_empresa_tipo_id') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('documentacion_empresa_tipo_id', "Tipo de documento") }}
                {!! Form::select('documentacion_empresa_tipo_id', $documentacion_empresa_tipo->pluck('nombre', 'id'), isset($documentacion_jornal) ? $documentacion_jornal->profesional_tipo_id : null, ['placeholder' => 'Tipo de documento', 'class' => 'form-control box-size']) !!}
                @if  ($errors->has('documentacion_empresa_tipo_id'))
                <span class="help-block">
          <strong>{{ $errors->first('documentacion_empresa_tipo_id') }}</strong>
        </span>
                @endif
            </div>
        </div>

        <div class="col-md-12 col-sm-12 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('descripcion', "Descripcion") }}
                {{ Form::textarea('descripcion', isset($documentacion_jornal) ? $documentacion_jornal->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                @if  ($errors->has('descripcion'))
                <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
          </span>
                @endif
            </div>
        </div>

    </div>
</div>
