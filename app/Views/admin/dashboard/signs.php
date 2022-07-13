<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4 text-center font-weight-bold">FIRMAR DOCUMENTOS</h1>
				<a href=""></a>
			</div>

			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('firmar_documento') ?>" target="_blank" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-signature fa-2x"></i>
							<h4 style="margin-top: 1.5em;">Firmar documento</h4>
						</a>

					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('firmar_documento/validar.php') ?>" target="_blank" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
						<i class="fas fa-check-circle fa-2x"></i>
							<h4 style="margin-top: 1.5em;">Validar documento</h4>
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<?= $this->endSection() ?>
