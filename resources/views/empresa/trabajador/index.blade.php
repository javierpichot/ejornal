@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de trabajadores de '. $empresa->nombre)


@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->

	<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal_content"></div>
		</div>
	</div>

   <div class="modal modal fade in" id="newTrabajador" tabindex="-1" role="dialog" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
			  	@include('empresa.trabajador._form')
          </div>
      </div>
   </div>



 <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
			 <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
         <li class="breadcrumb-item active" aria-current="page">Listado de trabajadores</li>
     </ol>
 </nav>

 <div class="row">
   <div class="col-xs-12">
     <div class="box box-primary">
       <div class="box-header with-border">
         <h3 class="box-title">
             Listado de trabajadores
         </h3>
         <div class="box-tools pull-right">
			 <div class="dropdown">
				 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					 Opciones
					 <span class="caret"></span>
				 </button>
				 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					 <li>
						 <a href="#" data-toggle="modal" data-target="#newTrabajador">
							 <i class="fa fa-file-o"></i>
							 Nuevo trabajador
						 </a>
					 </li>
					 <li role="separator" class="divider"></li>
					 <li><a href="{{ route('empresa.trabajadores.import.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Importa cvs</a></li>
				 </ul>
			 </div>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">



					<table class="table table-striped table-bordered" id="empresa-trabajadores">
						<thead>
							<tr>
								<th>Foto</th>
								<th>Apellido y Nombre</th>
								<th>Documento</th>
								<th>Sector</th>
								<th>Puesto</th>
								<th>Turno</th>
								<th>Legajo</th>
								<th>Celular</th>
								<th>Telefono</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script type="text/javascript">
			$(function () {

	            $('#empresa-trabajadores').DataTable({
   "lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "Todos"] ],

				"buttons": [
				'excelHtml5',
				'pdfHtml5'
				],
								"language": {
										"sProcessing":     "Procesando...",
										"sLengthMenu":     "Mostrar _MENU_ registros",
										"sZeroRecords":    "No se encontraron resultados",
										"sEmptyTable":     "Ningún dato disponible en esta tabla",
										"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
										"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
										"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
										"sInfoPostFix":    "",
										"sSearch":         "Buscar:",
										"sUrl":            "",
										"sInfoThousands":  ",",
										"sLoadingRecords": "Cargando...",
										"oPaginate": {
												"sFirst":    "Primero",
												"sLast":     "Último",
												"sNext":     "Siguiente",
												"sPrevious": "Anterior"
										},
										"oAria": {
												"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
												"sSortDescending": ": Activar para ordenar la columna de manera descendente"
										}
								},
								processing: true,
								serverSide: true,
								ajax: '/api/trabajadores/{{ $empresa->id }}/get',
								columns: [
										{data: 'foto', name: 'foto', orderable: false, searchable: false},
										{data: 'nombre', name: 'nombre'},
										{data: 'documento', name: 'documento'},
										{data: 'sector.nombre', name: 'sectores', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
return data == null ? "" :data;}},
										{data: 'tarea.nombre', name: 'tareas', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
return data == null ? "" :data;}},
										{data: 'turno.nombre', name: 'turnos', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
return data == null ? "" :data;}},
										{data: 'numero_legajo', name: 'numero_legajo', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
return data == null ? "" :data;}},
										{data: 'celular', name: 'celular', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
return data == null ? "" :data;}},
										{data: 'telefono', name: 'telefono', render: function ( data, type, full, meta ) {
										//console.log("Hello I am rendering...");
										return data == null ? "" :data;}},
										{data: 'action', name: 'action', orderable: false, searchable: false}
								],
								columnDefs: [
							    { targets: 0,
							      render: function(data) {
							         return $('<div>').html(data).text();
							      }
							    }
							  ],
	            });

							$(document).on('click', '.delete-confirm', function(e) {
									 e.preventDefault();

									 const swalWithBootstrapButtons = swal.mixin({
										 confirmButtonClass: 'btn btn-success',
										 cancelButtonClass: 'btn btn-danger',
										 buttonsStyling: false,
									 })

									 swalWithBootstrapButtons({
										 title: 'Desea eliminar al trabajador?',
										 text: "Al eliminar esto no hay vuelta atras!",
										 type: 'warning',
										 showCancelButton: true,
										 confirmButtonText: 'Si, eliminar!',
										 cancelButtonText: 'No, cancelar!',
										 reverseButtons: true
									 }).then((result) => {
										 if (result.value) {
											 $.ajax({
												 url: $(this).attr('data-href'),
												 method: 'POST',
												 dataType: 'JSON',
												 data: {
													 '_token': $('input[name="_token"]').val(),
													 'id': $(this).attr('data-id'),
													 '_method': 'DELETE'
												 },
												 success: function(data) {
													 if( data.status == 'success' ) {
														 var tr = $(this).parents('tr');
														 $('#empresa-trabajadores').DataTable().row(tr).remove().draw(false);
														 sweetAlert('Eliminada', data.message, 'success');
													 } else {
														 sweetAlert('Uppsss...', data.message, 'error');
													 }
												 },
												 error: function(xhr, message) {

												 }
											 });
										 } else if (
											 // Read more about handling dismissals
											 result.dismiss === swal.DismissReason.cancel
										 ) {
											 swalWithBootstrapButtons(
												 'Cancelada',
												 'La operacion ha sido realizada con exito.',
												 'error'
											 )
										 }
									 })

								 });
		});
	</script>

