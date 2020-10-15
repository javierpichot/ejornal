@extends('adminlte::layouts.app')
@section('titulo', 'Crear Proveedor')

@section('main-content')

    {{ Form::open(['route' => 'admin.proveedor.store', 'role' => 'form', 'method' => 'post', 'id' => 'form']) }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.proveedores.index') }}">Listado de Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proveedor</li>
        </ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.proveedor._formulario")
             </div>
            </div>

    </div>


    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('admin.proveedores.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection
@section('script')
    <script type="text/javascript">

            $(function () {

                $('#proveedor_phone_principal').mask('(000) 000-0000');
                $('#proveedor_celular_phone_principal').mask('(000) 000-0000');

                $("#form").validate();

                var t = $('#detalle').DataTable({
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

                $("#btnSubmit").click(function() {
                    var v = $("#form").valid();
                    if (!t.data().count()) {
                        $("#error-table").html("La tabla debe contener al menos una fila.");
                    } else {
                        $("#error-table").html(null);
                        if(v) {
                            $("#form").submit();
                        }
                    }
                });

                $('#addRow').on('click', function () {
                    if($("#producto").val()!='') {

                        var flag = true;
                        $('input[name="producto_id[]"]').each(function(index, value) {
                            if($(this).val() == $('#producto').val()) {
                                flag = false;
                            }
                        });

                        if(flag) {
                            t.row.add([
                               $('#producto :selected').text(),
                               '<input type="hidden" name="producto_id[]" value="' + $('#producto').val() + '" />' +
                               '<button  type="button" class="btn btn-secondary">Eliminar</button>',
                            ]).draw(false);
                            $("#error-table").html(null);
                        } else {
                            $("#error-table").html('Esta ingresando un valor repetido.');
                        }
                    } else {
                        $("#error-table").html('Para poder adicionar un valor el campo no puede ser vacio.');
                    }
                });

                $('#detalle').on("click", "button", function(){
                    var tr = $(this).parents('tr');
                    bootbox.confirm({
                        message: "Estas seguro de eliminar este registro?",
                        callback: function (result) {
                            if(result) {
                                $('#detalle').DataTable().row(tr).remove().draw(false);
                            }
                        }
                    });
                });

            });
        </script>
@endsection
