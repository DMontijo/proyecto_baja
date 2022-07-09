<?= $this->extend('email_template/main_template') ?>
<?= $this->section('body') ?>

<div style="text-align:center;">
	<h2>EL FOLIO <?= $folio ?> FUE <?= $motivo ?></h2>
	<br>
	<p>DA CLIC EN EL BOTÓN INFERIOR PARA VER EL DIRECTORIO DE DERIVACIONES Y CANALIZACIONES</p>
	<br>
	<?php if ($motivo == 'CANALIZADO') { ?>
		<a class="btn" href="<?= base_url('/canalizaciones') ?>">
			VER DIRECTORIO
		</a>
	<?php } else { ?>
		<a class="btn" href="<?= base_url('/derivaciones') ?>">
			VER DIRECTORIO
		</a>
	<?php } ?>
</div>

<?= $this->endSection() ?>