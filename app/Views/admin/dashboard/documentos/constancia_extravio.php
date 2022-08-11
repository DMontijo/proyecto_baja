<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php

?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="firmarConstancia" data-target="#contrasena_modal"><i class="fas fa-file-signature"></i> Firmar constancia</button>
				<div class="card shadow border-0">
					<div class="card-body" name="certificado" id="certificado" style="margin: 2%;">
						<h5><?php echo $body_data->constanciaExtravio->PLACEHOLDER ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('firma')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			text: '<?= session()->getFlashdata('firma') ?>',
			confirmButtonColor: '#bf9b55',
		})
		let btn_descargar_pdf = document.getElementById("downloadPDF");
		let btn_descargar_xml = document.getElementById("downloadXML");

		let btn_firmar = document.getElementById("firmarConstancia")
		let inputFolio = document.getElementById("input_folio_atencion");
		let year = new Date().getFullYear();
		document.getElementById("firmarConstancia").style.display = "none";
		document.getElementById("downloadPDF").style.display = "block";
		document.getElementById("downloadXML").style.display = "block";
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('password_incorrecto')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			text: '<?= session()->getFlashdata('password_incorrecto') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('firma_no_valida')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			text: '<?= session()->getFlashdata('firma_no_valida') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>

<?php if (session()->getFlashdata('signature_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			text: '<?= session()->getFlashdata('signature_error') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php include('modal_validation_password.php') ?>

<?= $this->endSection() ?>
