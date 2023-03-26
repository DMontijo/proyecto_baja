<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<h2>SE HA FIRMADO TU CONSTANCIA SOLICITADA:</h2>
	<p>Ingrese a su cuenta en el Centro de Denuncia Tecnológica e inicie sesión para descargarla nuevamente.</p>
	<br>
	<br>
	<a class="btn" href="<?= base_url('/constancia_extravio') ?>">
		IR A PLATAFORMA
	</a>
	<br>
	<br>
	<br>
	<p style="font-size:10px;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> | <a href="<?= base_url() ?>/assets/documentos/TerminosCondiciones.pdf">Términos y condiciones</a> | <a href="<?= base_url() ?>/assets/documentos/DerechosDeVictimaOfendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
</div>

<?= $this->endSection() ?>
