<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ing de Software | Administrador</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="<?=base_url()?>public/img/logo_condensed.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/admin/AdminLTE.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/admin/skin-blue.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/admin/fileinput.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>public/plugins/clockpicker/bootstrap-clockpicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  </head>
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?=base_url()?>public/img/logo.png" width="35" alt="logo"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?=base_url()?>public/img/logo.png" width="35" alt="logo"> Ing. de Software</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                           
              <!-- Tasks Menu -->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url()?>public/img/<?=$this->session->userdata('avatar_admin')?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$this->session->userdata('nombre');?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?=base_url()?>public/img/<?=$this->session->userdata('avatar_admin')?>" class="img-circle" alt="User Image">
                    <p>
                     <?=$this->session->userdata('nombre');?>
                        <small>Admin</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Config</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url()?>admin/logout" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url()?>public/img/<?=$this->session->userdata('avatar_admin')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=$this->session->userdata('nombre');?></p>
              <a href="#"><a> Administrador</a>
            </div>
          </div>
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Contenidos</li>
            <li class="treeview">
              <a href="#"><i class="is-teoria"></i> <span>Articulos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>admin/addart"><i class="fa fa-circle-o text-aqua"></i> Nuevo</a></li>
                <li><a href="<?=base_url()?>admin/updart"><i class="fa fa-circle-o text-aqua"></i> Midificar/ Eliminar</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="is-lista "></i> <span>Evaluaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>admin/addeval"><i class="fa fa-circle-o text-aqua"></i> Nueva Evaluación</a></li>
                <li><a href="<?=base_url()?>admin/updateval"><i class="fa fa-circle-o text-aqua"></i> Midificar/ Eliminar</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <section>
        
      </section>