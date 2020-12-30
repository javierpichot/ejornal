<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li>
      <a class="active" href="{{ route('trabajador.ticket.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Gestion de tickets">
        <i class="fa fa-ticket"></i>
        Tickets
        <span class="sr-only">(current)</span>
      </a>
    </li>
    <li>
      <a class="nav-link" href="{{ route('trabajador.comunicacion.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Gestion de comunicaciones">
        <i class="fa fa-commenting"></i>
        Comunicaciones
      </a>
    </li>


    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.incidencia.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Gestión de incidencias">
        <i class="fa fa-exclamation-triangle"></i>
        Incidencias
      </a>
    </li>
    @php
    $id_trabajador = encrypt($trabajador->id);
    $id_empresa = encrypt($empresa->id);
    @endphp
    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.expediente.show', ['id' => $id_trabajador, 'empresa_id' => $id_empresa]) }}" data-toggle="tooltip" title="Historial del expediente">
        <i class="fa fa-user-times"></i>
        Ausentismo
      </a>
    </li>

    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Gestión de consultas">
        <i class="fa fa-user-md"></i>
        Consultas
      </a>
    </li>

    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.prestacion.pedido.index', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Gestión de prestaciones">
        <i class="fa fa-hospital-o"></i>
        Prestaciones
      </a>
    </li>

    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.documentacion.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id])}}" data-toggle="tooltip" title="Gestión de documentación">
        <i class="fa fa-book"></i>
        Documentación
      </a>
    </li>
    <li>
      <a class="nav-link disabled" href="#" data-toggle="tooltip" title="Gestión de capacitaciones">
        <i class="fa fa-users"></i>
        Capacitaciones
      </a>
    </li>
    <li>
      <a class="nav-link disabled" href="{{ route('trabajador.estadisticas.show',  ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]) }}" data-toggle="tooltip" title="Estadisticas">
        <i class="fa fa-plus-square"></i>
        Estadisticas
      </a>
    </li>
  </ul>
</div>
