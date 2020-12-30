<?php $__env->startSection('titulo', 'Gestion de consultas de '. $trabajador->nombre. ' '.$trabajador->apellido); ?>

<?php $__env->startSection('menu-empresa'); ?>
<?php echo $__env->make('empresa.partials.menu_empresa', ['empresa' => $empresa], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>




<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a
				href="<?php echo e(route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )); ?>">Dashboard de
				<?php echo e($empresa->nombre); ?></a></li>
		<li class="breadcrumb-item" aria-current="page"> <a
				href="<?php echo e(route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">Listado
				de trabajadores</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a
				href="<?php echo e(route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id])); ?>">Perfil
				de <?php echo e($trabajador->nombre); ?> <?php echo e($trabajador->apellido); ?></a></li>
		<li class="breadcrumb-item active" aria-current="page">Listado de comunicación</li>
	</ol>
</nav>
<div class="card">
	<?php echo $__env->make('trabajador.profile.partials.nav_menu_empresa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="card-body">
		<div class="row" id="app">

			<div class="col-md-3">

				<worker-panel trabajador="<?php echo e($trabajador->nombre); ?>  <?php echo e($trabajador->apellido); ?>"
					url-foto="<?php echo e(($trabajador->photo != "") ? asset('storage/empresas/'. $empresa->id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' )); ?>"
					sector="<?php echo e(isset($trabajador->sector->nombre) ? $trabajador->sector->nombre : ''); ?>" tarea="<?php echo e(isset($trabajador->tarea->nombre) ? $trabajador->tarea->nombre : ''); ?>"
					turno="<?php echo e(isset($trabajador->turno->nombre) ? $trabajador->turno->nombre : ''); ?>" empresa_id="<?php echo e($empresa->id); ?>"
					user_id=" <?php echo e(auth()->user()->id); ?>" trabajador_id="<?php echo e($trabajador->id); ?>">


					<template slot="info-trabajador">
						<div class="text-center">
							<?php if($ausente->count() >=1): ?>
							<button class="btn btn-danger"></button>
							<?php $__currentLoopData = $ausente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo e($row->ausentismo_tipo->nombre); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php echo e($ausente->sum('dias_ausente')); ?> días
							<?php else: ?>
							<button class="btn btn-success"></button> Trabajando
							<?php endif; ?>
							<br /><br />
							<?php if(isset($cita->start_date)): ?>
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							Proxima cita: <?php echo e(isset($cita->start_date) ? $cita->start_date : ''); ?>

							<?php endif; ?>


						</div>


						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Documento:</b> <a
									class="pull-right"><?php echo e(isset($trabajador->documento) ? $trabajador->documento : 'No disponible'); ?></a>
							</li>
							<li class="list-group-item">
								<b><?php echo e(isset($trabajador->obrasocial->nombre) ? $trabajador->obrasocial->nombre : 'No disponible'); ?>:</b> <a
									class="pull-right"><?php echo e(isset($trabajador->numero_afiliado) ? $trabajador->numero_afiliado : 'No disponible'); ?></a>
							</li>
							<li class="list-group-item">
								<b>Direccion: </b> <a
									class="pull-right"><?php echo e(isset($trabajador->observacion_direccion) ? $trabajador->observacion_direccion : 'No disponible'); ?>

									<?php echo e(isset($trabajador->localidad->nombre) ? $trabajador->localidad->nombre : ''); ?></a>
							</li>
							<li class="list-group-item">
								<b>Celular: </b> <a class="pull-right"><?php echo e(isset($trabajador->celular) ? $trabajador->celular : 'No disponible'); ?></a>
							</li>
							<li class="list-group-item">
								<b>Telefono: </b> <a
									class="pull-right"><?php echo e(isset($trabajador->telefono) ? $trabajador->telefono : 'No disponible'); ?></a>
							</li>
							<li class="list-group-item">
								<b>Agentes de riesgo declarados según puesto: </b>
								<?php if(!empty($trabajador->tarea->agente_riesgo_tarea)): ?>
								<?php $__currentLoopData = $trabajador->tarea->agente_riesgo_tarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agente_riesgo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<button type="button"
									class="btn btn-block btn-warning btn-sm"><?php echo e(isset($agente_riesgo['agente_riesgo']) ? $agente_riesgo['agente_riesgo'] : ''); ?></button>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</li>
						</ul>

						

					</template>

				</worker-panel>
			</div>

			<div class="col-md-9">
				<loader v-show="isLoading"></loader>
				<?php echo $__env->make('trabajador.consulta.partials._created', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('trabajador.consulta.partials._edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
							api-url="/api/consultas/trabajador?empresa_id=<?php echo e($empresa->id); ?>&trabajador_id=<?php echo e($trabajador->id); ?>"
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
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
				trabajador_id: <?php echo e($trabajador->id); ?>,
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
				axios.get("<?php echo e(route('consulta-reposo.json')); ?>").then((result) => {
					this.consulta_reposos = result.data
				}).catch((err) => {

				});
			},
			fetchConsultaMotivo () {
				axios.get("<?php echo e(route('consulta-motivo.json')); ?>").then((result) => {
					this.consulta_motivos = result.data
				}).catch((err) => {

				});
			},

			fetchConsultaTipo () {
				axios.get("<?php echo e(route('consulta-tipo.json')); ?>").then((result) => {
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
				axios.get("<?php echo e(route('getPrestacionFarmacoEmpresa.json')); ?>?empresa_id=<?php echo e($empresa->id); ?>").then((result) => {
					this.prestacion_farmacias = result.data
				}).catch((err) => {

				});
			},

			fetchAusentismoTrabajador () {
				axios.get("<?php echo e(route('getAusentismoTrabajador.json')); ?>?trabajador_id=<?php echo e($trabajador->id); ?>").then((result) => {
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
				axios.post("<?php echo e(route('consulta.trabajador.store')); ?>",  {empresa_id: empresa.id, user_id: user_id, trabajador_id: this.trabajador_id, consulta: this.form, prestacion_farmacos: this.prestacion_farmacos } ).then(response => {

					this.isLoading = false
					this.$refs.actionCreate.close();
					this.successMessage("Registro creado exitosamente");
					Vue.nextTick( () => this.$refs.vuetable.refresh())
				}).catch(err =>  {
					if (err.response.status === 422) {
						this.errors = err.response.data.errors || {};
						this.isLoading = false
						this.$refs.actionCreate.open();
						alert('Llena los campos correspondientes que son obligatorios. Se indican con éste signo: * ');
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
						alert('Llena los campos correspondientes que son obligatorios. Se indican con éste signo: * ');
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>