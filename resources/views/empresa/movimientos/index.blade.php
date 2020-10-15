@extends('adminlte::layouts.app')
@section('titulo', 'Listado de movimientos')

@section('menu-empresa')
	@include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')



	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">Listado de movimientos</li>
	</nav>

	</nav>
	<div class="row">

		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						Listado de movimientos en la empresa {{ $empresa->nombre }}
					</h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<table class="table table-striped table-bordered" id="empresa_moviminetos">
						<thead>
						<tr>
							<td>Fecha</td>
							<td>Usuario</td>
							<td>Accion</td>
							<td>Navegador</td>
							<td>Entidad</td>
                            <td>Parametros created</td>
                            <td>Parametros update</td>
							<td>IP address</td>
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
                            'La operacion a sido :)',
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
                        $('.is-invalid').removeClass('is-invalid');
                        $('#newTrabajador').modal('hide');
                        // window.location.reload('/');
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

            $('#empresa_moviminetos').DataTable({
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
                ajax: '/api/movimientos-empresa/{{ $empresa->id }}/get',
                columns: [
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: true, render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }},
                    {data: 'usuario', name: 'usuario', orderable: true, searchable: false, render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }},
                    {data: 'tipo', name: 'tipo', orderable: true, searchable: true, render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }},
                    {data: 'navegador', name: 'navegador', orderable: true, searchable: true, render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }},
                    {data: 'auditable_type', name: 'auditable_type', orderable: true, searchable: true, render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }},
                    {data: 'parametros_created', name: 'parametros_created', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'parametros_update', name: 'parametros_update', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {
                        data: 'ip', name: 'ip', render: function (data, type, full, meta) {
//console.log("Hello I am rendering...");
                            return data == null ? "" : data;
                        }
                    }

                ],
                columnDefs: [
                    { targets: 0,
                        render: function(data) {
                            return $('<div>').html(data).text();
                        }
                    }
                ],
            });
        });
	</script>
@endpush
