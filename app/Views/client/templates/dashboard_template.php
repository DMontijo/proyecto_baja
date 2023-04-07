<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<meta name="robots" content="noindex">
	<link rel="icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<!--Bootstrap 5-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
	<!--Bootstrap Icons-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/icons/bootstrap-icons.css">
	<!--Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--Sweet Alert 2-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<!--Styles-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/client/style.css">
	<!-- Mapas -->

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Y8sKd0VSyZcl9kPdCewI2mpXh95AJ-8&callback=initMap&v=weekly" defer></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZnoURjO4MKsTx6_iRb1stAdXiGHLKSrQ&callback=initMap&v=weekly" defer></script> -->
	<script>
		console.clear();
	</script>
	<script src="<?= base_url() ?>/assets/guest/guest.js" type="module"></script>

	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
</head>

<body>
	<script src="<?= base_url() ?>/assets/jQuery/jquery.js"></script>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>/denuncia/dashboard"><img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-header img-fluid" alt="FGEBC Logo"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacion" aria-controls="navegacion" aria-expanded="false" aria-label="FGEBC navegación denuncia">
				<i class="bi bi-list"></i>
			</button>
			<div class="collapse navbar-collapse" id="navegacion">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link <?php if ('' === 'dashboard' || '' === 'video-denuncia') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard"><i class="bi bi-camera-video"></i>
							Denunciar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if ('' === 'denuncias') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard/denuncias"><i class="bi bi-archive"></i> Mis
							denuncias</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="options" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-three-dots-vertical"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="options">
							<li><a class="dropdown-item" href="#!" onclick="javascript:toggleFullScreen()"><i class="bi bi-fullscreen"></i> Expandir</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?= base_url() ?>/constancia_extravio/dashboard"><i class="bi bi-file-earmark"></i> Constancias</a></li>
							<li><a class="dropdown-item" href="<?= base_url() ?>/denuncia/dashboard/perfil"><i class="bi bi-person"></i> Perfil</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?= base_url('denuncia/logout') ?>"><i class="bi bi-box-arrow-left"></i> Salir</a></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid main bg-light py-3">
		<div class="container p-0" style="min-height:85vh;">
			<?= $this->renderSection('content') ?>
		</div>
	</div>
	<footer class="container-fluid text-center text-white bg-primary d-flex align-items-center justify-content-center footer py-3">
		<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	</footer>
	<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>
