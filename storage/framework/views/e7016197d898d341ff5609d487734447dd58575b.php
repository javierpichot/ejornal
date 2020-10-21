<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control search-menu-box" placeholder="Buscar..." id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">



            <?php if (\Shinobi::can('menu_acces_jornal')): ?>
            <li class="header">MENU eJORNAL</li>

            <?php if (\Shinobi::can('menu_geren_jornal')): ?>

            <!--Administracion web-->
            <li
                class="treeview <?php echo Request::is('administrador/profesional-fichada') || Request::is('administrador/sucursales') ||  Request::is('administrador/empresas') || Request::is('administrador/roles') ||  Request::is('administrador/proveedores') || Request::is('administrador/tipo-prestaciones') ||  Request::is('administrador/gestion-pedidos') ? 'active' : ''; ?>">
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-suitcase"></i>
                    <span class="nav-label">Gerencia eJornal</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo e(route('events_jornal.index')); ?>"><i class="sidebar-item-icon fa fa-calendar"></i> Calendario</a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="sidebar-item-icon fa fa-address-card"></i> Profesionales
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo e(route('admin.profesional.index')); ?>"><i class="sidebar-item-icon fa fa-group"></i> Gestión de profesionales</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.profesional-fichada.index')); ?>"><i class="sidebar-item-icon fa fa-clock-o"></i> Fichadas</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.profesional.index')); ?>"><i class="sidebar-item-icon fa fa-paw"></i> Registro de accesos</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.profesional.movimientos')); ?>"><i class="sidebar-item-icon fa fa-laptop"></i> Ultimos movimientos</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.sucursales.index')); ?>"><i class="sidebar-item-icon fa fa-university"></i> Capacitaciones</a>
                            </li>

                        </ul>
                    </li>

                    <!--Profesionales-->

                    <li class="treeview">
                        <a href="#"><i class="sidebar-item-icon fa fa-industry"></i> Empresas<i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo e(route('admin.empresa.index')); ?>"><i class="sidebar-item-icon fa fa-handshake-o"></i> Gestión de empresas</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.profesional.index')); ?>"><i class="sidebar-item-icon fa fa-paw"></i> Registro de accesos</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.sucursales.index')); ?>"><i class="sidebar-item-icon fa fa-laptop"></i> Ultimos movimientos</a>
                            </li>

                        </ul>
                    </li>
                    <!--Empresas-->

                    <li class="treeview">
                        <a href="#"><i class="sidebar-item-icon fa fa-user"></i> Usuarios<i class="fa fa-angle-left arrow"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo e(route('admin.users.index')); ?>"><i class="sidebar-item-icon fa fa-group"></i> Gestión de usuarios</a>
                            </li>


                            <li>
                                <a href="<?php echo e(route('admin.sucursales.index')); ?>"><i class="sidebar-item-icon fa fa-paw"></i> Registro de accesos</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.user.movimientos')); ?>"><i class="sidebar-item-icon fa fa-laptop"></i> Ultimos movimientos</a>
                            </li>
                        </ul>
                    <li class="treeview <?php echo Request::is('administrador/permissions') || Request::is('administrador/users') ||  Request::is('administrador/profesionales') ? 'active' : ''; ?>">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-laptop"></i>
                            <span class="nav-label">Administracion web</span>
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo e(route('admin.users.index')); ?>"><i class="fa fa-user"></i>Gestion de administradores</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.roles.index')); ?>"><i class="sidebar-item-icon fa fa-universal-access"></i> Gestión de roles</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.permissions.index')); ?>"><i class="sidebar-item-icon fa fa-universal-access
        "></i> Gestión de permisos</a>
                            <li>
                                <a href="<?php echo e(route('admin.diagnostico.index')); ?>"><i class="sidebar-item-icon fa fa-stethoscope"></i> Gestión de diagnósticos</a>
                            </li>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.dashboard.index')); ?>"><i class="fa fa-gear"></i>Ajustes</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.profesional.index')); ?>"><i class="sidebar-item-icon fa fa-paw"></i> Registro de accesos</a>
                    </li>
                    <li>
                        <a href=""><i class="sidebar-item-icon fa fa-laptop"></i> Ultimos movimientos</a>
                    </li>




                </ul>
            </li>
            </li>
            <!--Usuarios-->


            <li class="treeview">
                <a href="<?php echo e(route('admin.proveedores.index')); ?>"><i class="sidebar-item-icon fa fa-hospital-o"></i> Prestaciones <i class="fa fa-angle-left arrow"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('admin.tipo-prestacion.index')); ?>"><i class="sidebar-item-icon fa fa-shopping-basket"></i> Cartera de servicios </a></li>

                    <?php if (\Shinobi::can('proveedores.view')): ?>
                    <li>
                        <a href="<?php echo e(route('admin.proveedores.index')); ?>"><i class="sidebar-item-icon fa fa-user-md"></i> Gestión de
                            proveedores</a>
                    </li>
                    <?php endif; ?>

                    <li>
                        <a href="<?php echo e(route('admin.gestion-pedidos.index')); ?>"><i class="sidebar-item-icon fa fa-shopping-cart"></i> Gestión de pedidos</a>
                    </li>

                </ul>
            </li>




        </ul>
        </li>
        <?php endif; ?>

        <?php if (\Shinobi::can('menu_equip_jornal')): ?>

        <!--Gerencia Jornal-->
        <li class="treeview <?php echo Request::is('administrador/documentacion-jornals') ? 'active' : ''; ?>">
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-group"></i>
                <span class="nav-label">Equipo eJornal</span>
                <i class="fa fa-angle-left arrow"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="<?php echo e(route('admin.dashboard.index')); ?>"><i class="sidebar-item-icon fa fa-dashboard"></i> Dashboard Jornal
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('ticket-jornals.index')); ?>">
                        <i class="sidebar-item-icon fa fa-ticket"></i>
                        <span class="nav-label">Tickets internos</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('admin.documento_jornal.index')); ?>">
                        <i class="sidebar-item-icon fa fa-book"></i> <span class="nav-label">Documentación interna</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <!--Equipo Jornal-->
        <?php echo $__env->yieldContent('menu-empresa'); ?>



        </ul>
        <!-- /.sidebar-menu -->



    </section>
    <!-- /.sidebar -->
</aside>