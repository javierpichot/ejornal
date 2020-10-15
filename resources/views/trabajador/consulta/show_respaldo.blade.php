@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de consultas de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

	<!-- Modal -->
	<div class="modal fade" id="editConsulta" tabindex="-1" role="dialog" data-backdrop="static">
 	   <div class="modal-dialog modal-lg" role="document">
 		   <div class="modal-content" id="modal_content"></div>
 	   </div>
    </div>

   <div class="modal fade" id="newConsulta" tabindex="-1" role="dialog" data-backdrop="static">
	   <div class="modal-dialog modal-lg" role="document">
		   <div class="modal-content">
			   @include('trabajador.consulta._form')
		   </div>
	   </div>
   </div>



	 <nav aria-label="breadcrumb">
		 <ol class="breadcrumb">
			 <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
				<li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
										 <li class="breadcrumb-item active" aria-current="page">Listado de comunicación</li>	 </ol>
    </nav>
 <div class="card">
			  	@include('trabajador.profile.partials.nav_menu_empresa')
				<div class="card-body">
	<div class="row">

		<div class="col-md-3">
			@include('trabajador.profile.partials.panel')
		</div>

		  <div class="col-md-9">
			  <div class="box box-info">
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
										    <a class="btn btn-primary waves-effect waves-light" href="{{route('trabajador.consulta.view', ['id' => $consulta->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $consulta->trabajador->id ])}}"><i title="ver consulta" class="fa fa-eye"></i></a>

											{!! method_field('DELETE') !!}
 										   @csrf
 										   <input type="hidden" name="trabajador_id" value="{{ $consulta->trabajador->id }}">
 										   <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
 										   <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $consulta->id}}" data-href="{{ route('trabajador.consulta.destroy', ['id' => $consulta->id]) }}">
 											   <i class="fa fa-trash"></i>
 										   </button>

										   <a class="btn btn-warning" title="Edit" href="#editConsulta" 		data-toggle="modal" data-href="{{route('trabajador.consulta.edit', ['id' => $consulta->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $consulta->trabajador->id ])}}"><i title="Editar consulta" class="fa fa-pencil"></i></a>

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

				$('select#consulta_motivo_id').on('change',function(){
					var consultaMotivoID = $(this).val();
					if(consultaMotivoID){
						$.ajax({
							type:'POST',
							url:'{{ route('trabajador.diagnotico.consulta.show') }}',
							data:'consulta_motivo_id='+consultaMotivoID,
							success:function(response){
								$('#diagnostico_id').html(response.data);
							}
						});
					}else{

					}
				});

				$('select#diagnostico_id').on('change',function(){
					var diagnostico_id = $(this).val();
					if(diagnostico_id){
						$.ajax({
							type:'POST',
							url:'{{ route('trabajador.diagnotico.consulta.guia') }}',
							data:'diagnostico_id='+diagnostico_id,
							success:function(response){
								$('#guia_diag').html(response.data);
							}
						});
					}else{

					}
				});






				$(document).on('click', 'a.page-link', function (event) {
				    event.preventDefault();
				    ajaxLoad($(this).attr('href'));
				});

                

				$('#fecha_cita').datetimepicker({
				   format: 'YYYY-MM-DD',
				   locale: 'es-us'
			   });

				$(document).on('submit', 'form#consulta', function(event) {
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
						success: function(data) {
							toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
							$('.is-invalid').removeClass('is-invalid');
							$('#newConsulta').modal('hide');
							$('#editConsulta').modal('hide');

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

				$('.delete-confirm').on('click', function(e) {
				   e.preventDefault();

				   const swalWithBootstrapButtons = swal.mixin({
					   confirmButtonClass: 'btn btn-success',
					   cancelButtonClass: 'btn btn-danger',
					   buttonsStyling: false,
				   })

				   swalWithBootstrapButtons({
						 title: 'Eliminar consulta',
					 text: "¿Desea eliminar esta consulta?",
					 type: 'warning',
					 showCancelButton: true,
					 confirmButtonText: 'Si, eliminar',
					 cancelButtonText: 'No, cancelar',
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
									   $('#consulta_trabajador_' + data.id).fadeOut();
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
							   'La operacion ha sido cancelada',
							   'error'
						   )
					   }
				   })

			   });

			   $("#consulta_tipo_id").change(function() {

				   if ($("#consulta_tipo_id").val() == 1) {
					   $("#capa_medica").css("display", "block");
					   $("#especialidad").css("display", "block");
					   $("#diagnostico").css("display", "block");
					   $("#ausentismo").css("display", "block");

					   $("#file_01").css("display", "block");
					   $("#file_02").css("display", "block");
						$("#capa_enfermeria").css("display", "none");
					   $("#consulta_motivo").css("display", "none");
				   }


				   if ($("#consulta_tipo_id").val() == 2) {
					   $("#capa_medica").css("display", "none");
					   $("#especialidad").css("display", "block");
					   $("#diagnostico").css("display", "block");
					   $("#capa_enfermeria").css("display", "block");
					   $("#consulta_motivo").css("display", "block");
					   $("#ausentismo").css("display", "block");
					   $("#file_01").css("display", "block");
					   $("#file_02").css("display", "block");
				   }
			   });

			  var regex = /^(.+?)(\d+)$/i;
			  var cloneIndex = $(".clonedata").length;
			  function clone(){
				  console.log('hola');
				  $(this).parents(".clonedata").clone()
					  .appendTo("#appends")
					  .attr("id", "clonedata" +  cloneIndex)
					  .find("*")
					  .each(function() {
						  var id = this.id || "";
						  var match = id.match(regex) || [];
						  if (match.length == 3) {
							  this.id = match[1] + (cloneIndex);
						  }
					  })
					  .on('click', 'button.clone', clone)
					  .on('click', 'button.remove', remove);
				  cloneIndex++;
			  }
			  function remove(){
				  $(this).parents(".clonedata").remove();
			  }

			  $("button.clone").on("click", clone);

			  $("button.remove").on("click", remove);

				$('#editConsulta').on('show.bs.modal', function (event) {
				    var button = $(event.relatedTarget);
				    ajaxLoad(button.data('href'), 'modal_content');
				});

				$('#editConsulta').on('shown.bs.modal', function () {

					$("#consulta_tipo_id").change(function() {
	 				   if ($("#consulta_tipo_id").val() == 1) {
	 					   $("#capa_medica").css("display", "block");
               $("#comun").css("display", "block");
	 						$("#capa_enfermeria").css("display", "none");

	 				   }


	 				   if ($("#consulta_tipo_id").val() == 2) {
	 					   $("#capa_medica").css("display", "none");
	 					   $("#capa_enfermeria").css("display", "block");
               $("#comun").css("display", "block");

	 				   }
	 			   });

					var regex = /^(.+?)(\d+)$/i;
	                var cloneIndex = $(".clonedata").length;
	                function clone(){
	                    $(this).parents(".clonedata").clone()
	                        .appendTo("#appends")
	                        .attr("id", "clonedata" +  cloneIndex)
	                        .find("*")
	                        .each(function() {
	                            var id = this.id || "";
	                            var match = id.match(regex) || [];
	                            if (match.length == 3) {
	                                this.id = match[1] + (cloneIndex);
	                            }
	                        })
	                        .on('click', 'button.clone', clone)
	                        .on('click', 'button.remove', remove);
	                    cloneIndex++;
	                }
	                function remove(){
	                    $(this).parents(".clonedata").remove();
	                }

	                $("button.clone").on("click", clone);

	                $("button.remove").on("click", remove);

					$('#fecha_cita').datetimepicker({
						 format: 'YYYY-MM-DD',
						 locale: 'es-us'
				 	});
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
	            $('#empresa-consultas').DataTable({
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
