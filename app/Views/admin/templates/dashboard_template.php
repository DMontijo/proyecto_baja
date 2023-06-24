<!doctype html>
<html lang="es" class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta name="robots" content="noindex">
	<link rel="icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
	<!--Montserrat Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--  App CSS (Do not remove) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/dist/css/dash.css'); ?>">
	<!-- Lada Telefonica -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
	<!--Sweet Alert 2-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<!--DataTables-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/DataTables/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/DataTables/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/DataTables/datatables-buttons/css/buttons.bootstrap4.min.css">
	<script src="<?= base_url() ?>/assets/DataTables/jquery/jquery.min.js"></script>
	<link href="<?= base_url() ?>/assets/styles/admin/quill.snow.css" rel="stylesheet">
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.2/tinymce.min.js"></script>
	<!-- Select 2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" rel="stylesheet" />
	<!-- Mapas -->

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Y8sKd0VSyZcl9kPdCewI2mpXh95AJ-8&callback=initMap&v=weekly" defer></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZnoURjO4MKsTx6_iRb1stAdXiGHLKSrQ&callback=initMap&v=weekly" defer></script> -->
	<script src="<?= base_url() ?>/assets/agent/agent.js" type="module"></script>

</head>

<body class="c-app c-legacy-theme">

	<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
		<div class="c-sidebar-brand">
			<img alt="Logo" class="img-fluid c-sidebar-brand-full" src="<?= base_url() ?>/assets/img/FGEBC.png" style="max-height:50px;" />
			<img alt="Logo" class="img-fluid c-sidebar-brand-minimized" src="<?= base_url() ?>/assets/img/FGEBC.png" style="max-height:50px;" />
		</div>
		<ul class="c-sidebar-nav">


			<li class="c-sidebar-nav-item" id="nav-inicio" name="nav-inicio">
				<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard">
					<i class="fas fa-tachometer-alt c-sidebar-nav-icon"></i> Inicio
				</a>
			</li>

			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 1) { ?>

					<li class="c-sidebar-nav-item" id="nav-videodenuncia" name="nav-videodenuncia">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/video-denuncia">
							<i class="fas fa-video c-sidebar-nav-icon"></i> Videodenuncia
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 10) { ?>

					<li class="c-sidebar-nav-item" id="nav-denuncia-anonima" name="nav-denuncia-anonima">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/denuncia-anonima">
							<i class="fas fa-phone-alt c-sidebar-nav-icon"></i> Denuncia anónima
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 3) { ?>

					<li class="c-sidebar-nav-item" id="nav-folios" name="nav-folios">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/folios">
							<i class="fas fa-archive c-sidebar-nav-icon"></i> Bandeja folios
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 2) { ?>

					<li class="c-sidebar-nav-item" id="nav-buscar-folio" name="nav-buscar-folio">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/buscar_folio') ?>">
							<i class="fas fa-search c-sidebar-nav-icon"></i> Consultar folios
						</a>
					</li>

				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 11) { ?>
					<li class="c-sidebar-nav-item" id="nav-bandeja" name="nav-bandeja">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/bandeja') ?>">
							<i class="fas fa-solid fa-inbox c-sidebar-nav-icon"></i> Bandeja remisión
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 4) { ?>
					<li class="c-sidebar-nav-item" id="nav-constancias" name="nav-constancias">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/constancias">
							<i class="fas fa-folder c-sidebar-nav-icon"></i> Constancias de extravío
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<!-- <?php foreach ($body_data->rolPermiso as $permiso) { ?>
				<?php if ($permiso->PERMISOID == 5) { ?>
					<li class="c-sidebar-nav-item" id="nav-documentos" name="nav-documentos">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/documentos">
							<i class="fas fa-file-invoice c-sidebar-nav-icon"></i> Documentos
						</a>
					</li>
				<?php } ?>
			<?php } ?> -->

			<?php foreach ($body_data->rolPermiso as $permiso) { ?>

				<?php if ($permiso->PERMISOID == 6) { ?>
					<li class="c-sidebar-nav-item">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url() ?>/admin/dashboard/usuarios">
							<i class="fas fa-users c-sidebar-nav-icon"></i> Usuarios
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php foreach ($body_data->rolPermiso as $permiso) { ?>
				<?php if ($permiso->PERMISOID == 7) { ?>
					<li class="c-sidebar-nav-item" id="nav-reportes" name="nav-reportes">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/reportes') ?>">
							<i class="fas fa-folder-open c-sidebar-nav-icon"></i> Reportes
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>
				<?php if ($permiso->PERMISOID == 8) { ?>
					<li class="c-sidebar-nav-item" id="nav-roles" name="nav-roles">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/asignacion_permisos') ?>">
							<i class="fas fa-user-cog c-sidebar-nav-icon"></i> Roles
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php foreach ($body_data->rolPermiso as $permiso) { ?>
				<?php if ($permiso->PERMISOID == 9) { ?>
					<li class="c-sidebar-nav-item" id="nav-roles" name="nav-roles">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/videos') ?>">
							<i class="fas fa-video c-sidebar-nav-icon"></i> Videos
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<?php foreach ($body_data->rolPermiso as $permiso) { ?>
				<?php if ($permiso->PERMISOID == 12) { ?>
					<li class="c-sidebar-nav-item" id="nav-sesiones" name="nav-sesiones">
						<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/dashboard/sesiones_activas') ?>">
							<i class="fas fa-users c-sidebar-nav-icon"></i> Sesiones Activas
						</a>
					</li>
				<?php } ?>
			<?php } ?>
			<li class="c-sidebar-nav-item" id="nav-salir" name="nav-salir">
				<a class="c-sidebar-nav-link font-weight-bold" href="<?= base_url('admin/logout') ?>">
					<i class="fas fa-sign-out-alt c-sidebar-nav-icon"></i> Salir
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
			<!-- <a class="c-header-brand d-lg-none" href="#">
				<i class="fas fa-bars"></i>
			</a> -->
			<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
				<i class="fas fa-bars"></i>
			</button>
			<button class="c-header-toggler c-class-toggler mfs-3 d-sm-down-none font-weight-bold" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
				<?php $session = session(); ?>
				BIENVENIDO <?= $session->NOMBRE ?> <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?> | <?= $session->rol->NOMBRE_ROL ?>
			</button>
			<ul class="c-header-nav ml-auto mr-2">
				<!-- <li class="c-header-nav-item dropdown">
					<a class="c-header-nav-link" href="<?= base_url('admin/logout') ?>">
						<div class="c-avatar font-weight-bold">
							<i class="fas fa-sign-out-alt mr-2"></i> Salir
						</div>
					</a>
				</li> -->
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
						<a class="dropdown-item" href="<?= base_url('admin/dashboard/perfil') ?>">
							<i class="fas fa-user-cog mr-2"></i> Pérfil
						</a>
						<a class="dropdown-item" href="<?= base_url('admin/logout') ?>">
							<i class="fas fa-sign-out-alt mr-2"></i> Salir
						</a>
					</div>
				</li>
				<li class="c-header-nav-item dropdown">
					<a class="c-header-nav-link" href="#!" onclick="javascript:toggleFullScreen()">
						<div class="c-avatar font-weight-bold">
							<i class="fas fa-expand"></i>
						</div>
					</a>
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
	<script src="<?= base_url('/dist/js/commons.js'); ?>"></script>
	<script src="<?= base_url('/dist/js/dash.js'); ?>"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/jszip/jszip.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url() ?>/assets/DataTables/datatables-buttons/js/buttons.colVis.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/full_screen.js"></script>
	<?php if (session()->getFlashdata('message_error')) : ?>
		<script>
			Swal.fire({
				icon: 'error',
				html: '<strong><?= session()->getFlashdata('message_error') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('message_success')) : ?>
		<script>
			Swal.fire({
				icon: 'success',
				html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('message_warning')) : ?>
		<script>
			Swal.fire({
				icon: 'warning',
				html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>
	<script>
		closeSessionTimeout();
		function closeSessionTimeout(){
			var timeout; 
		clearTimeout(timeout); 
		timeout = setTimeout(function(){
			console.log('timeout funcionando');
			Swal.fire({
				icon: 'error',
				title: 'Tiempo de sesión agotado',
				text: 'Si quieres seguir trabajando hay que renovar la sesion dando click en Ok, sino Cancelar',
				confirmButtonColor: '#bf9b55',
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "<?= base_url('admin/actualizar-sesion') ?>",
						method: "get",
						dataType: "json",
						success: function(response) {
							if(response.result){
									Swal.fire({
									icon: 'success',
									title: 'Sesión actualizada',
									confirmButtonColor: '#bf9b55',
									}).then((result) => {
										if (result.isConfirmed) {
											console.log(response);
											closeSessionTimeout();
										}
									});
								}else{
									Swal.fire({
									icon: 'error',
									title: 'Tiempo agotado',
									confirmButtonColor: '#bf9b55',});	
								}
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});
				}
			})
		}, 7080000); ///7080000 for 1:58 hours
		}
		 	
	</script>
</body>

</html>
