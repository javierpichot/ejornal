<template>
    <div>
        <modal ref="actionCreateCita" size="medium" color="modal-info">
                <form slot="form" action="" method="post" @submit.prevent="newStoreCita">
                    <div slot="title" class="modal-header">
                        <h4 class="modal-title">Nueva cita</h4>
                    </div>
                    <div slot="body" class="modal-body">
                        <div v-if="existe" class="alert alert-info" role="alert">
                           {{ existe }}
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                               <label>Fecha cita</label>
                                <datetime 
                                    value-zone="America/New_York"
                                    zone="Asia/Shanghai"
                                    v-model="form_cita.start_date"
                                    :input-class="'form-control'"
                                    :format="{ year: 'numeric', month: 'long', day: 'numeric' }"
                                    ></datetime>
                                <span v-if="errors && errors['cita.start_date']"  class="text-danger" role="alert">
                                    <strong>{{ errors['cita.start_date'][0] }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Hora cita</label>
                                <datetime 
                                    type="time"
                                    v-model="form_cita.start_time"
                                    :input-class="'form-control'"
                                    :format="{ hour: '2-digit', minute: '2-digit', hour12: false }"
                                    ></datetime>
                                <span v-if="errors && errors['cita.start_time']"  class="text-danger" role="alert">
                                    <strong>{{ errors['cita.start_time'][0] }}</strong>
                                </span>
                            </div>

                            
                        </div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-12 col-sm-12">
                                <textarea v-model="form_cita.description" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                                <span v-if="errors && errors['cita.description']"  class="text-danger" role="alert">
                                    <strong>{{ errors['cita.description'][0] }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                        
                    <div slot="footer" class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$refs.actionCreateCita.close()">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
        </modal>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle"
                     :src="urlFoto"
                     :alt="trabajador">
                <h3 class="profile-username text-center">{{ trabajador }}</h3>
                <div align="center">
                    <slot name="info"></slot>
                </div>

                <div class="text-center">
                    <a class="btn btn-primary" @click="newCita"><i class="fa fa-clock-o" aria-hidden="true"></i> <b> Nueva
										cita</b> </a>
                </div>

                <div align="center">
                    <a title="Sector">{{ sector }}</a> / <a
                        title="tarea">{{ tarea }} </a>/ <a
                        title="Turno"> {{ turno }}</a>
                </div>
                

                <slot name="info-trabajador"></slot>
            </div>
        </div>
    </div>
</template>

<script>
import modal from './Modal'
import { DateTime as LuxonDateTime } from 'luxon'
    export default {
        name: "WorkerPanel",
        props: {
            trabajador: {
                type: String,
                default: ''
            },
            urlFoto: {
                type: String,
                default: true
            },
            sector: {
                type: String,
                default: ''
            },
            tarea: {
                type: String,
                default: ''
            },
            turno: {
                type: String,
                default: ''
            },
            empresa_id: {
                type: String,
                default: ''
            },
            user_id: {
                type: String,
                default: ''
            },
            trabajador_id: {
                type: String,
                default: ''
            }

        },

        data() {
            return {
                form_cita: {
                    start_date: '',
                    start_time: '',
                    description: '',
                },
                errors: '',
                existe: '',
                datetimeTheming: LuxonDateTime.local().toLocaleString(LuxonDateTime.TIME_SIMPLE),
                zone:  'Local'


            }
        },

        components: {
            modal
        },

        computed: {
            fechaCita () {
                let format = ""

                if (!format) {
                   format = LuxonDateTime.TIME_24_SIMPLE
                }
                return moment.parseZone(this.form_cita.start_time).local().format('HH:mm:ss');
            },
        },
        
        methods: {
            newCita() {
				this.$refs.actionCreateCita.open()
            },
            newStoreCita () {
				axios.post("/api/cita/store",  {empresa_id: empresa.id, user_id: user_id, trabajador_id: this.trabajador_id, cita: this.form_cita, fecha_cita: this.fechaCita } ).then(response => {

                    this.$refs.actionCreateCita.close();
                    this.form_cita.start_date = ""
                    this.form_cita.start_time = ""
                    this.form_cita.description = ""
                    window.open(response.data.redirect_url, '_blank');
				}).catch(err =>  {
                    this.$refs.actionCreateCita.open();
					if (err.response.status === 422) {
                        this.errors = err.response.data.errors || {};
					} else {                  
                        this.existe = err.response.data.text
					}

				})
            },
            successMessage(message){
                swal("Exito!", message, "success");   
            },

            errorMessage(message){
                swal("Error!", message, "error");   
            }
        },
    }
</script>

<style scoped>
    .mb-3 {
        margin-bottom: 3rem
    }
    .mt-3 {
         margin-top: 3rem
    }
</style>