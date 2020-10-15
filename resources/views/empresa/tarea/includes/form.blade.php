
@isset($tarea)

    {{ Form::model($tarea, ['route' => ['empresa.tarea.agentes.update',$tarea->id,$empresa->id ], 'enctype' => 'multipart/form-data', 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}

    <script !src="">
        $(function() {
            $('#tipo_tarea_id').select2({
                multiple: true,
                placeholder: "Seleccione el agente riesgo",
                width: "100%",
                closeOnSelect: true
            } )
        });
    </script>
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
@endisset

@empty ($tarea)
    {{ Form::open(['route' => 'empresa.tarea.agentes.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'frm']) }}
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty


<div class="modal-header">
    <h4 class="modal-title">{{isset($tarea)?'Editar':'Crear nueva'}} tarea</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            {{ Form::label('nombre', "Titulo") }}
            {{ Form::text('nombre',  isset($tarea) ? $tarea->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Titulo de la tarea"]) }}
            @if ($errors->has('nombre'))
                <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
            @else
                <span class="help-block" id="nombre"></span>
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12 {{ $errors->has('tipo_tarea_id') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('tipo_tarea_id', "Agente riesgo:") }}
                {!! Form::select('agente_riesgo_id[]', $agentes_riegos->pluck('agente_riesgo', 'id'), isset($tarea) ? $tarea->agente_riesgo_tarea : null, ['class' => 'form-control box-size', 'id' => 'tipo_tarea_id', 'required' => 'required', 'multiple' => 'multiple']) !!}
                @if ($errors->has('tipo_tarea_id'))
                    <span class="help-block">
                <strong>{{ $errors->first('tipo_tarea_id') }}</strong>
            </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span>Guardar</button>
</div>
{{ Form::close() }}