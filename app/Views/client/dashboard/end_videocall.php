<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-12">
		<div class="card text-center">
			<div class="card-body p-5 d-flex justify-content-center align-items-center shadow">
				<div class="text-center" style="max-width:500px;">
					<img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="Loader FGEBC" class="mb-3" style="width:250px;">
					<p class="fw-bold">ESTIMADO (A) USUARIO (A),<br>¡GRACIAS POR SELECCIONAR EL SERVICIO DE VIDEO DENUNCIA!</p>
					<p>En la Fiscalía General del Estado de Baja California día a día trabajamos para garantizarte un fácil acceso a la justicia desde cualquier lugar del mundo.</p>
					<div class="d-grid gap-2">
						<a href="<?= base_url('/denuncia/dashboard/denuncias') ?>" type="button" name="" id="" class="btn btn-primary">IR A MIS DENUNCIAS</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>
