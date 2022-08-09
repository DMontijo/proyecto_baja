<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS</h1>
				<a href=""></a>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/constancias_extravio_abiertas') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-alt"></i> Abiertas<br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->abiertas ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/constancias_extravio_firmadas') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-box-open"></i> Firmadas <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->firmadas ?></span>
						</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
