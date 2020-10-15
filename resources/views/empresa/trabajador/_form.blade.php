


@isset($trabajador)
    <script type="text/javascript">
            $(function () {
                $('.delete-confirm').on('click', function(e) {
                   e.preventDefault();

                   const swalWithBootstrapButtons = swal.mixin({
                       confirmButtonClass: 'btn btn-success',
                       cancelButtonClass: 'btn btn-danger',
                       buttonsStyling: false,
                   })

                   swalWithBootstrapButtons({
                       title: 'Desea eliminar la empresa?',
                       text: "Al eliminar esto no hay vuelta atras!",
                       type: 'warning',
                       showCancelButton: true,
                       confirmButtonText: 'Si, eliminar!',
                       cancelButtonText: 'No, cancelar!',
                       reverseButtons: true
                   }).then((result) => {
                       if (result.value) {
                           $.ajax({
                               url: $(this).attr('data-href'),
                               method: 'POST',
                               dataType: 'JSON',
                               data: {
                                   '_token': $('input[name="_token"]').val(),
                                   'id': $(this).attr('data-id'),
                                   '_method': $('input[name="_method"]').val()
                               },
                               success: function(data) {
                                   if( data.status == 'success' ) {
                                       $('#trabajador_' + data.id).fadeOut();
                                       sweetAlert('Eliminada', data.message, 'success');
                                   } else {
                                       sweetAlert('Uppsss...', data.message, 'error');
                                   }
                               },
                               error: function(xhr, message) {

                               }
                           });
                       } else if (
                           // Read more about handling dismissals
                           result.dismiss === swal.DismissReason.cancel
                       ) {
                           swalWithBootstrapButtons(
                               'Cancelada',
                               'La operacion a sido :)',
                               'error'
                           )
                       }
                   })

               });

               $('#logo').fileinput({
                   <?php if(isset($trabajador)) { ?>
                   initialPreview: ["{{ asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) }}"],
                   initialPreviewAsData: true,
                   <?php } ?>
                   theme: 'fa',
                   language: 'es',
                   uploadUrl: '#',
                   allowedFileExtensions: ['jpg', 'png', 'gif'],
                   browseClass: "btn btn-primary btn-block",
                   showCaption: false,
                   showRemove: false,
                   showUpload: false
               });

               $('#celular').mask('(000) 0000-0000');
               $('#telefono').mask('(000) 0000-0000');
               $('#celular_familiar').mask('(000) 0000-0000');
               $('#antecedente_medico').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })
               $('#antecedente_familiar').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })
               $('#estilo_vida').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })
               $("#frm").validate();
               $(document).on('click', 'a.page-link', function (event) {
                   event.preventDefault();
                   ajaxLoad($(this).attr('href'));
               });

               $('#fecha_nacimiento').datetimepicker({
				   format: 'YYYY-MM-DD',
				   locale: 'es-us'
			   });

               $('#fecha_contrato').datetimepicker({
                  format: 'YYYY-MM-DD',
                  locale: 'es-us'
              });

        });
    </script>

    {{ Form::model($trabajador, ['route' => ['empresa.trabajadores.update', $trabajador->id, $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@endisset

@empty ($trabajador)
    {{ Form::open(['route' => 'empresa.trabajadores.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'frm']) }}
@endempty
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @isset($trabajador)
        <h4 class="modal-title">Editar trabajador</h5>
    @endisset

    @empty ($trabajador)
        <h4 class="modal-title">Nuevo trabajador</h5>
    @endempty

</div>



<div class="modal-body">
    <div class="row">
        <div class="col-md-5">
            <div class="file-loading">
                <input id="logo" name="photo" type="file">
            </div>
            <div class="form-row mt-4">
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <div class="form-group col-md-6">
                    {{ Form::label('nombre', "Nombre") }}
                    {{ Form::text('nombre',  isset($trabajador) ? $trabajador->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre", 'required' => 'required']) }}
                    @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                        @else
                            <span class="help-block" id="nombre"></span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('apellido', "Apellido") }}
                    {{ Form::text('apellido',  isset($trabajador) ? $trabajador->apellido : null, ['class' => 'form-control box-size', 'placeholder' => "Apellido", 'required' => 'required']) }}
                    @if ($errors->has('apellido'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellido') }}</strong>
                        </span>
                    @else
                        <span class="help-block" id="apellido"></span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    {{ Form::label('documento', "Documento") }}
                    {{ Form::number('documento',  isset($trabajador) ? $trabajador->documento : null, ['class' => 'form-control box-size', 'placeholder' => "Documento", 'required' => 'required']) }}
                    @if ($errors->has('documento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('documento') }}</strong>
                        </span>
                    @else
                        <span class="help-block" id="documento"></span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('fecha_nacimiento', "Fecha nacimiento") }}
                    <div id="fecha_nacimiento" class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        {{ Form::text('fecha_nacimiento',  isset($trabajador) ? $trabajador->fecha_nacimiento : null, ['class' => 'form-control box-size date', 'placeholder' => "Fecha nacimiento"]) }}
                        @if ($errors->has('fecha_nacimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                            </span>
                        @else
                            <span class="help-block" id="fecha_nacimiento"></span>
                        @endif
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
   
                    
                    <button  class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Identificacion
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              {{ Form::label('localidad_id', "Pais/provincia nacimiento") }}
                              {!! Form::select('localidad_id', $localidades->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->localidad_id : null, ['placeholder' => 'Seleccione una localidad', 'class' => 'form-control box-size']) !!}
                              @if ($errors->has('localidad_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('localidad_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="localidad_id"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-6">
                              {{ Form::label('localidad', "Localidad") }}
                              {{ Form::text('localidad',  isset($trabajador) ? $trabajador->localidad : null, ['class' => 'form-control box-size', 'placeholder' => "Localidad"]) }}
                              @if ($errors->has('localidad'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('localidad') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="localidad"></span>
                              @endif
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                              {{ Form::label('obra_social_id', "Obra social") }}
                              {!! Form::select('obra_social_id', $obra_social->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->obra_social_id : null, ['placeholder' => 'Seleccione una obra social', 'class' => 'form-control box-size']) !!}
                              @if ($errors->has('obra_social_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('obra_social_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="obra_social_id"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-6">
                              {{ Form::label('numero_afiliado', "Numero afiliado") }}
                              {{ Form::text('numero_afiliado',  isset($trabajador) ? $trabajador->numero_afiliado : null, ['class' => 'form-control box-size', 'placeholder' => "Numero afiliado"]) }}
                              @if ($errors->has('numero_afiliado'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('numero_afiliado') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="numero_afiliado"></span>
                              @endif
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-12">
                              {{ Form::label('observacion_direccion', "Observaciones de la dirección") }}
                              {{ Form::textarea('observacion_direccion',  isset($trabajador) ? $trabajador->observacion_direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Observaciones de la dirección"]) }}
                              @if ($errors->has('observacion_direccion'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('observacion_direccion') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="observacion_direccion"></span>
                              @endif
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-4">
                              {{ Form::label('celular', "Celular") }}
                              {{ Form::text('celular',  isset($trabajador) ? $trabajador->celular : null, ['class' => 'form-control box-size', 'placeholder' => "Celular", 'id' => 'celular']) }}
                              @if ($errors->has('celular'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('celular') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="celular"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-4">
                              {{ Form::label('telefono', "Telefono") }}
                              {{ Form::text('telefono',  isset($trabajador) ? $trabajador->telefono : null, ['class' => 'form-control box-size', 'placeholder' => "Telefono", 'id' => 'telefono']) }}
                              @if ($errors->has('telefono'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('telefono') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="telefono"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-4">
                              {{ Form::label('email', "Email") }}
                              {{ Form::email('email',  isset($trabajador) ? $trabajador->email : null, ['class' => 'form-control box-size', 'placeholder' => "Email"]) }}
                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="email"></span>
                              @endif
                          </div>
                      </div>


                      <div class="form-row">
                          <div class="form-group col-md-4">
                              {{ Form::label('nombre_familiar', "Nombre familiar") }}
                              {{ Form::text('nombre_familiar',  isset($trabajador->familiar) ? $trabajador->familiar->nombre_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Nombre familiar"]) }}
                              @if ($errors->has('nombre_familiar'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('nombre_familiar') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="nombre_familiar"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-4">
                              {{ Form::label('celular_familiar', "Telefono Familiar") }}
                              {{ Form::text('celular_familiar',  isset($trabajador->familiar) ? $trabajador->familiar->celular_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Numero", 'id' => 'celular_familiar']) }}
                              @if ($errors->has('celular_familiar'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('celular_familiar') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="celular_familiar"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-4">
                              {{ Form::label('carga_familiar', "Carga familiar") }}
                              {{ Form::number('carga_familiar',  isset($trabajador->familiar) ? $trabajador->familiar->carga_familiar : null, ['class' => 'form-control box-size', 'placeholder' => "Carga familiar"]) }}
                              @if ($errors->has('carga_familiar'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('carga_familiar') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="carga_familiar"></span>
                              @endif
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-primary btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     Información laboral
                    </button>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                      <div class="form-row">
                          <div class="form-group col-md-6">
                             {{ Form::label('fecha_contrato', "Fecha contrato") }}
                              <div id="fecha_contrato" class="input-group date">
                                  <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                  {{ Form::text('fecha_contrato',  isset($trabajador) ? $trabajador->fecha_contrato : null, ['class' => 'form-control box-size', 'placeholder' => "Fecha contrato", 'id' => 'fecha_contrato']) }}
                                  @if ($errors->has('fecha_contrato'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('fecha_contrato') }}</strong>
                                      </span>
                                  @else
                                      <span class="help-block" id="fecha_contrato"></span>
                                  @endif
                              </div>



                          </div>

                          <div class="form-group col-md-6">
                              {{ Form::label('numero_legajo', "Numero legajo") }}
                              {{ Form::number('numero_legajo',  isset($trabajador) ? $trabajador->numero_legajo : null, ['class' => 'form-control box-size', 'placeholder' => "Numero legajo"]) }}
                              @if ($errors->has('numero_legajo'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('numero_legajo') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="numero_legajo"></span>
                              @endif
                          </div>
                      </div>
<div class="form-group col-md-4">
                              {{ Form::label('turno_id', "Turno") }}
                              {!! Form::select('turno_id', $turnos->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->turno_id : null, ['placeholder' => 'Seleccione un turno', 'class' => 'form-control box-size']) !!}
                              @if ($errors->has('turno_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('turno_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="turno_id"></span>
                              @endif
                          </div>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                              {{ Form::label('sector_id', "Sector") }}
                              {!! Form::select('sector_id', $sectores->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->sector_id : null, ['placeholder' => 'Seleccione un sector', 'class' => 'form-control box-size']) !!}
                              @if ($errors->has('sector_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('sector_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="sector_id"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-4">
                              {{ Form::label('tarea_id', "Puesto") }}
                              {!! Form::select('tarea_id', $tareas->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->tarea_id : null, ['placeholder' => 'Seleccione un puesto', 'class' => 'form-control box-size']) !!}
                              @if ($errors->has('tarea_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('tarea_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="tarea_id"></span>
                              @endif
                          </div>

                          
                      </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-primary btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Antecedentes
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                      <div class="form-row">
                          <div class="form-group col-md-12">
                              {{ Form::label('antecedente_med_id', "Antecedentes médicos") }}
                              <br>
                              {!! Form::select('antecedente_medico_id[]', $antecedentes_medico->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->antecedente_medico->pluck('enfermedad_id') : null, ['class' => 'form-control', 'id' => 'antecedente_medico', 'multiple' => true, 'style' => 'width: 100%;']) !!}
                              @if ($errors->has('antecedente_medico_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('antecedente_medico_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="antecedente_medico_id"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-12">
                              {{ Form::label('antecedente_familiar_id', "Antecedentes médicos familiares") }}
                              <br>
                              {!! Form::select('antecedente_familiar_id[]', $antecedentes_familiar->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->antecedente_familiar->pluck('enfermedad_id') : null, ['class' => '"form-control', 'id' => 'antecedente_familiar', 'multiple' => true, 'style' => 'width: 100%;']) !!}
                              @if ($errors->has('antecedente_familiar_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('antecedente_familiar_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="antecedente_familiar_id"></span>
                              @endif
                          </div>

                          <div class="form-group col-md-12">
                              {{ Form::label('estilo_vida_id', "Estilo de vida") }}
                              <br>
                              {!! Form::select('estilo_vida_id[]', $estilo_vida->pluck('nombre', 'id'), isset($trabajador) ? $trabajador->estilo_vida->pluck('enfermedad_id') : null, ['class' => 'form-control', 'id' => 'estilo_vida', 'multiple' => true, 'style' => 'width: 100%;']) !!}
                              @if ($errors->has('estilo_vida_id'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('estilo_vida_id') }}</strong>
                                  </span>
                              @else
                                  <span class="help-block" id="estilo_vida_id"></span>
                              @endif
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @isset($trabajador)
            <button type="submit" class="btn btn-primary">Editar</button>
        @endisset

    @empty ($trabajador)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endempty
</div>

{{ Form::close() }}
