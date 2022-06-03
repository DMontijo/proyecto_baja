<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>Se ha generado un nuevo folio</p>
	<h2>TU FOLIO ES:<br />
		<?= $folio ?>
	</h2>
	<p>Para darle seguimiento a tu caso ingresa a tu cuenta en el Centro de Denuncia Tecnológica e inicia tu video denuncia con el folio generado.</p>
</div>

<?= $this->endSection() ?>
