<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<div class="ratio ratio-16x9">
						<iframe src="https://smartbc.assertivebusiness.com.mx/videollamada?name=Otoniel_Flores" frameborder="0" allow="camera *;microphone *"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>
