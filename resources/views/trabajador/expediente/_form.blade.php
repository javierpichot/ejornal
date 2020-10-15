@isset($ausentismo)
    {{ Form::model($ausentismo, ['route' => ['trabajador.expediente.update', $ausentismo->id, $ausentismo->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'expediente'])
    }}
    <input type="hidden" name="trabajador_id" value="{{ $ausentismo->trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $ausentismo->empresa_id }}">
@endisset

@empty ($ausentismo)
    {!! Form::open(['route' => 'trabajador.expediente.store', 'id'=>'expediente']) !!}
    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty


<div class="modal-header">
    <h5 class="modal-title">{{isset($ausentismo)?'Editar':'Crear nuevo'}} episodio de ausentismo</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-3 mb-3">
            {{ Form::label('ausentismo_tipo_id', "Tipo de ausencia") }}
            {!! Form::select('ausentismo_tipo_id', $tipo_ausencia->pluck('nombre', 'id'), isset($ausentismo) ? $ausentismo->ausentismo_tipo_id : null, ['placeholder' => 'Tipo de ausencia', 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if ($errors->has('ausentismo_tipo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ausentismo_tipo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="ausentismo_tipo_id"></span>
            @endif
        </div>
        <div class="col-xs-3">
                {{ Form::label('consulta_motivo_id', "RRHH INFO") }}
                {!! Form::select('consulta_motivo_id', $consulta_motivo->pluck('nombre', 'id'), isset($consulta) ? $consulta->consulta_motivo_id : null, ['class' => 'form-control box-size']) !!}
                @if ($errors->has('consulta_motivo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('consulta_motivo_id') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="consulta_motivo_id"></span>
                @endif
            </div>
        <div class="col-md-3 mb-3">
            {{ Form::label('motivo', "Motivo") }}
            {{ Form::text('motivo',  isset($ausentismo) ? $ausentismo->motivo : null, ['class' => 'form-control box-size', 'placeholder' => "Motivo", 'required' => 'required']) }}
            @if ($errors->has('motivo'))
                <span class="help-block">
                    <strong>{{ $errors->first('motivo') }}</strong>
                </span>
            @else
                <span class="help-block" id="motivo"></span>
            @endif
        </div>


    </div>


    <div class="form-row">
        <div class="form-group col-md-4">
            {{ Form::label('fecha_ausente', "Fecha de inicio de ausencia") }}
            <div id="fecha_ausente" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_ausente',  isset($ausentismo) ? $ausentismo->fecha_ausente : null, ['class' => 'form-control box-size date', 'placeholder' => "Fecha de inicio de ausencia", 'required' => 'required']) }}
                @if ($errors->has('fecha_ausente'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_ausente') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('fecha_probable_alta', "Fecha probable alta") }}
            <div id="fecha_probable_alta" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_probable_alta',  isset($ausentismo) ? $ausentismo->fecha_probable_alta : null, ['class' => 'form-control box-size date', 'placeholder' => "Fecha probable alta"]) }}
                @if ($errors->has('fecha_probable_alta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_probable_alta') }}</strong>
                    </span>
                @endif
            </div>


        </div>


        <div class="form-group col-md-4">
            {{ Form::label('fecha_alta', "Fecha de alta") }}
            <div id="fecha_alta" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_alta',  isset($ausentismo) ? $ausentismo->fecha_alta : null, ['class' => 'form-control box-size date', 'placeholder' => "Fecha de alta"]) }}
                @if ($errors->has('fecha_alta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_alta') }}</strong>
                    </span>
                @endif
            </div>


        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6 mb-3">
            {{ Form::label('incidencia_id', "Asociar ausentismo con incidente/accidente") }}
            {!! Form::select('incidencia_id', $incidencias->pluck('fecha', 'id'), isset($ausentismo) ? $ausentismo->incidencia_id : null, ['placeholder' => 'Ausentismo', 'class' => 'form-control box-size']) !!}
            @if ($errors->has('incidencia_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('incidencia_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="incidencia_id"></span>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('observacion', "Observacion") }}
            {{ Form::textarea('observacion',  isset($ausentismo) ? $ausentismo->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observacion"]) }}
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
    @if(isset($incidencia))
        <button type="submit" class="btn btn-primary">Editar ausentismo</button>
        @else
            <button type="submit" class="btn btn-primary">Guardar ausentismo</button>
    @endif

</div>
