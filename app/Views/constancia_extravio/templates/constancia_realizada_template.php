<!doctype html>
<html lang="es">

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
	<!--Bootstrap 5-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
	<!--Bootstrap Icons-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/icons/bootstrap-icons.css">
	<!--Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--Sweet Alert 2-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js?v=<?= rand() ?>"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<!--Styles-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/client/style.css">

	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
</head>

<body>
	<script src="<?= base_url() ?>/assets/jQuery/jquery.js?v=<?= rand() ?>"></script>
	<nav class="navbar navbar-expand-md navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-header img-fluid" alt="FGEBC Logo"></a>
		</div>
	</nav>
	<div class="container-fluid main bg-light py-3">
		<div class="container p-0">
			<?= $this->renderSection('content') ?>
		</div>
	</div>
	<footer class="container-fluid text-center text-white bg-primary d-flex align-items-center justify-content-center footer py-3">
		<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	</footer>
	<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js?v=<?= rand() ?>"></script>
	<script src="<?= base_url() ?>/assets/js/full_screen.js?v=<?= rand() ?>"></script>
</body>

</html>
