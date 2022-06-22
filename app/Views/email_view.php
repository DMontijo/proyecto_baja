<?= $this->extend('templates/page_template') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
	<form method="post" action="<?= base_url('/email') ?>">
		<div class="form-group">
			<label>Destinatario</label>
			<input type="email" name="email" class="form-control">
		</div>

		<div class="form-group">
			<label>Asunto</label>
			<input type="text" name="subject" class="form-control">
		</div>

		<div class="form-group">
			<label>Mensaje</label>
			<textarea rows="6" type="text" name="message" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Enviar mensaje</button>
		</div>

	</form>
</div>
<?= $this->endSection() ?>
