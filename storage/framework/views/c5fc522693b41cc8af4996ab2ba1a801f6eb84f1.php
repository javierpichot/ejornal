<?php $__env->startSection('titulo', 'Movimientos de Profesionales'); ?>

<?php $__env->startSection('main-content'); ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('events_jornal.index')); ?>">Gerencia de Jornal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Movimientos de Usuarios</li>

    </ol>
</nav>

<div class="row">

    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    Movimientos de Usuarios
                </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" id="users_moviminetos">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(function() {

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

        $('#users_moviminetos').DataTable({
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
            ajax: "<?php echo e(route('api.getUsersMovimientos.show')); ?>",
            columns: [{
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'usuario',
                    name: 'usuario',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'tipo',
                    name: 'tipo',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'navegador',
                    name: 'navegador',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'auditable_type',
                    name: 'auditable_type',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'parametros_created',
                    name: 'parametros_created',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'parametros_update',
                    name: 'parametros_update',
                    orderable: true,
                    searchable: true,
                    render: function(data, type, full, meta) {
                        return data == null ? "" : data;
                    }
                },
                {
                    data: 'ip',
                    name: 'ip',
                    render: function(data, type, full, meta) {
                        //console.log("Hello I am rendering...");
                        return data == null ? "" : data;
                    }
                }

            ],
            columnDefs: [{
                targets: 0,
                render: function(data) {
                    return $('<div>').html(data).text();
                }
            }],
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>