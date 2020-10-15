@isset($documentacion)
    {{ Form::model($documentacion, ['route' => ['empresa.documentacion.update', $documentacion->id, $documentacion->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm', 'enctype' => 'multipart/form-data'])
    }}
    <input type="hidden" name="empresa_id" value="{{ $documentacion->empresa_id }}">

    <script type="text/javascript">
        $('#documentos').fileinput({
            <?php if(isset($documentacion)) { ?>
            previewTemplates: 'file-preview-pdf',
            initialPreviewFileType: 'pdf',
            initialPreview: ["{{ asset('storage/empresas/'. $documentacion->empresa_id .'/documentacion_empresa/'. $documentacion->id . '/' . $documentacion->url) }}"],
            initialPreviewAsData: true,
            initialPreviewDownloadUrl: "{{ route('empresa.documentacion.empresa.generate',['empresa_id' => $documentacion->empresa_id, 'filename' => $documentacion->url, 'documentacion_pedido' => $documentacion->id, 'type' => 'documentacion_empresa'] ) }}",
            <?php } ?>
            theme: 'fa',
            language: 'es',
            uploadUrl: '#',
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            showRemove: false,
            showUpload: false,

        });
    </script>
@endisset

@empty ($documentacion)
    {!! Form::open(['route' => 'empresa.documentacion.store', 'enctype' => 'multipart/form-data', 'id'=>'frm']) !!}
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
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="file-loading">
                <input id="documentos" name="documentos[]" type="file" multiple>
            </div>
        </div>

        @if ($errors->has('documentos'))
            <span class="help-block">
                            <strong>{{ $errors->first('documentos') }}</strong>
                        </span>
        @else
            <span class="help-block" id="documentos"></span>
        @endif
    </div>


    <div class="col-md-8 col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('nombre', "Titulo") }}
                    {{ Form::text('nombre', isset($documentacion) ? $documentacion->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Titulo"]) }}
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @else
                        <span class="help-block" id="nombre"></span>
                    @endif
                </div>
            </div>

            <div class="col-md-12 col-sm-12 {{ $errors->has('documentacion_empresa_tipo_id') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('documentacion_empresa_tipo_id', "Tipo de documento") }}
                    {!! Form::select('documentacion_empresa_tipo_id', $documentacion_tipos->pluck('nombre', 'id'), isset($documentacion) ? $documentacion->profesional_tipo_id : null, ['placeholder' => 'Tipo de documento', 'class' => 'form-control box-size']) !!}
                    @if ($errors->has('documentacion_empresa_tipo_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('documentacion_empresa_tipo_id') }}</strong>
                        </span>
                    @else
                        <span class="help-block" id="documentacion_empresa_tipo_id"></span>
                    @endif
                </div>
            </div>

            <div class="col-md-12 col-sm-12 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <div class="form-group">
                    {{ Form::label('descripcion', "Descripcion") }}
                    {{ Form::textarea('descripcion', isset($documentacion) ? $documentacion->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
                    @if ($errors->has('descripcion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @else
                        <span class="help-block" id="descripcion"></span>
                    @endif
                </div>
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
