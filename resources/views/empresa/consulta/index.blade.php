@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de consultas de '. $empresa->nombre)

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

	 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
					<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de consultas</li>
        </ol>
    </nav>

</nav>


<div class="row">
   <div class="col-xs-12">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">
  Gestion de consultas         </h3>

       </div>
       <!-- /.box-header -->
       <div class="box-body table-responsive">

                    <table class="table table-striped table-bordered" id="empresa_consultas">
                        <thead>
                            <tr>
                                <td>Fecha y hora</td>
                                <td>Foto</td>
                                <td>Nombre y apellido</td>

                                <td>Tipo de consulta</td>
                                <td>Motivo de consulta</td>
                                <td>Profesional</td>
                                <td>Observaciones</td>
                                <td>Salida</td>
                                <td style="width:20%">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresa->consulta as $key => $consulta)
                                <tr id="consulta_{{ $consulta->id }}">
                                    <td>{{ $consulta->created_at }}</td>
                                  										<td>
											<img src="{{ asset('img/trabajador/'. $consulta->trabajador->photo) }}" alt="{{ $consulta->trabajador->nombre }} {{ $consulta->trabajador->apellido }}" class="rounded-circle" width="50 px">
										</td>
                                    <td>
                                      <a href="{{ route('trabajador.show', ['id' => $consulta->trabajador->id, 'name' => $consulta->trabajador->nombre, 'empresa_id' => $empresa->id]) }}">{{ $consulta->trabajador->nombre }} {{ $consulta->trabajador->apellido }}</a>
                                      </td>
                                    <td>{{ $consulta->consulta_tipo->nombre or '' }}</td>
                                    <td>{{ $consulta->consulta_motivo->nombre or '' }}</td>
                                    <td>{{ $consulta->user->nombre or '' }}</td>
                                    <td>{{ $consulta->observacion or '' }}</td>
                                    <td>{{ $consulta->consulta_reposo->nombre or '' }}</td>
                                    <td>
										<a class="btn btn-warning" title="Edit" href="#editConsulta" 		data-toggle="modal" data-href="{{route('empresa.consultas.edit', ['id' => $consulta->id, 'id_empresa' => $empresa->id ])}}"><i title="Editar ticket" class="fa fa-pencil"></i></a>
										{!! method_field('DELETE') !!}
										@csrf
										<input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
										<button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $consulta->id }}" data-href="{{ route('empresa.consultas.destroy', ['id' => $consulta->id]) }}">
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
     $('#empresa_consultas').DataTable({
             "order": [[ 0, "desc" ]],

			 "dom": 'Bfrtip',
		 "buttons": [
		 'excelHtml5',
		 'pdfHtml5'
		 ],    "language": {
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
					   title: 'Desea eliminar la consulta?',
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
									   $('#consulta_' + data.id).fadeOut();
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
						   toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
 						  $('.is-invalid').removeClass('is-invalid');
 						  $('#newConsulta').modal('hide');
 						  $('#editConsulta').modal('hide');

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

               $('#editConsulta').on('show.bs.modal', function (event) {
                   var button = $(event.relatedTarget);

                   ajaxLoad(button.data('href'), 'modal_content');
               });

               $('#editConsulta').on('shown.bs.modal', function () {
				   $("#consulta_tipo_id").change(function() {
					   if ($("#consulta_tipo_id").val() == 1) {
						   $("#capa_medica").css("display", "block");
						    $("#capa_enfermeria").css("display", "none");
					   }


					   if ($("#consulta_tipo_id").val() == 2) {
						   $("#capa_medica").css("display", "none");
						   $("#capa_enfermeria").css("display", "block");
					   }
				   });

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


            });
    </script>
@endpush
