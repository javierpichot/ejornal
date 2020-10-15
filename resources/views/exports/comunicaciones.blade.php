<style>
    strong, b {
        font-weight: bold;
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="9"><strong>Ejornal Gestion de comunicaciones de {{ $empresa->nombre or '' }}</strong></th>
    </tr>
    </thead>
</table>
<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Trabajador</th>
        <th>Legajo</th>
        <th>Turno</th>

        <th>Remitente</th>
        <th>Modo Comunicacion</th>
        <th>Motivo</th>
        <th>Contenido</th>
        <th>Observacion</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comunicaciones as $comunicacion)
        <tr>
            <td>{{ $comunicacion->created_at }}</td>
            <td>{{  $comunicacion->trabajador->apellido or '' }} {{ $comunicacion->trabajador->nombre or '' }} </td>
            <td>{{ $comunicacion->trabajador->legajo or ''}}</td>
            <td>{{ $comunicacion->trabajador->turno['nombre'] or ''}}</td>
            <td>{{ $comunicacion->remitente->nombre or ''}}</td>
            <td>{{ $comunicacion->modo_comunicacion->nombre or ''}}</td>
            <td>{{ $comunicacion->motivo_comunicacion->nombre or ''}}</td>
            <td>{{ $comunicacion->contenido or ''}}</td>
            <td>{{ $comunicacion->observacion or ''}}</td>
            <td>{{ $comunicacion->user->nombre or ''}} {{ $comunicacion->user->apellido or ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
