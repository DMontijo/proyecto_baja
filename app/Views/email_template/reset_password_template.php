<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>
		Usted ha solicitado un cambio de contraseña.
	</p>
	<br>
	<p>Su nueva contraseña es:</p>
	<h2><?= $password ?></h2>
	<br>
</div>

<?= $this->endSection() ?>
