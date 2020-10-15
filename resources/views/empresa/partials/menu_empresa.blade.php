<li class="header">MENU {{strtoupper( $empresa->nombre) }}</li>
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image" align="middle">
        <a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">
            <img src="{{ isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : asset('img/avatar5.png') }}" width="35 px" height="35 px" class="img-circle elevation-2" alt="{{ $empresa->nombre }}">
        </a>
    </div>
</div>
    <li class="{!! Request::is('empresa/*/*/show') ? 'active' : '' !!}">
    <a  href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}"><i class="sidebar-item-icon fa fa-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>
@can ('menu_calen_empresa')

<li class="{!! Request::is('calendario/*/*') ? 'active' : '' !!}">
    <a href="{{ route('calendario.index',  ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
        <i class="sidebar-item-icon fa fa-calendar"></i> <span class="nav-label">Calendario</span>
    </a>
</li>
@endcan
@can ('menu_gesti_empresa')

    <li class="treeview {!! Request::is('empresa/*/*/revision-entidades')  ? 'active' : '' !!}" >
        <a href="#">
            <i class="sidebar-item-icon fa fa-industry"></i> <span class="nav-label">Gestión empresa</span>
            <i class="fa fa-angle-left arrow"></i></a>
            <ul class="treeview-menu">
        <li class="treeview">
                <a href="">
                    <i class="sidebar-item-icon fa fa-binoculars"></i> <span class="nav-label">Gestión de tareas</span>
                    <i class="fa fa-angle-left arrow"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('empresa.revisiones.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"><i class="fa fa-circle-o"></i>Relevamiento de tareas</a>
                            </li>
                            <li>
                                <a href="{{ route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"><i class="fa fa-circle-o"></i>Histórico de tareas </a>
                            </li>
                        </ul>
        </li>


        <li>
          <a href="{{ route('empresa.usuarios.index',  ['id' => $empresa->id, 'name' => $empresa->nombre] ) }}"><i class="sidebar-item-icon fa fa-group"></i> Administración usuarios</a>
        </li>
              

  
        <li class="">
            <a href="{{ route('empresa.movimientos.show', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
                <i class="sidebar-item-icon fa fa-university"></i><span class="nav-label">Últimos movimientos</span>
            </a>
        </li>
                            </ul>
    </li>
@endcan
@can ('menu_corre_empresa')
<li>
    <a href="{{ route('empresa.mails.index', ['id' => $empresa->id, 'name' => $empresa->nombre, 'folder' => 'INBOX']  ) }}"><i

class="sidebar-item-icon fa fa-at"></i>
        <span class="nav-label">Correo corporativo</span>
    </a>
</li>
@endcan
@can ('menu_ticke_empresa')

<li class="{!! Request::is('empresa/*/*/ticket-empresa')  ? 'active' : '' !!}">
<a href="{{ route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
           <i class="sidebar-item-icon fa fa-ticket"></i> <span class="nav-label">Gestión de tickets</span>
        </a>
    </li>
    @endcan
@can ('menu_traba_empresa')

    <li class="{!! Request::is('empresa/*/*/trabajadores')  ? 'active' : '' !!}">
         <a href="{{ route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
            <i class="sidebar-item-icon fa fa-users"></i> <span class="nav-label">Gestión de trabajadores</span>
        </a>
    </li>
@endcan



@can ('menu_seh_empresa')

    <li class="treeview {!! Request::is('empresa/*/*/incidencias')  ? 'active' : '' !!}">
        <a href="#">
            <i class="sidebar-item-icon fa fa-exclamation-triangle"></i> <span class="nav-label">Seguridad e

Higiene</span>
        <i class="fa fa-angle-left arrow"></i></a>
        <ul class="treeview-menu">
  <li class="">
        <a href="{{ route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
            <i class="sidebar-item-icon fa fa-fire-extinguisher"></i><span class="nav-label">Relevamiento agentes de riesgo</span>
        </a>
    </li>
          <li class="">
        <a href="{{ route('empresa.incidencias.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
            <i class="sidebar-item-icon fa fa-exclamation-triangle"></i> <span class="nav-label">Incidencias / Accidentes</span>
        </a>
    </li>

          

    <li class="">
        <a href="">
            <i class="sidebar-item-icon fa fa-university"></i><span class="nav-label">Gestión

capacitaciones</span>
        </a>
    </li>
                        </ul>
    </li>
    @endcan
    @can ('menu_ausen_empresa')

    <li class="treeview {!! Request::is('empresa/*/*/ausentismos') || Request::is('empresa/*/*/comunicaciones')  || Request::is('empresa/*/*/certificaciones-entregadas')|| Request::is('empresa/*/*/medicos-a-domicilio')? 'active' : '' !!}">
        <a href="#">
            <i class="sidebar-item-icon fa fa-user-times"></i> <span class="nav-label">Gestión ausentismo</span>
        <i class="fa fa-angle-left arrow"></i></a>
    <ul class="treeview-menu">
               <li class="">

                                <a href="{{ route('empresa.ausentismos.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"><i class="sidebar-item-icon fa fa-window-close-o"></i>

Episodios de ausentismo </a>
                            </li>


      <li class="">
        <a href="{{ route('empresa.comunicaciones.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}">
            <i class="sidebar-item-icon fa fa-commenting"></i> <span class="nav-label">Gestión
de comunicaciones</span>
        </a>
    </li>

                            <li>
                                        <a href="{{ route('empresa.certificaciones.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}"><i class="sidebar-item-icon fa fa-archive"></i>

Certificados entregados </a>
                            </li>
           <li>
                                <a href="{{ route('empresa.medicos_domicilio.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}"><i class="sidebar-item-icon fa fa-cab"></i>

Médico a domicilio </a>
                            </li>    </ul>
    </li>
    @endcan

@can ('menu_medla_empresa')
    <li class="treeview {!! Request::is('empresa/*/*/consultas') || Request::is('empresa/*/*/farmacos')? 'active' : '' !!}">
        <a href="">
            <i class="sidebar-item-icon fa fa-user-md"></i> <span class="nav-label">Medicina Laboral</span>
             <i class="fa fa-angle-left arrow"></i></a>
        <ul class="treeview-menu">
                            <li>

                                        <a href="{{ route('empresa.consultas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}">
            <i class="sidebar-item-icon fa fa-user-md"></i> <span class="nav-label">Gestión de consultas</span>
        </a>
                            </li>


<li class="treeview">
        <a href="">
            <i class="sidebar-item-icon fa fa-binoculars"></i> <span class="nav-label">Gestión de farmacia</span>
            <i class="fa fa-angle-left arrow"></i></a>
  </a>
                                  <ul class="treeview-menu">
                            <li>

                                <a href="{{ route('empresa.farmacos.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}"><i class="fa fa-circle-o"></i>

Stock</a>
                            </li>

                            <li>
                                <a href="{{ route('empresa.farmacos.stock', ['id' => $empresa->id, 'name' => $empresa->nombre])}}"><i class="fa fa-circle-o"></i>

Histórico de movimientos </a>
                            </li>



                        </ul>
                            </li>

   
                        </ul>
    </li>
@endcan
@can ('menu_prest_empresa')

    <li class=" {!! Request::is('empresa/*/*/prestacion-pedidos')? 'active' : '' !!}">
 <a href="{{ route('empresa.prestacion.pedido.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}">
   <i class="sidebar-item-icon fa fa-hospital-o"></i> <span class="nav-label">Gestión prestaciones</span>
 </a>

    </li>
@endcan
@can ('menu_docum_empresa')

    <li class=" {!! Request::is('empresa/*/*/documentos')? 'active' : '' !!}">
        <a href="{{ route('empresa.documentos.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}">
            <i class="sidebar-item-icon fa fa-book"></i> <span class="nav-label">Documentación {{ $empresa->nombre }}</span>
        </a>
    </li>

    @endcan
    @can ('menu_repor_empresa')



       <li class="{!! Request::is('reportes/*/*')? 'active' : '' !!}">
        <a href="{{ route('reportes.index', ['id' => $empresa->id, 'name' => $empresa->nombre])}}">
            <i class="sidebar-item-icon fa fa-envelope-o"></i> <span class="nav-label">Reportes</span>
        </a>
    </li>
    @endcan
    @can ('menu_estad_empresa')

    <li class="{!! Request::is('empresa/*/*/estadisticas')? 'active' : '' !!}">
    <a href="{{ route('empresa.estadisticas.show', ['id' => $empresa->id, 'name' => $empresa->nombre])}}">
            <i class="sidebar-item-icon fa fa-pie-chart"></i> <span class="nav-label">Estadisticas</span>
        </a>
    </li>

    @endcan




@isset($empresa)
    @if(Carbon::now()->format('Y-m-d') > $empresa->caducidad)
        <script>
            $(document).ready(function()
            {
                $('#mostrarmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                })

            });
        </script>
    @endif

    @if($empresa->caducidad == Carbon::now()->format('Y-m-d'))
        <script>
            $(document).ready(function()
            {
                $('#mostrarmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                })

                setTimeout(function(){
                    $('#mostrarmodal').modal('hide')
                }, 10000);
            });
        </script>
    @endif
@endisset

