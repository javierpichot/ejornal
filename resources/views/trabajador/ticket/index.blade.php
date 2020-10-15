@extends('adminlte::layouts.app')

@section('titulo', 'Gestion de tickets de '. $trabajador->nombre. ' '.$trabajador->apellido)


@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id="modal_content"></div>
		</div>
	</div>

	<!-- Modal -->
   <div class="modal fade" id="newticket" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog" role="document">
		   <div class="modal-content">
			   @include('trabajador.ticket._form')
		   </div>
	   </div>
   </div>



	 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
					<li class="breadcrumb-item" aria-current="page"><a href="{{ route('trabajador.ticket.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de tickets</li>
        </ol>
    </nav>
 <div class="row">
	 <div class="col-md-3">
		 @include('trabajador.profile.partials.panel')
	 </div>
   <div class="col-md-9">
     <div class="box box-primary">
       <div class="box-header with-border">
         <h3 class="box-title">
             Gestión de tickets
         </h3>
         <div class="box-tools pull-right">
<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newticket" style="margin-bottom:25px">Nuevo ticket</a>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">


						<table class="table table-striped table-bordered" id="empresa-ticket">
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
								@foreach($tickets AS $c)

									<tr id="ticket_{{ $c->id }}">
										<td>
											@if ($c->status == true)
												<a href="#" class="btn btn-primary">Abierto</a>
												@else
												<a href="#" class="btn btn-danger">Cerrado</a>
											@endif
										</td>

										<td>
											{{ $c->nombre  }} {{ $c->apellido  }}
										</td>
										<td>
											{{ $c->trabajador_apellido or '' }} {{ $c->trabajador_nombre or '' }}
										</td>
										<td>{{ $c->motivo }}</td>
										<td>{{ $c->comentario[0]->comentarios or '' }}</td>
										<td>{{ $c->nombre_accion or '' }} {{ $c->apellido_accion or '' }}</td>
										<td>


											<a class="btn btn-warning" title="Edit" href="#modalForm" data-toggle="modal" data-href="{{route('trabajador.ticket.edit', ['id' => $c->id, 'id_empresa' => $empresa->id])}}"><i title="Editar ticket" class="fa fa-pencil"></i></a>

											<a href="{{ route('trabajador.ticket.comentario.view', ['id' => $c->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $c->trabajador_id]) }}" target="_blank"><button class="btn btn-success"><i title="Ver comentarios" class="fa fa-commenting-o"></i></button></a>

											@csrf
											<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
											<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $c->id }}" data-href="{{ route('trabajador.ticket.destroy', ['id' => $c->id]) }}">
												<i class="fa fa-trash"></i>
											</button>

										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
	                </div>
              </div>
			  </div>
		  </div>
	</div>
@endsection

@push('script')
	<script type="text/javascript">
			$(function () {

				$('.delete-confirm').on('click', function(e) {
	 e.preventDefault();

	 const swalWithBootstrapButtons = swal.mixin({
		 confirmButtonClass: 'btn btn-success',
		 cancelButtonClass: 'btn btn-danger',
		 buttonsStyling: false,
	 })

	 swalWithBootstrapButtons({
		 title: 'Desea eliminar el ticket?',
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
						 $('#ticket_' + data.id).fadeOut();
						 sweetAlert('Eliminado', data.message, 'success');
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
				 'La operacion a sido cancelada',

				 'error'
			 )
		 }
	 })

 });

				$(document).on('click', 'a.page-link', function (event) {
				    event.preventDefault();
				    ajaxLoad($(this).attr('href'));
				});

				$(document).on('submit', 'form#ticket', function(event) {
					event.preventDefault();
					var form = $(this);
					var data = new FormData($(this)[0]);
					console.log(data)
					var url = form.attr("action");
					$.ajax({
						type: form.attr('method'),
						url: url,
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(data) {
							toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
							$('#modalForm').modal('hide');
							$('#newticket').modal('hide');

							setTimeout(function() {
								window.location.reload(data.redirect_url);
							}, 3000);

						},
						error: function(jqXhr, json, errorThrown) {
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
	            $('#empresa-ticket').DataTable({
								"dom": 'Bfrtip',
							"buttons": [
							'excelHtml5',
							'pdfHtml5'
							], "language": {
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
	                "paging": true,
	                "lengthChange": true,
	                "searching": true,
	                "ordering": true,
	                "info": true,
	                "autoWidth": false,
	                "responsive": true
	            });
		});
	</script>
@endpush
