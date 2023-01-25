<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>
<div style="font-size: 14px !important; font-weight: normal !important;font-family: Helvetica !important;">
	<?php if ($status == 'EXPEDIENTE') { ?>
		<p style="text-align:justify;">Estimado usuario, en la fecha en que se actúa el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio de atención <strong><?= $folio . '/' . $year ?></strong>, respecto del cual se generó <strong><?= $tipoexpediente ?></strong> número <strong><?= $expediente ?></strong>,
			por el delito de <strong><?= $delito ?></strong> en contra de <strong><?= $imputado ?></strong>, en el que se ordenaron las diligencias consistentes en: <strong><?= $delito ?></strong>.</p>
		<br>
		<p style="text-align:justify;">
			Para consultar el estado de su expediente es importante ingresar a <strong>https://cdtec.fgebc.gob.mx</strong>.
			Lo anterior con fundamento en lo dispuesto por el Artículo 131 fracción II del Código Nacional de Procedimientos Penales, Artículo 20, inciso C de la Constitución Política de los Estados Unidos Mexicanos, así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado.
		</p>
	<?php } else { ?>
		<p style="text-align:justify;">Estimado usuario, en la fecha en que se actúa el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio de atención <strong><?= $folio . '-' . $year ?></strong>, respecto del cual se <strong><?= $tipoexpediente ?></strong> a la instancia correspondiente para su debida atención.
		</p>
		<br>
		<p style="text-align:justify;">
			Lo anterior con fundamento en lo dispuesto por el Artículo 131 fracción II del Código Nacional de Procedimientos Penales, Artículo 20, inciso C de la Constitución Política de los Estados Unidos Mexicanos, así como el Artículo 22, fracción II y demás aplicables de la Ley Orgánica de la Fiscalía General del Estado.
		</p>
	<?php } ?>
	<br>
	<p style="text-align:center;">
		<strong>Lic. <?= $agente ?></strong><br>
		adscrito al Centro de Denuncia Tecnológica de la
		<br>
		Fiscalía General del Estado de Baja California
	</p>
	<br>
	<br>
	<p style="font-size:10px;text-align:center;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> | <a href="<?= base_url() ?>/assets/documentos/TerminosCondiciones.pdf">Términos y condiciones</a> | <a href="<?= base_url() ?>/assets/documentos/DerechosDeVictimaOfendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
</div>

<?= $this->endSection() ?>