<script type="text/javascript">
			$(function () {


			   $('#logo').fileinput({
                   theme: 'fa',
                   language: 'es',
                   uploadUrl: '#',
                   allowedFileExtensions: ['jpg', 'png', 'gif'],
                   browseClass: "btn btn-primary btn-block",
                   showCaption: false,
                   showRemove: false,
                   showUpload: false
               });

               $('#celular').mask('(000) 000-0000');
               $('#telefono').mask('(000) 000-0000');
               $('#celular_familiar').mask('(000) 000-0000');
               $('#antecedente_medico').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })

               $('#antecedente_familiar').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })
               $('#estilo_vida').select2({
                   placeholder: "Seleccione",
                   allowClear: true
               })
               $("#frm").validate();
               $(document).on('click', 'a.page-link', function (event) {
                   event.preventDefault();
                   ajaxLoad($(this).attr('href'));
               });
			   $('#fecha_nacimiento').datetimepicker({
				   format: 'YYYY-MM-DD',
				   locale: 'es-us'
			   });

			   $('#fecha_contrato').datetimepicker({
				   format: 'YYYY-MM-DD',
				   locale: 'es-us'
			   });



				$(document).on('submit', 'form#frm', function (event) {
				    event.preventDefault();
				    var form = $(this);
				    var data = new FormData($(this)[0]);
				    var url = form.attr("action");
				    $.ajax({
				        type: form.attr('method'),
				        url: url,
				        data: data,
				        cache: false,
				        contentType: false,
				        processData: false,
				        success: function (data) {
				            $('.is-invalid').removeClass('is-invalid');
							$('#newTrabajador').modal('hide');
							$('#modalForm').modal('hide');
							setTimeout(function() {
								window.location.reload(data.redirect_url);
							}, 3000);
				        },
				        error: function(jqXhr, json, errorThrown){
							var errors = jqXhr.responseJSON;
        					var errorsHtml = '';

							for (control in errors['errors']) {
								var inputField = $('[name=' + control + ']');
								var parentDiv = inputField.closest('.form-group');
								// apply has-error class
								parentDiv.addClass('has-error');
								$('input[name=' + control + ']').addClass('is-invalid');
								console.log(errors['errors'][control][0]);
								$('span#' + control).html(errors['errors'][control][0]);
							}
				        }
				    });
				    return false;
				});

				$('#modalForm').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#modalForm').on('shown.bs.modal', function () {
				    $('#focus').trigger('focus')
				});

				function ajaxLoad(filename, content) {
				    content = typeof content !== 'undefined' ? content : 'content';
				   // $('.loading').show();
				    $.ajax({
				        type: "GET",
				        url: filename,
				        contentType: false,
				        success: function (data) {
				            $("#" + content).html(data);
				          //  $('.loading').hide();
				        },
				        error: function (xhr, status, error) {
				            alert(xhr.responseText);
				        }
				    });
				}

		});
	</script>

@endpush
