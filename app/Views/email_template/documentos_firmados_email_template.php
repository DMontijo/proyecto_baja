<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>
<div style="text-align:justify;font-size: 14px !important; 	font-weight: normal !important;font-family: Helvetica !important;">
	<p>Estimado usuario, en la fecha en que se actúa el Sistema Estatal de Justicia Alternativa Penal a través del Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio de atención <strong><?= $folio?></strong>, respecto del cual se generó <strong><?= $tipoexpediente?></strong> número <strong><?= $expediente?></strong>, 
	por el delito de <strong><?= $delito?></strong> en contra de <strong><?= $imputado?></strong>, en el que se ordenaron las diligencias consistentes en: <strong><?= $delito?></strong>.
		
	<br>
	Para consultar el estado de su expediente es importante ingresar a <strong>https://cdt.fgebc.gob.mx/</strong>
		Lo anterior con fundamento en lo dispuesto por el Artículo 131 fracción II del Código Nacional de Procedimientos Penales, Artículo 20, inciso C de la Constitución Política de los Estados Unidos Mexicanos, así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado.
		LIC.
		<strong><?= $agente?></strong>
		adscrito al Centro de Denuncia Tecnológica del
		Sistema Estatal de Justicia Alternativo Penal
		FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA</p>

	<br>
	<br>
	<br>
	<p style="font-size:10px;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> | <a href="<?= base_url() ?>/assets/documentos/TerminosCondiciones.pdf">Términos y condiciones</a> | <a href="<?= base_url() ?>/assets/documentos/DerechosDeVictimaOfendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
</div>

<?= $this->endSection() ?>