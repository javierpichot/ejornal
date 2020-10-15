@isset($presupuesto)
    <script type="text/javascript">
        $(function () {
            $('#presupuesto_url').fileinput({
                <?php if(isset($presupuesto)) { ?>
                previewTemplates: 'file-preview-pdf',
                initialPreviewFileType: 'pdf',
                initialPreview: ["{{ asset('archivos/' . $presupuesto->presupuesto_url) }}"],
                initialPreviewAsData: true,
                initialPreviewDownloadUrl: "{{ asset('archivos/' .$presupuesto->presupuesto_url) }}",
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las fotos del presupuesto',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

        });
    </script>

    {{ Form::model($presupuesto, ['route' => ['empresa.presupuesto.pedido.update',$presupuesto->id , $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@endisset

@empty ($presupuesto)
    {{ Form::open(['route' => 'empresa.presupuesto.pedido.store', 'role' => 'form', 'method' => 'post', 'id' => 'frm']) }}
@endempty

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    @isset($presupuesto)
        <h5 class="modal-title" id="exampleModalLabel">Editar presupuesto</h5>
    @endisset

    @empty ($presupuesto)
        <h5 class="modal-title" id="exampleModalLabel">Nuevo presupuesto</h5>
    @endempty


</div>

<div class="modal-body">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="prestacion_pedido_id" value="{{ $prestacion_pedido->id }}">
    <input type="hidden" name="prestacion_tipo_id" value="{{ $prestacion_pedido->prestacion_tipo->id }}">
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('proveedor_id', "Elegir proveedor") }}
            {!! Form::select('proveedor_id', $proveedores->pluck('nombre', 'id'), isset($presupuesto) ? $presupuesto->proveedor_id : null, ['placeholder' => 'Proveedor', 'class' => 'form-control box-size']) !!}
            @if ($errors->has('proveedor_id'))
                <span class="help-block">
                            <strong>{{ $errors->first('proveedor_id') }}</strong>
                        </span>
            @else
                <span class="help-block" id="proveedor_id"></span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('presupuesto', "presupuesto") }}
            {{ Form::text('presupuesto',  isset($presupuesto) ? $presupuesto->presupuesto : null, ['class' => 'form-control box-size', 'placeholder' => "presupuesto"]) }}
            @if ($errors->has('presupuesto'))
                <span class="help-block">
                            <strong>{{ $errors->first('presupuesto') }}</strong>
                        </span>
            @else
                <span class="help-block" id="presupuesto"></span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="file-loading">
                <input id="presupuesto_url" name="presupuesto_url[]" type="file" multiple>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('observaciones', "Observaciones") }}
            {{ Form::text('observaciones',  isset($presupuesto) ? $presupuesto->observaciones : null, ['class' => 'form-control box-size', 'placeholder' => "observaciones"]) }}
            @if ($errors->has('observaciones'))
                <span class="help-block">
                            <strong>{{ $errors->first('observaciones') }}</strong>
                        </span>
            @else
                <span class="help-block" id="observaciones"></span>
            @endif
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @isset($presupuesto)
        <button type="submit" class="btn btn-primary">Editar</button>
    @endisset

    @empty ($presupuesto)
        <button type="submit" class="btn btn-primary">Guardar</button>
    @endempty
</div>

{{ Form::close() }}
