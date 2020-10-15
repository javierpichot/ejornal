@isset($consulta)
    <script type="text/javascript">
        $(function () {
            $('select#consulta_motivo_id').on('change',function(){
                var consultaMotivoID = $(this).val();
                if(consultaMotivoID){
                    $.ajax({
                        type:'POST',
                        url:'{{ route('trabajador.diagnotico.consulta.show') }}',
                        data:'consulta_motivo_id='+consultaMotivoID,
                        success:function(response){
                            $('#diagnostico_id').html(response.data);
                        }
                    });
                }else{

                }
            });
            var regex = /^(.+?)(\d+)$/i;
            var cloneIndex = $(".clonedata").length;
            function clone(){
                $(this).parents(".clonedata").clone()
                    .appendTo("#appends")
                    .attr("id", "clonedata" +  cloneIndex)
                    .find("*")
                    .each(function() {
                        var id = this.id || "";
                        var match = id.match(regex) || [];
                        if (match.length == 2) {
                            this.id = match[1] + (cloneIndex);
                        }
                    })
                    .on('click', 'button.clone', clone)
                    .on('click', 'button.remove', remove);
                cloneIndex++;
            }
            function remove(){
                $(this).parents(".clonedata").remove();
            }

            $("button.clone").on("click", clone);

            $("button.remove").on("click", remove);
        });
    </script>

    {{ Form::model($consulta, ['route' => ['trabajador.consulta.update',$consulta->id , $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'consulta'])
    }}

    <input type="hidden" name="trabajador_id" value="{{ $consulta->trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $consulta->empresa_id }}">
@endisset


@empty ($consulta)
    {!! Form::open(['route' => 'trabajador.consulta.store', 'role' => 'form', 'method' => 'post', 'id' => 'consulta']) !!}
    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty
<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    @isset($consulta)
        <h4 class="modal-title" id="exampleModalLabel">Editar consulta</h4>
    @endisset

    @empty ($consulta)
        <h4 class="modal-title" id="exampleModalLabel">Nueva consulta</h4>
    @endempty

</div>

<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            {{ Form::label('consulta_tipo_id', "Tipo de consulta") }}
            {!! Form::select('consulta_tipo_id', $consulta_tipo->pluck('nombre', 'id'), isset($consulta) ? $consulta->consulta_tipo_id : null, ['placeholder' => 'Tipo de consulta', 'class' => 'form-control box-size']) !!}
            @if ($errors->has('consulta_tipo_id'))
                <span class="help-block">
                          <strong>{{ $errors->first('consulta_tipo_id') }}</strong>
                      </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4" id="ausentismo" style="display: {{ isset($consulta) ? ($consulta->consulta_tipo_id == 1 or $consulta->consulta_tipo_id == 2) ? 'block' : 'none' : 'none' }}">
            {{ Form::label('ausentismo_id', "Asociar consulta con ausentismo") }}

            {!! Form::select('ausentismo_id', $ausentismos->pluck('created_at', 'id'), isset($prestacion) ? $consulta->ausentismo_id : null, ['placeholder' => 'Ausentismo', 'class' => 'form-control box-size']) !!}

            @if ($errors->has('ausentismo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ausentismo_id') }}</strong>
                </span>
            @else
                <span class="help-block" id="ausentismo_id"></span>
            @endif
        </div>

        @empty($consulta)
            <div class="col-xs-4" id="especialidad" style="display: none">
                {{ Form::label('consulta_motivo_id', "Especialidad*") }}
                {!! Form::select('consulta_motivo_id', $consulta_motivo->pluck('nombre', 'id'), isset($consulta) ? $consulta->consulta_motivo_id : null, ['placeholder' => 'Especialidad', 'class' => 'form-control box-size']) !!}
                @if ($errors->has('consulta_motivo_id'))
                    <span class="help-block">
                    <strong>{{ $errors->first('consulta_motivo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="consulta_motivo_id"></span>
                @endif
            </div>

            <div class="col-xs-4" id="diagnostico" style="display: {{ isset($consulta) ? ($consulta->consulta_tipo_id == 1 or $consulta->consulta_tipo_id == 2) ? 'block' : 'none' : 'none' }}">
                {{ Form::label('diagnostico_id', "Diagnóstico*") }}
                <select name="diagnostico_id" id="diagnostico_id" class="form-control"></select>
                @if ($errors->has('consulta_motivo_id'))
                    <span class="help-block">
                    <strong>{{ $errors->first('diagnostico_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="diagnostico_id"></span>
                @endif
            </div>
            <div class="col-md-12">
                <p id="guia_diag"></p>
            </div>
        @endempty

        @isset($consulta)

            <div class="col-xs-4" id="especialidad">
                {{ Form::label('consulta_motivo_id', "Especialidad*") }}
                {!! Form::select('consulta_motivo_id', $consulta_motivo->pluck('nombre', 'id'), isset($consulta) ? $consulta->consulta_motivo_id : null, ['placeholder' => 'Especialidad', 'class' => 'form-control box-size']) !!}
                @if ($errors->has('consulta_motivo_id'))
                    <span class="help-block">
                    <strong>{{ $errors->first('consulta_motivo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="consulta_motivo_id"></span>
                @endif
            </div>


            <div class="col-xs-4" id="diagnostico">
                {{ Form::label('diagnostico_id', "Diagnóstico*") }}
                {!! Form::select('diagnostico_id', $diagnostico->pluck('diagnostico', 'id'), isset($consulta) ? $consulta->diagnostico_id : null, ['placeholder' => 'Especialidad', 'class' => 'form-control box-size']) !!}
                @if ($errors->has('consulta_motivo_id'))
                    <span class="help-block">
                    <strong>{{ $errors->first('consulta_motivo_id') }}</strong>
                </span>
                @else
                    <span class="help-block" id="consulta_motivo_id"></span>
                @endif
            </div>

            <div class="col-md-12">
                <p id="guia_diag"></p>
            </div>
        @endisset
    </div>
    <div class="row" id="file_01" style="display: none">


        <div class="col-xs-4">
            {{ Form::label('tension_arterial', "Tension Art.") }}
            {{ Form::text('tension_arterial',  isset($consulta) ? $consulta->consulta_control->tension_arterial : null, ['class' => 'form-control box-size', 'placeholder' => "Tension Arterial"]) }}
            @if ($errors->has('tension_arterial'))
                <span class="help-block">
                            <strong>{{ $errors->first('tension_arterial') }}</strong>
                        </span>
            @else
                <span class="help-block" id="tension_arterial"></span>
            @endif
        </div>
        <div class="col-xs-4">
            {{ Form::label('frecuencia_cardiaca', "Frecuencia Card.") }}
            {{ Form::text('frecuencia_cardiaca',  isset($consulta) ? $consulta->consulta_control->frecuencia_cardiaca : null, ['class' => 'form-control box-size', 'placeholder' => "Frecuencia Cardiaca"]) }}
            @if ($errors->has('frecuencia_cardiaca'))
                <span class="help-block">
                            <strong>{{ $errors->first('frecuencia_cardiaca') }}</strong>
                        </span>
            @else
                <span class="help-block" id="frecuencia_cardiaca"></span>
            @endif
        </div>

        <div class="col-xs-4">
            {{ Form::label('peso', "Peso") }}
            {{ Form::text('peso',  isset($consulta) ? $consulta->consulta_control->peso : null, ['class' => 'form-control box-size', 'placeholder' => "Peso"]) }}
            @if ($errors->has('peso'))
                <span class="help-block">
                            <strong>{{ $errors->first('peso') }}</strong>
                        </span>
            @else
                <span class="help-block" id="peso"></span>
            @endif
        </div>
    </div>

    <div class="row" id="file_02" style="display: none">
        <div class="col-xs-4">
            {{ Form::label('altura', "Altura") }}
            {{ Form::text('altura',  isset($consulta) ? $consulta->consulta_control->altura : null, ['class' => 'form-control box-size', 'placeholder' => "Altura"]) }}
            @if ($errors->has('altura'))
                <span class="help-block">
                            <strong>{{ $errors->first('altura') }}</strong>
                        </span>
            @else
                <span class="help-block" id="altura"></span>
            @endif
        </div>

        <div class="col-xs-4">
            {{ Form::label('glucemia', "Glucemia") }}
            {{ Form::text('glucemia',  isset($consulta) ? $consulta->consulta_control->glucemia : null, ['class' => 'form-control box-size', 'placeholder' => "Altura"]) }}
            @if ($errors->has('glucemia'))
                <span class="help-block">
                            <strong>{{ $errors->first('glucemia') }}</strong>
                        </span>
            @else
                <span class="help-block" id="glucemia"></span>
            @endif
        </div>

        <div class="col-xs-4">
            {{ Form::label('saturacion_oxigeno', "Saturacion Oxigeno") }}
            {{ Form::text('saturacion_oxigeno',  isset($consulta) ? $consulta->consulta_control->saturacion_oxigeno : null, ['class' => 'form-control box-size', 'placeholder' => "Altura"]) }}
            @if ($errors->has('saturacion_oxigeno'))
                <span class="help-block">
                            <strong>{{ $errors->first('saturacion_oxigeno') }}</strong>
                        </span>
            @else
                <span class="help-block" id="saturacion_oxigeno"></span>
            @endif
        </div>
    </div>



    <div id="capa_medica" style="display: {{ isset($consulta) ? ($consulta->consulta_tipo_id == 1) ? 'block' : 'none' : 'none' }}" >
        <div class="row">
            <div class="col-xs-6">
                {{ Form::label('entrevista', "Anamnesis") }}
                {{ Form::textarea('entrevista',  isset($consulta) ? $consulta->entrevista : null, ['class' => 'form-control box-size', 'placeholder' => "El paciente refiere que...", 'rows' => 3]) }}
                @if ($errors->has('entrevista'))
                    <span class="help-block">
                        <strong>{{ $errors->first('entrevista') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="entrevista"></span>
                @endif
            </div>

            <div class="col-xs-6">
                {{ Form::label('examen_fisico', "Examen fisico") }}
                {{ Form::textarea('examen_fisico',  isset($consulta) ? $consulta->examen_fisico : null, ['class' => 'form-control box-size', 'placeholder' => "Examen fisico detallado", 'rows' => 3]) }}
                @if ($errors->has('examen_fisico'))
                    <span class="help-block">
                        <strong>{{ $errors->first('examen_fisico') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="examen_fisico"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                {{ Form::label('examenes_complementarios', "Examen complementario") }}
                {{ Form::textarea('examenes_complementarios',  isset($consulta) ? $consulta->examenes_complementarios : null, ['class' => 'form-control box-size', 'placeholder' => "Examen complementario", 'rows' => 3]) }}
                @if ($errors->has('examen_fisico'))
                    <span class="help-block">
                        <strong>{{ $errors->first('examenes_complementarios') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="examenes_complementarios"></span>
                @endif
            </div>

            <div class="col-xs-6">
                {{ Form::label('diagnostico', "Diagnostico") }}
                {{ Form::textarea('diagnostico',  isset($consulta) ? $consulta->diagnostico : null, ['class' => 'form-control box-size', 'placeholder' => "Diagnostico", 'rows' => 3]) }}
                @if ($errors->has('diagnostico'))
                    <span class="help-block">
                        <strong>{{ $errors->first('diagnostico') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="diagnostico"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                {{ Form::label('tratamiento', "Tratamiento") }}
                {{ Form::textarea('tratamiento',  isset($consulta) ? $consulta->tratamiento : null, ['class' => 'form-control box-size', 'placeholder' => "Tratamiento", 'rows' => 3]) }}
                @if ($errors->has('tratamiento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tratamiento') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="tratamiento"></span>
                @endif
            </div>
            <div class="col-xs-6">
                {{ Form::label('tratamiento', "Plan a seguir*") }}
                {{ Form::textarea('tratamiento',  isset($consulta) ? $consulta->tratamiento : null, ['class' => 'form-control box-size', 'placeholder' => "Plan a seguir", 'rows' => 3]) }}
                @if ($errors->has('tratamiento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tratamiento') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="tratamiento"></span>
                @endif
            </div>
        </div>
    </div><!--Capa-medica-->

    <div id="capa_enfermeria" style="display: {{ isset($consulta) ? ($consulta->consulta_tipo_id == 2) ? 'block' : 'none' : 'none' }}">
        <div class="row">
            <div class="col-xs-12">
                {{ Form::label('enfermeria', "Descripcion") }}
                {{ Form::textarea('enfermeria',  isset($consulta) ? $consulta->enfermeria : null, ['class' => 'form-control box-size', 'placeholder' => "Descripcion", 'rows' => 3]) }}
                @if ($errors->has('enfermeria'))
                    <span class="help-block">
                        <strong>{{ $errors->first('enfermeria') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="enfermeria"></span>
                @endif
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-xs-6">
                @isset($consulta->consulta_prestacion_farmacia_droga)
                    @foreach($consulta->consulta_prestacion_farmacia_droga as $consulta_prestacion_farmacia_droga)
                        {!! Form::select('prestacion_farmacia_droga_id[]', $prestacion_farmacia_droga->pluck('nombre', 'id'), isset($consulta) ? $consulta_prestacion_farmacia_droga->toArray() : null, ['placeholder' => 'Medicacion', 'class' => 'form-control box-size top-buffer']) !!}
                    @endforeach
                @endisset

                @if ($errors->has('prestacion_farmacia_droga_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('prestacion_farmacia_droga_id') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="prestacion_farmacia_droga_id"></span>
                @endif
            </div>

            <div class="col-xs-4">
                @isset($consulta->consulta_prestacion_farmacia_droga)
                    @foreach($consulta->consulta_prestacion_farmacia_droga as $consulta_prestacion_farmacia_droga)
                        <input type="numeric" name="cantidad[]" class="form-control top-buffer" value="{{ $consulta_prestacion_farmacia_droga->pivot->cantidad }}">
                    @endforeach
                @endisset

            </div>
        </div>

        <div class="row clonedata" id="clonedata">
            <div class="col-xs-6">

                {!! Form::select('prestacion_farmacia_droga_id[]', $prestacion_farmacia_droga->pluck('nombre', 'id'), null, ['placeholder' => 'Medicacion', 'class' => 'form-control box-size mb-3']) !!}

                @if ($errors->has('prestacion_farmacia_droga_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('prestacion_farmacia_droga_id') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="prestacion_farmacia_droga_id"></span>
                @endif
            </div>

            <div class="col-xs-4">
                <input type="numeric" name="cantidad[]" class="form-control">
            </div>

            <div class="col-xs-2">
                <button type="button" class="clone mb-xs mr-xs btn btn-info"><i class="fa fa-plus"></i></button>
                <button type="button"class="remove btn btn-danger">X</button>
            </div>
        </div>
        <div id="appends"></div> <!--clonedata-->

        <div class="row">
            <div class="col-xs-12">
                {{ Form::label('consulta_reposo_id', "Amerita salida") }}
                {!! Form::select('consulta_reposo_id', $consulta_reposo->pluck('nombre', 'id'), isset($consulta) ? $consulta->consulta_reposo_id : null, ['placeholder' => '', 'class' => 'form-control box-size']) !!}
                @if ($errors->has('consulta_reposo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('consulta_reposo_id') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="consulta_reposo_id"></span>
                @endif
            </div>


        </div>

        <div class="row">


            <div class="col-xs-12">
                {{ Form::label('observacion', "Observaciones") }}
                {{ Form::textarea('observacion',  isset($consulta) ? $consulta->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones", 'rows' => 3]) }}
                @if ($errors->has('observacion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('observacion') }}</strong>
                    </span>
                @else
                    <span class="help-block" id="observacion"></span>
                @endif
            </div>
        </div>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @isset($consulta)
        <button type="submit" class="btn btn-primary">Editar</button>
    @endisset

    @empty ($consulta)
        <button type="submit" class="btn btn-primary">Guardar</button>
    @endempty
</div>

{{ Form::close() }}
