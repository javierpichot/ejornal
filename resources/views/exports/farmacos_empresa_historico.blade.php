<style>
    strong, b {
        font-weight: bold;
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="9"><strong>Ejornal Gestion de farmacos de {{ $empresa->nombre }}</strong></th>
    </tr>
    </thead>
</table>
<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Trabajador</th>
         <th>Documento</th>
         <th>Legajo</th>
              <th>Turno</th>
      
        <th>Farmaco</th>
        <th>Cantidad</th>
        <th>Motivo Consulta</th>
        <th>Profesional</th>
    </tr>
    </thead>
    <tbody>
    @foreach($farmacos as $farmaco)
        <tr>
            <td>{{ $farmaco->fecha_consulta }}</td>
            <td>{{ $farmaco->nombre }} {{ $farmaco->apellido }}</td>
            <td>{{ $farmaco->documento }}</td>
            <td>{{ $farmaco->numero_legajo }}</td>
          
            <td>{{ $farmaco->nombre_turno }}</td>
            <td>{{ $farmaco->nombre_farmaco }}</td>
            <td>{{ $farmaco->cantidad }}</td>
            <td>{{ $farmaco->motivo_consulta }}</td>
            <td>{{ $farmaco->nombre_profesional }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
