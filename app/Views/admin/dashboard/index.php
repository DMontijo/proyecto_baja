<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Card title</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Card title</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Card title</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
