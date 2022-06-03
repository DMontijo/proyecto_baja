<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>
		Usted ha solicitado un cambio de contraseña.
		<br>Para cambiar la contraseña haga clic en el botón inferior.
	</p>
	<br>
	<a class="btn" href="<?= $link ?>">
		NUEVA CONTRASEÑA
	</a>
</div>

<?= $this->endSection() ?>
