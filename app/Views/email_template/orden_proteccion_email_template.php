<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>
<div style="font-size: 14px !important; font-weight: normal !important;font-family: Helvetica !important;">
	<p style="text-align:justify;">
		Anteponiendo un cordial saludo, a través del presente se adjunta medida de protección emergente generada en el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, misma que se remite para su debida atención, agradeciendo de antemano su colaboración.
	</p>
	<br>
	<p style="text-align:center;">
		<?= isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' ?>BAJA CALIFORNIA, <?= $fecha ?><br>
		CENTRO DE DENUNCIA TECNOLÓGICA DE LA<br>
		FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA
	</p>
	<br>
	<br>
</div>

<?= $this->endSection() ?>
