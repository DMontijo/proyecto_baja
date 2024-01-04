<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>
		Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica.
		<br>Para acceder debes ingresar los siguientes datos
	</p>
	<h2 style="font-weight: bold;">
		USUARIO: <br><?= $email ?><br><br>
		CONTRASEÑA: <br><?= $password ?>
	</h2>
	<br>
	<a class="btn" href="<?= base_url('/denuncia_litigantes') ?>">
		INICIAR DENUNCIA
	</a>
	<br>
	<br>
</div>

<?= $this->endSection() ?>
