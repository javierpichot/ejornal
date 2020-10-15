<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(url('/home')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">        <img src="/img/logo.png" width="40px" height="40px">
</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">eJornal</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"><?php echo e(trans('adminlte_lang::message.togglenav')); ?></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->




                <?php if(Auth::guest()): ?>
                    <li><a href="<?php echo e(url('/register')); ?>"><?php echo e(trans('adminlte_lang::message.register')); ?></a></li>
                    <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('adminlte_lang::message.login')); ?></a></li>
                <?php else: ?>
                    <?php if(Request::is('empresa/*')): ?>


<?php if(isset($empresa)): ?>
                            <li class="dropdown messages-menu">
                                <a href="<?php echo e(route('empresa.mails.index', ['id' => $empresa->id, 'name' => $empresa->nombre, 'folder' => 'INBOX']  )); ?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-warning"></span>
                                </a>
                            </li>
                            <li class="dropdown notifications-menu">
                                <a href="<?php echo e(route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre])); ?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ticket"></i>
                                    <span class="label label-warning"><?php echo e($tickets->count()); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
     <li class="dropdown">
                        <a href="<?php echo e(route('messages@index')); ?>" class="" title="Mensajes">
                            <i class="fa fa-comments-o"></i>
                        </a>
                    </li>

                    <?php endif; ?>


                <?php if (app()["auth"]->check() && app()["auth"]->user()->isImpersonated()): ?>
                    <li class="dropdown impersonate-menu">
                        <a href="<?php echo e(route('impersonate.stop')); ?>" class="bg-red">
                            <i class="fa fa-user-secret"></i> <!-- Stop Impersonating -->
                        </a>
                    </li>
                <?php endif; ?>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu" style="max-width: 280px;white-space: nowrap;">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
                            <!-- The user image in the navbar-->
                            <img src="<?php echo e(asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo)); ?>" alt="<?php echo e($user->nombre); ?>" class="user-image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs" data-toggle="tooltip" title="<?php echo e(Auth::user()->name); ?>"><?php echo e(Auth::user()->name); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?php echo e(asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo)); ?>" alt="<?php echo e($user->nombre); ?>"  class="img-circle" alt="User Image" />
                                <p>
                                    <span data-toggle="tooltip" title="<?php echo e(Auth::user()->name); ?>"><?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>
                                    <small><?php echo e($user->roles->implode('name', ',')); ?></small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo e(route('admin.user.edit', ['id' => $user->id] )); ?>" class="btn btn-default btn-flat"><?php echo e(trans('adminlte_lang::message.profile')); ?></a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <?php echo e(trans('adminlte_lang::message.signout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li>
    <?php if(Request::is('empresa/*')): ?>          <a href="#" data-toggle="control-sidebar"><i class="fa fa-flag-o"></i></a>
          </li>                <?php endif; ?>



            </ul>
        </div>
    </nav>
</header>
