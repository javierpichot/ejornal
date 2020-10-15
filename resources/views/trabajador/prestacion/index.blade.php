@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de prestaciones')

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    <div class="modal fade in" id="editIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newIncidencia" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @include('trabajador.prestacion._form')
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
   	 			<li class="breadcrumb-item" aria-current="page">  <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado de trabajadores</a></li>
   <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}">Perfil de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listado de prestacion pedidos</li>
        </ol>
    </nav>
    <div class="row">
        @include('trabajador.profile.partials.nav_menu_empresa')
        <div class="col-md-3">
            @include('trabajador.profile.partials.panel')
        </div>

        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Listado de prestacion pedidos
                    </h3>
                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newIncidencia" style="margin-bottom:25px">Nuevo pedido de prestacion del trabajador</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table class="table table-striped table-bordered" id="empresa-trabajadores">
                        <thead>
                        <tr>
                            <td>Fecha</td>
                            <td>Prestacion tipo</td>
                            <td>Relativo a</td>
                            <td>Descripcion</td>
                            <td>Estado</td>
                            <td>Observaciones</td>

                            <td style="width:19%">Acciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach  ($trabajador->prestacion_pedido as $key => $prestacion_pedido)
                            <tr id="prestacion_{{ $prestacion_pedido->id }}">
                                <td>{{ $prestacion_pedido->created_at }}</td>
                                <td>{{ $prestacion_pedido->prestacion_tipo->nombre }}</td>
                                <td>
                                    @isset($prestacion_pedido->trabajador)
                                        {{ $prestacion_pedido->trabajador->nombre or '' }} {{ $prestacion_pedido->trabajador->apellido or '' }}
                                    @endisset

                                    @empty ($prestacion_pedido->trabajador)
                                        {{ $empresa->nombre }}
                                    @endempty
                                </td>
                                <td>{{ $prestacion_pedido->descripcion or '' }}</td>
                                <td>@include('empresa.prestacion.estado')</td>

                                <td>{{ $prestacion_pedido->observaciones or '' }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">


                                        <a class="btn btn-warning" title="Edit" href="#editIncidencia" data-toggle="modal" data-href="{{route('trabajador.prestacion.pedido.edit', ['id' => $prestacion_pedido->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $prestacion_pedido->trabajador_id ])}}"><i title="Editar incidencia" class="fa fa-pencil"></i></a>

                                        {!! method_field('DELETE') !!}
                                        @csrf
                                        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                                        <input type="hidden" name="trabajador_id" value="{{ $prestacion_pedido->trabajador_id }}">
                                        <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $prestacion_pedido->id }}" data-href="{{ route('trabajador.prestacion.pedido.destroy', ['id' => $prestacion_pedido->id]) }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <a href="{{ route('trabajador.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'name' => $trabajador->nombre, 'trabajador_id' => $trabajador->id, 'empresa_id' => $empresa->id]) }}" target="_blank"><button class="btn btn-success"><i title="Ver pedido" class="fa fa-eye"></i></button></a>
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

            $("#prestacion_tipo_id").change(function() {
               if ($("#prestacion_tipo_id").val() == 1) {
                    $("#blank_info").css("display", "none");
                    $("#not_blank_info").css("display", "block");
               }


               if ($("#prestacion_tipo_id").val() != 1) {
                    $("#not_blank_info").css("display", "none");
                    $("#blank_info").css("display", "block");
               }
           });

            $('.delete-confirm').on('click', function(e) {
                e.preventDefault();



                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                  title: 'Eliminar prestación',
      	 			 	 text: "¿Desea eliminar esta prestación?",
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
                                '_method': 'DELETE'
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    $('#prestacion_' + data.id).fadeOut();
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
                            'La operacion ha sido cancelada',

                            'error'
                        )
                    }
                })

            });



            $("#prestacion").validate();
            $(document).on('click', 'a.page-link', function(event) {
                event.preventDefault();
                ajaxLoad($(this).attr('href'));
            });

            $(document).on('submit', 'form#prestacion', function(event) {
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
