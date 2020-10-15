@foreach ($threads as $key => $thread)
    <div class='js-message-row pull-left message-row' data-id='{{ $thread->id }}' data-index='{{ $thread->id }}'><div class='media-left'>
                <span class='avatar avatar-xs'>
                    <img src='{{ asset('storage/jornal/usuario/'.$thread->creator()->id . '/perfil/' . $thread->creator()->photo) }}' />

                </span>
        </div>
        <div class='media-body'>
            <div class='media-heading'>
                <strong>{{ $thread->creator()->nombre }}</strong>
                <span class='text-off pull-right time'></span>
            </div>
{{ $thread->subject }}
        </div>
    </div>
@endforeach
