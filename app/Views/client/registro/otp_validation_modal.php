<div class="modal fade" id="otp_validation_modal" tabindex="-1" aria-labelledby="resetLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">Validación de correo</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3" id="divCorreo">
					<label for="correo_otp" class="col-form-label">Ingresa el código que llego a tu correo electrónico</label>
					<input type="text" class="form-control" id="correo_otp" name="correo_otp" required pattern="\d{6}" maxlength="6">
					<div class="invalid-feedback">
						Deben ser 6 dígitos númericos
					</div>
				</div>
				<a class="btn btn-primary" href="<?= base_url() ?>/denuncia" role="button">Validar correo</a>
			</div>
		</div>
	</div>
</div>
