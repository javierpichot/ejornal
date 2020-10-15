@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de comunicaciones de '. $empresa->nombre)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->
   <div class="modal fade" id="editComunicacion" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog modal-lg" role="document">
		   <div class="modal-content" id="modal_content"></div>
	   </div>
   </div>


   <div class="modal fade" id="newTrabajador" tabindex="-1" role="dialog" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
          </div>
      </div>
   </div>

	 <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de comunicaciones</li>
        </ol>
    </nav>
<div class="row">
   <div class="col-xs-12">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">
  Gestion de comunicaciones         </h3>

       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">


        						<table class="table table-striped table-bordered" id="comunicaciones">
							<thead>
								<tr>
									<td>Fecha</td>
									<td>Foto</td>
									<td>Trabajador</td>
									<td>Vinc. ausentismo</td>
									<td>Remitente</td>
									<td>Modo</td>
									<td>Motivo</td>
									<td>Aporto documento</td>
									<td>Usuario</td>
                                    <td>Acciones</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($empresa->comunicacion as $key => $comunicacion)
									<tr id="comunicacion_{{ $comunicacion->id }}">
										<td>{{ $comunicacion->created_at }}</td>
										<td>
										<a href="{{ route('trabajador.show', ['id' => $comunicacion->trabajador->id, 'name' => $comunicacion->trabajador->nombre, 'empresa_id' => $empresa->id]) }}">         				<img src="{{ asset('storage/empresas/'.$empresa->id.'/trabajadores/'.$comunicacion->trabajador->id.'/perfil/'. $comunicacion->trabajador->photo) }}" alt="{{ $comunicacion->trabajador->nombre }}" class="rounded-circle" width="35px"></a>
										</td>
										<td><a href="{{ route('trabajador.show', ['id' => $comunicacion->trabajador->id, 'name' => $comunicacion->trabajador->nombre, 'empresa_id' => $empresa->id]) }}">          {{ $comunicacion->trabajador->nombre or '' }} {{ $comunicacion->trabajador->apellido or '' }}</a>
</td>										<td>
												@isset($comunicacion->ausentismo_id)
													Si
												@endisset

												@empty ($comunicacion->ausentismo_id)
													No
												@endempty
											</td>

										<td>{{ $comunicacion->remitente->nombre }}</td>
										<td>{{ $comunicacion->modo_comunicacion->nombre }}</td>
										<td>{{ $comunicacion->motivo_comunicacion->nombre }}</td>
										<td>
											@isset($comunicacion->documentacion_id)
												Si
											@endisset

											@empty ($comunicacion->documentacion_id)
												No
											@endempty
										</td>

										<td>{{ $comunicacion->user->nombre }} {{ $comunicacion->user->apellido }}</td>
<td>
											<div class="btn-group" role="group" aria-label="Basic example">


												<button class="btn btn-warning" title="Edit" href="#editComunicacion" 		data-toggle="modal" data-href="{{route('trabajador.comunicacion.edit', ['id' => $comunicacion->id, 'id_empresa' => $empresa->id, 'empleado_id' => $comunicacion->trabajador->id ])}}"><i title="Editar Comunicacion" class="fa fa-pencil"></i>
												</button>

												<form method="post" id="confirm_delete">
														{!! method_field('DELETE') !!}
														@csrf
														<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
														<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $comunicacion->id }}" data-href="{{ route('empresa.trabajadores.destroy', ['id' => $comunicacion->id]) }}">
															<i class="fa fa-trash"></i>
														</button>
											    </form>
											</div>
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
     $('#comunicaciones').DataTable({
			 "dom": 'Bfrtip',
		 "buttons": [
		 'excelHtml5',
		 'pdfHtml5'
		 ],          "language": {
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
	</script>

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
					   title: 'Desea eliminar la empresa?',
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
								   '_method': $('input[name="_method"]').val()
							   },
							   success: function(data) {
								   if( data.status == 'success' ) {
									   $('#trabajador_' + data.id).fadeOut();
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

			   $('#logo').fileinput({
                   <?php if(isset($trabajador)) { ?>
                   initialPreview: ["{{ asset('img/trabajador/' . $trabajador->photo) }}"],
                   initialPreviewAsData: true,
                   <?php } ?>
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
				            if (data.fail) {
				                for (control in data.errors) {
				                    $('input[name=' + control + ']').addClass('is-invalid');
				                    $('#error-' + control).html(data.errors[control]);
				                }
				            } else {
				                $('#newTrabajador').modal('hide');
								$('#editComunicacion').modal('hide');

				                window.location.reload('/');
				            }
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

				$('#editComunicacion').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#editComunicacion').on('shown.bs.modal', function () {
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
	<style media="screen">
	.navbar-icon-top .navbar-nav .nav-link > .fa {
position: relative;
width: 36px;
font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
font-size: 0.75rem;
position: absolute;
right: 0;
font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
top: 3px;
line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
top: -10px;
}

@media (min-width: 576px) {
.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 768px) {
.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 992px) {

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

@media (min-width: 1200px) {
.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
text-align: center;
display: table-cell;
height: 70px;
vertical-align: middle;
padding-top: 0;
padding-bottom: 0;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
display: block;
width: 48px;
margin: 2px auto 4px auto;
top: 0;
line-height: 24px;
}

.navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
top: -7px;
}
}

	</style>
@endpush
