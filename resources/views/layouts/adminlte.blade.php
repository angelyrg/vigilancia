<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vigilancia - EPIS</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset("adminlte/bootstrap/dist/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset("adminlte/font-awesome/css/font-awesome.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset("adminlte/Ionicons/css/ionicons.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("adminlte/css/AdminLTE.min.css") }}">


    <link rel="stylesheet" href="{{ asset("adminlte/css/skins/skin-blue.min.css") }}">


    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic") }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="{{asset("img/logoEPIS.png")}}" alt="Logo de la EPIS UNH">
      </span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg">
        <img src="{{asset("img/logoEPIS.png")}}" alt="Logo de la EPIS UNH">
        <small>Vigilancia</small>
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="/home" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{ asset("adminlte/img/user8-128x128.jpg") }}" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ Auth::user()->role->name }}</span>
                </a>
                <ul class="dropdown-menu">

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest


                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <img src="{{ asset("adminlte/img/user8-128x128.jpg")}}" class="img-circle" alt="User Image">

                        <p>
                            {{ Auth::user()->name." ".Auth::user()->lastname }}
                        </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Mi perfil</a>
                            </div>
                            <div class="pull-right">

                            <div class="btn btn-flat btn-danger">
                              <i class="fa fa-sign-out" aria-hidden="true"></i>
                              <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                  {{ __('Cerrar sesión') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                  @csrf
                              </form>
                            </div>

                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
            </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("adminlte/img/user8-128x128.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name." ".Auth::user()->lastname }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> --}}
      <!-- /.search form -->


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        @if(Auth::user()->role_id == 1 )
          <li class="header">ADMINISTRADOR</li>
  
          <!-- Optionally, you can add icons to the links -->
          <li><a href="/user"><i class="fa fa-user text-aqua"></i> <span>Usuarios</span></a></li>
          <li><a href="/horario"><i class="fa fa-calendar text-aqua"></i> <span>Horarios</span></a></li>
        @endif

        <li class="header">MENÚ</li>

        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Control</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/teachers"><i class="fa fa-briefcase"></i> <span>Gestión de Docentes</span></a></li>
            <li><a href="/administrative"><i class="fa fa-user"></i> <span>Gestión de Administrativos</span></a></li>
            <li><a href="/visitors"><i class="fa fa-users"></i> <span>Gestión de Visitantes</span></a></li>

          </ul>
        </li>

        <li><a href="/attendance"><i class="fa fa-clock-o"></i> <span>Asistencia</span></a></li>
        <li><a href="/vehicles"><i class="fa fa-car"></i> <span>Gestión de Vehículos</span></a></li>
        <li><a href="/incidents"><i class="fa fa-grav"></i> <span>Gestión de Incidentes</span></a></li>
        <li><a href="/borrowings"><i class="fa fa-object-group"></i> <span>Gestión de Préstamos</span></a></li>
        <li><a href="/supports"><i class="fa fa-book"></i> <span>Gestión de Apoyo</span></a></li>



      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Start Here |
        -------------------------->
        @yield('content')
        <!--------------------------
        | Your Page Content Finish Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">v2.0</div>
    <!-- Default to the left -->
    <b>Sistemas EPIS-UNH </b>&copy; 2021  <a href="#">Politicas de privacidad</a>
  </footer>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset("adminlte/jquery/dist/jquery.min.js") }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("adminlte/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("adminlte/js/adminlte.min.js") }}"></script>

</body>
</html>