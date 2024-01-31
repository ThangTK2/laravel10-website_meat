<!DOCTYPE html>
<html>
<head>
    <base href="/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/x-icon" href="uploads/favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin_assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="admin_assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin_assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="admin_assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/css/customize.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home.index') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">TK2</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="admin_assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="admin_assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="{{ route('admin.logout') }}"><i class="fa fa-circle text-success"></i> Logout</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="{{ route('admin.index') }}">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> List Categories</a></li>
            <li><a href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> Add New Category</a></li>
          </ul>
        </li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i> <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('product.index') }}"><i class="fa fa-circle-o"></i> List Products</a></li>
              <li><a href="{{ route('product.create') }}"><i class="fa fa-circle-o"></i> Add New Product</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-shopping-cart"></i> <span>Orders</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="admin_assets/index.html"><i class="fa fa-circle-o"></i> List</a></li>
              <li><a href="admin_assets/index2.html"><i class="fa fa-circle-o"></i> static</a></li>
            </ul>
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
        @yield('title')
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          @yield('main')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          ©️ TK2 - Bemet
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="https://adminlte.io">TK2</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="admin_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="admin_assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="admin_assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin_assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
