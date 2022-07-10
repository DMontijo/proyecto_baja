<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>

<div class="row">
	<div class="col-12">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<h1 class="text-center font-weight-bold">DENUNCIA ANÓNIMA</h1>
				<div class="row">
					<div class="col-12">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->endSection() ?>
