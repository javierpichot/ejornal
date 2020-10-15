@extends('adminlte::layouts.app')
@section('titulo', 'Listado de Roles')

@section('main-content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="{{ route('events_jornal.index') }}">Gerencia de Jornal</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="{{ route('admin.ajustes.index') }}">Administración web</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestión de roles</li>


    
	</ol>
</nav>
    <div class="box box-info">
         <div class="box-header">
           <h3 class="box-title">Listado de Roles</h3>
           <a href="{{ route('admin.role.create') }}" class="btn btn-primary pull-right">
               <i class="fa fa-file-o"></i>
               Nuevo
           </a>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-striped table-bordered" id="role">
                 <thead>
                     <tr>
                         <td>Nombre</td>
                         <td>Acciones</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i=1; ?>
                     @foreach($roles AS $c)
                         <tr id="role_{{ $c->id }}">
                             <td>{{ $c->name }}</td>
                             <td>

                                  <a class="btn btn-primary" href="{{ route('admin.role.edit', ['id' => $c->id]) }}">
                                     <i class="fa fa-pencil"></i>
                                  </a>

                                  {!! method_field('DELETE') !!}
                                  @csrf
                                  <button type="submit" class="btn btn-danger delete-confirm" data-id="{{ $c->id }}" data-href="{{ route('admin.role.destroy', ['id' => $c->id]) }}">
                                      <i class="fa fa-trash"></i>
                                  </button>


                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
    </div>


</div>
@endsection

@push('script')
    <script type="text/javascript">
            $(function () {
                $('.delete-confirm').on('click', function(e) {
					e.preventDefault();

					const swalWithBootstrapButtons = swal.mixin({
						confirmButtonClass: 'btn btn-success',
						cancelButtonClass: 'btn btn-danger',
						buttonsStyling: false,
					})

					swalWithBootstrapButtons({
						title: 'Desea eliminar el role?',
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
										$('#role_' + data.id).fadeOut();
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

                $('#role').DataTable({
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
