@extends('adminlte::layouts.vue')
@section('titulo', 'Gestion de comunicaciones de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@push('styles')
	<!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker.min.css') }}">
@endpush
@section('main-content')
	<div>
			<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
						<li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
													<li class="breadcrumb-item active" aria-current="page">Listado de comunicación</li>		 </ol>
			   </nav>
			<div class="card">
							 @include('trabajador.profile.partials.nav_menu_empresa')
						   <div class="card-body">
			   <div class="row" id="app">
				    
				   <div class="col-md-3">
				   <worker-panel trabajador="{{ $trabajador->nombre }}  {{ $trabajador->apellido }}" url-foto="{{ ($trabajador->photo != "") ? asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' ) }}" sector="{{ $trabajador->sector->nombre or '' }}" tarea="{{ $trabajador->tarea->nombre or '' }}" turno="{{ $trabajador->turno->nombre or ''}}" empresa_id="{{ $empresa->id }}" user_id=" {{ auth()->user()->id }}" trabajador_id="{{ $trabajador->id }}">
						
							
						<template slot="info-trabajador">
							<div class="text-center" >
								@if($ausente->count() >=1)
									<button class="btn btn-danger"></button>
									@foreach($ausente as $row)
										{{ $row->ausentismo_tipo->nombre }}
									@endforeach
									{{  $ausente->sum('dias_ausente') }} días
								@else
									<button class="btn btn-success"></button> Trabajando
								@endif
									<br/><br/>
								@if(isset($cita->start_date))
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									Proxima cita: {{ $cita->start_date or '' }}
								@endif

								
							</div>


							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Documento:</b> <a class="pull-right">{{ $trabajador->documento or 'No disponible'}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ $trabajador->obrasocial->nombre or 'No disponible'}}:</b> <a
											class="pull-right">{{ $trabajador->numero_afiliado or 'No disponible'}}</a>
								</li>
								<li class="list-group-item">
									<b>Direccion: </b> <a
											class="pull-right">{{ $trabajador->observacion_direccion or 'No disponible'}} {{ $trabajador->localidad->nombre  or ''}}</a>
								</li>
								<li class="list-group-item">
									<b>Celular: </b> <a class="pull-right">{{ $trabajador->celular or 'No disponible'}}</a>
								</li>
								<li class="list-group-item">
									<b>Telefono: </b> <a class="pull-right">{{ $trabajador->telefono or 'No disponible'}}</a>
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
							@include('trabajador.comunicacion.partials._created')
							@include('trabajador.comunicacion.partials._edit')
						 <div class="box box-info">
							  <div class="box-header">
								<h3 class="box-title">Gestion de comunicaciones</h3>
						<div class="btn-group pull-right">
							 <button type="button" class="btn btn-primary  dropdown-toggle"  @click="newRow">Nueva comunicacion</button>
		   
						   </div>
		   
							  </div>
		   
								<div class="box-header">
									<h3 class="box-title">Descargar reporte</h3>
									<div class="btn-group pull-right">
										{!! Form::open(['route' => 'trabajador.getReporteComunicacion']) !!}
										<input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
										<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
									   <div class="col-xs-4">
										   {{ Form::label('fecha_inicio', "Fecha inicio") }}
											<div id="fecha_cita" class="input-group date">
													<span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
													{{ Form::text('fecha_inicio', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha inicio", 'id' => 'fecha_inicio']) }}
												<span class="help-block" id="fecha_inicio"></span>
											</div>
									   </div>
		   
									   <div class="col-xs-4">
										   {{ Form::label('fecha_fin', "Fecha inicio") }}
											<div  class="input-group date">
													<span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
													{{ Form::text('fecha_fin', null, ['class' => 'form-control box-size', 'placeholder' => "Fecha fin", 'id' => 'fecha_fin']) }}
												<span class="help-block" id="fecha_fin"></span>
											</div>
									   </div>
		   
									   <div class="col-xs-4" style="margin-top: 24px">
										   <button type="submit" class="btn btn-primary">Descargar reporte</button>
									   </div>
									   {{ Form::close() }}
									   
		   
									</div>
								</div>
		   
		   
							  <div class="box-body table-responsive">
									<vuetable ref="vuetable"
									api-url="/api/comunicaciones?empresa_id={{ $empresa->id }}&trabajador_id={{ $trabajador->id }}"
									:fields="fields"
									pagination-path=""
									:css="css.table"
									:append-params="moreParams" 
									:sort-order="sortOrder"
									@vuetable:pagination-data="onPaginationData"
									@vuetable:loading="onLoading"        
									@vuetable:loaded="onLoaded"
									>
									<template slot="actions" slot-scope="props">
											<div class="btn-group-sm">
													<button class="btn btn-warning btn-sm" @click="editRow(props.rowData)">
															<span class="glyphicon glyphicon-pencil"></span></button>
													<button class="btn btn-danger btn-sm" @click="deleteRow(props.rowData)">
															<span class="glyphicon glyphicon-trash"></span></button>
											</div>
									</template>
								</vuetable>
									<vuetable-pagination ref="pagination"
									:css="css.pagination"
									@vuetable-pagination:change-page="onChangePage"
									></vuetable-pagination>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
		   </div>
	</div>
@endsection

@push('script')
	<script src="{{ asset('bower_components/bootstrap-datetimepicker.min.js') }}" ></script>
	<!-- Validate -->
	<script src="{{ asset('bower_components/validate/jquery.validate.min.js') }}" ></script>
	<script src="{{ asset('bower_components/validate/localization/messages_es.min.js') }}" ></script>
	<script type="text/javascript">
		const swalWithBootstrapButtons = swal.mixin({
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
					buttonsStyling: false,
				})
			new Vue({
				data() {
					return {
						sort_order: 'asc',
						isLoading: false,
						remitentes: [],
						trabajador_id: {{ $trabajador->id }},
						sortOrder: [
							{ field: 'created_at', direction: 'desc' }
						],
						modos: [],
						motivos: [],
						ausentismos: [],
						documentos: [],
						moreParams: {},
						errors: '',
						comunicacion: '',
						form: {
							remitente_id: '',
							modo_comunicacion_id: '',
							motivo_comunicacion_id: '',
							contenido: '',
							ausentismo_id: '',
							documentacion_id: '',
							observacion: ''
						},
						form_cita: {
							start_date: '',
							start_time: '',
							description: ''
						},
						fields: [
							{
									name: 'created_at',
									title: 'Fecha y hora',
									sortField: 'created_at'
								},
								{
									name: 'remitente.nombre',
									title: 'Remitente'
								},
								{
									name: 'modo_comunicacion.nombre',
									title: 'Modo'
								},
								{
									name: 'motivo_comunicacion.nombre',
									title: 'Motivo'
								},
								{
									name: 'motivo_comunicacion.nombre',
									title: 'Aporto documentacion'
								},
								{
									name: 'contenido',
									title: 'Contenido'
								},
								{
									name: 'user.nombre',
									title: 'Usuario'
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
				methods: {
					newStoreComunicacion () {
						this.isLoading = true
						this.$refs.actionCreate.close();
						axios.post("{{ route('trabajador.comunicacion.store') }}",  {remitente_id: this.form.remitente_id.id, modo_comunicacion_id: this.form.modo_comunicacion_id.id, empresa_id: empresa.id, motivo_comunicacion_id: this.form.motivo_comunicacion_id.id, user_id: user_id, contenido: this.form.contenido, ausentismo_id: this.form.ausentismo_id.id, documentacion_id: this.form.documentacion_id.id, observacion: this.form.observacion, trabajador_id: this.trabajador_id } ).then(response => {
							this.form.remitente_id = ''
							this.form.modo_comunicacion_id = ''
							this.form.motivo_comunicacion_id = ''
							this.form.ausentismo_id = ''
							this.form.documentacion_id = ''
							this.form.observacion = ''
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
					updateComunicacion () {
						this.isLoading = true
						this.$refs.actionEdit.close();
						axios.patch('/api/comunicaciones/' + this.comunicacion.id +'/update',  {empresa_id: empresa.id, trabajador_id: this.trabajador_id, comunicacion: this.comunicacion } ).then(response => {
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
					openRecourses () {
						this.getRemitentes()
						this.getModos()
						this.getMotivos()
						this.getDocumentos()
						this.getAusentismos()
					},
					
					newRow () {
						this.$refs.actionCreate.open();
					},
					editRow (row) {
						this.comunicacion = row
						this.$refs.actionEdit.open();
					},
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
                            axios.delete('/api/comunicaciones/'+ row.id + '/destroy', { empresa_id: empresa.id }).then(result => {
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

					successMessage(message){
                        swal("Exito!", message, "success");   
                    },

                    errorMessage(message){
                        swal("Error!", message, "error");   
                    },

					getRemitentes () {
						axios.get("{{ route('remitentes.json') }}").then(response => {
							this.remitentes = response.data
						})
					},

					getAusentismos () {
						axios.get("{{ route('ausentismos-comunicaciones.json', ['id' => $trabajador->id ]) }}").then(response => {
							this.ausentismos = response.data
						})
					},

					getDocumentos () {
						axios.get("{{ route('documentos-comunicaciones.json', ['id' => $trabajador->id] ) }}").then(response => {
							this.documentos = response.data.data
						})
					},

					getModos () {
						axios.get("{{ route('modo-comunicaciones.json') }}").then(response => {
							this.modos = response.data
						})
					},

					getMotivos () {
						axios.get("{{ route('motivo-comunicaciones.json') }}").then(response => {
							this.motivos = response.data
						})
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
					}
				}
			}).$mount('#app');

			
			$('#fecha_inicio').datetimepicker({
					 format: 'YYYY-MM-DD',
					 locale: 'es-us'
			});

			$('#fecha_fin').datetimepicker({
					format: 'YYYY-MM-DD',
					locale: 'es-us'
			});
	</script>

@endpush
