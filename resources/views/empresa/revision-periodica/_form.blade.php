
@isset($revision_periodica)

    <script type="text/javascript">
            $(function () {
      		$('#fotos').fileinput({
                <?php if(isset($revision_periodica)) { ?>
                    previewTemplates: 'file-preview-pdf',
                    initialPreviewFileType: 'pdf',
                initialPreview: ["{{ asset('storage/empresas/'. $revision_periodica->revision_periodica_entidad->empresa->id .'/'. $revision_periodica->fotos) }}"],
                initialPreviewAsData: true,
                initialPreviewDownloadUrl: "{{
                    route('empresa.documentacion.empresa.generate',['empresa_id' => $revision_periodica->revision_periodica_entidad->empresa->id, 'filename' => $revision_periodica->fotos,  'documentacion_pedido' => $revision_periodica->id, 'type' => 'revisiones_periodicas'] ) }}",
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

    {{ Form::model($revision_periodica, ['route' => ['empresa.revision-periodica.update',$revision_periodica->id,$empresa->id ], 'enctype' => 'multipart/form-data', 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@endisset

@empty ($revision_entidad)
    {{ Form::open(['route' => 'empresa.revision-periodica.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'frm']) }}
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty
<div class="modal-header">
    <h4 class="modal-title">{{isset($revision_periodica)?'Editar':'Crear nueva'}} tarea</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="modal-body">
  <div class="row">
      <div class="col-md-6">
          {{ Form::label('revision_periodica_entidad_id', "Tarea") }}
          {!! Form::select('revision_periodica_entidad_id', $revision_periodica_entidad->pluck('nombre', 'id'), isset($revision_periodica) ? $revision_periodica->revision_periodica_entidad_id : null, ['placeholder' => 'Tarea', 'class' => 'form-control box-size']) !!}
          @if ($errors->has('revision_periodica_entidad_id'))
              <span class="help-block">
                          <strong>{{ $errors->first('revision_periodica_entidad_id') }}</strong>
                      </span>
          @else
              <span class="help-block" id="revision_periodica_entidad_id"></span>
          @endif
      </div>

      <div class="col-md-6">
          {{ Form::label('revision_periodica_tipo_id', "Tipo de revision") }}
          {!! Form::select('revision_periodica_tipo_id', $revision_periodica_tipos->pluck('nombre', 'id'), isset($revision_periodica) ? $revision_periodica->revision_periodica_tipo_id : null, ['placeholder' => 'Tipo de tarea', 'class' => 'form-control box-size']) !!}
          @if ($errors->has('revision_periodica_tipo_id'))
              <span class="help-block">
                          <strong>{{ $errors->first('revision_periodica_tipo_id') }}</strong>
                      </span>
          @endif
      </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('informe', "Informe") }}
            {{ Form::textarea('informe',  isset($revision_periodica) ? $revision_periodica->informe : null, ['class' => 'form-control box-size', 'placeholder' => "Informe"]) }}
            @if ($errors->has('informe'))
                <span class="help-block">
                            <strong>{{ $errors->first('informe') }}</strong>
                        </span>
            @else
                <span class="help-block" id="informe"></span>
            @endif
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            {{ Form::label('observaciones', "Observaciones") }}
            {{ Form::text('observaciones',  isset($revision_periodica) ? $revision_periodica->observaciones : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones"]) }}
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
            <div class="form-group col-md-12">
               {{ Form::label('nuevo_control', "Nuevo control") }}
                <div id="nuevo_control" class="input-group date">
                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                    {{ Form::text('nuevo_control',  isset($revision_periodica) ? $revision_periodica->nuevo_control : null, ['class' => 'form-control box-size', 'placeholder' => "Nuevo control", 'id' => 'nuevo_control']) }}
                    @if ($errors->has('nuevo_control'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nuevo_control') }}</strong>
                        </span>
                        @else
                            <span class="help-block" id="nuevo_control"></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="file-loading">
                <input id="fotos" name="fotos[]" type="file" multiple>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @isset($revision_periodica)
            <button type="submit" class="btn btn-primary">Editar</button>
        @endisset

    @empty ($revision_periodica)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endempty
</div>

{{ Form::close() }}
