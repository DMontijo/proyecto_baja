<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>


<div style="text-align:center;">
	<h3>El folio <strong><?= $folio ?> / <?= $year ?></strong> es un caso de suma importancia. <br> Favor de verificar en el sistema de videodenuncia</h3>
	<!-- <p>Se ha generado un nuevo expediente</p> -->
	<br>
	<h2></h2>
	<br>
</div>

<?= $this->endSection() ?>
