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

    <link rel="shortcut icon" href="{{ asset("img/logoEPIS.png")}}" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic") }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    @yield('css')
</head>

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
                    @if (Auth::user()->user_photo != null)                        
                        <img src="{{ asset('img/'.Auth::user()->user_photo) }}" class="user-image" alt="User Image">
                    @else
                        <img src="{{ asset("/adminlte/img/user-default.jpg") }}" class="user-image" alt="User Image">
                    @endif
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ ucfirst(Auth::user()->role->description) }}</span>
                </a>
                <ul class="dropdown-menu">

                    <!-- The user image in the menu -->
                    <li class="user-header">
                        @if (Auth::user()->user_photo != null)                        
                            <img src="{{ asset('img/'.Auth::user()->user_photo) }}" class="img-circle" alt="User Image">
                        @else
                            <img src="{{ asset("/adminlte/img/user-default.jpg") }}" class="img-circle" alt="User Image">
                        @endif

                        <p>
                            {{ Auth::user()->name." ".Auth::user()->lastname }}
                        </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="/profile" class="btn btn-success btn-flat"> <i class="fa fa-user"></i> Mi perfil</a>
                        </div>
                        <div class="pull-right">
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                  @csrf
                                  <button type="submit" class="btn btn-default btn-flat">
                                    Cerrar sesi??n <i class="fa fa-sign-out"></i>
                                  </button>
                              </form>
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
          @if (Auth::user()->user_photo != null)                        
              <img src="{{ asset('img/'.Auth::user()->user_photo) }}" class="img-circle" alt="User Image">
          @else
              <img src="{{ asset("/adminlte/img/user-default.jpg") }}" class="img-circle" alt="User Image">
          @endif

        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name." ".Auth::user()->lastname }}</p>
          <!-- Status -->
          <a href="/profile"><i class="fa fa-circle text-success"></i> Online</a>
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
          <li><a href="/offices"><i class="fa fa-building-o text-aqua"></i> <span>Oficinas</span></a></li>
          <li><a href="/attendance"><i class="fa fa-check text-aqua"></i> <span>Asistencias</span></a></li>
          @endif

        <li class="header">MEN??</li>

        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Control personas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/teachers"><i class="fa fa-briefcase"></i> <span>Gesti??n de Docentes</span></a></li>
            <li><a href="/administrative"><i class="fa fa-user"></i> <span>Gesti??n de Administrativos</span></a></li>
            <li><a href="/visitors"><i class="fa fa-users"></i> <span>Gesti??n de Visitantes</span></a></li>

          </ul>
        </li>

        @if (Auth::user()->role_id != 1)              
          <li class="treeview">
            <a href="#"><i class="fa fa-clock-o"></i> <span>Asistencia</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/attendance/create"><i class="fa fa-check-circle-o"></i> <span>Registrar asistencia</span></a></li>
              <li><a href="/attendance"><i class="fa fa-list"></i> <span>Mis asistencias</span></a></li>
            </ul>
          </li>
        @endif

        <li><a href="/vehicles"><i class="fa fa-car"></i> <span>Gesti??n de Veh??culos</span></a></li>
        <li><a href="/incidents"><i class="fa fa-grav"></i> <span>Gesti??n de Incidentes</span></a></li>
        <li><a href="/borrowings"><i class="fa fa-object-group"></i> <span>Gesti??n de Pr??stamos</span></a></li>
        <li><a href="/supports"><i class="fa fa-book"></i> <span>Gesti??n de Apoyo</span></a></li>

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
    <b>Copyright </b>&copy; 2021  <a href="/creditos">Equipo de Desarrollo</a>
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


@yield('scripts')

</body>
</html>