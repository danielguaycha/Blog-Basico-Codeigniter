<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Articulo </title>
	<link rel="stylesheet" href="<?=base_url()?>public/css/custom.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/articulo.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/flipclock.css">
	<link rel="icon" type="image/png" href="<?=base_url()?>public/img/logo_condensed.png">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>
<body>
 	<header>
 	<a href="<?=base_url()?>">
 		
 			<div class="logo">
 			<img src="<?=base_url()?>public/img/logo_condensed.png" alt="logo" width="34px">
 		</div>
 	</a>
 	
 		<div class="name">Ingenieria de Software</div>
 		<ul class="menu">
 			<li><a href="<?=base_url()?>/#temas"><i class="is-books ">&nbsp;</i>Articulos</a></li>
 			<li><a href="<?=base_url()?>/#repo"><i class="is-carpeta ">&nbsp;</i>Recursos</a></li>
 			<li><a href="<?=base_url()?>/#acerca-de"><i class="is-acerca-da ">&nbsp;</i>Acerca de</a></li>
 			<?php if ($this->session->userdata('login')): ?>
 				<a class="btn btn-primary navbar-btn navbar-right" style="margin-left: 18px;" href="<?=base_url()?>admin" target="_blank">Administrar</a>
 			<?php else: ?>
 				<a class="btn btn-success navbar-btn navbar-right" style="margin-left: 18px;" href="<?=base_url()?>admin/login" target="_blank">Iniciar</a>
 			<?php endif ?>
 			
 		</ul>
 	</header>
 	<div class="jumbotron"><div class="container"><center><img src="<?=base_url()?>public/img/logoutm.png" alt="Utmach" width="150px;"></center></div></div>
	