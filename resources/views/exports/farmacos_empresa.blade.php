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
        <th>Nombre</th>
        <th>Via</th>
        <th>Empresa</th>
        <th>Cantidad</th>
        <th>Fecha caducidad</th>
        <th>Prestacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($farmacos->farmacia as $farmaco)
        <tr>
            <td>{{ $farmaco->nombre }}</td>
           <td>{{ $farmaco->via_prestacion }}</td>
            <td>{{ $empresa->nombre }}</td>
            <td>{{ $farmaco->cantidad }}</td>
            <td>{{ $farmaco->fecha_caducidad }}</td>
            <td>{{ $farmaco->prestacion_droga_tipo->nombre }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
