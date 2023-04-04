<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $rolesToMonitor = [1, 2, 6, 7, 11]; ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS</h1>
				<a href=""></a>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_expediente') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-alt"></i> Expedientes <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->expedientes ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_abiertos') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-box-open"></i> Abiertos <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->abiertos ?></span>
						</a>

					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_derivados') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-share"></i> Derivados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->derivados ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/folios_canalizados') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-share"></i> Canalizados <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->canalizados ?></span>
						</a>
					</div>
				</div>
			</div>
			<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow border-0 text-center">
						<img class="card-img-top" src="holder.js/100px180/" alt="">
						<div class="card-body p-2" style="height:200px;">
							<a href="<?= base_url('admin/dashboard/folios_en_proceso') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-user-cog"></i> En proceso <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->proceso ?></span>
							</a>
						</div>
					</div>
				</div>
			<?php }; ?>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
