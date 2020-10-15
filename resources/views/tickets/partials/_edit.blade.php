    <modal ref="actionEdit" :need-header="false" size="medium" :opened="getAllRoles">
        <form slot="form" action="" method="post" @submit.prevent="editTicket">
            <div slot="title" class="modal-header">
                <h4 class="modal-title">Crear ticket</h4>
            </div>
            <div slot="body" class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <multiselect v-model="ticket.roles" track-by="name" label="name" placeholder="Seleccione un rol" :options="roles" :searchable="true" :allow-empty="false" :multiple="true"></multiselect> 
                        <span v-if="errors && errors.roles"  class="text-danger" role="alert">
                          <strong>@{{ errors.roles[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Motivo</label>
                        <input type="text" v-model="ticket.motivo" class="form-control" :class="{ 'is-invalid': errors.motivo }" required>
                        <span v-if="errors && errors.motivo"  class="text-danger" role="alert">
                          <strong>@{{ errors.motivo[0] }}</strong>
                        </span>
                      </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Observacion</label>
                        <textarea v-model="ticket.observacion" cols="30" rows="10" class="form-control" :class="{ 'is-invalid': errors.observacion }" required></textarea>
                        <span v-if="errors && errors.observacion"  class="text-danger" role="alert">
                          <strong>@{{ errors.observacion[0] }}</strong>
                        </span>
                      </div>
                    </div>
                </div>
            </div>
            <div slot="footer" class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionEdit.close()">Cerrar</button>
          
                <button type="submit" class="btn btn-success">Editar ticket</button>
            </div>
        </form>
    </modal>