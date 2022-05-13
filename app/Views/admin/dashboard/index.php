<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col">
		<div class="card shadow" style="width: 18rem; border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">FOLIOS</h5>
				<h4 class="font-weight-bold">4,500</h4>
				<button type="button" class="btn btn-primary font-weight-bold mt-4">VER MÁS</button>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow" style="width: 18rem; border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">EXPEDIENTES</h5>
				<h4 class="font-weight-bold">4,500</h4>
				<button type="button" class="btn btn-primary font-weight-bold mt-4">VER MÁS</button>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card shadow" style="width: 18rem; border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">DERIVACIONES</h5>
				<h4 class="font-weight-bold">4,500</h4>
				<button type="button" class="btn btn-primary font-weight-bold mt-4">VER MÁS</button>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
