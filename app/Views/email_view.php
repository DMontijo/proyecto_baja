<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
	<form method="post" action="<?= base_url() ?>/CorreoController/sendMail">
		<div class="form-group">
			<label>Destinatario</label>
			<input type="email" name="destinatario" class="form-control">
		</div>

		<div class="form-group">
			<label>Asunto</label>
			<input type="text" name="asunto" class="form-control">
		</div>
		<div class="form-group">
			<label>Mensaje</label>
			<textarea rows="6" type="text" name="mensaje" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Enviar mensaje</button>
		</div>
	</form>
</div>
<?= $this->endSection() ?>
