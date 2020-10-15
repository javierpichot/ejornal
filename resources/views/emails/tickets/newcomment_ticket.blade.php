@component('mail::message')
# Hola, {{ $user->nombre }} {{ $user->apellido }}

Hay nuevos comentarios en tu ticket asignado.

@component('mail::button', ['url' => $url])
Ver comentarios
@endcomponent

Gracias el equipo,<br>
{{ config('app.name') }}
@endcomponent
