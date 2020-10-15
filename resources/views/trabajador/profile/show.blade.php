@extends('adminlte::layouts.app')
@section('titulo', 'Perfil de '. $trabajador->nombre. ' '.$trabajador->apellido)

@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')

    @php
        $widget1 = collect($widget1);
        $widget2 = collect($widget2);
        $widget3 = collect($widget3);
    @endphp
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard
                    de {{ $empresa->nombre }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">Listado
                    de trabajadores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfil
                de {{ $trabajador->nombre }} {{ $trabajador->apellido }}</li>
        </ol>
    </nav>
    <div class="card">
        @include('trabajador.profile.partials.nav_menu_empresa')
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    @include('trabajador.profile.partials.panel')
                </div>

                <div class="col-lg-9 col-xs-12">
                    @if ($widget2->sum('dias_ausente') >=7)
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Alerta!</h4>
                            Trabajador con frecuentes episodios de ausentismo
                        </div>@endif
                    @if ($total_episodio_ausentismo >=1)

                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                            Este trabajador tiene episodios de ausentismo abiertos.
                        </div>
                    @endif
                    @if ($total_ticket_abierto >=1)
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                            Este trabajador tiene tickets abiertos.
                        </div>@endif
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-user-times"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Último mes</span>
                            <span class="info-box-number">
										{{ $widget1->sum('dias_ausente') }}
									</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-user-times"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Últimos 3 meses</span>
                            <span class="info-box-number"> 	{{ $widget2->sum('dias_ausente') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-user-times"></i></span>


                        <div class="info-box-content">
                            <span class="info-box-text">Ùltimo año</span>
                            <span class="info-box-number"> 	{{ $widget3->sum('dias_ausente') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $total_incidencias }}</h3>

                            <p>Incidencias</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-alert"></i>
                        </div>
                        <a href="{{ route('trabajador.incidencia.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}"
                           class="small-box-footer">
                            Más info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $total_consultas }}</h3>

                            <p>Consultas medicina laboral</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-medkit"></i>
                        </div>
                        <a href="{{ route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}"
                           class="small-box-footer">
                            Más info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $total_documentacion }}</h3>

                            <p>Certificados entregados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                        <a href="{{ route('trabajador.documentacion.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id])}}"
                           class="small-box-footer">
                            Más info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <i class="fa fa-bullhorn"></i>

                            <h3 class="box-title">Últimos movimientos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table class="table table-striped table-bordered" id="movimiento-trabajadores">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Accion</th>
                                    <th>Navegador</th>
                                    <th>Entidad</th>
                                    <th>Parametros Created</th>
                                    <th>Parametros Update</th>
                                    <td>IP address</td>
                                    <td>Method</td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', 'a.page-link', function (event) {
                event.preventDefault();
                ajaxLoad($(this).attr('href'));
            });

            $('.delete-confirm').on('click', function (e) {
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
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('#ticket_trabajador_' + data.id).fadeOut();
                                    sweetAlert('Eliminada', data.message, 'success');
                                } else {
                                    sweetAlert('Uppsss...', data.message, 'error');
                                }
                            },
                            error: function (xhr, message) {

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
                        toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
                        $('.is-invalid').removeClass('is-invalid');
                        $('#newticket').modal('hide');
                        $('#modalForm').modal('hide');

                        setTimeout(function () {
                            window.location.reload(data.redirect_url);
                        }, 3000);

                    },
                    error: function (jqXhr, json, errorThrown) {
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

            $('#movimiento-trabajadores').DataTable({
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
                processing: true,
                serverSide: true,
                ajax: '/api/movimientos-trabajador/{{ $empresa->id }}/{{ $trabajador->id }}/get',
                columns: [
                    {data: 'created_at', name: 'created_at', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'usuario', name: 'usuario', orderable: true, searchable: false, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'tipo', name: 'tipo', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'navegador', name: 'navegador', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'auditable_type', name: 'auditable_type', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'parametros_created', name: 'parametros_created', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'parametros_update', name: 'parametros_update', orderable: true, searchable: true, render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},
                    {data: 'ip', name: 'ip', render: function ( data, type, full, meta ) {
//console.log("Hello I am rendering...");
                            return data == null ? "" :data;}},
                    {data: 'method', name: 'method', render: function ( data, type, full, meta ) {
                            return data == null ? "" :data;}},

                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function (data) {
                            return $('<div>').html(data).text();
                        }
                    }
                ],
            });
        });
    </script>

@endpush
