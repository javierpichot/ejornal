<modal ref="actionCreate" size="large" :opened="openRecourses">
    <form slot="form" action="" method="post" @submit.prevent="newStoreConsulta">
        <div slot="title" class="modal-header">
            <h4 class="modal-title">Crear nueva consulta</h4>
        </div>
        <div slot="body" class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Tipo consulta</label>
                        <multiselect required v-model="form.consulta_tipo_id" track-by="id" label="nombre" placeholder="Tipo consulta" :options="consulta_tipos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                        <span v-if="errors && errors.consulta_tipo_id"  class="text-danger" role="alert">
                        <strong>{{ errors.consulta_tipo_id[0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row" v-for="(prestacion_farmaco, index) in prestacion_farmacos">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <multiselect required v-model="prestacion_farmaco.prestacion_farmacia_droga_id" track-by="id" label="nombre" placeholder="Medicacion" :options="prestacion_farmacias" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.prestacion_farmacia_droga_id"  class="text-danger" role="alert">
                        <strong>{{ errors.prestacion_farmacia_droga_id[0] }}</strong>
                      </span>
                    </div>
                </div>

                <div class="col-md-2 col-sm-2">
                    <div class="form-group">
                        <input type="number" v-model="prestacion_farmaco.cantidad" class="form-control input-lg">
                        <span v-if="errors && errors.cantidad"  class="text-danger" role="alert">
                          <strong>{{ errors.cantidad[0] }}</strong>
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
                      <multiselect v-model="form.consulta_reposo_id" track-by="id" label="nombre" placeholder="Amerita Salida" :options="consulta_reposos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.consulta_reposo_id"  class="text-danger" role="alert">
                        <strong>{{ errors.consulta_reposo_id[0] }}</strong>
                      </span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea v-model="form.observacion" cols="30" rows="2" class="form-control" :class="{ 'is-invalid': errors.observacion }"></textarea>
                        <span v-if="errors && errors.observacion"  class="text-danger" role="alert">
                        <strong>{{ errors.observacion[0] }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            


            <template v-if="form.consulta_tipo_id.id == 1">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Asociar consulta con ausentismo</label>
                        <multiselect v-model="form.ausentismo_id" track-by="id" label="nombre" placeholder="Ausentismo" :options="ausentismos_trabajador" :searchable="true" :allow-empty="false" :multiple="false" :custom-label="customLabel" :show-labels="false">
                                <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">{{ props.option.fecha_ausente }} {{ props.option.motivo }} </span></span></template>
                        </multiselect>
                        <span v-if="errors && errors.ausentismo_id"  class="text-danger" role="alert">
                            <strong>{{ errors.ausentismo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                                <label>Especialidad*</label>
                        <multiselect required v-model="form.consulta_motivo_id" track-by="id" label="nombre" placeholder="Especialidad" :options="consulta_motivos" :searchable="true" :allow-empty="false" :multiple="false" @select="fetchDiagnostico"></multiselect>
                        <span v-if="errors && errors.consulta_motivo_id"  class="text-danger" role="alert">
                            <strong>{{ errors.consulta_motivo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Diagnóstico*</label>
                            <multiselect required v-model="form.diagnostico_id" track-by="id" label="diagnostico" placeholder="Ausentismo" :options="diagnosticos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                            <span v-if="errors && errors.diagnostico_id"  class="text-danger" role="alert">
                                <strong>{{ errors.diagnostico_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Tension Art.</label>
                            <input type="text" v-model="form.tension_arterial" class="form-control input-lg" placeholder="Tension Art.">
                            <span v-if="errors && errors.tension_arterial"  class="text-danger" role="alert">
                            <strong>{{ errors.tension_arterial[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Frecuencia Card.</label>
                            <input type="text" v-model="form.frecuencia_cardiaca" class="form-control input-lg" placeholder="Frecuencia Card.">
                            <span v-if="errors && errors.frecuencia_cardiaca"  class="text-danger" role="alert">
                            <strong>{{ errors.frecuencia_cardiaca[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" v-model="form.peso" class="form-control input-lg" placeholder="Peso">
                            <span v-if="errors && errors.peso"  class="text-danger" role="alert">
                            <strong>{{ errors.peso[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Altura</label>
                            <input type="text" v-model="form.altura" class="form-control input-lg" placeholder="Altura">
                            <span v-if="errors && errors.altura"  class="text-danger" role="alert">
                            <strong>{{ errors.altura[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Glucemia</label>
                            <input type="text" v-model="form.glucemia" class="form-control input-lg" placeholder="Glucemia">
                            <span v-if="errors && errors.glucemia"  class="text-danger" role="alert">
                            <strong>{{ errors.glucemia[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Saturacion Oxigeno</label>
                            <input type="text" v-model="form.saturacion_oxigeno" class="form-control input-lg" placeholder="Saturacion Oxigeno">
                            <span v-if="errors && errors.saturacion_oxigeno"  class="text-danger" role="alert">
                            <strong>{{ errors.saturacion_oxigeno[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Anamnesis</label>
                            <textarea v-model="form.entrevista" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.entrevista }"></textarea>
                            <span v-if="errors && errors.entrevista"  class="text-danger" role="alert">
                            <strong>{{ errors.entrevista[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Examen fisico</label>
                            <textarea v-model="form.examen_fisico" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.examen_fisico }"></textarea>
                            <span v-if="errors && errors.examen_fisico"  class="text-danger" role="alert">
                            <strong>{{ errors.examen_fisico[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Tratamiento</label>
                            <textarea v-model="form.tratamiento" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.tratamiento }" ></textarea>
                            <span v-if="errors && errors.tratamiento"  class="text-danger" role="alert">
                            <strong>{{ errors.tratamiento[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Plan a seguir*</label>
                            <textarea required v-model="form.plan" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.plan }"></textarea>
                            <span v-if="errors && errors.plan"  class="text-danger" role="alert">
                            <strong>{{ errors.plan[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Examen complementario</label>
                            <textarea v-model="form.examenes_complementarios" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.examenes_complementarios }"></textarea>
                            <span v-if="errors && errors.examenes_complementarios"  class="text-danger" role="alert">
                            <strong>{{ errors.examenes_complementarios[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Diagnostico</label>
                            <textarea required v-model="form.diagnostico" cols="30" rows="4" class="form-control" :class="{ 'is-invalid': errors.diagnostico }"></textarea>
                            <span v-if="errors && errors.diagnostico"  class="text-danger" role="alert">
                            <strong>{{ errors.diagnostico[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="form.consulta_tipo_id.id == 2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Asociar consulta con ausentismo</label>
                        <multiselect v-model="form.ausentismo_id" track-by="id" label="fecha_ausente" placeholder="Ausentismo" :options="ausentismos_trabajador" :searchable="true" :allow-empty="false" :multiple="false">
                                <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">{{ props.option.fecha_ausente }}</span></span></template>
                        </multiselect>
                        <span v-if="errors && errors.ausentismo_id"  class="text-danger" role="alert">
                            <strong>{{ errors.ausentismo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                                <label>Especialidad*</label>
                        <multiselect v-model="form.consulta_motivo_id" track-by="name" label="nombre" placeholder="Especialidad" :options="consulta_motivos" :searchable="true" :allow-empty="false" :multiple="false" @select="fetchDiagnostico"></multiselect>
                        <span v-if="errors && errors.consulta_motivo_id"  class="text-danger" role="alert">
                            <strong>{{ errors.consulta_motivo_id[0] }}</strong>
                        </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Diagnóstico*</label>
                            <multiselect v-model="form.diagnostico_id" track-by="id" label="diagnostico" placeholder="Ausentismo" :options="diagnosticos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                            <span v-if="errors && errors.diagnostico_id"  class="text-danger" role="alert">
                                <strong>{{ errors.diagnostico_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Tension Art.</label>
                            <input type="text" v-model="form.tension_arterial" class="form-control input-lg" placeholder="Tension Art.">
                            <span v-if="errors && errors.tension_arterial"  class="text-danger" role="alert">
                            <strong>{{ errors.tension_arterial[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Frecuencia Card.</label>
                            <input type="text" v-model="form.frecuencia_cardiaca" class="form-control input-lg" placeholder="Frecuencia Card.">
                            <span v-if="errors && errors.frecuencia_cardiaca"  class="text-danger" role="alert">
                            <strong>{{ errors.frecuencia_cardiaca[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" v-model="form.peso" class="form-control input-lg" placeholder="Peso">
                            <span v-if="errors && errors.peso"  class="text-danger" role="alert">
                            <strong>{{ errors.peso[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Altura</label>
                            <input type="text" v-model="form.altura" class="form-control input-lg" placeholder="Altura">
                            <span v-if="errors && errors.altura"  class="text-danger" role="alert">
                            <strong>{{ errors.altura[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Glucemia</label>
                            <input type="text" v-model="form.glucemia" class="form-control input-lg" placeholder="Glucemia">
                            <span v-if="errors && errors.glucemia"  class="text-danger" role="alert">
                            <strong>{{ errors.glucemia[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label>Saturacion Oxigeno</label>
                            <input type="text" v-model="form.saturacion_oxigeno" class="form-control input-lg" placeholder="Saturacion Oxigeno">
                            <span v-if="errors && errors.saturacion_oxigeno"  class="text-danger" role="alert">
                            <strong>{{ errors.saturacion_oxigeno[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea v-model="form.enfermeria" cols="30" rows="2" class="form-control" :class="{ 'is-invalid': errors.enfermeria }"></textarea>
                            <span v-if="errors && errors.enfermeria"  class="text-danger" role="alert">
                            <strong>{{ errors.enfermeria[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div slot="footer" class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionCreate.close()">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</modal>
