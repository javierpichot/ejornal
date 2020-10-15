@isset($comunicacion)
    {{ Form::model($comunicacion, ['route' => ['trabajador.comunicacion.update', $comunicacion->id, $comunicacion->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'comunicacion'])
    }}
    <input type="hidden" name="trabajador_id" value="{{ $comunicacion->trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $comunicacion->empresa_id }}">
@endisset

@empty ($comunicacion)
    {!! Form::open(['route' => 'trabajador.comunicacion.store', 'id'=>'comunicacion']) !!}
    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty


<div class="modal-header">
    <h5 class="modal-title">{{isset($comunicacion)?'Editar':'Crear nueva'}} comunicacion</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            {{ Form::label('remitente_id', "Remitente") }}
            {!! Form::select('remitente_id', $remitentes->pluck('nombre', 'id'), isset($comunicacion) ? $comunicacion->remitente_id : null, ['placeholder' => 'Remitente', 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if ($errors->has('remitente_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('remitente_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="remitente_id"></span>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('modo_comunicacion_id', "Modo de comunicacion") }}
            {!! Form::select('modo_comunicacion_id', $modos->pluck('nombre', 'id'), isset($comunicacion) ? $comunicacion->modo_comunicacion_id : null, ['placeholder' => 'Modo de comunicacion', 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if ($errors->has('modo_comunicacion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('modo_comunicacion_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="modo_comunicacion_id"></span>
            @endif
        </div>

    </div>


    <div class="form-row">
        <div class="col-md-6 mb-3">
            {{ Form::label('motivo_comunicacion_id', "Motivo comunicacion") }}
            {!! Form::select('motivo_comunicacion_id', $motivos->pluck('nombre', 'id'), isset($comunicacion) ? $comunicacion->motivo_comunicacion_id : null, ['placeholder' => 'Motivo comunicacion', 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if ($errors->has('modo_comunicacion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('motivo_comunicacion_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="motivo_comunicacion_id"></span>
            @endif
        </div>


        <div class="col-md-6 mb-3">
            {{ Form::label('contenido', "Contenido de la comunicacion") }}
            {{ Form::textarea('contenido',  isset($trabajador) ? $trabajador->contenido : null, ['class' => 'form-control box-size', 'placeholder' => "Contenido de la comunicacion", 'rows' => 2]) }}
            @if ($errors->has('contenido'))
                <span class="help-block">
                    <strong>{{ $errors->first('contenido') }}</strong>
                </span>
                @elseEditar
                    <span class="help-block" id="contenido"></span>
            @endif
        </div>
    </div>


    <div class="form-row">
        <div class="col-md-6 mb-3">
            {{ Form::label('ausentismo_id', "Asociar comunicación con episodio de ausentismo") }}
            {!! Form::select('ausentismo_id', $ausentismos->pluck('fecha_ausente', 'id'), isset($comunicacion) ? $comunicacion->ausentismo_id : null, ['placeholder' => 'Seleccion un ausentismo', 'class' => 'form-control box-size']) !!}



            @if ($errors->has('ausentismo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ausentismo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="ausentismo_id"></span>
            @endif

        </div>


        <div class="col-md-6 mb-3">
            {{ Form::label('documentacion_id', "Asociar comunicación con documentacion aportada") }}
            {!! Form::select('documentacion_id', $documentaciones->pluck('documentacion_tipo.nombre', 'id'), isset($comunicacion) ? $comunicacion->documentacion_id : null, ['placeholder' => 'Seleccion un ausentismo', 'class' => 'form-control box-size']) !!}

            @if ($errors->has('documentacion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('documentacion_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="documentacion_id"></span>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12 mb-3">
            {{ Form::label('observacion', "Observaciones de la comunicacion") }}
            {{ Form::textarea('observacion',  isset($trabajador) ? $trabajador->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de la comunicacion", 'rows' => 2]) }}
            @if ($errors->has('observacion'))
                <span class="help-block">
                    <strong>{{ $errors->first('observacion') }}</strong>
                </span>
                @else
                    <span class="help-block" id="observacion"></span>
            @endif
        </div>
    </div>
</div>



<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @if(isset($comunicacion))
            <button type="submit" class="btn btn-primary">Editar</button>
        @else
            <button type="submit" class="btn btn-primary">Guardar</button>
    @endif

</div>

{{ Form::close() }}
