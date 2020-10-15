@extends('adminlte::layouts.vue')
@section('titulo', 'Gestion de consultas de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')




<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a
				href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de
				{{ $empresa->nombre }}</a></li>
		<li class="breadcrumb-item" aria-current="page"> <a
				href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado
				de trabajadores</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a
				href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil
				de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Listado de comunicación</li>
	</ol>
</nav>
<div class="card">
	@include('trabajador.profile.partials.nav_menu_empresa')
	<div class="card-body">
		<div class="row" id="app">

			<div class="col-md-3">

				<worker-panel trabajador="{{ $trabajador->nombre }}  {{ $trabajador->apellido }}"
					url-foto="{{ ($trabajador->photo != "") ? asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' ) }}"
					sector="{{ $trabajador->sector->nombre or '' }}" tarea="{{ $trabajador->tarea->nombre or '' }}"
					turno="{{ $trabajador->turno->nombre or ''}}" empresa_id="{{ $empresa->id }}"
					user_id=" {{ auth()->user()->id }}" trabajador_id="{{ $trabajador->id }}">


					<template slot="info-trabajador">
						<div class="text-center">
							@if($ausente->count() >=1)
							<button class="btn btn-danger"></button>
							@foreach($ausente as $row)
							{{ $row->ausentismo_tipo->nombre }}
							@endforeach
							{{  $ausente->sum('dias_ausente') }} días
							@else
							<button class="btn btn-success"></button> Trabajando
							@endif
							<br /><br />
							@if(isset($cita->start_date))
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							Proxima cita: {{ $cita->start_date or '' }}
							@endif


						</div>


						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Documento:</b> <a
									class="pull-right">{{ $trabajador->documento or 'No disponible'}}</a>
							</li>
							<li class="list-group-item">
								<b>{{ $trabajador->obrasocial->nombre or 'No disponible'}}:</b> <a
									class="pull-right">{{ $trabajador->numero_afiliado or 'No disponible'}}</a>
							</li>
							<li class="list-group-item">
								<b>Direccion: </b> <a
									class="pull-right">{{ $trabajador->observacion_direccion or 'No disponible'}}
									{{ $trabajador->localidad->nombre  or ''}}</a>
							</li>
							<li class="list-group-item">
								<b>Celular: </b> <a class="pull-right">{{ $trabajador->celular or 'No disponible'}}</a>
							</li>
							<li class="list-group-item">
								<b>Telefono: </b> <a
									class="pull-right">{{ $trabajador->telefono or 'No disponible'}}</a>
							</li>
							<li class="list-group-item">
								<b>Agentes de riesgo declarados según puesto: </b>
								@if (!empty($trabajador->tarea->agente_riesgo_tarea))
								@foreach($trabajador->tarea->agente_riesgo_tarea as $agente_riesgo)
								<button type="button"
									class="btn btn-block btn-warning btn-sm">{{$agente_riesgo['agente_riesgo'] or ''}}</button>
								@endforeach
								@endif
							</li>
						</ul>

						{{-- <div class="text-center">
						<a class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i><b>Editar</b></a>
					</div> --}}

					</template>

				</worker-panel>
			</div>

			<div class="col-md-9">
				<loader v-show="isLoading"></loader>
				@include('trabajador.consulta.partials._created')
				@include('trabajador.consulta.partials._edit')
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Gestion de consultas</h3>
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-primary  dropdown-toggle" @click="newRow">Nueva
								consulta</button>

						</div>

					</div>


					<div class="box-body table-responsive">
						<vuetable ref="vuetable"
							api-url="/api/consultas/trabajador?empresa_id={{ $empresa->id }}&trabajador_id={{ $trabajador->id }}"
							:fields="fields" pagination-path="" :css="css.table" :append-params="moreParams"
							:sort-order="sortOrder" @vuetable:pagination-data="onPaginationData"
							@vuetable:loading="onLoading" @vuetable:loaded="onLoaded">
							<template slot="actions" slot-scope="props">
								<div class="btn-group-sm">
									<button class="btn btn-warning btn-sm" @click="editRow(props.rowData)">
										<span class="glyphicon glyphicon-pencil"></span></button>
									<button class="btn btn-danger btn-sm" @click="deleteRow(props.rowData)">
										<span class="glyphicon glyphicon-trash"></span></button>
								</div>
							</template>
						</vuetable>
						<vuetable-pagination ref="pagination" :css="css.pagination"
							@vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
					</div>
				</div>
				{{-- <div class="box box-info">
				   <div class="box-header">
					 <h3 class="box-title">Gestion de consultas</h3>

					<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newConsulta" style="margin-bottom:25px">Nueva consulta</a>
				   </div>
				   <div class="box-body table-responsive">
					   <table class="table table-striped table-bordered" id="empresa-consultas">
						   <thead>
							   <tr>
								   <td>Fecha y hora</td>
								   <td>Nombre y apellido</td>
								   <td>Tipo de consulta</td>
								   <td>Motivo de consulta</td>
								   <td>Profesional</td>
								   <td>Observaciones</td>
								   <td>Salida</td>
								   <td style="width:  20%">Acciones</td>
							   </tr>
						   </thead>
						   <tbody>
							   @foreach($trabajador->consulta AS $consulta)

								   <tr id="consulta_trabajador_{{ $consulta->id }}">
				<td>{{ $consulta->created_at }}</td>
				<td>{{ $consulta->trabajador->nombre }} {{ $consulta->trabajador->apellido }}</td>
				<td>{{ $consulta->consulta_tipo->nombre or '' }}</td>
				<td>{{ $consulta->consulta_motivo->nombre or '' }}</td>
				<td>{{ $consulta->user->nombre or '' }}</td>
				<td>{{ $consulta->observacion or '' }}</td>
				<td>{{ $consulta->consulta_reposo->nombre or '' }}</td>
				<td style="width:  20%">
					<a class="btn btn-primary waves-effect waves-light"
						href="{{route('trabajador.consulta.view', ['id' => $consulta->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $consulta->trabajador->id ])}}"><i
							title="ver consulta" class="fa fa-eye"></i></a>

					{!! method_field('DELETE') !!}
					@csrf
					<input type="hidden" name="trabajador_id" value="{{ $consulta->trabajador->id }}">
					<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
					<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $consulta->id}}"
						data-href="{{ route('trabajador.consulta.destroy', ['id' => $consulta->id]) }}">
						<i class="fa fa-trash"></i>
					</button>

					<a class="btn btn-warning" title="Edit" href="#editConsulta" data-toggle="modal"
						data-href="{{route('trabajador.consulta.edit', ['id' => $consulta->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $consulta->trabajador->id ])}}"><i
							title="Editar consulta" class="fa fa-pencil"></i></a>

				</td>
				</tr>
				@endforeach
				</tbody>
				</table>
			</div>
		</div> --}}

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
	new Vue({
		el: '#app',
		data() {
			return {
				consultas: '',
				isLoading: false,
				edit: false,
				sortOrder: [
					{ field: 'created_at', direction: 'desc' }
				],
				moreParams: {},
				errors: '',
				consulta_reposos: [],
				consulta_motivos: [],
				consulta_tipos: [],
				prestacion_farmacias: [],
				ausentismos_trabajador: [],
				diagnosticos: [],
				trabajador_id: {{ $trabajador->id }},
				form: {
					consulta_tipo_id: {
						id: ''
					},
					ausentismo_id: '',
					consulta_motivo_id: '',
					diagnostico_id: '',
					tension_arterial: '',
					frecuencia_cardiaca: '',
					peso: '',
					altura: '',
					glucemia: '',
					saturacion_oxigeno: '',
					examen_fisico: '',
					entrevista: '',
					examenes_complementarios: '',
					diagnostico: '',
					tratamiento: '',
					plan: '',
					enfermeria: '',
					cantidad: '',
					consulta_reposo_id: '',
					observacion: ''
				},
				prestacion_farmacos: [],
				prestacion_farmaco: {
					prestacion_farmacia_droga_id: '',
					cantidad: ''
				},
				fields: [
					{
						name: 'created_at',
						title: 'Fecha y hora',
						sortField: 'created_at'
					},
					{
						name: 'trabajador.nombre',
						title: 'Nombre y apellido'
					},
					{
						name: 'consulta_tipo.nombre',
						title: 'Tipo de consulta'
					},
					{
						name: 'consulta_motivo.nombre',
						title: 'Motivo'
					},
					{
						name: 'user.nombre',
						title: 'Profesional'
					},
					{
						name: 'observacion',
						title: 'Observaciones'
					},
					{
						name: 'consulta_reposo.nombre',
						title: 'Salida'
					},
					'__slot:actions'
				],
				css: {
							table: {
								tableClass: 'table table-striped table-bordered',
								loadingClass: 'loading',
								ascendingIcon: 'glyphicon glyphicon-chevron-up',
								descendingIcon: 'glyphicon glyphicon-chevron-down',
								handleIcon: 'glyphicon glyphicon-menu-hamburger',
							},
							pagination: {
								infoClass: 'pull-left',
								wrapperClass: 'vuetable-pagination pull-right',
								activeClass: 'btn-primary',
								disabledClass: 'disabled',
								pageClass: 'btn btn-border',
								linkClass: 'btn btn-border',
								icons: {
								first: '',
								prev: '',
								next: '',
								last: '',
								},
							}
						}
			}
		},

		mounted: function () {
			this.prestacion_farmacos = [{prestacion_farmacia_droga_id: '', cantidad: ''}]
		},
		
		methods: {
			deleteRow (row) {
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
                    axios.delete('/api/consultas/'+ row.id + '/destroy', { empresa_id: empresa.id }).then(result => {
                        sweetAlert('Eliminado', result.data.message, 'success');
                        Vue.nextTick( () => this.$refs.vuetable.refresh())
                    })
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelada',
						'La operacion a sido cancelada',
						'error'
                    )
                }
           	 })
			},

			fetchConsultaReposo () {
				axios.get("{{ route('consulta-reposo.json') }}").then((result) => {
					this.consulta_reposos = result.data
				}).catch((err) => {
					
				});
			},
			fetchConsultaMotivo () {
				axios.get("{{ route('consulta-motivo.json') }}").then((result) => {
					this.consulta_motivos = result.data
				}).catch((err) => {
					
				});
			},

			fetchConsultaTipo () {
				axios.get("{{ route('consulta-tipo.json') }}").then((result) => {
					this.consulta_tipos = result.data
				}).catch((err) => {
					
				});
			},

			fetchDiagnostico (motivo_id) {
				axios.get("/api/diagnostico/" + motivo_id.id + "/json").then((result) => {
					this.diagnosticos = result.data
				}).catch((err) => {
					
				});
			},

			fetchPrestacionFarmaciaDroga () {
				axios.get("{{ route('getPrestacionFarmacoEmpresa.json') }}?empresa_id={{ $empresa->id }}").then((result) => {
					this.prestacion_farmacias = result.data
				}).catch((err) => {
					
				});
			},

			fetchAusentismoTrabajador () {
				axios.get("{{ route('getAusentismoTrabajador.json') }}?trabajador_id={{ $trabajador->id }}").then((result) => {
					this.ausentismos_trabajador = result.data
				}).catch((err) => {
					
				});
			},

			addNewFarmaco () {
				this.prestacion_farmacos.push(Vue.util.extend({}, this.prestacion_farmaco))
			},

			removeFarmaco: function (index) {
				Vue.delete(this.prestacion_farmacos, index);
			},

			openRecourses() {
				this.fetchConsultaMotivo()
				this.fetchConsultaReposo()
				this.fetchConsultaTipo()
				//this.fetchDiagnostico()
				this.fetchPrestacionFarmaciaDroga()
				this.fetchAusentismoTrabajador()
			},
			newRow () {
				this.$refs.actionCreate.open();
			},
			editRow (row) {
				this.consultas = row
				if (!this.consultas.consulta_prestacion_farmacia_droga.length) {
					this.consultas.consulta_prestacion_farmacia_droga = [{prestacion_farmacia_droga_id: '', cantidad: ''}]
				} else {
					for (const key in this.consultas.consulta_prestacion_farmacia_droga) {
						if (this.consultas.consulta_prestacion_farmacia_droga.hasOwnProperty(key)) {
							this.consultas.consulta_prestacion_farmacia_droga[key].cantidad = this.consultas.consulta_prestacion_farmacia_droga[key].pivot.cantidad;
							console.log(this.consultas);
							
						}
					}
				}
				
				this.$refs.actionEdit.open();
			},

			inc(property, index){
				this.prestacion_farmacos[index].cantidad++				
			},
			dec(property, index){
				if (this.prestacion_farmacos[index].cantidad === 1) return
				this.prestacion_farmacos[index].cantidad --;
			},
			newStoreConsulta () {
				this.isLoading = true
				this.$refs.actionCreate.close();
				axios.post("{{ route('consulta.trabajador.store') }}",  {empresa_id: empresa.id, user_id: user_id, trabajador_id: this.trabajador_id, consulta: this.form, prestacion_farmacos: this.prestacion_farmacos } ).then(response => {
					
					this.isLoading = false
					this.$refs.actionCreate.close();
					this.successMessage("Registro creado exitosamente");
					Vue.nextTick( () => this.$refs.vuetable.refresh())
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
			updateConsulta () {
				this.isLoading = true
				this.$refs.actionEdit.close();
				axios.patch('/api/consultas/' + this.consultas.id +'/update',  {empresa_id: empresa.id, trabajador_id: this.trabajador_id, consulta: this.consultas } ).then(response => {
					this.isLoading = false
					this.$refs.actionEdit.close();
					this.successMessage("Registro actualizado exitosamente");
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				}).catch(err =>  {
					if (err.response.status === 422) {
						this.errors = err.response.data.errors || {};
						this.isLoading = false
						this.$refs.actionEdit.open();
					} else {
						this.isLoading = false
						this.errorMessage("Algo fallo intente nuevamente")
						this.$refs.actionEdit.open();
					}

				})
			},
			customLabel ({ fecha_ausente, motivo}) {
			return `${fecha_ausente} ` + " - " + `${motivo}`
			},
			onPaginationData (paginationData) {
						this.$refs.pagination.setPaginationData(paginationData)
					},
			onChangePage (page) {
				this.$refs.vuetable.changePage(page)
			},
			onLoading() {
				this.isLoading = true
			},
			onLoaded() {
				this.isLoading = false
			},
			successMessage(message){
                swal("Exito!", message, "success");   
            },

            errorMessage(message){
                swal("Error!", message, "error");   
            },
		},
	})
</script>
@endpush