<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="firmarDocumento" data-target="#contrasena_modal_doc"><i class="fas fa-file-signature"></i> Firmar documento</button>
				<div class="card shadow border-0">
					<div class="card-body" name="document" id="document" style="margin: 2%;">
						<h5><?php echo $body_data->documento->PLACEHOLDER ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
	<script>
		Swal.fire({
			icon: 'warning',
			html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php include('modal_validation_password_doc.php') ?>

<?= $this->endSection() ?>
