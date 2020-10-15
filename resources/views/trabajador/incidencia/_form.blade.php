@isset($incidencia)

<script type="text/javascript">
    $(function() {
        $('#fecha_incidencia').datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
          locale: 'es-es'
        });
        $('#fotos_escenario').fileinput({
            <?php if(isset($incidencia)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview: ["{{ asset('storage/empresas/'. $incidencia->empresa_id . '/trabajadores/'. $incidencia->trabajador->id  .'/seh/'.  $incidencia->id .'/'. $incidencia->fotos_escenario) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl: "{{ route('trabajador.documentacion.generate',['trabajador_id' =>  $incidencia->trabajador->id, 'filename' => $incidencia->fotos_escenario, 'empresa_id' => $incidencia->empresa_id, 'documento_id' => $incidencia->id, 'type' => 'seh'] ) }}",
            <?php } ?>
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre las fotos del escenario',
            allowedFileExtensions: ['pdf','jpg', 'png', 'gif'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });
        $('#declaracion_accidente').fileinput({
            <?php if(isset($incidencia)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview: ["{{ asset('storage/empresas/'. $incidencia->empresa_id . '/trabajadores/'. $incidencia->trabajador->id  .'/seh/'.  $incidencia->id .'/'. $incidencia->fotos_accidente) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl: "{{ route('trabajador.documentacion.generate',['trabajador_id' =>  $incidencia->trabajador->id, 'filename' => $incidencia->fotos_accidente, 'empresa_id' => $incidencia->empresa_id, 'documento_id' => $incidencia->id, 'type' => 'seh'] ) }}",
            <?php } ?>
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre las fotos de la declaración de accidente manuscrita por el trabajador, supervisor o compañero con firma y aclaración.',
            allowedFileExtensions: ['pdf','jpg', 'png', 'gif'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });
        $('#fotos_lesiones').fileinput({
            <?php if(isset($incidencia)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview:  ["{{ asset('storage/empresas/'. $incidencia->empresa_id . '/trabajadores/'. $incidencia->trabajador->id  .'/seh/'.  $incidencia->id .'/'. $incidencia->fotos_lesion) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl:"{{ route('trabajador.documentacion.generate',['trabajador_id' =>  $incidencia->trabajador->id, 'filename' => $incidencia->fotos_lesion, 'empresa_id' => $incidencia->empresa_id, 'documento_id' => $incidencia->id, 'type' => 'seh'] ) }}",
            <?php } ?>
            maxFileCount: 5,
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            dropZoneTitle: 'Suba o arrastre las fotos de la lesion',
            allowedFileExtensions: ['pdf','jpg', 'png', 'gif'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false
        });
    });
</script>
{{ Form::model($incidencia, ['route' => ['trabajador.incidencia.update', $incidencia->id, $incidencia->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'incidencia', 'enctype' => 'multipart/form-data'])
}}
<input type="hidden" name="trabajador_id" value="{{ $incidencia->trabajador->id }}">
<input type="hidden" name="empresa_id" value="{{ $incidencia->empresa_id }}">


@endisset

@empty  ($incidencia)
{!! Form::open(['route' => 'trabajador.incidencia.store', 'id'=>'incidencia', 'enctype' => 'multipart/form-data']) !!}
<input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty


<div class="modal-header">
    <h5 class="modal-title">{{isset($incidencia)?'Editar':'Crear nueva'}} incidencia relativo a {{ $trabajador->nombre }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            {{ Form::label('tipo_incidencia_id', "Tipo incidencia") }}
            {!! Form::select('tipo_incidencia_id', $tipo_incidencias->pluck('nombre', 'id'), isset($incidencia) ? $incidencia->tipo_incidencia_id : null, [ 'class' => 'form-control box-size', 'required' => 'required']) !!}
            @if  ($errors->has('tipo_incidencia_id'))
            <span class="help-block">
                    <strong>{{ $errors->first('tipo_incidencia_id') }}</strong>
                </span>
            @else
            <span class="help-block" id="tipo_incidencia_id"></span>
            @endif
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('fecha', "Hora y fecha") }}
            <div id="fecha_incidencia" class="input-group date">
                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                {!! Form::text('fecha', isset($incidencia) ? $incidencia->fecha : null, ['class' => 'form-control box-size', 'placeholder' => "Hora y fecha", 'required' => 'required']) !!}
                @if  ($errors->has('fecha'))
                <span class="help-block">
                        <strong>{{ $errors->first('fecha') }}</strong>
                    </span>
                @else
                <span class="help-block" id="fecha"></span>
                @endif
            </div>
        </div>

    </div>
    <div class="form-row">


        <div class="col-md-6 mb-3">
            {{ Form::label('lugar', "Lugar") }}
            {{ Form::text('lugar', isset($incidencia) ? $incidencia->lugar : null, ['class' => 'form-control box-size', 'placeholder' => "Sector donde ocurrio", 'required' => 'required']) }}
            @if  ($errors->has('lugar'))
            <span class="help-block">
                    <strong>{{ $errors->first('lugar') }}</strong>
                </span>
            @else
            <span class="help-block" id="lugar"></span>
            @endif
        </div>


        <div class="col-md-6 mb-3">
            {{ Form::label('tarea', "Tarea") }}
            {{ Form::text('tarea', isset($incidencia) ? $incidencia->tarea : null, ['class' => 'form-control box-size', 'placeholder' => "Tarea desarrollada", 'required' => 'required']) }}
            @if  ($errors->has('tarea'))
            <span class="help-block">
                    <strong>{{ $errors->first('tarea') }}</strong>
                </span>
            @else
            <span class="help-block" id="tarea"></span>
            @endif
        </div>
    </div>

    <div class="form-row">

        <div class="col-md-6 mb-3">
            {{ Form::label('maquinaria_herramientas', "Maquinaria utilizada") }}
            {{ Form::text('maquinaria_herramientas', isset($incidencia) ? $incidencia->maquinaria_herramientas : null, ['class' => 'form-control box-size', 'placeholder' => "Maquinaria y herramientas utilizadas", 'required' => 'required']) }}
            @if  ($errors->has('maquinaria_herramientas'))
            <span class="help-block">
                    <strong>{{ $errors->first('maquinaria_herramientas') }}</strong>
                </span>
            @else
            <span class="help-block" id="maquinaria_herramientas"></span>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            {{ Form::label('proteccion', "Metodos proteccion utilizados") }}
            {{ Form::text('proteccion', isset($incidencia) ? $incidencia->proteccion : null, ['class' => 'form-control box-size', 'placeholder' => "Metodos de protección utilizados", 'required' => 'required']) }}
            @if  ($errors->has('proteccion'))
            <span class="help-block">
                    <strong>{{ $errors->first('proteccion') }}</strong>
                </span>
            @else
            <span class="help-block" id="proteccion"></span>
            @endif
        </div>
    </div>
    <div class="form-row">

        <div class="col-md-12 mb-3">
            {{ Form::label('testigos', "Testigos") }}
            {{ Form::text('testigos', isset($incidencia) ? $incidencia->testigos : null, ['class' => 'form-control box-size', 'placeholder' => "Testigos que lo presenciaron", 'required' => 'required']) }}
            @if  ($errors->has('testigos'))
            <span class="help-block">
                    <strong>{{ $errors->first('testigos') }}</strong>
                </span>
            @else
            <span class="help-block" id="testigos"></span>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12 mb-3">
            {{ Form::label('descripcion', "Descripcion") }}
            {{ Form::textarea('descripcion', isset($incidencia) ? $incidencia->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion", 'required' => 'required']) }}
            @if  ($errors->has('descripcion'))
            <span class="help-block">
                    <strong>{{ $errors->first('descripcion') }}</strong>
                </span>
            @else
            <span class="help-block" id="descripcion"></span>
            @endif
        </div>
        <div class="col-md-12">
            <div class="file-loading">
                <input id="declaracion_accidente" name="fotos_accidente[]" type="file" multiple>
        </div>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-4 mb-3">
                {{ Form::label('forma_accidente_id', "Forma de accidente") }}
                {!! Form::select('forma_accidente_id', $forma_accidentes->pluck('nombre', 'id'), isset($incidencia) ? $incidencia->forma_accidente_id : null, ['placeholder' => 'Forma de accidente', 'class' => 'form-control box-size']) !!}
                @if  ($errors->has('forma_accidente_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('forma_accidente_id') }}</strong>
                </span>
                @else
                <span class="help-block" id="forma_accidente_id"></span>
                @endif
            </div>


            <div class="form-group col-md-4 mb-3">
                {{ Form::label('tipo_lesion_id', "Tipo de lesión") }}
                {!! Form::select('tipo_lesion_id', $tipo_lesions->pluck('nombre', 'id'), isset($incidencia) ? $incidencia->tipo_lesion_id : null, ['placeholder' => 'Tipo de lesión', 'class' => 'form-control box-size']) !!}
                @if  ($errors->has('tipo_lesion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipo_lesion_id') }}</strong>
                </span>
                @else
                <span class="help-block" id="tipo_lesion_id"></span>
                @endif
            </div>

            <div class="form-group col-md-4 mb-3">
                {{ Form::label('ubicacion_lesion_id', "Ubicación de la lesión") }}
                {!! Form::select('ubicacion_lesion_id', $ubicacion_lesions->pluck('nombre', 'id'), isset($incidencia) ? $incidencia->ubicacion_lesion_id : null, ['placeholder' => 'Ubicación de lesión', 'class' => 'form-control box-size']) !!}
                @if  ($errors->has('ubicacion_lesion_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ubicacion_lesion_id') }}</strong>
                </span>
                @else
                <span class="help-block" id="ubicacion_lesion_id"></span>
                @endif
            </div>

        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                {{ Form::label('examen_medico', "Examen médico") }}
                {{ Form::textarea('examen_medico', isset($incidencia) ? $incidencia->examen_medico : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion", 'required' => 'required']) }}
                @if  ($errors->has('examen_medico'))
                <span class="help-block">
                    <strong>{{ $errors->first('examen_medico') }}</strong>
                </span>
                @else
                <span class="help-block" id="examen_medico"></span>
                @endif
            </div>

            <div class="col-md-6 mb-3">
                {{ Form::label('perimetria_medica', "Lesionologia") }}
                {{ Form::textarea('perimetria_medica', isset($incidencia) ? $incidencia->perimetria_medica : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion", 'required' => 'required']) }}
                @if  ($errors->has('perimetria_medica'))
                <span class="help-block">
                    <strong>{{ $errors->first('perimetria_medica') }}</strong>
                </span>
                @else
                <span class="help-block" id="perimetria_medica"></span>
                @endif
            </div>
            <div class="col-md-12">
                <div class="file-loading">
                    <input id="fotos_lesiones" name="fotos_lesion[]" type="file" multiple>

        </div>
                </div>

        </div>

        <div class="form-row">


            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    {{ Form::label('causas', "Posibles causas") }}
                    {{ Form::textarea('causas', isset($incidencia) ? $incidencia->causas : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                    @if  ($errors->has('causas'))
                    <span class="help-block">
                    <strong>{{ $errors->first('causas') }}</strong>
                </span>
                    @else
                    <span class="help-block" id="causas"></span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    {{ Form::label('declaracion_supervision', "Declaración supervisión") }}
                    {{ Form::textarea('declaracion_supervision', isset($incidencia) ? $incidencia->declaracion_supervision : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                    @if  ($errors->has('declaracion_supervision'))
                    <span class="help-block">
                    <strong>{{ $errors->first('declaracion_supervision') }}</strong>
                </span>
                    @else
                    <span class="help-block" id="declaracion_supervision"></span>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    {{ Form::label('testigos', "Declaración testigos") }}
                    {{ Form::textarea('testigos', isset($incidencia) ? $incidencia->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                    @if  ($errors->has('testigos'))
                    <span class="help-block">
                    <strong>{{ $errors->first('testigos') }}</strong>
                </span>
                    @else
                    <span class="help-block" id="testigos"></span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="file-loading">
                        <input id="fotos_escenario" name="fotos_escenario[]" type="file" multiple>
            </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        {{ Form::label('acciones_inmediatas', "Acciones inmediatas") }}
                        {{ Form::textarea('acciones_inmediatas', isset($incidencia) ? $incidencia->acciones_inmediatas : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                        @if  ($errors->has('acciones_inmediatas'))
                        <span class="help-block">
                    <strong>{{ $errors->first('acciones_inmediatas') }}</strong>
                </span>
                        @else
                        <span class="help-block" id="acciones_inmediatas"></span>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        {{ Form::label('descripcion', "Acciones correctivas") }}
                        {{ Form::textarea('acciones_correctivas', isset($incidencia) ? $incidencia->acciones_correctivas : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                        @if  ($errors->has('acciones_correctivas'))
                        <span class="help-block">
                    <strong>{{ $errors->first('acciones_correctivas') }}</strong>
                </span>
                        @else
                        <span class="help-block" id="acciones_correctivas"></span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {{ Form::label('consulta_id', "Asociar incidencia con consulta") }}
                        {!! Form::select('consulta_id', $consultas->pluck('created_at', 'id'), isset($incidencia) ? $incidencia->consulta_id : null, ['placeholder' => 'Consultas', 'class' => 'form-control box-size']) !!}
                        @if  ($errors->has('consulta_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('consulta_id') }}</strong>
                </span>
                        @else
                        <span class="help-block" id="consulta_id"></span>
                        @endif
                    </div>
                </div>
                <div class="form-row">


                    <div class="col-md-6 mb-3">
                        {{ Form::label('numero_art', "Nº Denuncia ART") }}
                        {{ Form::text('numero_art', isset($incidencia) ? $incidencia->numero_art : null, ['class' => 'form-control box-size', 'placeholder' => "# art"]) }}
                        @if  ($errors->has('numero_art'))
                        <span class="help-block">
                    <strong>{{ $errors->first('numero_art') }}</strong>
                </span>
                        @else
                        <span class="help-block" id="numero_art"></span>
                        @endif
                    </div>


                    <div class="col-md-6 mb-3">
                        {{ Form::label('derivacion', "Derivado a") }}
                        {{ Form::text('derivacion', isset($incidencia) ? $incidencia->derivacion : null, ['class' => 'form-control box-size', 'placeholder' => "Clinica asociada a ART"]) }}
                        @if  ($errors->has('derivacion'))
                        <span class="help-block">
                    <strong>{{ $errors->first('derivacion') }}</strong>
                </span>
                        @else
                        <span class="help-block" id="derivacion"></span>
                        @endif
                    </div>
                </div>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                @if(isset($incidencia))
                <button type="submit" class="btn btn-primary">Editar comunicacion</button>
                @else
                    <button type="submit" class="btn btn-primary">Guardar comunicacion</button>
                @endif

            </div>
