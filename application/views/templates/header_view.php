<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="subjet" content="Elecciones UNAM 2018">
  <meta http-equiv="Content-Language" content="es"/>
  <meta name="distribution" content="global"/>
  <meta name="Robots" content="all"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=5" name="viewport">
  <link rel="stylesheet" href="<?php echo assets_url('assets');?>css/layout.css">

  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo assets_url('bower_components');?>Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo assets_url('assets');?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo assets_url('assets');?>css/skins/skin-red.min.css">

  <!-- jQuery 3 -->
  <script src="<?php echo assets_url('bower_components');?>jquery/dist/jquery.min.js"></script>
  <script src="<?php echo assets_url('bower_components');?>chart.js/Chart.js"></script><!-- Bootstrap 3.3.7 -->
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo assets_url('bower_components');?>bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo assets_url('assets');?>js/adminlte.min.js"></script>
  <!-- Sweet alert -->
   <link rel="stylesheet" href="<?php echo assets_url('node_modules');?>sweetalert2/dist/sweetalert2.css"></link>
  <script src="<?php echo assets_url('node_modules');?>sweetalert2/dist/sweetalert2.min.js"></script>


  <!-- Google Font 
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  
    <link type="image/x-icon" href="<?php echo assets_url('assets');?>img/votacion-icono.png" rel="shortcut icon" />
  <link type="image/x-icon" href="<?php echo assets_url('assets');?>img/votacion-icono.png" rel="icon" />
</head>

<body class="hold-transition skin-red sidebar-mini fixed">
<div class="wrapper">
  
 <!-- Main Header -->
 <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo site_url('inicio');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
       <span class="logo-lg">Frase para llevar</span>
      <!-- logo for regular state and mobile devices -->
     <span class="logo-lg">Frase para llevar</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" >
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">    

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-user"></i>
              <span class="hidden-xs"><?php echo ucfirst($_SESSION['apellido']) . ' ' . ucfirst($_SESSION['nombre']);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?php echo $_SESSION['usuario']?>
                  <small>
                    <?php if($_SESSION['tipo_usuario'] == 1){
                      echo 'ADMINISTRADOR';
                    }else{
                      echo 'PARTICIPANTE';
                    }

                     ?>                      
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url('login/logout');?>" class="btn btn-default btn-flat">Cerrar sesion</a>
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
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo site_url('inicio');?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <?php if($_SESSION['tipo_usuario'] == 1):?>
        <li><a href="<?php echo site_url('usuarios');?>"><i class="fa fa-users"></i> <span>Gestion de usuarios</span></a></li>
       <?php endif;?>
        <li><a href="<?php echo site_url('login/logout');?>"><i class="glyphicon glyphicon-circle-arrow-left"></i> <span>Cerrar sesion</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1 class="text-uppercase" id="titulo-superior">       
          <b><?php echo $title;?></b>        
      </h1>
    </section>

    <!-- Main content -->
    <main class="content container-fluid">

