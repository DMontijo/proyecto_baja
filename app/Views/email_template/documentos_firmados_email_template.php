<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="font-size: 14px !important; font-weight: normal !important;font-family: Helvetica !important;">
	<?php if ($status == 'EXPEDIENTE') {
		$expediente_guiones = '';
		$arrayExpediente = str_split($expediente);
		$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
		 ?>
		<p style="text-align:justify;">
			Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio <strong><?= $folio . '/' . $year ?></strong>, mediante el cual expone hechos presumiblemente como delito, por lo que se generó el expediente número <strong><?= $expediente_guiones . '/' . $claveexpediente ?>, por la probable comisión del delito <strong><?= $delito ?></strong> y/o lo que resulte en contra de <strong><?= $imputado ?></strong>. Se le informa que en el expediente generado se ordenaron los documentos que se adjuntan al presente correo. Para consultar el estado de su expediente puede ingresar a <strong>https://cdtec.fgebc.gob.mx</strong>.
		</p>
		<p style="text-align:justify;">
			Lo anterior, con fundamento en lo dispuesto por los artículos 20 inciso C y 21 de la Constitución Política de los Estados Unidos Mexicanos, el numeral 131 fracción II del Código Nacional de Procedimientos Penales, así como el artículo 22 fracción II y demás relativos de la Ley Orgánica de la Fiscalía General del Estado de Baja California.
		</p>
		<br>
		<p style="text-align:center;">
			<?= isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' ?>BAJA CALIFORNIA, <?= $fecha ?><br>
			<strong>LIC. <?= $agente ?></strong><br>
			AGENTE DEL MINISTERIO PÚBLICO CON ADSCRIPCIÓN<br>
			CENTRO DE DENUNCIA TECNOLÓGICA DE LA<br>
			FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA<br>
		</p>
	<?php } else { ?>
		<p style="text-align:justify;">
			Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio de atención número <strong><?= $folio . '/' . $year ?></strong> respecto del cual se generó derivación o canalización, misma que se adjunta al presente correo, lo anterior en virtud de que la solicitud planteada corresponde a diversa autoridad.
		</p>
		<br>
		<p style="text-align:center;">
			<?= isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' ?>BAJA CALIFORNIA, <?= $fecha ?><br>
			CENTRO DE DENUNCIA TECNOLÓGICA DE LA<br>
			FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA
		</p>
	<?php } ?>
	<br>
	<br>
	<p style="font-size:10px;text-align:center;">
		<a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf">Aviso de privacidad</a> | <a href="<?= base_url() ?>/assets/documentos/TerminosCondiciones.pdf">Términos y condiciones</a> | <a href="<?= base_url() ?>/assets/documentos/DerechosDeVictimaOfendido.pdf">Derechos de víctima u ofendido.</a>
	</p>
</div>

<?= $this->endSection() ?>
