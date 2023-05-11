<?= $this->extend('templates/page_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
	<!--Versión escritorio-->
	<div class="row">
		<div class="col-12 text-center" style="height: 73vh;">
			<h1 class="mb-3 fw-bold">SITIO EN MANTENIMIENTO</h1>
			<h3>DISCULPE LAS MOLESTIAS QUE ESTO LE OCASIONA</h3>
		</div>
	</div>
<?= $this->endSection() ?>
