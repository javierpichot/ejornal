@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de stock de farmacia de '. $empresa->nombre)

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    <!-- Modal -->
    <div class="modal fade in" id="newFarmaco" tabindex="-1" role="dialog" data-backdrop="static">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
 			  	@include('empresa.farmacia._form')
           </div>
       </div>
    </div>

    <div class="modal fade in" id="editFarmaco" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>

 	 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión stock de farmacia</li>
      </ol>
    </nav>
</nav>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Gestion de farmacia         </h3>
                    {!! Form::open(['route' => 'empresa.exportsFarmacos']) !!}
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <!-- /.box-body -->
                    <button type="submit" class="btn btn-info pull-left">Exportar cvs</button>
                    <!-- /.box-footer -->
                    {{ Form::close() }}
                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newFarmaco" style="margin-bottom:25px">Nuevo farmaco</a>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-striped table-b$documentacionordered" id="empresa_farmacos">
                        <thead>
                        <tr>
                            <td>Droga</td>
                            <td>Via</td>
                            <td>Tipo</td>
                            <td>Cantidad</td>

                            <td>Fecha caducidad</td>
                            <td>Acciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($empresa->farmacia as $key => $farmacia_droga)
                            <tr id="farmaco_{{ $farmacia_droga->id }}">
                                <td>{{ $farmacia_droga->nombre }}</td>
                                <td>{{ $farmacia_droga->via_prestacion or ''}}</td>
                                <td>{{ $farmacia_droga->prestacion_droga_tipo->nombre or ''}}</td>
                                <td id="cantidad_{{ $farmacia_droga->id }}">{{ $farmacia_droga->cantidad or ''}}</td>

                                <td>{{ $farmacia_droga->fecha_caducidad or ''}}</td>
                                <td>
                                    
                                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                        
                                    <button class="btn btn-warning" title="Edit" href="#editFarmaco" 		data-toggle="modal" data-href="{{route('empresa.farmacos.edit', ['id' => $farmacia_droga->id, 'id_empresa' => $empresa->id])}}"><i title="Editar Comunicacion" class="fa fa-pencil"></i>
                                    </button>
                                              <button type="submit" class="btn btn-danger delete-confirm" data-id="{{  $farmacia_droga->id}}" data-href="{{ route('empresa.farmacos.destroy', ['id' =>  $farmacia_droga->id]) }}">
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
                        title: 'Desea eliminar este movimiento?',
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
                                    if (data.status == 'success') {
                                        $('#farmaco_' + data.id).fadeOut();
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

                $(".incremete").on('click', function (e) {
					var id = $(this).attr('data-id');
                    var cantidad = $("#cantidad_" + id);
                    cantidad.html( parseInt(cantidad.html()) + 1 )
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: $(this).attr('data-href'),
                        data: {
                            'type': 'increment',
                            '_method': $('input[name="_method"]').val()

                        },
                        success: function (data) {

                        }
                    });
                });


                $(".decrement").on('click', function (e) {
					var id = $(this).attr('data-id');
                    var cantidad = $("#cantidad_" + id);
                    cantidad.html( parseInt(cantidad.html()) - 1 )
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: $(this).attr('data-href'),
                        data: {
                            'type': 'decrement',
                            '_method': $('input[name="_method"]').val()

                        },
                        success: function (data) {

                        }
                    });
                });

                $('#fecha_caducidad_picker').datetimepicker({
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
                          toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
						   $('#newFarmaco').modal('hide');
                           $('#editFarmaco').modal('hide');
                          /* setTimeout(function() {
                               window.location.reload(data.redirect_url);
                           }, 3000);*/

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



                $('#editFarmaco').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    ajaxLoad(button.data('href'), 'modal_content');
                });

                $('#editFarmaco').on('shown.bs.modal', function() {
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



                $('#empresa_farmacos').DataTable({
                  "dom": 'Bfrtip',
                "buttons": [
                'excelHtml5',
                'pdfHtml5'
                ],"language": {
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
