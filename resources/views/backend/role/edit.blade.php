@extends('adminlte::layouts.app')
@section('titulo', 'Rol')

@section('main-content')

    {{ Form::model($role, ['route' => ['admin.role.update', $role->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'form'])
    }}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.roles.index') }}">Listado de Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>
<div class="row">  <div class="col-md-6">
    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">Informaci&oacute;n General</h3>
         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                @include("backend.role._formulario")
             </div>
            </div>
          </div>

    </div>

      <div class="col-md-6">
    <div class="box box-info">
         <div class="box-header">
          <h3 class="card-title">  Detalle de Asignación de Permisos</h3>

         </div>
         <div class="box-body">
             <div class="row">
                 <!-- /.card-header -->
                 <div class="col-12">

                                         <div class="box-body table-responsive">
                                           <hr>
                                            <h3>Permiso especial</h3>
                                            <div class="form-group">
                                            <label>{{ Form::radio('special', 'all-access') }} Acceso total</label>
                                            <label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label>
                                            </div>
                                            <hr>
                                            <h3>Lista de permisos</h3>
                                            <div class="form-group">
                                            <ul class="list-unstyled" id="treeview">
                                              @foreach($permissions as $permission)
                                                <li>
                                                    <label>
                                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                                    {{ $permission->name }}
                                                    <em>({{ $permission->description }})</em>
                                                    </label>
                                                </li>
                                                @endforeach
                                              </ul>
                                            </div>
                                         </div>


                                     </div>
             </div>
            </div>

    </div>


    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="pull-right">
                <button type="submit" size="sm" class="btn btn-primary" variant="primary">
                    <i class="fa fa-save nav-icon"></i>
                    Guardar
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </div>
    </div>  </div>  </div>
    {{ Form::close() }}
@endsection

@push('script')
    <script type="text/javascript">
        $(function(){
          $("#treeview").hummingbird();

          $('#permission').DataTable({

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
          });

    </script>
@endpush
