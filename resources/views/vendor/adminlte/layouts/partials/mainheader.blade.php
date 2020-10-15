<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
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
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->




                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    @if (Request::is('empresa/*'))


@isset($empresa)
                            <li class="dropdown messages-menu">
                                <a href="{{ route('empresa.mails.index', ['id' => $empresa->id, 'name' => $empresa->nombre, 'folder' => 'INBOX']  ) }}" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-warning">{{-- $oStatus->count() --}}</span>
                                </a>
                            </li>
                            <li class="dropdown notifications-menu">
                                <a href="{{ route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre]) }}" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ticket"></i>
                                    <span class="label label-warning">{{ $tickets->count() }}</span>
                                </a>
                            </li>
                        @endisset
     <li class="dropdown">
                        <a href="{{ route('messages@index')}}" class="" title="Mensajes">
                            <i class="fa fa-comments-o"></i>
                        </a>
                    </li>

                    @endif


                @impersonating
                    <li class="dropdown impersonate-menu">
                        <a href="{{ route('impersonate.stop') }}" class="bg-red">
                            <i class="fa fa-user-secret"></i> <!-- Stop Impersonating -->
                        </a>
                    </li>
                @endImpersonating
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu" style="max-width: 280px;white-space: nowrap;">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo) }}" alt="{{ $user->nombre }}" class="user-image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('storage/jornal/usuario/'. $user->id . '/perfil/'. $user->photo) }}" alt="{{ $user->nombre }}"  class="img-circle" alt="User Image" />
                                <p>
                                    <span data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
                                    <small>{{ $user->roles->implode('name', ',') }}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin.user.edit', ['id' => $user->id] )}}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
    @if (Request::is('empresa/*'))          <a href="#" data-toggle="control-sidebar"><i class="fa fa-flag-o"></i></a>
          </li>                @endif



            </ul>
        </div>
    </nav>
</header>
