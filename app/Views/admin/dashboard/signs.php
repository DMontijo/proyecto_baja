<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-12">
					<h1 class="mb-4 text-center font-weight-bold">FIRMAS</h1>
					<a href=""></a>
				</div>

				<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('firmas/cargarpdf.php') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-upload fa-2x"></i>
							<h4 style="margin-top: 1.5em;">Subir archivos a firmar</h4>
						</a>

					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('firmas/firmardocumentos.php') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-signature fa-2x"></i>
							<h4 style="margin-top: 1.5em;">Firma de Archivos</h4>
						</a>
					</div>
				</div>
			</div>
				
			</div>
		</div>
	</div>
</section>

<?= $this->endSection() ?>
