<style>
        strong, b {
            font-weight: bold;
        }
    </style>
    <table>
        <thead>
        <tr>
            <th colspan="9"><strong>Listado de trabajadores de {{ $empresa->nombre }}</strong></th>
        </tr>
        </thead>
    </table>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombres Apellidos</th>
            <th>Fecha nacimiento</th>
            <th>Documento</th>
            <th>Puesto</th>
            <th>Turno</th>
            <th>Legajo</th>
            <th>Fecha contrato</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trabajadores as $trabajador)
            <tr>
                <td>{{ $trabajador->id }}</td>
                <td>{{ $trabajador->nombre or ''}} {{ $trabajador->apellido or ''}}</td>
                <td>{{ $trabajador->fecha_nacimiento or ''}}</td>
                <td>{{ $trabajador->documento or ''}}</td>
                <td> {{ $trabajador->tarea->nombre or  ''}} </td>
                <td>{{ $trabajador->turno->nombre or ''}}</td>
                <td> {{ $trabajador->numero_legajo or ''}} </td>
                <td> {{ $trabajador->fecha_contrato or ''}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>