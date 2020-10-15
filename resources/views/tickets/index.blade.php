@extends('adminlte::layouts.vue')

@isset($empresa->nombre)
	@section('titulo', 'Gestion de tickets de '. $empresa->nombre)
@endisset

@isset($trabajador)
	@section('titulo', 'Gestion de tickets de '. $trabajador->nombre. ' '.$trabajador->apellido)
@endisset


@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

<div id="app">
    <loader v-show="isLoading"></loader>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
					<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de tickets</li>
        </ol>
    </nav>
    @include('tickets.partials._created')
    @include('tickets.partials._edit')
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                  Gestión de tickets
              </h3>
              <div class="box-tools pull-right">
                <a href="#" class="btn btn-primary" style="margin-bottom:25px" @click="newTicket">Nuevo ticket</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>Estado</td>
                        <td>Abierto por</td>
                        <td>Relativo a</td>
                        <td>Motivo</td>
                        <td>Ultimo comentario</td>
                        <td>Cerrado por</td>
                        <td>acciones</td>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-if="tickets.length > 0" v-for="ticket in tickets">
                            <td>
                                <a v-if="ticket.status == 1" href="#" class="btn btn-primary">Abierto</a>
                                <a v-if="ticket.status == 0" class="btn btn-danger">Cerrado</a>
                            </td>
                            <td>
                              @{{ ticket.user.name }}
                            </td>

                            <td>
                              @{{ ticket.empresa.nombre }}
                            </td>

                            <td>
                              @{{ ticket.motivo }}
                            </td>

                            <td v-if="ticket.comentario">
                              <template v-for="comment in ticket.comentario"> @{{ comment.comentarios }} </template>
                            </td>

                            <td>
                              @{{ ticket.action_user }}
                            </td>

                            <td>
                              <a class="btn btn-warning" title="Editar ticket" href="#" @click="getEditTicket(ticket)"><i title="Editar ticket" class="fa fa-pencil"></i></a>
                              <a :href="'/empresa/ticket/' + ticket.id + '/' + ticket.empresa.id  + '/comentarios'" target="_blank"><button class="btn btn-success"><i title="Ver comentarios" class="fa fa-commenting-o"></i></button></a>
                              <button type="submit" class="btn btn-danger delete-confirm" @click="destroyTicket(ticket.id)">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                        </tr>
                        <tr v-if="tickets.total == 0">
                          <td colspan="7" class="text-center text-blue">Ningún dato disponible en esta tabla</td>
                        </tr>
                       
                    </tbody>
                </table>
                <pagination :data="pagination" @pagination-change-page="getAllTicketsJson"></pagination>
            </div>
          </div>
        </div>
    </div>
</div>  
@endsection

@push('script')
  <script>
    const swalWithBootstrapButtons = swal.mixin({
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
    })
    //Instaciamos VUE
    const app = new Vue({
      el: '#app',
      data() {
        return {
          tickets: [],
          pagination: {
            links: '',
            meta: ''
          },
          ticket: {
            motivo: '',
            observacion: '',
            roles: ''
          },
            form: {
                motivo: '',
                observacion: '',
                roles: ''
            },
          roles: [],
          editarTicket: false,
          errors: '',
          isLoading: false
        }
      },
      created() {
        this.getAllTicketsJson(1);
      },
      methods: {
        getAllRoles () {
          axios.get("{{ route('roles.json') }}").then(response => {
            this.roles = response.data.roles
          })
        },
        getAllTicketsJson (page) {
          this.isLoading = true
          axios.get("{{ route('tickets.json', ['id' => $empresa->id]) }}?page=" + page).then (response => {
            this.tickets = response.data.data
            this.pagination.links = response.data.links
            this.pagination.meta = response.data.meta
            this.isLoading = false
          })
        },
        newTicket() {
          this.$refs.actionCreate.open();
        },
        storeTicket() {
          this.isLoading = true
          this.$refs.actionCreate.close();
          axios.post("{{ route('empresa.ticket-empresa.store') }}",  {motivo: this.form.motivo, observacion: this.form.observacion, empresa_id: empresa.id, roles: this.form.roles, user_id: user_id} ).then(response => {
            this.form.motivo = ''
            this.form.observacion = ''
            this.form.roles = []
            this.isLoading = false
            this.$refs.actionCreate.open();
          }).catch(err =>  {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors || {};
              this.isLoading = false
              this.$refs.actionCreate.open();
            } else {
              this.isLoading = false
              this.errorMessage("Algo fallo intente nuevamente")
              this.$refs.actionCreate.open();
            }

          })
        },
        editTicket () {
          this.isLoading = true
          this.$refs.actionEdit.close();
          axios.put('/api/tickets/' + this.ticket.id + '/update', {motivo: this.ticket.motivo, observacion: this.ticket.observacion, empresa_id: empresa.id, roles: this.ticket.roles, user_id: user_id})
          .then(response => {
            this.ticket.motivo = ''
            this.ticket.observacion = ''
            this.ticket.roles = []
            this.isLoading = false
            this.$refs.actionEdit.close();
            this.getAllTicketsJson();
          }).catch(err =>  {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors || {};
              this.isLoading = false
              this.$refs.actionEdit.open();
            } else {
              this.isLoading = false
              this.errorMessage("Algo fallo intente nuevamente");
              this.$refs.actionEdit.open();
            }

          })
        },
        getEditTicket(ticket) {
          this.ticket = ticket
          this.$refs.actionEdit.open();     
        },
        destroyTicket(id) {
          swalWithBootstrapButtons({
            title: 'Desea eliminar el registro?',
            text: "Al eliminar esto no hay vuelta atras!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            //Acepto eliminar el registro
            if (result.value) {
              axios.delete('/api/tickets/'+ id + '/destroy').then(result => {
                sweetAlert('Eliminado', result.data.message, 'success');
                this.getAllTicketsJson()
              })
            } else if (
              result.dismiss === swal.DismissReason.cancel
              ){
                swalWithBootstrapButtons(
                  'Cancelada',
                  'La operacion a sido cancelada',
                  'error'
                )
              }
            })
        },
        successMessage(message){
          swal("Exito!", message, "success");   
        },
        errorMessage(message){
          swal("Error!", message, "error");   
        },
      },
    });
  </script>
@endpush
