
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Comanche</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/logo.ico/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/logo.ico//apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/logo.ico//apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/logo.ico/apple-icon-76x76.')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/logo.ico/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/logo.ico/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/logo.ico/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/logo.ico/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/logo.ico/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('img/logo.ico//android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/logo.ico/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/logo.ico/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/logo.ico/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('img/logo.ico//manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('img/logo.ico/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{asset('css/skins/skin-yellow.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('api')

    <style>
        .skin-blue .main-header .logo{
            background-color: white;
            color:black;
        }

        .skin-blue .main-header .logo:hover{
            background-color: white !important;
            color:black !important;
        }
    </style>
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
<body class="hold-transition skin-yellow sidebar-mini fixed">
@include('mensajes.exito')
@include('mensajes.confirmacion')
@if(Request::is('lote') || Request::is('secado') )
    <style>
        input[readonly]{
            background-color:transparent;
            border: 0;
            font-size: 1em;
        }

    </style>
    @include('lote.modals.detalle')
@endif
@yield('modal')
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            {{--<span class="logo-mini"><b>A</b>LT</span>--}}
            <span class="logo-mini"><b><img src="{{asset('img/logo.jpg')}}" width="100%" alt=""></b></span>
            <!-- logo for regular state and mobile devices -->
            {{--<span class="logo-lg"><b>Admin</b>LTE</span>--}}
            <span class="logo-lg"><b><img src="{{asset('img/logo.jpg')}}" alt="" width="25%"> COMANCHE</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- Notifications Menu -->
                    {{--<li class="dropdown notifications-menu">--}}
                        {{--<!-- Menu toggle button -->--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-bell-o"></i>--}}
                            {{--<span class="label label-warning">10</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li class="header">You have 10 notifications</li>--}}
                            {{--<li>--}}
                                {{--<!-- Inner Menu: contains the notifications -->--}}
                                {{--<ul class="menu">--}}
                                    {{--<li><!-- start notification -->--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<!-- end notification -->--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="footer"><a href="#">View all</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                    <!-- User Account Menu -->
                    @if(auth()->user()->area->descripcion == 'administrador' or auth()->user()->area->descripcion == 'gerencia' or auth()->user()->area->descripcion == 'recepcion' or auth()->user()->area->descripcion == 'ventas' )
                    @else
                        <li class="dropdown notificaciones"  >
                            @include('notificaciones.notificaciones')
                        </li>
                    @endif
                    <li class="dropdown">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="hidden-xs">{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}}</span>
                            <span class="caret"></span>
                        </a>
                        @if(auth()->check())
                            <ul class="dropdown-menu" role="menu">
                                <!-- Menu Footer-->
                                <form action="{{route('logout')}}" method="post" class="" style="margin-bottom:0px;">
                                    {{csrf_field()}}
                                <li class="">
                                    <div class="">
                                            <button class="btn btn-danger btn-flat btn-block">Cerrar Sesión</button>
                                    </div>
                                </li>
                                </form>
                            </ul>
                        @endif
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{--<li>--}}
                        {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">
                @yield('header')
                @show
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            {{--<div class="container-fluid">--}}
                @yield('content')
            {{--</div>--}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    {{--<footer class="main-footer">--}}
        {{--<!-- To the right -->--}}
        {{--<div class="pull-right hidden-xs">--}}
            {{--Anything you want--}}
        {{--</div>--}}
        {{--<!-- Default to the left -->--}}
        {{--<strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.--}}
    {{--</footer>--}}

    <!-- Control Sidebar -->
    {{--<aside class="control-sidebar control-sidebar-dark">--}}
        {{--<!-- Create the tabs -->--}}
        {{--<ul class="nav nav-tabs nav-justified control-sidebar-tabs">--}}
            {{--<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>--}}
            {{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
        {{--</ul>--}}
        {{--<!-- Tab panes -->--}}
        {{--<div class="tab-content">--}}
            {{--<!-- Home tab content -->--}}
            {{--<div class="tab-pane active" id="control-sidebar-home-tab">--}}
                {{--<h3 class="control-sidebar-heading">Recent Activity</h3>--}}
                {{--<ul class="control-sidebar-menu">--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--<i class="menu-icon fa fa-birthday-cake bg-red"></i>--}}

                            {{--<div class="menu-info">--}}
                                {{--<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>--}}

                                {{--<p>Will be 23 on April 24th</p>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.control-sidebar-menu -->--}}

                {{--<h3 class="control-sidebar-heading">Tasks Progress</h3>--}}
                {{--<ul class="control-sidebar-menu">--}}
                    {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                            {{--<h4 class="control-sidebar-subheading">--}}
                                {{--Custom Template Design--}}
                                {{--<span class="pull-right-container">--}}
                    {{--<span class="label label-danger pull-right">70%</span>--}}
                  {{--</span>--}}
                            {{--</h4>--}}

                            {{--<div class="progress progress-xxs">--}}
                                {{--<div class="progress-bar progress-bar-danger" style="width: 70%"></div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.control-sidebar-menu -->--}}

            {{--</div>--}}
            {{--<!-- /.tab-pane -->--}}
            {{--<!-- Stats tab content -->--}}
            {{--<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>--}}
            {{--<!-- /.tab-pane -->--}}
            {{--<!-- Settings tab content -->--}}
            {{--<div class="tab-pane" id="control-sidebar-settings-tab">--}}
                {{--<form method="post">--}}
                    {{--<h3 class="control-sidebar-heading">General Settings</h3>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="control-sidebar-subheading">--}}
                            {{--Report panel usage--}}
                            {{--<input type="checkbox" class="pull-right" checked>--}}
                        {{--</label>--}}

                        {{--<p>--}}
                            {{--Some information about this general settings option--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<!-- /.form-group -->--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<!-- /.tab-pane -->--}}
        {{--</div>--}}
    {{--</aside>--}}
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    {{--<div class="control-sidebar-bg"></div>--}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
<script src="{{asset('js/holder.min.js')}}"></script>
<script src="{{asset('js/notificaciones.js')}}"></script>

<script type="text/javascript">
function lettersOnly()
{
          var charCode = event.keyCode;

          if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)

              return true;
          else
              return false;
}
</script>
@yield('script')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
