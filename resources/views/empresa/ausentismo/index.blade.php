@extends('adminlte::layouts.vue')
@section('titulo', 'Gestion de ausentismo de '. $empresa->nombre)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')
<div id="app">
	<loader v-show="isLoading"></loader>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">Listado de ausentismo</li>
		</ol>
	</nav>
	<div class="row">
			<div class="col-xs-12">
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">
						Listado de ausentismo de {{ $empresa->nombre }}
				  </h3>
				  <div  class="text-left">
					<div class="form-group">
						<div class="col col-md-2">
							<datetime 
							v-model="fechaInicio"
							:input-class="'form-control'"
							:format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit', timeZoneName: 'short' }"
							></datetime>
						</div>
						<div class="col col-md-2">
								<datetime 
								v-model="fechaFin"
								:input-class="'form-control'"
								:format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit', timeZoneName: 'short' }"
								></datetime>
						</div>
						<div class="col col-md-2">
							<button @click="resetDate" class="btn btn-primary">Borrar filtro</button>
						</div>
					</div>
				  </div>
				  <div class="pull-right" style="margin-right: 10px">
					<button id="abierto" class="btn btn-default filter" @click="getFilterAbiertos">Abierto</button>
					<button id="cerrado" class="btn btn-default filter" @click="getFilterCerrados">Cerrado</button>
					<button id="all" class="btn btn-default filter" @click="onFilterReset">Todos</button>
				</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<vuetable ref="vuetable"
						api-url="/api/ausentismos?empresa={{ $empresa->id }}/"
						:fields="fields"
						pagination-path=""
						:css="css.table"
						:append-params="moreParams" 
						@vuetable:pagination-data="onPaginationData"
						@vuetable:loading="onLoading"        
    					@vuetable:loaded="onLoaded"
						>
						<template slot="field" slot-scope="props">
								<td v-if="!props.rowData.fecha_alta">
										<a :href="/trabajador/ + props.rowData.trabajador.id + '/profile/' + props.rowData.empresa_id + '/expedientes'" target="\&quot;_blank\&quot;"><button class="btn btn-danger" >Abierto</button></a>
								</td>
								<td v-if="props.rowData.fecha_alta">
										<a :href="/trabajador/ + props.rowData.trabajador.id + '/profile/' + props.rowData.empresa_id + '/expedientes'" target="\&quot;_blank\&quot;"><button class="btn btn-success">Cerrado</button></a>
								</td>
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
 
@endsection

@push('script')
	<script>
		
		const app = new Vue({
			el: '#app',
			data() {
				return {
					isLoading: false,
					fechaInicio: '',
					fechaFin: '',
					format: "dd MMMM yyyy",
					language: "es",
					languages: lang,
					ausentismos: [],
					byAbiertos: '',
					byCerrados: '',
					byAll: '',
					page: 10,
					moreParams: {},
					fields: [
								{ 
									name: '__slot:field', 
									title: 'Estado',
									sortField: '__slot:field'
								}, 
								{
									name: 'trabajador.name',
									title: 'Nombre apellido',
									sortField: 'trabajador.name'
								},
								{
									name: 'tipo.nombre',
									title: 'Tipo de ausentismo',
									sortField: 'tipo.nombre'
								},
								{
									name: 'fecha_ausente',
									title: 'Fecha baja',
									sortField: 'fecha_ausente'
								},
								{
									name: 'numero_comunicacion',
									title: 'Nº comunicacados',
									sortField: 'numero_comunicacion'
								},
								{
									name: 'numero_documentacion',
									title: 'Nº documentos',
									sortField: 'numero_documentacion'
								},
								{
									name: 'numero_consulta',
									title: 'Nº consultas',
									sortField: 'numero_consulta'
								},
								{
									name: 'user.name',
									title: 'Usuario',
									sortField: 'user.name'
								}
							],
					sortOrder: [
						{ field: 'name', direction: 'asc' }
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
		
			computed: {
				setDateIni () {
				return this.fechaInicio ? moment(this.fechaInicio).format('YYYY-MM-DD') : ''
				},
				setDateFin () {
				return this.fechaFin ? moment(this.fechaFin).format('YYYY-MM-DD') : ''
				}
			},
			methods: {
				transform: function(data) {
					var transformed = {}
					transformed = {
						data: data.data,
						total: data.meta.total,
						per_page:data.meta.per_page,
						current_page: data.meta.current_page,
						last_page: data.meta.last_page,
						next_page_url: data.links.next,
						prev_page_url: data.links.prev,
						from:  data.meta.from,
						to: data.meta.to
					}

					return transformed
				},
				onFilterSet (filterText) {
					this.moreParams = {
						'filter': filterText
					}
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				},
				onFilterReset () {
					this.moreParams = {}
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				},
				getFilterAbiertos () {
					this.byAbiertos = 'Null'
					this.byCerrados = ''
				},
				getFilterCerrados () {
					this.byAbiertos = ''
					this.byCerrados = 'NotNull'
				},

				getFilterAll () {
					this.byAbiertos = ''
					this.byCerrados = ''
					this.byAll = true
				},
				resetDate () {
					this.fechaInicio = ''
					this.fechaFin = ''
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
			},
			//Si se realizo algun cambio refrescamos y filtramos segun el boton selecionado
			watch: {
				byAbiertos: function () {
					this.moreParams = {
						'byAbiertos': this.byAbiertos,
					}
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				},
				byCerrados: function () {
					this.moreParams = {
						'byCerrados': this.byCerrados
					}
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				},
				fechaFin: function () {
					this.moreParams = {
						'whereDateBetweenFin': this.setDateFin,
						'whereDateBetweenIni': this.setDateIni
					}
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				}
			}
		});
	</script>
@endpush
