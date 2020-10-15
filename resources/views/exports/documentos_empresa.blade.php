<style>
    strong, b {
        font-weight: bold;
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="9"><strong>Ejornal Gestion de documentos de {{ $empresa->nombre }}</strong></th>
    </tr>
    </thead>
</table>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>Descripcion</th>
        <th>Usuario</th>
        <th>Empresa</th>
        <th>Tipo documento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($documentos as $documentacion)
        <tr>
            <td>{{ $documentacion->id }}</td>
            <td>{{ $documentacion->created_at }}</td>
            <td>{{  $documentacion->descripcion }}</td>
            <td>{{ $documentacion->user->nombre or ''}}</td>
            <td>{{ $documentacion->empresa->nombre or ''}}</td>
            <td>{{ $documentacion->documentacion_empresa_tipo->nombre or ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>