@extends('adminlte::layouts.app')
@section('titulo', 'Crear un profesional')

@section('main-content')

    {{ Form::open(['route' => 'admin.profesional.store', 'role' => 'form', 'method' => 'post', 'id' => 'form',  'enctype' => 'multipart/form-data']) }}
    <nav aria-label="breadcrumb">
    				<ol class="breadcrumb">
    						<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.dashboard.index') }}">Gerencia de Jornal</a></li>
    						<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.profesional.index') }}">Listado de Profesionales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dar de alta nuevo profesional</li>
</ol>
    </nav>

    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.profesional._form")
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
    <br>
    {{ Form::close() }}

@endsection
@push('script')
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

                $('#photo').fileinput({
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del profesional',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_titulo').fileinput({
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del titulo',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_documento').fileinput({
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del documento',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_seguro').fileinput({
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto del seguro',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});

                $('#foto_matricula').fileinput({
        			maxFileCount: 5,
        			theme: 'fa',
        			language: 'es',
        			uploadUrl: '#',
        			dropZoneTitle: 'Suba o arrastre las foto de la matricula',
        			allowedFileExtensions: ['jpg', 'png', 'gif'],
        			browseClass: "btn btn-primary btn-block",
        			showCaption: false,
        			showRemove: false,
        			showUpload: false
        		});



            });
        </script>
@endpush
