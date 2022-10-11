<div class="modal fade" id="contrasena_modal_doc" tabindex="-1" aria-labelledby="passworddoc_modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content border-0">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title text-white font-weight-bold" id="password_modalLabel">Contraseña de FIEL</h5>
				<h5 class="modal-title text-white font-weight-bold d-none" id="password_verifying">Firmando documento</h5>
			</div>
			<div class="modal-body text-center" id="load">
					<div class="col-12 mb-3">
						<input type="text" class="form-control" id="folio" name="folio" value="<?= $body_data->folio ?>" hidden required>
						<input type="text" class="form-control" id="expediente" name="expediente" value="<?= $body_data->expediente ?>" hidden required>

						<input type="text" class="form-control" id="year" name="year" value="<?= $body_data->year ?>" hidden required>
						<input class="form-control" id="contrasena" name="contrasena" type="text" autocomplete="off" required>
						<div class="invalid-feedback">
							La contraseña es obligatoria
						</div>
					</div>
					<div class="col-12">
						<button type="button" id="firmar_documento_modal"  name="firmar_documento_modal" class="btn btn-secondary font-weight-bold">Firmar documento</button>
					</div>
			</div>
			<div id="loading" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation')
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {

					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					} else {
						document.querySelector('#load').classList.add('d-none');
						document.querySelector('#password_modalLabel').classList.add('d-none');
						document.querySelector('#loading').classList.remove('d-none');
						document.querySelector('#password_verifying').classList.remove('d-none');
					}
					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
