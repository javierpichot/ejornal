<style>
    strong, b {
        font-weight: bold;
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="18"><strong>Ejornal Gestion de consultas de {{ $empresa->nombre }}</strong></th>
    </tr>
    </thead>
</table>
<table>
    <thead>
    <tr>
        <th>Fecha y Hora</th>
        <td>Trabajador</td>
        <th>Tipo de consulta</th>
        <th>Motivo de consulta</th>
        <th>Observaciones</th>
        <th>Profesional</th>
      
    </tr>
    </thead>
    <tbody>
    @foreach($consultas as $consulta)
        <tr>
            <td>{{ $consulta->created_at }}</td>
          
            <td>{{ $consulta->trabajador->apellido or ''}} {{ $consulta->trabajador->nombre or ''}}</td>
            <td>{{ $consulta->consulta_tipo->nombre or '' }}</td>
            <td>{{ $consulta->consulta_motivo->nombre or ''}}</td>
            <td>{{ $consulta->observacion or '' }}</td>
            <td>{{ $consulta->user->nombre or '' }} {{ $consulta->user->apellido or '' }}</td>
          
        </tr>
    @endforeach
    </tbody>
</table>