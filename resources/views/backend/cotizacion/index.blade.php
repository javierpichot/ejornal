@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de cotizaciones')


@section('main-content')

    <div class="modal modal-info fade in" id="editIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">

        </ol>
    </nav>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Listado de cotizaciones
                    </h3>
                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newIncidencia" style="margin-bottom:25px">Nueva cotizacion</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table class="table table-striped table-bordered" id="empresa-trabajadores">
                        <thead>
                        <tr>
                            <td>Proveedor</td>
                            <td>Cotizacion</td>
                            <td>Cotizacion archivo</td>
                            <td>Observaciones</td>
                            <td>Elegida</td>
                            <td>Acciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach  ($prestacion_cotizacion as $key => $prestacion_cotizacion)
                            <tr id="cotizacion_{{ $prestacion_cotizacion->id }}">

                                <td>{{ $prestacion_cotizacion->proveedor->nombre }}</td>
                                <td>{{ $prestacion_cotizacion->cotizacion }}</td>
                                <td>{{ $prestacion_cotizacion->observaciones }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

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
        $(function() {
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
                                if (data.status == 'success') {
                                    $('#incidencia_' + data.id).fadeOut();
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



            $("#frm").validate();
            $(document).on('click', 'a.page-link', function(event) {
                event.preventDefault();
                ajaxLoad($(this).attr('href'));
            });

            $(document).on('submit', 'form#frm', function(event) {
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
                        $.toast({
                            heading: 'Success',
                            text: data.text,
                            icon: 'success',
                            position: 'top-right',
                            stack: false
                        })
                        $('.is-invalid').removeClass('is-invalid');
                        $('#newIncidencia').modal('hide');
                        $('#editIncidencia').modal('hide');

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

            $('#fecha_incidencia').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-us'
            });

            $('#presupuesto_url').fileinput({
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las fotos del presupuesto',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });
            $('#orden_servicio_url').fileinput({
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las fotos de la orden de servicio',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });
            $('#reporte_url').fileinput({
                maxFileCount: 5,
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                dropZoneTitle: 'Suba o arrastre las fotos del reporte',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            $('#editIncidencia').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                ajaxLoad(button.data('href'), 'modal_content');
            });

            $('#editIncidencia').on('shown.bs.modal', function() {
                $('#focus').trigger('focus')
            });

            function ajaxLoad(filename, content) {
                content = typeof content !== 'undefined' ? content : 'content';
                // $('.loading').show();
                $.ajax({
                    type: "GET",
                    url: filename,
                    contentType: false,
                    success: function(data) {
                        $("#" + content).html(data);
                        //  $('.loading').hide();
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
            $('#empresa-trabajadores').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
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
