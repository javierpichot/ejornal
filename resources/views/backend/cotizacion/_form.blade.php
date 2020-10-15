@isset($prestacion_cotizacion)
    {{ Form::model($prestacion_cotizacion, ['route' => ['empresa.prestacion.pedido.update',$prestacion_cotizacion->id , $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@endisset

@empty ($prestacion_cotizacion)
    {{ Form::open(['route' => 'empresa.prestacion.pedido.store', 'role' => 'form', 'method' => 'post', 'id' => 'frm']) }}
@endempty

<div class="modal-header">
    @isset($prestacion_pedido)
        <h5 class="modal-title" id="exampleModalLabel">Editar perdido de prestacion</h5>
    @endisset

    @empty ($prestacion_pedido)
        <h5 class="modal-title" id="exampleModalLabel">Nuevo perdido de prestacion</h5>
    @endempty

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">

        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

        <div class="form-group col-md-12">
            {{ Form::label('descripcion', "Descripcion") }}
            {{ Form::textarea('descripcion',  isset($prestacion_pedido) ? $prestacion_pedido->descripcion : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion"]) }}
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
        <div class="form-group col-md-12">
            {{ Form::label('prestacion_tipo_id', "Tipo de prestacion") }}
            {!! Form::select('prestacion_tipo_id', $prestacion_tipos->pluck('nombre', 'id'), isset($prestacion_pedido) ? $prestacion_pedido->prestacion_tipo_id : null, ['placeholder' => 'Tipo de prestacion', 'class' => 'form-control box-size']) !!}
            @if ($errors->has('prestacion_tipo_id'))
                <span class="help-block">
                            <strong>{{ $errors->first('prestacion_tipo_id') }}</strong>
                        </span>
            @else
                <span class="help-block" id="prestacion_tipo_id"></span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('observaciones', "Observaciones") }}
            {{ Form::textarea('observaciones',  isset($prestacion_pedido) ? $prestacion_pedido->observaciones : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones"]) }}
            @if ($errors->has('observaciones'))
                <span class="help-block">
                            <strong>{{ $errors->first('observaciones') }}</strong>
                        </span>
            @else
                <span class="help-block" id="observaciones"></span>
            @endif
        </div>
    </div>

    <!--<div class="row">
        <div class="col-md-12">
            <div class="file-loading">
                <input id="presupuesto_url" name="presupuesto_url" type="file">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            {{ Form::label('presupuesto', "presupuesto") }}
            {{ Form::text('presupuesto',  isset($prestacion_pedido) ? $prestacion_pedido->presupuesto : null, ['class' => 'form-control box-size', 'placeholder' => "presupuesto"]) }}
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
           {{ Form::label('confirmacion', "confirmacion") }}
           {{ Form::text('confirmacion',  isset($prestacion_pedido) ? $prestacion_pedido->confirmacion : null, ['class' => 'form-control box-size', 'placeholder' => "confirmacion"]) }}
           @if ($errors->has('confirmacion'))
               <span class="help-block">
                            <strong>{{ $errors->first('confirmacion') }}</strong>
                        </span>
           @else
               <span class="help-block" id="confirmacion"></span>
           @endif
       </div>

    </div>


    <div class="row">
       <div class="col-md-12">
           <div class="file-loading">
               <input id="orden_servicio_url" name="orden_servicio_url" type="file">
           </div>
       </div>

    </div>

    <div class="row">
       <div class="col-md-12">
           <div class="file-loading">
               <input id="reporte_url" name="reporte_url" type="file">
           </div>
       </div>

    </div>

    <div class="row">
       <div class="col-md-12">
           {{ Form::label('reporte', "reporte") }}
           {{ Form::text('reporte',  isset($prestacion_pedido) ? $prestacion_pedido->reporte : null, ['class' => 'form-control box-size', 'placeholder' => "reporte"]) }}
           @if ($errors->has('reporte'))
               <span class="help-block">
                            <strong>{{ $errors->first('reporte') }}</strong>
                        </span>
           @else
               <span class="help-block" id="reporte"></span>
           @endif
       </div>

    </div>


    <div class="row">
       <div class="col-md-12">
           {{ Form::label('feedback', "feedback") }}
           {{ Form::text('feedback',  isset($prestacion_pedido) ? $prestacion_pedido->feedback : null, ['class' => 'form-control box-size', 'placeholder' => "confirmacion"]) }}
           @if ($errors->has('feedback'))
               <span class="help-block">
                            <strong>{{ $errors->first('feedback') }}</strong>
                        </span>
           @else
               <span class="help-block" id="feedback"></span>
           @endif
       </div>

    </div>-->



</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @isset($prestacion_pedido)
        <button type="submit" class="btn btn-primary">Editar</button>
    @endisset

    @empty ($prestacion_pedido)
        <button type="submit" class="btn btn-primary">Guardar</button>
    @endempty
</div>

{{ Form::close() }}