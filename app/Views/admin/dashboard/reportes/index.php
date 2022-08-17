<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4 text-center font-weight-bold">REPORTES</h1>
				<a href=""></a>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reportes_folios') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="far fa-clipboard"></i> FOLIOS <br><br> <span class="font-weight-bold" style="font-size:20px;"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card shadow border-0 text-center">
					<img class="card-img-top" src="holder.js/100px180/" alt="">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reportes_constancias') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
                            <i class="far fa-clipboard"></i> CONSTANCIAS <br><br> <span class="font-weight-bold" style="font-size:20px;"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
