@component('mail::message')
# Nueva visita a domicilio

Estimado prestador gracias por su colaboración, a continuación adjuntamos un listado con los pacientes que deseamos realice una valoración. Por favor, utilice el enlace de cada paciente para remitirnos su informe. Muy atentamente equipo eJornal.

# Trabajador: {{ $trabajador->nombre }} {{ $trabajador->apellido }}
# Direccion : {{ $prestacion_pedido->descripcion }}

@component('mail::button', ['url' => $url])
Entrar
@endcomponent

Gracias el equipo de,<br>
{{ config('app.name') }}
@endcomponent
