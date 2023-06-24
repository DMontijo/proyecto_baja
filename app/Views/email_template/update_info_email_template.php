<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>
<?php
$expediente_guiones = '';
$arrayExpediente = str_split($expediente);
$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
?>

<div style="text-align:center;">
	<p>El expediente se ha cambio de estado y se encuentra en: <?= $estadojuridico ?> </p>
	<!-- <p>Se ha generado un nuevo expediente</p> -->
	<br>
	<p>y se esta atendiendo en la oficina: </p>

	<h2><?= $oficina ?> </h2>
	<br>
</div>

<?= $this->endSection() ?>
