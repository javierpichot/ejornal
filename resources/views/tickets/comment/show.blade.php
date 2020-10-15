@extends('adminlte::layouts.app')
@section('titulo',  'Gestion de tickets')

@section('menu-empresa')
@include('empresa.partials.menu_empresa',  ['empresa' => $empresa])
@endsection


@section('main-content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
					<li class="breadcrumb-item" aria-current="page"><a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">Dashboard de {{ $empresa->nombre }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">Gestión de tickets</li>
	</ol>
</nav>

<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="user-block">
					<img class="img-circle" src="{{ isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : asset('img/avatar5.png') }}" alt="User Image">
					<span class="username"><a href="#">{{ $empresa->nombre }}</a></span>
					<span class="description">{{ $empresa->created_at->diffForHumans() }}</span>
				</div>

			</div>
			<!-- /.box-body -->
			<div class="box-body">
				<p>Ticket #{{ $ticket->id }}</p>
				<p>Relativo a: {{ $empresa->nombre }}</p>
				<p>Motivo: {{ $ticket->motivo }}</p>
				<p>Observacion: {{ $ticket->observacion }}</p>
				<p>Participantes:
					@foreach ($ticket->roles as $key => $roles)
						{{ $loop->first ? '' : ', ' }}
						{{ $roles->name }}
					@endforeach
				</p>


					@if  ($ticket->status == true)
<button type="button" class="btn btn-primary btn-block open-close-confirm" data-id="{{ $ticket->id }}" data-href-ticket="{{ route('empresa.ticket.comentario.update', ['id' => $ticket->id]) }}" data-toggle="tooltip" title="Cerrar ticket">Cerrar ticket</button>

					@endif

					@if ($ticket->status == false)

						<button type="button" class="btn btn-danger btn-block open-close-confirm" data-id="{{ $ticket->id }}" data-href-ticket="{{ route('empresa.ticket.comentario-open.update', ['id' => $ticket->id]) }}" data-toggle="tooltip" title="Cerrar ticket">Abrir ticket</button>

					@endif

			</div>
		</div>
	</div>

	<div class="col-md-9">
		<!-- Box Comment -->
		<div class="box box-widget">
			<div class="box-header with-border">

				<!-- /.user-block -->

				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->

			<!-- /.box-body -->
			<div class="box-footer box-comments">

				@forelse  ($ticket->comentario as $key => $comentario)

				<div class="box-comment">
					<!-- User image -->
					<img class="img-circle img-sm" src="{{ asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo) }}" alt="{{ $user->nombre }}">

					<div class="comment-text">
						<span class="username">
                               {{ $comentario->user->nombre }}
                             <span class="text-muted pull-right">{{ $comentario->created_at->diffForHumans()}}</span>
						</span><!-- /.username -->
						{!! $comentario->comentarios !!}
					</div>
					<!-- /.comment-text -->
				</div>
				<!-- /.box-comment -->
				@empty
				<div class="callout callout-success">
					<h4>Aun sin comentario!</h4>

					<p>Danos tu opinion.</p>
				</div>
				@endforelse
				<div id="comment_{{ $ticket->id }}"></div>
			</div>
			<!-- /.box-footer -->
			<div class="box-footer">
				@if  ($ticket->status == true)
				<form action="#" method="post" id="commentForm_{{ $ticket->id }}">
					<input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
					<img class="img-responsive img-circle img-sm" src="{{ asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo) }}" alt="{{ $user->nombre }}">
					<!-- .img-push is used to add margin to elements next to floating images -->
					<div class="img-push">
						<textarea class="textarea" placeholder="Place some text here" onkeyup="borrar(event,this)"
	                               style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="commentText" data-id="{{ $ticket->id }}"></textarea>
					</div>
					<div class="row pull-right">
						<button type="button" class="btn btn-primary submit"> Comentar</button>
					</div>
				</form>
				@else
				<div class="callout callout-danger">
					<h4>Los comentarios han sido cerrado!</h4>
				</div>
				@endif

			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
@endsection

@push('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.open-close-confirm').on('click', function(e) {
			e.preventDefault();

			const swalWithBootstrapButtons = swal.mixin({
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false,
			})

			swalWithBootstrapButtons({
				title: 'Cerrar el ticket',
				@if ($ticket->status == true)
					text: "Esta seguro que desea cerrar el ticket?",
				@endif

				@if ($ticket->status == false)
					text: "Esta seguro que desea abrir el ticket?",
				@endif
				type: 'warning',
				showCancelButton: true,
				@if ($ticket->status == true)
					confirmButtonText: 'Si, cerrar!',
				@endif

				@if ($ticket->status == false)
					confirmButtonText: 'Si, abrirlo!',
				@endif

				cancelButtonText: 'No, dejar abierto!',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: $(this).attr('data-href-ticket'),
						method: 'POST',
						dataType: 'JSON',
						data: {
							'id': $(this).attr('data-id'),
							'_method': 'PATCH'
						},
						success: function(data) {
							window.location.reload('/');
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
						'Operación cancelada',
						'error'
					)
				}
			})

		});

		$('.textarea').summernote({
			height: 300,
			focus: true,
			callbacks: {
				onImageUpload: function(files) {
					uploadImage(files[0]);
				}
			}
		});

		function uploadImage(file) {
			data = new FormData();
			data.append("file", file);
			$.ajax({
				data: data,
				type: 'POST',
				url: '/trabajador/ticket/upload-files',
				cache: false,
				contentType: false,
				processData: false,
				success: function(url) {
					$('.textarea').summernote('insertImage', url, function($image) {
						$image.css('width', $image.width() / 2);
						$image.addClass('img-responsive');
					});
				}
			});
		}

		//showPost();

		$('#postBtn').click(function() {
			var post = $('#post').val();
			if (post == '') {
				alert('Please write a Post first!');
				$('#post').focus();
			} else {
				var postForm = $('#postForm').serialize();
				$.ajax({
					type: 'POST',
					url: '/post',
					data: postForm,
					dataType: 'json',
					success: function() {
						showPost();
						$('#postForm')[0].reset();
					},
				});
			}
		});



		$(document).on('click', '.submit', function() {
			var thisForm = $(this);
			var parent = $(this).data('parent');
			if ($('#commentText').val() == '') {
				alert('Please write a Comment First!');
			} else {
				var comment = $("#commentText").val();
				var ticket_id = $('input[name="ticket_id"]').val();
				var dataString = '&comment=' + comment + '&ticket_id=' + ticket_id;
				$.ajax({
					type: 'POST',
					url: '/trabajador/ticket/comentario/store',
					data: dataString,
					success: function(data) {
						var newComment = '<div class="box-comment"><img class="img-circle img-sm" src="{{ url('/') }}/storage/jornal/usuario/' + {{ auth()->user()->id }} + '/perfil/' + data.user.photo + '" alt="' + data.user.nombre + '"><div class="comment-text"><span class="username">' + data.user.nombre +
							'<span class="text-muted pull-right">' + data.created_at + '</span>' + data.comentarios + '</div></div>';
						$('#comment_' + ticket_id).prepend(newComment);
						$('.textarea').summernote('reset');
					},
				});
			}

		});

	});

	function eraseText() {
		document.getElementById("comment").value = "";
	}

	function showPost() {
		$.ajax({
			url: '/show',
			success: function(data) {
				$('#postList').html(data);
			},
		});
	}

	function getComment(id) {
		$.ajax({
			type: 'GET',
			url: '/trabajador/ticket/' + id + '/comentarios',
			success: function(data) {
				$('#comment_' + id).html(data);
			}
		});
	}
</script>
@endpush
