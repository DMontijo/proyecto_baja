<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>
<?php
$expediente_guiones = '';
$arrayExpediente = str_split($expediente);
$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
?>

<div style="text-align:center;">
<h2>Gracias por denunciar, se te ha generado un nuevo expediente</h2>
	<!-- <p>Se ha generado un nuevo expediente</p> -->
	<br>
	<h2><?= $expediente_guiones ?> /<?= $tipoexpediente ?> </h2>
	<br>
</div>

<?= $this->endSection() ?>
