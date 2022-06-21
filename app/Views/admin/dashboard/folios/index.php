<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS</h1>
				<a href=""></a>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_abiertos') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-box-open"></i> Folios Abiertos <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->abiertos ?></span>
						</a>

					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_derivados') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-share"></i> Folios Derivados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->derivados ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_canalizados') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-share"></i> Folios Canalizados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->canalizados ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_expediente') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-alt"></i> Expedientes generados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->expedientes ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_sin_firma') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-alt"></i> Expedientes no firmados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->expedientes_no_firmados ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
