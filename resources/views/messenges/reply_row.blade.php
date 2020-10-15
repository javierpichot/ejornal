<div class="media b-b p15 m0 bg-white js-message-reply" data-message_id="{{ $message->id }}" href="#reply-{{ $message->id }}" >
    <div class="media-left">
        <span class="avatar avatar-sm">
            <img src="{{ asset('storage/jornal/usuario/'. auth()->user()->id . '/perfil/' . auth()->user()->photo) }}" alt="..." />
        </span>
    </div>
    <div class="media-body w100p">
        <div class="media-heading">
            <strong>
                {{  auth()->user()->nombre }} {{  auth()->user()->apellido }}
            </strong>
            <span class="text-off pull-right">{{  $message->created_at->diffForHumans() }}</span>
        </div>
        <p><?php echo nl2br($message->body); ?></p>

        <p>
            @php
                $files = unserialize($message->files);
                $total_files = count($files);
            @endphp
            @if($total_files)
                <i class='fa fa-paperclip pull-left font-16'></i>
                <a href="" class="" title="Descargar {{ $total_files }}">Descargar {{ $total_files }}</a>
            @endif
        </p>
    </div>
</div>