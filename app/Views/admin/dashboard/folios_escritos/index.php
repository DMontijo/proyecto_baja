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
				<h1 class="mb-4 text-center font-weight-bold">DENUNCIAS ESCRITAS</h1>
				<a href=""></a>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow border-0 text-center">
						<div class="card-body p-2" style="height:200px;">
							<a href="<?= base_url('admin/dashboard/folios_abiertos_escrita') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-box-open"></i> Abiertos <br><br> <span class="font-weight-bold" style="font-size:20px;"><?= $body_data->abiertos ?></span>
							</a>

						</div>
					</div>
				</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/denuncia-escrita') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-file-alt"></i> Atender denuncia escrita
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/buscar_folio_litigante') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-box-open"></i> Consultar folios de denuncia escrita</span>
						</a>

					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card shadow border-0 text-center">
					<div class="card-body p-2" style="height:200px;">
						<a href="<?= base_url('admin/dashboard/lista_moral') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-building"></i> Personas morales</span>
						</a>

					</div>
				</div>
			</div>
			<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					<div class="card shadow border-0 text-center">
						<div class="card-body p-2" style="height:200px;">
							<a href="<?= base_url('admin/dashboard/folios_en_proceso_escrita') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
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