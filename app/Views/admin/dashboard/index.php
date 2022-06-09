<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-4">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">FOLIOS GENERADOS</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_folios ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">EXPEDIENTES</h5>
				<h4 class="font-weight-bold">0</h4>
				<button type="button" class="btn btn-primary font-weight-bold mt-4">VER MÁS</button>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">DERIVACIONES</h5>
				<h4 class="font-weight-bold">0</h4>
				<button type="button" class="btn btn-primary font-weight-bold mt-4">VER MÁS</button>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
