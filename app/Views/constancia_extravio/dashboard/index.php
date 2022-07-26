<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-12">
		<div class="col-12">
			<div class="card bg-primary shadow mb-4" style="font-size:14px;background:url(<?= base_url('/assets/img/banner/LINEAS_BANNER.png') ?>);background-repeat: no-repeat;background-size: cover !important;background-position-y: top;border-radius:10px;">
				<div class="row p-4">
					<div class="col-12">
						<div class="row">
							<div class="col-12 col-md-6">
								<a class="p-0 my-3" href="tel:911" role="button"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
							</div>
							<div class="col-12 col-md-6 mt-4 mt-md-0">
								<a class="p-0 my-3" href="tel:8003432220" role="button" role="button"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h4 class="text-center text-blue fw-bold my-4">BIENVENID@ <?= $session->NOMBRE ?> <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?></h4>
	
		<div class="card rounded shadow border-0">
			<div class="card-body py-5 p-sm-5">
				<div class="container">
					<h1 class="text-center fw-bolder pb-1 text-blue">CONSTANCIA DE EXTRAVIO</h1>
				</div>
			</div>
			<section>
				<div class="row">
					<div class="col-12 text-center">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#boletos_modal">
							<i class="bi bi-play-btn-fill"></i> Boleto de Sorteos
						</button>
					</div>
				</div>
			</section>
			<br>
			<br>
			<section>
				<div class="row">
					<div class="col-12 text-center">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#documentos_modal">
							<i class="bi bi-play-btn-fill"></i> Documentos
						</button>
					</div>
				</div>
			</section>
			<br>
			<br>
			<section>
				<div class="row">
					<div class="col-12 text-center">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehiculo_modal">
							<i class="bi bi-play-btn-fill"></i> Placas
						</button>
					</div>
				</div>
			</section>
			<br>
			<br>
		</div>
	</div>
</div>

<?php if (session()->getFlashdata('peticion')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			text: '<?= session()->getFlashdata('peticion') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php include('modal_form_boletos.php') ?>
<?php include('modal_form_documentos.php') ?>
<?php include('modal_form_vehiculo.php') ?>
<?= $this->endSection() ?>