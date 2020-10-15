@extends('layouts.app')
@section('titulo', 'Vista de Proveedor')

@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.proveedor.index') }}">Listado de Proveedores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vista de Proveedor</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n General</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-6 {{ $errors->has('proveedor_code') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>C&oacute;digo</label>
                            <input name="proveedor_code" class="form-control" type="text" placeholder="Codigo del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_code : $codigo }}" readonly="true" required="true" readonly="true" />
                            @if ($errors->has('proveedor_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('proveedor_ruc') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>R.U.C.</label>
                            <input name="proveedor_ruc" class="form-control" type="text" placeholder="R.U.C. del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_ruc : '' }}" required="true" readonly="true" />
                            @if ($errors->has('proveedor_ruc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_ruc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 {{ $errors->has('proveedor_name') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="proveedor_name" class="form-control" type="text" placeholder="Nombre del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_name : '' }}" required="true" readonly="true" />
                            @if ($errors->has('proveedor_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('proveedor_email') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Correo Electr&oacute;nico</label>
                            <input name="proveedor_email" class="form-control" type="text" placeholder="Correo Electr&oacute;nico del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_email : '' }}" required="true" readonly="true" />
                            @if ($errors->has('proveedor_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 {{ $errors->has('proveedor_contact') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Contacto</label>
                            <input name="proveedor_contact" class="form-control" type="text" placeholder="Contacto del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_contact : '' }}" required="true" readonly="true" />
                            @if ($errors->has('proveedor_contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_contact') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('proveedor_address') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Direcci&oacute;n</label>
                          	<textarea class="form-control" id="proveedor_address" name="proveedor_address" rows="5" placeholder="Direcci&oacute;n del Proveedor" required="true" readonly="true" >{{ $proveedor->exists ? $proveedor->proveedor_address : '' }}</textarea>
                            @if ($errors->has('proveedor_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos de Contacto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<div class="row">
                    <div class="col-md-6 {{ $errors->has('proveedor_phone_principal') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Tel&eacute;fono Principal</label>
                            <div class="input-group">
                            <input name="proveedor_phone_principal" id="proveedor_phone_principal" class="form-control" type="text" placeholder="Tel&eacute;fono Principal del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_phone_principal : '' }}" required="true" readonly="true" />
                            <span class="input-group-text">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                            @if ($errors->has('proveedor_phone_principal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_phone_principal') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 {{ $errors->has('proveedor_celular_phone_principal') ? ' has-error' : '' }}">
                        <div class="form-group">
                            <label>Celular Principal</label>
                            <div class="input-group">
                            <input name="proveedor_celular_phone_principal" id="proveedor_celular_phone_principal" class="form-control" type="text" placeholder="Celular Principal del  del Empleado" value="{{ $proveedor->exists ? $proveedor->proveedor_celular_phone_principal : '' }}" required="true" readonly="true" />
                            <span class="input-group-text">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                              </div>
                            <small style="color: gray;"><b>Ejemplo</b>. (000) 000-0000</small>
                             @if ($errors->has('proveedor_celular_phone_principal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_celular_phone_principal') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 {{ $errors->has('proveedor_web') ? ' has-error' : '' }}">
                    	<label>Pagina WEB</label>
                        <input name="proveedor_web" class="form-control" type="text" placeholder="Pagina WEB del Proveedor" value="{{ $proveedor->exists ? $proveedor->proveedor_web : '' }}" required="true" readonly="true" />
                        @if ($errors->has('proveedor_web'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('proveedor_web') }}</strong>
                                </span>
                            @endif
                    </div>
                 </div>
            </div>
        </div>
        <br/>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Productos del Proveedor</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="detalle">
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                </tr>
                            </thead>
                            <tbody>

                                @if($proveedor->exists)
                                    @foreach($proveedor_detalle AS $d)
                                        <tr>
                                            <td>{{ $d->producto->producto_name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>


            </div>
        </div>
        <br/>
        <div class="row">
        	<div class="col-md-12">
        		<div class="float-right">
	        	    <a href="{{ route('admin.proveedor.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>

    </form>
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
