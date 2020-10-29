<li class="header">MENU <?php echo e(strtoupper( $empresa->nombre)); ?></li>
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image" align="middle">
        <a href="<?php echo e(route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )); ?>">
            <img src="<?php echo e(isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : asset('img/avatar5.png')); ?>" width="35 px" height="35 px" class="img-circle elevation-2" alt="<?php echo e($empresa->nombre); ?>">
        </a>
    </div>
</div>
    <li class="<?php echo Request::is('empresa/*/*/show') ? 'active' : ''; ?>">
    <a  href="<?php echo e(route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )); ?>"><i class="sidebar-item-icon fa fa-dashboard"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>
<?php if (\Shinobi::can('menu_calen_empresa')): ?>

<li class="<?php echo Request::is('calendario/*/*') ? 'active' : ''; ?>">
    <a href="<?php echo e(route('calendario.index',  ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
        <i class="sidebar-item-icon fa fa-calendar"></i> <span class="nav-label">Calendario</span>
    </a>
</li>
<?php endif; ?>
<?php if (\Shinobi::can('menu_gesti_empresa')): ?>

    <li class="treeview <?php echo Request::is('empresa/*/*/revision-entidades')  ? 'active' : ''; ?>" >
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
                                <a href="<?php echo e(route('empresa.revisiones.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="fa fa-circle-o"></i>Relevamiento de tareas</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="fa fa-circle-o"></i>Histórico de tareas </a>
                            </li>
                        </ul>
        </li>


        <li>
          <a href="<?php echo e(route('empresa.usuarios.index',  ['id' => $empresa->id, 'name' => $empresa->nombre] )); ?>"><i class="sidebar-item-icon fa fa-group"></i> Administración usuarios</a>
        </li>
              

  
        <li class="">
            <a href="<?php echo e(route('empresa.movimientos.show', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
                <i class="sidebar-item-icon fa fa-university"></i><span class="nav-label">Últimos movimientos</span>
            </a>
        </li>
                            </ul>
    </li>
<?php endif; ?>
<?php if (\Shinobi::can('menu_corre_empresa')): ?>
<li>
    <a href="<?php echo e(route('empresa.mails.index', ['id' => $empresa->id, 'name' => $empresa->nombre, 'folder' => 'INBOX']  )); ?>"><i

class="sidebar-item-icon fa fa-at"></i>
        <span class="nav-label">Correo corporativo</span>
    </a>
</li>
<?php endif; ?>
<?php if (\Shinobi::can('menu_ticke_empresa')): ?>

<li class="<?php echo Request::is('empresa/*/*/ticket-empresa')  ? 'active' : ''; ?>">
<a href="<?php echo e(route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
           <i class="sidebar-item-icon fa fa-ticket"></i> <span class="nav-label">Gestión de tickets</span>
        </a>
    </li>
    <?php endif; ?>
<?php if (\Shinobi::can('menu_traba_empresa')): ?>

    <li class="<?php echo Request::is('empresa/*/*/trabajadores')  ? 'active' : ''; ?>">
         <a href="<?php echo e(route('empresa.trabajadores.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-users"></i> <span class="nav-label">Gestión de trabajadores</span>
        </a>
    </li>
<?php endif; ?>



<?php if (\Shinobi::can('menu_seh_empresa')): ?>

    <li class="treeview <?php echo Request::is('empresa/*/*/incidencias')  ? 'active' : ''; ?>">
        <a href="#">
            <i class="sidebar-item-icon fa fa-exclamation-triangle"></i> <span class="nav-label">Seguridad e

Higiene</span>
        <i class="fa fa-angle-left arrow"></i></a>
        <ul class="treeview-menu">
  <li class="">
        <a href="<?php echo e(route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-fire-extinguisher"></i><span class="nav-label">Relevamiento agentes de riesgo</span>
        </a>
    </li>
          <li class="">
        <a href="<?php echo e(route('empresa.incidencias.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
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
    <?php endif; ?>
    <?php if (\Shinobi::can('menu_ausen_empresa')): ?>

    <li class="treeview <?php echo Request::is('empresa/*/*/ausentismos') || Request::is('empresa/*/*/comunicaciones')  || Request::is('empresa/*/*/certificaciones-entregadas')|| Request::is('empresa/*/*/medicos-a-domicilio')? 'active' : ''; ?>">
        <a href="#">
            <i class="sidebar-item-icon fa fa-user-times"></i> <span class="nav-label">Gestión ausentismo</span>
        <i class="fa fa-angle-left arrow"></i></a>
    <ul class="treeview-menu">
               <li class="">

                                <a href="<?php echo e(route('empresa.ausentismos.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="sidebar-item-icon fa fa-window-close-o"></i>

