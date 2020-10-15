@extends('adminlte::layouts.app')
@section('titulo', 'Empresa')

@section('main-content')
        {{ Form::model($sucursal, ['route' => ['admin.sucursal.update', $sucursal->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'form'])
        }}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.sucursales.index') }}">Listado de Sucursales</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Sucursal {{ $sucursal->nombre }}</li>
            </ol>
        </nav>

        <div class="box box-info">
             <div class="box-header">
              <h3 class="card-title">Informaci&oacute;n General</h3>
             </div>
             <div class="box-body">
                 <div class="row">
                     <!-- /.card-header -->
                    @include("backend.sucursal._formulario")
                 </div>
                </div>

        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                        <i class="fa fa-save nav-icon"></i>
                        Guardar edicion
                    </button>
                    <a href="{{ route('admin.sucursales.index') }}" class="btn btn-default">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
@endsection

@section('script')
    <style type="text/css">
        .kv-file-upload {
            display: none;
        }
    </style>
    <script type="text/javascript">
        $().ready(function() {
            $('.select2').select2()
            $('.categorias').tagsinput();
            $('.categorias').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here

               if (!event.options || !event.options.preventPost) {
                  $.ajax('/ajax-url', ajaxData, function(response) {
                     if (response.failure) {
                        // Re-add the tag since there was a failure
                        // "preventPost" here will stop this ajax call from running when the tag is added
                        $('.categorias').tagsinput('add', tag, {preventPost: true});
                     }
                  });
               }
            });


            $('.sectors').tagsinput();
            $('.sectors').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here

               if (!event.options || !event.options.preventPost) {
                  $.ajax('/ajax-url', ajaxData, function(response) {
                     if (response.failure) {
                        // Re-add the tag since there was a failure
                        // "preventPost" here will stop this ajax call from running when the tag is added
                        $('.sectors').tagsinput('add', tag, {preventPost: true});
                     }
                  });
               }
            });

            $('.turnos').tagsinput();
            $('.turnos').on('beforeItemRemove', function(event) {
               var tag = event.item;
               // Do some processing here

               if (!event.options || !event.options.preventPost) {
                  $.ajax('/ajax-url', ajaxData, function(response) {
                     if (response.failure) {
                        // Re-add the tag since there was a failure
                        // "preventPost" here will stop this ajax call from running when the tag is added
                        $('.turnos').tagsinput('add', tag, {preventPost: true});
                     }
                  });
               }
            });


            $('.tareas').tagsinput();
            $('.tareas').on('beforeItemRemove', function(event) {
               var tag = event.item;

               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



               // Do some processing here

               if (!event.options || !event.options.preventPost) {
                   $.ajax(
                    {
                        url:  "/admin/tarea/<?php echo $sucursal->id ?>/destroy",
                        type: 'delete', // replaced from put
                        dataType: "JSON",
                        data: {
                            'nombre': tag // method and token not needed in data
                        },
                        success: function (response)
                        {
                             $('.tareas').tagsinput('add', tag, {preventPost: true});
                        },
                        error: function(xhr) {
                         console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                       }
                    });

               }
            });

            // Bootstrap datepicker
            $.fn.datepicker.defaults.format = "yyyy-mm-dd";
            $('#caducidad .input-group.date').datepicker({
                todayBtn: "linked",
                dateFormat: 'yy-mm-dd',
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#logo').fileinput({
                <?php if(isset($empresa)) { ?>
                initialPreview: ["{{ asset('img/empresa/' . $empresa->logo) }}"],
                initialPreviewAsData: true,
                <?php } ?>
                theme: 'fa',
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });

            // validate the comment form when it is submitted
            $("#form").validate();
        });
    </script>
@endsection
