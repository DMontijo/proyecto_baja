<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>
		Se ha generado un nuevo registro en el Centro de Denuncia Tecnológica.
		<br>Para acceder debes ingresar los siguientes datos
	</p>
	<p style="font-weight: bold;">
		USUARIO: <?= $email ?><br>
		CONTRASEÑA: <?= $password ?>
	</p>
	<br>
	<a class="btn" href="<?= base_url('/admin') ?>">
		INGRESAR
	</a>
	<br>
	<br>
</div>

<?= $this->endSection() ?>
