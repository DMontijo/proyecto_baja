<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<p>Se ha generado un nuevo folio</p>
	<h2>SU FOLIO ES:<br />
		<?= $folio ?>
	</h2>
	<p>Para darle seguimiento a su caso ingrese a su cuenta en el Centro de Denuncia Tecnológica e inicie su video denuncia con el folio generado.</p>

	<br>
	<p style="font-size:10px;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> | <a href="<?= base_url() ?>/assets/documentos/TerminosCondiciones.pdf">Términos y condiciones</a> | <a href="<?= base_url() ?>/assets/documentos/DerechosDeVictimaOfendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
	<br>
</div>

<?= $this->endSection() ?>
