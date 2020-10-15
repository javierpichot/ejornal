@isset($documentacion)
    {{ Form::model($documentacion, ['route' => ['trabajador.documentacion.update', $documentacion->id, $documentacion->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'documento_laboral', 'enctype' => 'multipart/form-data'])
    }}
    <input type="hidden" name="trabajador_id" value="{{ $documentacion->trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $documentacion->empresa_id }}">


    <script type="text/javascript">
        $('#documentos').fileinput({
            <?php if(isset($documentacion)) { ?>
                previewTemplates: 'file-preview-pdf',
                initialPreviewFileType: 'pdf',
                initialPreview: ["{{ asset('storage/empresas/'. $empresa->id .'/trabajadores/' . $documentacion->trabajador->id .'/documentacion_laboral/'.  $documentacion->id . '/' .  $documentacion->url) }}"],
                initialPreviewAsData: true,
                initialPreviewDownloadUrl: "{{ route('trabajador.documentacion.generate',['empresa_id' => $empresa->id,  'trabajador_id' =>  $documentacion->trabajador->id, 'filename' => $documentacion->url, 'documento_id' => $documentacion->id, 'type' => 'documentacion_laboral'] ) }}",
                <?php } ?>
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions:  ['jpg', 'png', 'gif','jpeg'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false,

        });
    </script>
@endisset

@empty ($documentacion)
    {!! Form::open(['route' => 'trabajador.documentacion.store', 'enctype' => 'multipart/form-data', 'id'=>'documento_laboral']) !!}
    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty


<div class="modal-header">
    <h5 class="modal-title">{{isset($documentacion)?'Editar':'Crear nueva'}} documentacion</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6 mb-3">
            {{ Form::label('documentacion_tipo_id', "Tipo de certificado") }}
            {!! Form::select('documentacion_tipo_id', $documentacion_tipos->pluck('nombre', 'id'), isset($documentacion) ? $documentacion->documentacion_tipo_id : null, ['placeholder' => 'Tipo de certificado', 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if ($errors->has('documentacion_tipo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('documentacion_tipo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="documentacion_tipo_id"></span>
            @endif
        </div>

        <div class="col-md-6 mt-4">
            <div class="custom-control custom-checkbox">
                {{ Form::checkbox('notifico',isset($documentacion) ? $documentacion->notifico : null, null, ['class' => "custom-control-input", 'id' => "customCheck", "value" => true]) }}
        <label class="custom-control-label" for="customCheck">¿Notifico adecuadamente?</label>
        </div>
        </div>

    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('fecha_entrega', "Fecha de entrega fisica certificado") }}
            <div id="fecha_entrega" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_entrega',  isset($documentacion) ? $documentacion->fecha_entrega : null, ['class' => 'form-control box-size', 'placeholder' => "Fecha de entrega fisica certificado", 'required' => 'required']) }}
                @if ($errors->has('fecha_entrega'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_entrega') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('fecha_documento', "Fecha del documento") }}
            <div id="fecha_documento" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_documento',  isset($documentacion) ? $documentacion->fecha_documento : null, ['class' => 'form-control box-size', 'placeholder' => "Fecha del documento", 'required' => 'required']) }}
                @if ($errors->has('fecha_documento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_documento') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('fecha_incorporacion', "Fecha de reincorporacion") }}
            <div id="fecha_incorporacion" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {{ Form::text('fecha_incorporacion',  isset($documentacion) ? $documentacion->fecha_incorporacion : null, ['class' => 'form-control box-size', 'placeholder' => "Fecha de reincorporacion"]) }}
                @if ($errors->has('fecha_incorporacion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_incorporacion') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('diagnostico', "Diagnóstico") }}
            {{ Form::text('diagnostico',  isset($documentacion) ? $documentacion->diagnostico : null, ['class' => 'form-control box-size', 'placeholder' => "Diagnóstico"]) }}
            @if ($errors->has('diagnostico'))
                <span class="help-block">
                    <strong>{{ $errors->first('diagnostico') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            {{ Form::label('reposo', "Tiempo de reposo") }}
            {{ Form::text('reposo',  isset($documentacion) ? $documentacion->reposo : null, ['class' => 'form-control box-size', 'placeholder' => "Tiempo de reposo"]) }}
            @if ($errors->has('reposo'))
                <span class="help-block">
                    <strong>{{ $errors->first('reposo') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('institucion', "Institución") }}
            {{ Form::text('institucion',  isset($documentacion) ? $documentacion->institucion : null, ['class' => 'form-control box-size', 'placeholder' => "Institución"]) }}
            @if ($errors->has('institucion'))
                <span class="help-block">
                    <strong>{{ $errors->first('institucion') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            {{ Form::label('medico', "Médico firmante") }}
            {{ Form::text('medico',  isset($documentacion) ? $documentacion->medico : null, ['class' => 'form-control box-size', 'placeholder' => "Médico firmante"]) }}
            @if ($errors->has('medico'))
                <span class="help-block">
                    <strong>{{ $errors->first('medico') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('matricula_nacional', "Matricula Nacional (MN)") }}
            {{ Form::text('matricula_nacional',  isset($documentacion) ? $documentacion->matricula_nacional : null, ['class' => 'form-control box-size', 'placeholder' => "Matricula Nacional (MN)"]) }}
            @if ($errors->has('matricula_nacional'))
                <span class="help-block">
                    <strong>{{ $errors->first('matricula_nacional') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 mb-3">
            {{ Form::label('matricula_provincial', "Matricula Provincial (MP)") }}
            {{ Form::text('matricula_provincial',  isset($documentacion) ? $documentacion->matricula_provincial : null, ['class' => 'form-control box-size', 'placeholder' => "Matricula Provincial (MP)"]) }}
            @if ($errors->has('matricula_provincial'))
                <span class="help-block">
                    <strong>{{ $errors->first('matricula_provincial') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            {{ Form::label('observacion', "Observaciones") }}
            {{ Form::text('observacion',  isset($documentacion) ? $documentacion->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones"]) }}
            @if ($errors->has('observacion'))
                <span class="help-block">
                    <strong>{{ $errors->first('observacion') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('ausentismo_id', "Asociar documento con episodio de ausentismo") }}

        {!! Form::select('ausentismo_id', $ausentismos->pluck('created_at', 'id'), isset($prestacion) ? $consulta->ausentismo_id : null, ['placeholder' => 'Ausentismo', 'class' => 'form-control box-size']) !!}

        @if ($errors->has('ausentismo_id'))
            <span class="help-block">
                <strong>{{ $errors->first('ausentismo_id') }}</strong>
            </span>
        @else
            <span class="help-block" id="ausentismo_id"></span>
        @endif
    </div>


    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="file-loading">
                <input id="documentos" name="documentos[]" type="file" multiple>
            </div>
        </div>

    </div>



</div>

<br>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @if(isset($documentacion))
            <button type="submit" class="btn btn-primary">Editar</button>
        @else
            <button type="submit" class="btn btn-primary">Guardar</button>
    @endif

</div>
