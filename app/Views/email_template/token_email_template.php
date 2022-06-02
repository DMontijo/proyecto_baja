<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>Se ha generado un nuevo código.</p>
	<h2>SU CÓDIGO ES:<br />
		<?= $otp ?>
	</h2>
</div>

<?= $this->endSection() ?>
