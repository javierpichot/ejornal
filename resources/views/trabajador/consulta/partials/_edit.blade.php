<modal  ref="actionEdit" size="large" :opened="openRecourses">
    <form v-if="consultas" slot="form" action="" method="post" @submit.prevent="updateConsulta">
        <div slot="title" class="modal-header">
            <h4 class="modal-title">Editar consulta</h4>
        </div>
        <div slot="body" class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Tipo consulta</label>
                        <multiselect v-model="consultas.consulta_tipo" track-by="nombre" label="nombre" placeholder="Tipo consulta" :options="consulta_tipos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                        <span v-if="errors && errors.consulta_tipo_id"  class="text-danger" role="alert">
                        <strong>@{{ errors.consulta_tipo_id[0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="row" v-for="(prestacion_farmaco, index) in consultas.consulta_prestacion_farmacia_droga">
                <div class="col-md-6 col-sm-6" v-if="consultas.consulta_prestacion_farmacia_droga">
                    <div class="form-group">
                      <multiselect  :disabled="(prestacion_farmacos.cantidad == '' ) === true" v-model="consultas.consulta_prestacion_farmacia_droga[index]" track-by="nombre" label="nombre" placeholder="Medicacion" :options="prestacion_farmacias" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.prestacion_farmacia_droga_id"  class="text-danger" role="alert">
                        <strong>@{{ errors.prestacion_farmacia_droga_id[0] }}</strong>
                      </span>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6" v-else>
                    <div class="form-group">
                      <multiselect  :disabled="(prestacion_farmacos[index].cantidad == '' ) === true" v-model="prestacion_farmaco.prestacion_farmacia_droga_id" track-by="nombre" label="nombre" placeholder="Medicacion" :options="prestacion_farmacias" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.prestacion_farmacia_droga_id"  class="text-danger" role="alert">
                        <strong>@{{ errors.prestacion_farmacia_droga_id[0] }}</strong>
                      </span>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number btn-lg" style="padding: 7px 13px;" v-on:click.prevent="dec(prestacion_farmaco.cantidad, index)">
                                          <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" v-model="prestacion_farmaco.cantidad" class="form-control input-lg input-number">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number btn-lg" style="padding: 7px 13px;" v-on:click.prevent="inc(prestacion_farmaco.cantidad, index)">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                            </div>
                        
                        <span v-if="errors && errors.cantidad"  class="text-danger" role="alert">
                          <strong>@{{ errors.cantidad[0] }}</strong>
                        </span>
                    </div>
                </div>

                <div class="col-xs-2">
                    <button type="button" v-on:click="addNewFarmaco" class="btn btn-success">
                        Agregar +
                    </button>
                    <button v-if="prestacion_farmacos.length > 2" type="button"class="remove btn btn-danger" @click="removeFarmaco(index)">X</button>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Amerita Salida</label>
                      <multiselect v-model="consultas.consulta_reposo" track-by="nombre" label="nombre" placeholder="Amerita Salida" :options="consulta_reposos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.consulta_reposo_id"  class="text-danger" role="alert">
                        <strong>@{{ errors.consulta_reposo_id[0] }}</strong>
                      </span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea v-model="consultas.observacion" cols="30" rows="2" class="form-control" :class="{ 'is-invalid': errors.observacion }"></textarea>
                        <span v-if="errors && errors.observacion"  class="text-danger" role="alert">
                        <strong>@{{ errors.observacion[0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                

                

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <multiselect v-model="form.diagnostico_id" track-by="name" label="nombre" placeholder="Diagnóstico" :options="consulta_tipos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.diagnostico_id"  class="text-danger" role="alert">
                        <strong>@{{ errors.diagnostico_id[0] }}</strong>
                      </span>
                    </div>
                </div>
            </div> --}}
            

            <template v-if="form.consulta_tipo_id.id == 1">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Asociar consulta con ausentismo</label>
                        <multiselect v-model="consultas.ausentismo" track-by="fecha_ausente" label="fecha_ausente" placeholder="Ausentismo" :options="ausentismos_trabajador" :searchable="true" :allow-empty="false" :multiple="false" :custom-label="customLabel" :show-labels="false">
                                <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">@{{ props.option.fecha_ausente }} @{{ props.option.motivo }} </span></span></template>
                        </multiselect>
                        <span v-if="errors && errors.ausentismo_id"  class="text-danger" role="alert">
                            <strong>@{{ errors.ausentismo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                                <label>Especialidad*</label>
                        <multiselect v-model="consultas.consulta_motivo" track-by="nombre" label="nombre" placeholder="Especialidad" :options="consulta_motivos" :searchable="true" :allow-empty="false" :multiple="false" @select="fetchDiagnostico"></multiselect>
                        <span v-if="errors && errors.consulta_motivo_id"  class="text-danger" role="alert">
                            <strong>@{{ errors.consulta_motivo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Diagnóstico*</label>
                            <multiselect v-model="consultas.consulta_diagnostico" track-by="diagnostico" label="diagnostico" placeholder="Diagnóstico" :options="diagnosticos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                            <span v-if="errors && errors.diagnostico_id"  class="text-danger" role="alert">
                                <strong>@{{ errors.diagnostico_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Tension Art.</label>
                            <input type="text" v-model="consultas.consulta_control.tension_arterial" class="form-control input-lg" placeholder="Tension Art.">
                            <span v-if="errors && errors.tension_arterial"  class="text-danger" role="alert">
                            <strong>@{{ errors.tension_arterial[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Frecuencia Card.</label>
                            <input type="text" v-model="consultas.consulta_control.frecuencia_cardiaca" class="form-control input-lg" placeholder="Frecuencia Card.">
                            <span v-if="errors && errors.frecuencia_cardiaca"  class="text-danger" role="alert">
                            <strong>@{{ errors.frecuencia_cardiaca[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" v-model="consultas.consulta_control.peso" class="form-control input-lg" placeholder="Peso">
                            <span v-if="errors && errors.peso"  class="text-danger" role="alert">
                            <strong>@{{ errors.peso[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Altura</label>
                            <input type="text" v-model="consultas.consulta_control.altura" class="form-control input-lg" placeholder="Altura">
                            <span v-if="errors && errors.altura"  class="text-danger" role="alert">
                            <strong>@{{ errors.altura[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Glucemia</label>
                            <input type="text" v-model="consultas.consulta_control.glucemia" class="form-control input-lg" placeholder="Glucemia">
                            <span v-if="errors && errors.glucemia"  class="text-danger" role="alert">
                            <strong>@{{ errors.glucemia[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Saturacion Oxigeno</label>
                            <input type="text" v-model="consultas.consulta_control.saturacion_oxigeno" class="form-control input-lg" placeholder="Saturacion Oxigeno">
                            <span v-if="errors && errors.saturacion_oxigeno"  class="text-danger" role="alert">
                            <strong>@{{ errors.saturacion_oxigeno[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Anamnesis</label>
                            <textarea v-model="consultas.entrevista" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.entrevista }"></textarea>
                            <span v-if="errors && errors.entrevista"  class="text-danger" role="alert">
                            <strong>@{{ errors.entrevista[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Examen fisico</label>
                            <textarea v-model="consultas.examen_fisico" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.examen_fisico }"></textarea>
                            <span v-if="errors && errors.examen_fisico"  class="text-danger" role="alert">
                            <strong>@{{ errors.examen_fisico[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Tratamiento</label>
                            <textarea v-model="consultas.tratamiento" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.tratamiento }" ></textarea>
                            <span v-if="errors && errors.tratamiento"  class="text-danger" role="alert">
                            <strong>@{{ errors.tratamiento[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Plan a seguir*</label>
                            <textarea v-model="consultas.plan" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.plan }"></textarea>
                            <span v-if="errors && errors.plan"  class="text-danger" role="alert">
                            <strong>@{{ errors.plan[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Examen complementario</label>
                            <textarea v-model="consultas.examenes_complementarios" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.examenes_complementarios }"></textarea>
                            <span v-if="errors && errors.examenes_complementarios"  class="text-danger" role="alert">
                            <strong>@{{ errors.examenes_complementarios[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Diagnóstico*</label>
                            <multiselect v-model="consultas.consulta_diagnostico" track-by="diagnostico" label="diagnostico" placeholder="Diagnóstico" :options="diagnosticos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                            <span v-if="errors && errors.consulta_diagnostico"  class="text-danger" role="alert">
                                <strong>@{{ errors.consulta_diagnostico[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="consultas && consultas.consulta_tipo.id == 2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Asociar consulta con ausentismo</label>
                        <multiselect v-model="consultas.ausentismo" track-by="fecha_ausente" label="fecha_ausente" placeholder="Ausentismo" :options="ausentismos_trabajador" :searchable="true" :allow-empty="false" :multiple="false">
                                <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">@{{ props.option.fecha_ausente }}</span></span></template>
                        </multiselect>
                        <span v-if="errors && errors.ausentismo_id"  class="text-danger" role="alert">
                            <strong>@{{ errors.ausentismo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                                <label>Especialidad*</label>
                        <multiselect v-model="consultas.consulta_motivo" track-by="nombre" label="nombre" placeholder="Especialidad" :options="consulta_motivos" :searchable="true" :allow-empty="false" :multiple="false" @select="fetchDiagnostico"></multiselect>
                        <span v-if="errors && errors.consulta_motivo_id"  class="text-danger" role="alert">
                            <strong>@{{ errors.consulta_motivo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Diagnóstico*</label>
                            <multiselect v-model="consultas.consulta_diagnostico" track-by="diagnostico" label="diagnostico" placeholder="Diagnóstico" :options="diagnosticos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                            <span v-if="errors && errors.consulta_diagnostico"  class="text-danger" role="alert">
                                <strong>@{{ errors.consulta_diagnostico[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Tension Art.</label>
                            <input type="text" v-model="consultas.consulta_control.tension_arterial" class="form-control input-lg" placeholder="Tension Art.">
                            <span v-if="errors && errors.tension_arterial"  class="text-danger" role="alert">
                            <strong>@{{ errors.tension_arterial[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Frecuencia Card.</label>
                            <input type="text" v-model="consultas.consulta_control.frecuencia_cardiaca" class="form-control input-lg" placeholder="Frecuencia Card.">
                            <span v-if="errors && errors.frecuencia_cardiaca"  class="text-danger" role="alert">
                            <strong>@{{ errors.frecuencia_cardiaca[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" v-model="consultas.consulta_control.peso" class="form-control input-lg" placeholder="Peso">
                            <span v-if="errors && errors.peso"  class="text-danger" role="alert">
                            <strong>@{{ errors.peso[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Altura</label>
                            <input type="text" v-model="consultas.consulta_control.altura" class="form-control input-lg" placeholder="Altura">
                            <span v-if="errors && errors.altura"  class="text-danger" role="alert">
                            <strong>@{{ errors.altura[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Glucemia</label>
                            <input type="text" v-model="consultas.consulta_control.glucemia" class="form-control input-lg" placeholder="Glucemia">
                            <span v-if="errors && errors.glucemia"  class="text-danger" role="alert">
                            <strong>@{{ errors.glucemia[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Saturacion Oxigeno</label>
                            <input type="text" v-model="consultas.consulta_control.saturacion_oxigeno" class="form-control input-lg" placeholder="Saturacion Oxigeno">
                            <span v-if="errors && errors.saturacion_oxigeno"  class="text-danger" role="alert">
                            <strong>@{{ errors.saturacion_oxigeno[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea v-model="consultas.enfermeria" cols="30" rows="2" class="form-control" :class="{ 'is-invalid': errors.enfermeria }"></textarea>
                            <span v-if="errors && errors.enfermeria"  class="text-danger" role="alert">
                            <strong>@{{ errors.enfermeria[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div slot="footer" class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionEdit.close()">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</modal>