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
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reportes_folios') ?>" class="btn btn-primary btn-block font-weight-bold h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">FOLIOS</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reportes_constancias') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">CONSTANCIAS</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/registro_diario') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REGISTRO DIARIO</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reporte_fiel') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">FIEL</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/reporte_llamadas') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REPORTES LLAMADAS</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/registro_conavim') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REGISTRO CONAVIM</span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/registro_candev') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REGISTRO CANALIZACIONES Y DERIVACIONES</span>
						</a>
					</div>
				</div>
			</div>
			<?php if (session('ROLID') == 1 || session('ROLID') == 2 || session('ROLID') == 6 || session('ROLID') == 7 || session('ROLID') == 11) { ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow border-0 text-center">
						<div class="card-body p-2" style="height:200px;">
							<a href="<?= base_url('admin/dashboard/registro_atenciones') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
								<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REGISTROS DE ATENCIONES</span>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/registro_ceeiav') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
							<i class="far fa-clipboard" style="font-size: 20px;"></i><br><span class="font-weight-bold">REGISTRO CEEAIV</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