Episodios de ausentismo </a>
                            </li>


      <li class="">
        <a href="<?php echo e(route('empresa.comunicaciones.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-commenting"></i> <span class="nav-label">Gestión
de comunicaciones</span>
        </a>
    </li>

                            <li>
                                        <a href="<?php echo e(route('empresa.certificaciones.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="sidebar-item-icon fa fa-archive"></i>

Certificados entregados </a>
                            </li>
           <li>
                                <a href="<?php echo e(route('empresa.medicos_domicilio.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="sidebar-item-icon fa fa-cab"></i>

Médico a domicilio </a>
                            </li>    </ul>
    </li>
    <?php endif; ?>

<?php if (\Shinobi::can('menu_medla_empresa')): ?>
    <li class="treeview <?php echo Request::is('empresa/*/*/consultas') || Request::is('empresa/*/*/farmacos')? 'active' : ''; ?>">
        <a href="">
            <i class="sidebar-item-icon fa fa-user-md"></i> <span class="nav-label">Medicina Laboral</span>
             <i class="fa fa-angle-left arrow"></i></a>
        <ul class="treeview-menu">
                            <li>

                                        <a href="<?php echo e(route('empresa.consultas.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
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

                                <a href="<?php echo e(route('empresa.farmacos.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="fa fa-circle-o"></i>

Stock</a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('empresa.farmacos.stock', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>"><i class="fa fa-circle-o"></i>

Histórico de movimientos </a>
                            </li>



                        </ul>
                            </li>

   
                        </ul>
    </li>
<?php endif; ?>
<?php if (\Shinobi::can('menu_prest_empresa')): ?>

    <li class=" <?php echo Request::is('empresa/*/*/prestacion-pedidos')? 'active' : ''; ?>">
 <a href="<?php echo e(route('empresa.prestacion.pedido.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
   <i class="sidebar-item-icon fa fa-hospital-o"></i> <span class="nav-label">Gestión prestaciones</span>
 </a>

    </li>
<?php endif; ?>
<?php if (\Shinobi::can('menu_docum_empresa')): ?>

    <li class=" <?php echo Request::is('empresa/*/*/documentos')? 'active' : ''; ?>">
        <a href="<?php echo e(route('empresa.documentos.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-book"></i> <span class="nav-label">Documentación <?php echo e($empresa->nombre); ?></span>
        </a>
    </li>

    <?php endif; ?>
    <?php if (\Shinobi::can('menu_repor_empresa')): ?>



       <li class="<?php echo Request::is('reportes/*/*')? 'active' : ''; ?>">
        <a href="<?php echo e(route('reportes.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-envelope-o"></i> <span class="nav-label">Reportes</span>
        </a>
    </li>
    <?php endif; ?>
    <?php if (\Shinobi::can('menu_estad_empresa')): ?>

    <li class="<?php echo Request::is('empresa/*/*/estadisticas')? 'active' : ''; ?>">
    <a href="<?php echo e(route('empresa.estadisticas.show', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>">
            <i class="sidebar-item-icon fa fa-pie-chart"></i> <span class="nav-label">Estadisticas</span>
        </a>
    </li>

    <?php endif; ?>




<?php if(isset($empresa)): ?>
    <?php if(Carbon::now()->format('Y-m-d') > $empresa->caducidad): ?>
        <script>
            $(document).ready(function()
            {
                $('#mostrarmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                })

            });
        </script>
    <?php endif; ?>

    <?php if($empresa->caducidad == Carbon::now()->format('Y-m-d')): ?>
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
    <?php endif; ?>
<?php endif; ?>

