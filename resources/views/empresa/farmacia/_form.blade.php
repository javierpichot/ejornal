
    @isset($farmaco)
        <script type="text/javascript">
            $(function() {
                $('.date').datetimepicker({
                    format: 'YYYY-MM-DD',
                    locale: 'es-es'
                });
            });
        </script>
        {{ Form::model($farmaco, ['route' => ['empresa.farmacos.getUpdate', $farmaco->id, $farmaco->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
        }}
        <input type="hidden" name="empresa_id" value="{{ $farmaco->empresa_id }}">
    @endisset

    @empty ($farmaco)
        {{ Form::open(['route' => 'empresa.farmacos.store', 'role' => 'form', 'method' => 'post', 'id' => 'frm']) }}
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    @endempty

    <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Nuevo farmaco</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-12">
                {{ Form::label('nombre', "Nombre farmaco") }}
                {{ Form::text('nombre',  isset($farmaco->nombre) ? $farmaco->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre farmaco"]) }}
                @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="nombre"></span>
                @endif
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('via', "Via") }}
                {{ Form::text('via_prestacion',  isset($farmaco->via) ? $farmaco->via : null, ['class' => 'form-control box-size', 'placeholder' => "Via"]) }}
                @if ($errors->has('via_prestacion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('via_prestacion') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="via_prestacion"></span>
                @endif
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('cantidad', "Cantidad") }}
                {{ Form::text('cantidad',  isset($farmaco->cantidad) ? $farmaco->cantidad : null, ['class' => 'form-control box-size', 'placeholder' => "Cantidad"]) }}
                @if ($errors->has('cantidad'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cantidad') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="cantidad"></span>
                @endif
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('prestacion_droga_tipo_id', "Tipo farmaco") }}
                {!! Form::select('prestacion_droga_tipo_id', $tipo_farmaco->pluck('nombre', 'id'), isset($farmaco->caducidad) ? $farmaco->prestacion_droga_tipo : null, ['placeholder' => 'Seleccione el tipo', 'class' => 'form-control box-size']) !!}
                @if ($errors->has('prestacion_droga_tipo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('prestacion_droga_tipo_id') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="prestacion_droga_tipo_id"></span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <div class="form-group col-md-12">
                   {{ Form::label('fecha_caducidad', "Fecha caducidad") }}
                    <div id="fecha_caducidad_picker" class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        {{ Form::text('fecha_caducidad',  isset($farmaco->caducidad) ? $farmaco->caducidad : null, ['class' => 'form-control box-size', 'placeholder' => "Fecha caducidad"]) }}
                        @if ($errors->has('fecha_caducidad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_caducidad') }}</strong>
                            </span>
                        @else
                            <span class="help-block" id="fecha_caducidad"></span>
                        @endif
                    </div>



                </div>
            </div>

        </div>


    </div>



    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @if(isset($incidencia))
            <button type="submit" class="btn btn-primary">Editar Farmaco</button>
        @else
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endif
    </div>
    {{ Form::close() }}
