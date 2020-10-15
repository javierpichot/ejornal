@isset($prestacion_pedido)
    {{ Form::model($prestacion_pedido, ['route' => ['trabajador.prestacion.pedido.update',$prestacion_pedido->id , $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'prestacion'])
    }}
    <input type="hidden" name="trabajador_id" value="{{ $prestacion_pedido->trabajador_id }}">
    <input type="hidden" name="empresa_id" value="{{ $prestacion_pedido->empresa_id }}">
@endisset

@empty ($prestacion_pedido)
    {{ Form::open(['route' => 'trabajador.prestacion.pedido.store', 'role' => 'form', 'method' => 'post', 'id' => 'prestacion']) }}
    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endempty

<div class="modal-header">
    @isset($prestacion_pedido)
        <h5 class="modal-title" id="exampleModalLabel">Editar perdidoa de prestacion</h5>
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
        <div class="form-group col-md-12">
            {{ Form::label('prestacion_tipo_id', "Tipo de prestacion") }}
            {!! Form::select('prestacion_tipo_id', $prestacion_tipos->pluck('nombre', 'id'), isset($prestacion_pedido) ? $prestacion_pedido->prestacion_tipo_id : null, ['placeholder' => 'Tipo de prestacion', 'class' => 'form-control box-size',]) !!}
            @if ($errors->has('prestacion_tipo_id'))
                <span class="help-block">
                            <strong>{{ $errors->first('prestacion_tipo_id') }}</strong>
                        </span>
            @else
                <span class="help-block" id="prestacion_tipo_id"></span>
            @endif
        </div>
    </div>


    <div id="blank_info" style="display:block">
        <div class="row">


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
    </div>

    <div id="not_blank_info" style="display:none">
        <div class="row">
              <div class="form-group col-md-12">

                  {{ Form::label('descripcion', "Descripcion") }}
                  <textarea name="descripcion" rows="8" cols="80" class="form-control box-size">
                      {{ $trabajador->telefono }}

                      {{ $trabajador->direccion }}

                      {{ $trabajador->localidad }}

                      {{ $trabajador->observacion_direccion }}
                  </textarea>
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

      <div class="form-group col-md-12">
          {{ Form::label('ausentismo_id', "Asociar consulta con episodio de ausentismo") }}

          {!! Form::select('ausentismo_id', $ausentismos->pluck('created_at', 'id'), isset($prestacion) ? $prestacion->ausentismo_id : null, ['placeholder' => 'Ausentismo', 'class' => 'form-control box-size']) !!}

          @if ($errors->has('ausentismo_id'))
              <span class="help-block">
                  <strong>{{ $errors->first('ausentismo_id') }}</strong>
              </span>
          @else
              <span class="help-block" id="ausentismo_id"></span>
          @endif
      </div>




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
