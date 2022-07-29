<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>Se ha generado un nuevo expediente</p>
	<br>
	<h2><?= $expediente ?></h2>
	<br>
</div>

<?= $this->endSection() ?>
