@forelse ($comments as $key => $comentario)

    <div class="box-comment">
      <!-- User image -->
      <img class="img-circle img-sm" src="{{ isset( $user->photo) ? asset('img/usuario/'. $user->photo ) : '' }}" alt="User Image">

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
