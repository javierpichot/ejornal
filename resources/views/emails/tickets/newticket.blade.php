@component('mail::message')
# Hola, {{ $user->nombre }} {{ $user->apellido }} te han asignado un nuevo ticket

Haz recibido una notificacion de eJornal.

@component('mail::button', ['url' => $url])
Ver ticket
@endcomponent

Gracias el equipo de,<br>
{{ config('app.name') }}
@endcomponent
