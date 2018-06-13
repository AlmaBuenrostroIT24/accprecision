<?php
if(strlen(session_id())<1)
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ACC Precision</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
      <link rel="stylesheet" href="../../public/iCheck/all.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../public/img/favicon.ico">





    <!-- DATATABLES -->
    <!--<link rel="stylesheet" type="text/css" href="../../public/datatables/jquery.dataTables.min.css">-->
      <link rel="stylesheet" type="text/css" href="../../public/datatables/css/dataTables.bootstrap4.min.css">

    <link href="../../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>


      <link href="../../public/css/bootstrap-select.min.css" rel="stylesheet"/>








  </head>
  <body class="hold-transition skin-blue-light sidebar-mini sidebar-collapse">
    <div class="wrapper" style="font-family: arial, sans-serif">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ACC</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ACCPRECISION</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../files/user/<?php echo $_SESSION['photo'];?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['name_user'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../files/user/<?php echo $_SESSION['photo'];?>" class="img-circle" alt="User Image">
                    <p>
                        <?php echo $_SESSION['name_user'];?> -Software
                      <small>ACCPRECISION</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../../ajax/user.php?op=exit" class="btn btn-default btn-flat">Exit</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">


              <li class="header"></li>
              <?php
              if($_SESSION['desktop']==1)
              {
                  echo' <li>
              <a href="../desktop/dashboard.php">
                <i class="fa fa-tasks"></i> <span>Desktop</span>
              </a>
            </li> ';
              }
              ?>
              <?php
              if($_SESSION['purchases']==1)
              {
                  echo'
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Purchases</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i>Inventory</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i>Suppliers</a></li>
              </ul>
            </li>';
              }
              ?>



              <?php
              if($_SESSION['sales']==1)
              {
                  echo'<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Sales</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="venta.php"><i class="fa fa-circle-o"></i>Sales</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Client</a></li>
              </ul>
            </li>';
              }
              ?>

              <?php
              if($_SESSION['employees']==1)
              {
                  echo'  <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Employees</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../employees/status.php"><i class="fa fa-circle-o"></i>Status</a></li>
                <li><a href="../employees/employee.php"><i class="fa fa-circle-o"></i>Employee</a></li>
                <li><a href="../employees/competence.php"><i class="fa fa-circle-o"></i>Competences</a></li>
                <li><a href="../employees/eventstraining.php"><i class="fa fa-circle-o"></i>Events Training</a></li>
                <li><a href="../employees/categoria.php"><i class="fa fa-circle-o"></i>Categoria</a></li>
              </ul>
            </li>';
              }
              ?>

              <?php
              if($_SESSION['access']==1)
              {
                  echo'<li class="treeview">
              <a href="#">
              <i class="fa fa-user-plus"></i> <span>Access</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <li><a href="../access/user.php"><i class="fa fa-circle-o"></i> User</a></li>
                <li><a href="../access/rols.php"><i class="fa fa-circle-o"></i> Permits</a></li>

              </ul>
            </li>';
              }
              ?>





          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>


        <!-- jQuery -->
        <script src="../../public/js/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../../public/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->

        <script src="../../public/js/app.js"></script>





        <!-- DATATABLES -->

      <!--  <script src="../../public/datatables/jquery.dataTables.min.js"></script>-->
        <script src="../../public/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../public/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../public/datatables/dataTables.buttons.min.js"></script>
        <script src="../../public/datatables/buttons.html5.min.js"></script>
        <script src="../../public/datatables/buttons.colVis.min.js"></script>
        <script src="../../public/datatables/jszip.min.js"></script>
        <script src="../../public/datatables/pdfmake.min.js"></script>
        <script src="../../public/datatables/vfs_fonts.js"></script>
        <script src="../../public/iCheck/icheck.min.js"></script>
        <script src="../../public/js/bootbox.min.js"></script>
        <script src="../../public/js/bootstrap-select.min.js"></script>
        <script src="../scripts/jstree.min.js"></script>
