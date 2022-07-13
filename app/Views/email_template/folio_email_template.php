<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>Se ha generado un nuevo folio</p>
	<h2>TU FOLIO ES:<br />
		<?= $folio ?>
	</h2>
	<p>Para darle seguimiento a tu caso ingresa a tu cuenta en el Centro de Denuncia Tecnológica e inicia tu video denuncia con el folio generado.</p>

	<br>
	<br>
	<br>
	<p style="font-size:10px;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> <a href="<?= base_url() ?>/assets/documentos/Terminos_Y_Condiciones.pdf">Términos y condiciones</a> <a href="<?= base_url() ?>/assets/documentos/Derechos_De_Victima_Ofendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
</div>

<?= $this->endSection() ?>
