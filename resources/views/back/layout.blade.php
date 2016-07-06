<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EEFacts Admin | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('top-scripts')
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/back/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/back/dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EE</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>EE</b>Facts.com</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img 
                    src="{{ 'http://www.gravatar.com/avatar/'.md5(strtolower(trim(Auth::user()->email))).'?s=160' }}" 
                    class="user-image" alt="User Image">
                  <span class="hidden-xs">{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ 'http://www.gravatar.com/avatar/'.md5(strtolower(trim(Auth::user()->email))).'?s=160' }}" class="img-circle" alt="User Image">
                    <p>
                      {{Auth::user()->name}} - Administrator
                      <small>Member since {{date(' jS \of F Y', strtotime(Auth::user()->created_at))}}</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->


      <aside class="main-sidebar">

        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ 'http://www.gravatar.com/avatar/'.md5(strtolower(trim(Auth::user()->email))).'?s=160' }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <i class="fa fa-circle text-success"></i> Online
            </div>
          </div>

          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="active">
              <a href="/admin/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li>
              <a href="/admin/draws">
                <i class="fa fa-hand-paper-o"></i> <span>Draws</span> 
              </a>
            </li>
            <li>
              <a href="/admin/posts">
                <i class="fa fa-pencil"></i> <span>Posts</span> 
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @section('content-header')
                
            @show
          </h1>
          <ol class="breadcrumb">
              @section('breadcrumb')
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
              @show  
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.9.0
        </div>
        <strong>Copyright &copy;  <a href="/">EEFacts.com</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
    @section('scripts')
        <!-- jQuery 2.1.4 -->
        <script src="/back/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="/back/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/back/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/back/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/back/dist/js/demo.js"></script>
    @show
  </body>
</html>
