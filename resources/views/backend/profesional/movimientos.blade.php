@extends('adminlte::layouts.vue')
@section('titulo', 'Movimientos de Profesionales')

@section('main-content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Movimientos de Profesionales</li>

        </ol>
    </nav>

    <div class="row" id="app">
		<loader v-show="isLoading"></loader>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Movimientos de Profesionales
                    </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <vuetable ref="vuetable"
							api-url="/api/movimientos/json"
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
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data() {
                return {
                    isLoading: false,
                    sortOrder: [
					    { field: 'created_at', direction: 'desc' }
				    ],
                    moreParams: {},
                    fields: [
					{
						name: 'created_at',
						title: 'Fecha y hora',
						sortField: 'created_at'
					},
					{
						name: 'user.nombre',
						title: 'Profesional'
					},
					{
						name: 'event',
						title: 'Acción'
					},
					{
						name: 'user_agent',
						title: 'Navegador'
					},
					{
						name: 'auditable_type',
						title: 'Entidad'
					},
					{
						name: 'new_values',
						title: 'Parametros creados'
					},
					{
						name: 'old_values',
						title: 'Parametros actualizados'
                    },
                    {
						name: 'ip_address',
						title: 'Dirección Ip'
                    }
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
        })
    </script>
@endpush
