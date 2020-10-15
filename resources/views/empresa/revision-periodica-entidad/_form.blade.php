
@isset($revision_entidad)

    <script type="text/javascript">
            $(function () {
      		$('#foto').fileinput({
                <?php if(isset($revision_entidad)) { ?>
                    previewTemplates: 'file-preview-pdf',
                    initialPreviewFileType: 'pdf',
                initialPreview: ["{{ asset('storage/empresas/'. $revision_entidad->empresa_id .'/'. $revision_entidad->foto) }}"],
                initialPreviewAsData: true,
                initialPreviewDownloadUrl: "{{ route('empresa.documentacion.empresa.generate',['empresa_id' => $empresa->id, 'filename' => $revision_entidad->foto,  'documentacion_pedido' => $revision_entidad->id, 'type' => 'revisiones_periodicas_entidad'] ) }}",
                <?php } ?>
      			maxFileCount: 5,
      			theme: 'fa',
      			language: 'es',
      			uploadUrl: '#',
      			dropZoneTitle: 'Suba o arrastre las fotos de la lesion',
      			allowedFileExtensions: ['jpg', 'png', 'gif'],
      			browseClass: "btn btn-primary btn-block",
      			showCaption: false,
      			showRemove: false,
      			showUpload: false
      		});
        });
    </script>

    {{ Form::model($revision_entidad, ['route' => ['empresa.revision.update',$revision_entidad->id,$empresa->id ], 'enctype' => 'multipart/form-data', 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
    <input type="hidden" name="empresa_id" value="{{ $revision_entidad->empresa_id }}">
@endisset

@empty ($revision_entidad)
    {{ Form::open(['route' => 'empresa.revision.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'frm']) }}
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty
<div class="modal-header">
    <h4 class="modal-title">{{isset($revision_entidad)?'Editar':'Crear nueva'}} tarea</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            {{ Form::label('nombre', "Titulo") }}
            {{ Form::text('nombre',  isset($revision_entidad) ? $revision_entidad->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Titulo de la tarea"]) }}
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
        <div class="col-md-12">
            {{ Form::label('descripcion', "Descripción") }}
            {{ Form::textarea('descripcion',  isset($revision_entidad) ? $revision_entidad->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripción de la tarea"]) }}
            @if ($errors->has('descripcion'))
                <span class="help-block">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
            @else
                <span class="help-block" id="descripcion"></span>
            @endif
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-sm-12 {{ $errors->has('tipo_tarea_id') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('tipo_tarea_id', "Tipo de tarea:") }}
                {!! Form::select('tipo_tarea_id', $tipo_tareas->pluck('nombre', 'id'), isset($usuario) ? $revision_entidad->tipo_tarea : null, ['placeholder' => 'Seleccione el tipo de tarea', 'class' => 'form-control box-size', 'id' => 'tipo_tarea_id', 'required' => 'required']) !!}
                @if ($errors->has('tipo_tarea_id'))
                    <span class="help-block">
                <strong>{{ $errors->first('tipo_tarea_id') }}</strong>
            </span>
                @endif
            </div>
        </div>

<div class="col-md-6 col-sm-12 {{ $errors->has('role_id') ? ' has-error' : '' }}">
    <div class="form-group">
        {{ Form::label('role_id', "Asociar con un rol:") }}
        {!! Form::select('role_id', $roles->pluck('name', 'id'), isset($usuario) ? $usuario->roles : null, ['placeholder' => 'Seleccione un rol', 'class' => 'form-control box-size', 'id' => 'role_id', 'required' => 'required']) !!}
        @if ($errors->has('role_id'))
            <span class="help-block">
                <strong>{{ $errors->first('role_id') }}</strong>
            </span>
        @endif
    </div>
</div>
</div>

   

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('observaciones', "Observaciones") }}
            {{ Form::text('observaciones',  isset($revision_entidad) ? $revision_entidad->observaciones : null, ['class' => 'form-control box-size', 'placeholder' => "Observación"]) }}
            @if ($errors->has('observaciones'))
                <span class="help-block">
                            <strong>{{ $errors->first('observaciones') }}</strong>
                        </span>
            @else
                <span class="help-block" id="observaciones"></span>
            @endif
        </div>
    </div>

        <div class="row">
            <div class="col-md-12">
                <div class="file-loading">
                    <input id="foto" name="foto[]" type="file" multiple>
                </div>
            </div>
        </div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @isset($revision_entidad)
            <button type="submit" class="btn btn-primary">Editar</button>
        @endisset

    @empty ($revision_entidad)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endempty
</div>

{{ Form::close() }}
