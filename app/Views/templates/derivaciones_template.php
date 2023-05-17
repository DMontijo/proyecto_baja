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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<!--Styles-->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/styles/client/style.css">
	<script src="<?= base_url() ?>/assets/DataTables/jquery/jquery.min.js"></script>

	<title><?= $this->renderSection('title') ?> - Centro de Denuncia Tecnológica.</title>
</head>

<body>
	<script src="<?= base_url() ?>/assets/jQuery/jquery.js"></script>
	<header>
		<div class="container-fluid bg-primary p-0 m-0 header">
			<div class="container" style="max-width:900px;">
				<div class="row">
					<div class="col-12 text-center">
						<a class="d-inline-block" href="<?= base_url() ?>">
							<img src="<?= base_url() ?>/assets/img/FGEBC.png" style="max-height:90px;" alt="Logo">
							<h6 class="fw-bold text-white d-md-inline-block d-none">FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA</h6>
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
</body>

</html>
