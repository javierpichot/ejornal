<style>
    strong, b {
        font-weight: bold;
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="18"><strong>Ejornal Gestion de documentos de {{ $empresa->nombre }}</strong></th>
    </tr>
    </thead>
</table>
<table>
    <thead>
    <tr>
        <th>Fecha Documento</th>
        <th>Trabajador</th>
              <th>Legajo</th>
              <th>Turno</th>
        <th>Tipo Documentacion</th>
        <th>Estado</th>

        <th>Fecha Entrega</th>
        <th>Días otorgados</th>
              <th>Fecha probable alta</th>

         <th>Fecha Incorporación</th>

        <th>Observacion</th>
        
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($documentos as $documentacion)
        <tr>
            <td>{{ $documentacion->fecha_documento or ''}}</td>
            <td>{{  $documentacion->trabajador->apellido or ''}} {{  $documentacion->trabajador->nombre or ''}}</td>
            <td>{{  $documentacion->trabajador->legajo or ''}}</td>
            <td>{{  $documentacion->trabajador->turno->nombre or '' }}</td>
            <td>{{ $documentacion->documentacion_tipo->nombre or ''}}</td>
            <td>@include('exports.estados_doc_trabajadro', ['documentacion' => $documentacion])</td>
        
          
          <td>{{  $documentacion->fecha_entrega or ''}}</td>

           <td>{{  $documentacion->reposo  or ''}}</td>
          <td>{{  $documentacion->ausentismo->fecha_probable_alta or ''}}</td>

            <td>{{ $documentacion->fecha_incorporacion or ''}}</td>
            <td>{{ $documentacion->observacion or ''}}</td>
                        <td>{{ $documentacion->user->nombre  or ''}}</td>

        </tr>
    @endforeach
    </tbody>
</table>