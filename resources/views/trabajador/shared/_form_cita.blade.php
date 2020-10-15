<modal ref="actionCreateCita" size="small">
        <form slot="form" action="" method="post" @submit.prevent="newStoreCita">
            <div slot="title" class="modal-header">
            <h4 class="modal-title">Nueva cita</h4>
            </div>
            <div slot="body" class="modal-body">

            </div>
                
            <div slot="footer" class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionCreateCita.close()">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
</modal>