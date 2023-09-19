<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
	
	<!-- Primary Meta Tags -->
	<!-- <title>CDTEC</title> -->
	<meta name="title" content="Video Denuncia - Baja California" />
	<meta name="description" content="Plataforma de video denuncia de la Fiscalía General del Estado de Baja California." />
	<meta name=”keywords” content=”videodenuncia, video denuncia, fiscalia de baja california, baja california, cdtec, denuncia virtual, como denunciar” />

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://cdtec.fgebc.gob.mx" />
	<meta property="og:title" content="Video Denuncia - Baja California" />
	<meta property="og:description" content="Plataforma de video denuncia de la Fiscalía General del Estado de Baja California." />
	<meta property="og:image" content="<?= base_url() ?>/assets/img/post_videodenuncia.png" />

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:url" content="https://cdtec.fgebc.gob.mx" />
	<meta property="twitter:title" content="Video Denuncia - Baja California" />
	<meta property="twitter:description" content="Plataforma de video denuncia de la Fiscalía General del Estado de Baja California." />
	<meta property="twitter:image" content="<?= base_url() ?>/assets/img/post_videodenuncia.png" />

	<!--Bootstrap 5-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
	<!--Bootstrap Icons-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/icons/bootstrap-icons.css">
	<!--Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--Styles-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/style.css">

	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
</head>

<body>
	<script src="<?= base_url() ?>/assets/jQuery/jquery.js?v=<?= rand() ?>"></script>
	<header>
		<!--Versión escritorio-->
		<div class="container-fluid bg-primary p-0" style="height:162px;">
			<div class="container py-3 d-flex align-items-center">
				<div class="d-inline-block"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>/assets/img/FGEBC.png" class="logo-header" alt="FGEBC Logo"></a></div>
				<div class="d-inline-block ms-3"><span class="fw-bolder text-white">FÍSCALIA GENERAL DEL ESTADO <br>DE
						BAJA CALIFORNIA</span></div>
			</div>
		</div>
	</header>
	<div class="container-fluid bg-white p-0 py-5" style="min-height:calc(100vh - 242px);">

		<?= $this->renderSection('content') ?>

	</div>
	<footer class="container-fluid text-center text-white bg-primary d-flex align-items-center justify-content-center footer py-3" style="min-height:80px">
		<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	</footer>
	<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js?v=<?= rand() ?>"></script>
</body>

</html>
