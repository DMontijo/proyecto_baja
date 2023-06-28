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
						<a href="<?= base_url('admin/dashboard/modulo-litigantes-consulta') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
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
						<a href="<?= base_url('admin/dashboard/lista_ligaciones') ?>" class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
							<i class="fas fa-id-badge"></i> Ligar empresas</span>
						</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?= $this->endSection() ?>
