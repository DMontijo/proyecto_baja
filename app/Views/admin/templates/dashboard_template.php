<!doctype html>
<html lang="es" class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FGEBC - <?= $this->renderSection('title') ?></title>
	<!--Montserrat Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--  App CSS (Do not remove) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/dist/css/dash.css'); ?>">
</head>

<body class="c-app c-legacy-theme">
	<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
		<div class="c-sidebar-brand d-lg-down-none">
			<img alt="Logo" class="img-fluid c-sidebar-brand-full" src="<?= base_url() ?>/assets/img/FGEBC.png" style="max-height:50px;" />
		</div>
		<ul class="c-sidebar-nav">
			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link font-weight-bold" href="<?=base_url()?>/admin/dashboard">
					<i class="fas fa-tachometer-alt c-sidebar-nav-icon"></i> Inicio
				</a>
			</li>
			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link font-weight-bold" href="<?=base_url()?>/admin/dashboard/video-denuncia">
					<i class="fas fa-video c-sidebar-nav-icon"></i> Video denuncia
				</a>
			</li>
			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link font-weight-bold" href="#">
					<i class="fas fa-users c-sidebar-nav-icon"></i> Usuarios
				</a>
			</li>
		</ul>
		<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
	</div>
	<div class="c-wrapper" id="dash">
		<header class="c-header c-header-dark c-header-fixed c-header-with-subheader shadow">
			<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
				<i class="fas fa-bars"></i>
			</button>
			<a class="c-header-brand d-lg-none" href="#">
				<i class="fas fa-bars"></i>
			</a>
			<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
				<i class="fas fa-bars"></i>
			</button>
			<ul class="c-header-nav ml-auto mr-2">
				<li class="c-header-nav-item dropdown">
					<a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<div class="c-avatar">
							<i class="fas fa-cogs"></i>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right py-0 mt-3">
						<div class="dropdown-header bg-primary py-2 text-center text-white rounded">
							<strong>Opciones</strong>
						</div>
						<a class="dropdown-item" href="#">
							<i class="fas fa-user-cog mr-2"></i> Pérfil
						</a>
						<a class="dropdown-item" href="<?=base_url()?>/admin">
							<i class="fas fa-sign-out-alt mr-2"></i> Salir
						</a>
					</div>
				</li>
			</ul>
		</header>
		<div class="c-body">
			<main class="c-main fade-in">
				<div class="container-fluid">
					<!-- Contenido y carga dinámica de las vistas -->
					<?= $this->renderSection('content') ?>
				</div>
			</main>
			<footer class="c-footer">
				<div>
					<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
				</div>
			</footer>
		</div>
	</div>
	<!-- App JS (Do not remove) -->
	<script src="<?php echo base_url('/dist/js/commons.js'); ?>"></script>
	<script src="<?php echo base_url('/dist/js/dash.js'); ?>"></script>
</body>

</html>