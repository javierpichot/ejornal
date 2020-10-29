<modal ref="actionCreate" size="large" :opened="openRecourses">
    <form slot="form" action="" method="post" @submit.prevent="newStoreComunicacion">
        <div slot="title" class="modal-header">
            <h4 class="modal-title">Crear nueva comunicacion</h4>
        </div>
        <div slot="body" class="modal-body">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <multiselect v-model="form.remitente_id" track-by="id" label="nombre" placeholder="Remitente" :options="remitentes" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                    <span v-if="errors && errors.remitente_id"  class="text-danger" role="alert">
                      <strong>{{ errors.remitente_id[0] }}</strong>
                    </span>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <multiselect v-model="form.modo_comunicacion_id" track-by="id" label="nombre" placeholder="Modo de comunicacion" :options="modos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.modo_comunicacion_id"  class="text-danger" role="alert">
                        <strong>{{ errors.modo_comunicacion_id[0] }}</strong>
                      </span>
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <multiselect v-model="form.motivo_comunicacion_id" track-by="name" label="nombre" placeholder="Motivo comunicacion" :options="motivos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.motivo_comunicacion_id"  class="text-danger" role="alert">
                        <strong>{{ errors.motivo_comunicacion_id[0] }}</strong>
                      </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Contenido de la comunicacion</label>
                    <textarea v-model="form.contenido" cols="30" rows="10" class="form-control" :class="{ 'is-invalid': errors.contenido }" required></textarea>
                    <span v-if="errors && errors.contenido"  class="text-danger" role="alert">
                      <strong>{{ errors.contenido[0] }}</strong>
                    </span>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <multiselect v-model="form.ausentismo_id" track-by="id" label="fecha_ausente" placeholder="Asociar comunicación con episodio de ausentismo" :options="ausentismos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.ausentismo_id"  class="text-danger" role="alert">
                        <strong>{{ errors.ausentismo_id[0] }}</strong>
                      </span>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <multiselect v-model="form.documentacion_id" track-by="id" label="nombre" placeholder="Asociar comunicación con documentacion aportada" :options="documentos" :searchable="true" :allow-empty="false" :multiple="false"></multiselect>
                      <span v-if="errors && errors.documentacion_id"  class="text-danger" role="alert">
                        <strong>{{ errors.documentacion_id[0] }}</strong>
                      </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Observaciones de la comunicacion</label>
                    <textarea v-model="form.observacion" cols="30" rows="10" class="form-control" :class="{ 'is-invalid': errors.observacion }" required></textarea>
                    <span v-if="errors && errors.observacion"  class="text-danger" role="alert">
                      <strong>{{ errors.observacion[0] }}</strong>
                    </span>
                  </div>
                </div>
            </div>
        </div>
        <div slot="footer" class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionCreate.close()">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</modal>
