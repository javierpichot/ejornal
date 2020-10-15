@extends('adminlte::layouts.app') @section('titulo', 'Gestion de pedidos') @section('menu-empresa') @include('empresa.partials.menu_empresa', ['empresa' => $empresa]) @endsection @section('main-content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="">Perfil de {{ $empresa->nombre }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre, 'empresa_id' => $empresa->id]) }}">Gestión de pedidos</a></li>
  </ol>
</nav>

<div class="modal fade in" id="editCotizacion" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="modal_content"></div>
  </div>
</div>

<!--Modal cotizacion-->
<div class="modal fade" id="newCotizacion" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      @include('empresa.prestacion.cotizacion_form')
    </div>
  </div>
</div>


<!--Modal presupuesto-->
<div class="modal fade" id="newPresupesto" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      @include('empresa.prestacion.presupuesto_form')
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <div class="user-block">
          <img src="{{ isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : asset('img/avatar5.png') }}" width="35 px" height="35 px" class="img-circle elevation-2" alt="{{ $empresa->nombre }}">
          <span class="username"><a href="#">{{ $empresa->nombre }}</a></span>
          <span class="description" title="{{$empresa->created_at}}">Nº de orden #{{ $prestacion_pedido->id }} {{ $empresa->created_at->diffForHumans() }}</span>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-body">
        <h4></h4>
        <p><b>Relativo a:</b>
            @isset($prestacion_pedido->trabajador)
                {{ $prestacion_pedido->trabajador->nombre }} {{ $prestacion_pedido->trabajador->apellido }}
            @endisset

            @isset($prestacion_pedido->empresa)
                {{ $prestacion_pedido->empresa->nombre }}
            @endisset
        </p>

        <p><b>Tipo de prestación:</b> {{ $prestacion_pedido->prestacion_tipo->nombre }}</p>

        <p><b>Descripcion:</b> {{ $prestacion_pedido->descripcion }}</p>
        <p><b>Observacion:</b> {{ $prestacion_pedido->observaciones }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-6">

    <div class="callout callout-info">
      <h4><i class="icon fa fa-info"></i> Estado</h4>
      <p>
        @include('empresa.prestacion.estado')
      </p>
      <div class="pull-right">
        @if ($prestacion_pedido->estado == 6)
            {{ Form::model($prestacion_pedido, ['route' => ['empresa.close.pedido.update', $prestacion_pedido->id, $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm']) }}
            <button type="submit" class="btn btn-danger">Cerrar pedido</button> {{ Form::close() }}
        @endif

      </div>

    </div>
  </div>
</div>
<div class="row">
  @can ('gerencia_jornal.listado_cotizaciones')

  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">
          Listado de cotizaciones
        </h3>
        <div class="box-tools pull-right">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newCotizacion" style="margin-bottom:25px">Nueva cotizacion</a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <table class="table table-striped table-bordered" id="cotizaciones">
          <thead>
            <tr>
              <td>Proveedor</td>
              <td>Cotizacion</td>
              <td>Archivo cotizacion</td>
              <td>Observaciones</td>
              <td>Elegida</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($prestacion_cotizaciones as $key => $prestacion_cotizacion)
            <tr id="cotizacion_{{ $prestacion_cotizacion->id }}">
              <td>{{ $prestacion_cotizacion->proveedor->nombre }}</td>
              <td>{{ $prestacion_cotizacion->cotizacion }}</td>
              <td>{{ $prestacion_cotizacion->cotizacion_url }}</td>
              <td>{{ $prestacion_cotizacion->observaciones }}</td>
              <td></td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">


                  <a class="btn btn-warning" title="Edit" href="#editCotizacion" data-toggle="modal" data-href="{{route('empresa.cotizacion.pedido.edit', ['id' => $prestacion_cotizacion->id, 'id_empresa' => $empresa->id , 'pedido_id' => $prestacion_pedido->id])}}"><i title="Editar cotizacion" class="fa fa-pencil"></i></a>                  {!! method_field('DELETE') !!} @csrf
                  <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                  <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $prestacion_cotizacion->id }}" data-href="{{ route('empresa.cotizacion.pedido.destroy', ['id' => $prestacion_cotizacion->id]) }}">
                                            <i class="fa fa-trash"></i>
                                        </button>


                  <button type="submit" class="btn btn-success confirm-cotizacion" data-id="{{ $empresa->id }}" data-href="{{ route('empresa.cotizacion.pedido.update', ['id' => $prestacion_cotizacion->id, 'prestacion_pedido_id' =>  $prestacion_pedido->id ]) }}">
                                            <i class="fa fa-check"></i>
                                        </button>


                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endcan

  <!-- /.col -->
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">
          Listado de presupuestos
        </h3>
        <div class="box-tools pull-right">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newPresupesto" style="margin-bottom:25px">Nuevo presupuesto</a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <table class="table table-striped table-bordered" id="presupuesto_list">
          <thead>
            <tr>
              <td>Proveedor</td>
              <td>Presupuesto</td>
              <td>Archivo presupuesto</td>
              <td>Observaciones</td>
              <td>Aprobado</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($prestacion_presupuestos as $key => $prestacion_presupuesto)
            <tr id="presupuesto_{{ $prestacion_presupuesto->id }}">
              <td>{{ $prestacion_presupuesto->proveedor->nombre }}</td>
              <td>{{ $prestacion_presupuesto->presupuesto }}</td>
              <td>{{ $prestacion_presupuesto->presupuesto_url }}</td>
              <td>{{ $prestacion_presupuesto->observaciones }}</td>
              <td>

              </td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <div class="btn-group" role="group" aria-label="Basic example">




                    {!! method_field('DELETE') !!} @csrf
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                    <button type="submit" class="btn btn-danger delete-confirm-presupuesto" data-id="{{ $prestacion_presupuesto->id }}" data-href="{{ route('empresa.presupuesto.pedido.destroy', ['id' => $prestacion_presupuesto->id]) }}">
                                                <i class="fa fa-trash"></i>
                                            </button>


                    <button type="submit" class="btn btn-success confirm-presupuesto" data-id="{{ $empresa->id }}" data-href="{{ route('empresa.presupuesto.pedido.update', ['id' => $prestacion_presupuesto->id, 'prestacion_pedido_id' =>  $prestacion_pedido->id ]) }}">
                                                <i class="fa fa-check"></i>
                                            </button>


                  </div>
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

<div class="row">
  <div class="col-md-6">
      @isset($orden_servicio)
          {{ Form::model($orden_servicio, ['route' => ['empresa.orden.pedido.update', $orden_servicio->id, $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm', 'enctype' => 'multipart/form-data'])
          }}
      @endisset

      @empty ($orden_servicio)
          {{ Form::open(['route' => 'empresa.orden.pedido.store', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
      @endempty

    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
    <input type="hidden" name="prestacion_pedido_id" value="{{ $prestacion_pedido->id }}">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">
          Orden de servicio
        </h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <div class="col-md-12">
          {{ Form::label('orden_servicio', "Orden de servicio") }} {{ Form::textarea('orden_servicio', isset($orden_servicio) ? $orden_servicio->orden_servicio : null, ['class' => 'form-control box-size', 'placeholder' => "Orden de servicio"]) }} @if ($errors->has('orden_servicio'))
          <span class="help-block">
                            <strong>{{ $errors->first('orden_servicio') }}</strong>
                        </span> @else
          <span class="help-block" id="orden_servicio"></span> @endif
        </div>

        <div class="col-md-12">
          <div class="file-loading">
            <input id="orden_servicio_url" name="orden_servicio_url[]" type="file" multiple>
          </div>
        </div>

        <div class="col-md-12 pull-left" style="margin-top: 25px">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>




      </div>
    </div>

    {{ Form::close() }}


  </div>
  <div class="col-md-6">
    {{ Form::model($prestacion_pedido, ['route' => ['empresa.reporte.pedido.update', $prestacion_pedido->id, $empresa->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm', 'enctype' => 'multipart/form-data']) }}
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">
          Reporte del servicio
        </h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">

        <div class="col-md-12">
          {{ Form::label('reporte', "Reporte") }} {{ Form::textarea('reporte', isset($prestacion_pedido) ? $prestacion_pedido->reporte : null, ['class' => 'form-control box-size', 'placeholder' => "Reporte del servicio"]) }} @if ($errors->has('reporte'))
          <span class="help-block">
                            <strong>{{ $errors->first('reporte') }}</strong>
                        </span> @else
          <span class="help-block" id="reporte"></span> @endif
        </div>


        <div class="col-md-12">
          {{ Form::label('feedback', "Feedback") }} {{ Form::text('feedback', isset($prestacion_pedido) ? $prestacion_pedido->feedback : null, ['class' => 'form-control box-size', 'placeholder' => "Feedback"]) }} @if ($errors->has('feedback'))
          <span class="help-block">
                            <strong>{{ $errors->first('feedback') }}</strong>
                        </span> @else
          <span class="help-block" id="reporte"></span> @endif
        </div>

        <div class="col-md-12">
          <div class="file-loading">
            <input id="reporte_url" name="reporte_url[]" type="file" multiple>
          </div>
        </div>

        <div class="col-md-12 pull-left" style="margin-top: 25px">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>




      </div>
    </div>

    {{ Form::close() }}


  </div>
</div>


@endsection @push('script')
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
        title: 'Desea eliminar la cotizacion?',
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
                $('#cotizacion_' + data.id).fadeOut();
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


    $('.delete-confirm-presupuesto').on('click', function(e) {
      e.preventDefault();

      const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
      })

      swalWithBootstrapButtons({
        title: 'Desea eliminar el presupuesto?',
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
                $('#presupuesto_' + data.id).fadeOut();
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


    //Cotizacion update
    $('.confirm-cotizacion').on('click', function(e) {
      e.preventDefault();

      const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
      })

      swalWithBootstrapButtons({
        title: 'Deseas aprobar dicha cotizacion?',
        text: "Al ser aprobada no hay vuelta atras!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, aprobar!',
        cancelButtonText: 'No, cancelar accion!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: $(this).attr('data-href'),
            method: 'POST',
            dataType: 'JSON',
            data: {
              '_token': $('input[name="_token"]').val(),
              'empresa_id': $(this).attr('data-id'),
              '_method': "PATCH"
            },
            success: function(data) {
              if (data.status == 'success') {
                setTimeout(function() {
                  window.location.reload(data.redirect_url);
                }, 3000);
                sweetAlert('APROBADA', data.message, 'success');
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

    $('#orden_servicio_url').fileinput({
      <?php if(isset($orden_servicio)) { ?>
      previewTemplates: 'file-preview-pdf',
      initialPreviewFileType: 'pdf',
      initialPreview: ["{{ asset('storage/empresas/' . $empresa->id . '/prestaciones/' . $prestacion_pedido->id . '/orden_servicio/'. $orden_servicio->orden_servicio_url) }}"],
      initialPreviewAsData: true,
      initialPreviewDownloadUrl: "{{ route('empresa.documentacion.generate',['empresa_id' => $empresa->id, 'filename' => $orden_servicio->orden_servicio_url, 'prestacion_pedido' => $prestacion_pedido->id, 'type' => 'orden_servicio'] ) }}",
      <?php } ?>
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
      <?php if(isset($prestacion_pedido->reporte_url)) { ?>
      previewTemplates: 'file-preview-pdf',
      initialPreviewFileType: 'pdf',
      initialPreview: ["{{ asset('storage/empresas/' . $empresa->id . '/prestaciones/' . $prestacion_pedido->id . '/reporte_servicio/'.$prestacion_pedido->reporte_url) }}"],
      initialPreviewAsData: true,
      initialPreviewDownloadUrl: "{{ route('empresa.documentacion.generate',['empresa_id' => $empresa->id, 'filename' => $prestacion_pedido->reporte_url, 'prestacion_pedido' => $prestacion_pedido->id, 'type' => 'reporte_servicio'] ) }}",
      <?php } ?>
      maxFileCount: 5,
      theme: 'fa',
      language: 'es',
      uploadUrl: '#',
      dropZoneTitle: 'Suba o arrastre las fotos del reporte del servicio',
      allowedFileExtensions: ['jpg', 'png', 'gif'],
      browseClass: "btn btn-primary btn-block",
      showCaption: false,
      showRemove: false,
      showUpload: false
    });



    //Presupuesto update
    $('.confirm-presupuesto').on('click', function(e) {
      e.preventDefault();

      const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
      })

      swalWithBootstrapButtons({
        title: 'Deseas aprobar dicho presupuesto?',
        text: "Al ser aprobada no hay vuelta atras!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, aprobar!',
        cancelButtonText: 'No, cancelar accion!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: $(this).attr('data-href'),
            method: 'POST',
            dataType: 'JSON',
            data: {
              '_token': $('input[name="_token"]').val(),
              'empresa_id': $(this).attr('data-id'),
              '_method': "PATCH"
            },
            success: function(data) {
              if (data.status == 'success') {
                setTimeout(function() {
                  window.location.reload(data.redirect_url);
                }, 3000);
                sweetAlert('APROBADO', data.message, 'success');
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
          toastr.success(data.text, 'Operacion exitosa', {
            timeOut: 5000,
            icon: 'success'
          })

          $('.is-invalid').removeClass('is-invalid');
          $('#newPresupesto').modal('hide');


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

    $('#editCotizacion').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      ajaxLoad(button.data('href'), 'modal_content');
    });

    $('#editCotizacion').on('shown.bs.modal', function() {
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

    $('#cotizacion_url').fileinput({
      maxFileCount: 5,
      theme: 'fa',
      language: 'es',
      uploadUrl: '#',
      dropZoneTitle: 'Suba o arrastre las fotos de la cotizacion',
      allowedFileExtensions: ['jpg', 'png', 'gif'],
      browseClass: "btn btn-primary btn-block",
      showCaption: false,
      showRemove: false,
      showUpload: false
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
    $('#cotizaciones').DataTable({
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


    $('#presupuesto_list').DataTable({
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
