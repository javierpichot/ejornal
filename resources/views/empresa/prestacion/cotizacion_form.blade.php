@isset($prestacion_cotizacion)
    <script type="text/javascript">
        $(function () {
            $('#cotizacion_url').fileinput({
                <?php if(isset($prestacion_cotizacion)) { ?>
                previewTemplates: 'file-preview-pdf',
                initialPreviewFileType: 'pdf',
                initialPreview: ["{{ asset('storage/empresas/' . $empresa->id . '/' . $prestacion_cotizacion->cotizacion_url) }}"],
                initialPreviewAsData: true,
                initialPreviewDownloadUrl: "{{ route('empresa.documentacion.generate',['empresa_id' => $empresa->id, 'filename' =>$prestacion_cotizacion->cotizacion_url] ) }}",
                <?php } ?>
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las fotos de la cotizacion',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

        });
    </script>

    {{ Form::model($prestacion_cotizacion, ['route' => ['empresa.cotizacion.pedido.update',$prestacion_cotizacion->id , $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@endisset

@empty ($cotizacion)
    {{ Form::open(['route' => 'empresa.cotizacion.pedido.store', 'role' => 'form', 'method' => 'post', 'id' => 'frm']) }}
@endempty

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    @isset($prestacion_cotizacion)
        <h5 class="modal-title" id="exampleModalLabel">Editar cotizacion</h5>
    @endisset

    @empty ($prestacion_cotizacion)
        <h5 class="modal-title" id="exampleModalLabel">Nueva cotizacion</h5>
    @endempty


</div>

<div class="modal-body">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="prestacion_pedido_id" value="{{ $prestacion_pedido->id }}">
    <input type="hidden" name="prestacion_tipo_id" value="{{ $prestacion_pedido->prestacion_tipo->id }}">
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('proveedor_id', "Elegir proveedor") }}
            {!! Form::select('proveedor_id', $proveedores->pluck('nombre', 'id'), isset($prestacion_cotizacion) ? $prestacion_cotizacion->proveedor_id : null, ['placeholder' => 'Proveedor', 'class' => 'form-control box-size']) !!}
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
            {{ Form::label('cotizacion', "cotizacion") }}
            {{ Form::text('cotizacion',  isset($prestacion_cotizacion) ? $prestacion_cotizacion->cotizacion : null, ['class' => 'form-control box-size', 'placeholder' => "cotizacion"]) }}
            @if ($errors->has('cotizacion'))
                <span class="help-block">
                            <strong>{{ $errors->first('cotizacion') }}</strong>
                        </span>
            @else
                <span class="help-block" id="cotizacion"></span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="file-loading">
                <input id="cotizacion_url" name="cotizacion_url[]" type="file" multiple>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('observaciones', "Observaciones") }}
            {{ Form::text('observaciones',  isset($prestacion_cotizacion) ? $prestacion_cotizacion->observaciones : null, ['class' => 'form-control box-size', 'placeholder' => "observaciones"]) }}
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
    @isset($prestacion_cotizacion)
        <button type="submit" class="btn btn-primary">Editar</button>
    @endisset

    @empty ($prestacion_cotizacion)
        <button type="submit" class="btn btn-primary">Guardar</button>
    @endempty
</div>

{{ Form::close() }}
