<?= $this->extend('constancia_extravio/templates/constancia_realizada_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php

?>
<section class="content">
	<div class="container-fluid">

		<div class="row m-5">
			<div style="margin-left:69%;">
				<h5> <b>CONSTANCIA VALIDA</b> <i class="bi bi-check-circle-fill" style="color: green;"></i></h5>
			</div>
			<div class="d-flex justify-content-center">
				<div class="col-4 card-header" style="align-items: center;display: flex;">
					<h5> <b>CONSTANCIA DE EXTRAVÍO</b></h5>
				</div>
				<div class="card shadow border-0 col-8">
					<div class="card-body" name="certificado" id="certificado" style="margin: 10%;">
					

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('peticion')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			text: '<?= session()->getFlashdata('peticion') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?= $this->endSection() ?>
