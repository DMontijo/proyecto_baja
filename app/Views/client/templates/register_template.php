<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<link rel="icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<!-- Lada Telefonica -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
	<!-- Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/client/style.css">

	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
</head>

<body>
	<script src="<?= base_url() ?>/assets/jQuery/jquery.js"></script>
	<header>
		<div class="container-fluid bg-primary p-0 m-0 header">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<a href="<?= base_url() ?>">
							<img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="img-fluid c-sidebar-brand-minimized" alt="FGEBC Logo" style="max-width:80px;">
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container-fluid bg-white p-0 py-5 main">

		<?= $this->renderSection('content') ?>

	</div>
	<footer class="container-fluid text-center text-white bg-primary d-flex align-items-center justify-content-center footer py-3">
		<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	</footer>
	<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
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
