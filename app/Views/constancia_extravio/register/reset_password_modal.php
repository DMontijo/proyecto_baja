<div class="modal fade" id="reset_pass" tabindex="-1" aria-labelledby="resetLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">Restaurar mi contraseña</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="reset_password" action="<?= base_url("constancia_extravio/send_email_change_password") ?>" method="post" class="needs-validation" novalidate>
					<div class="mb-3" id="divCorreo">
						<label for="correo_reset_password" class="col-form-label">Correo electrónico:</label>
						<input type="email" class="form-control" id="correo_reset_password" name="correo_reset_password" required>
						<div class="invalid-feedback">
							Por favor, ingresa tu correo electrónico.
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Recuperar mi contraseña</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	(function() {
		'use strict'

		let form = document.querySelector('#reset_password');

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			} else {
				event.preventDefault();
				let regex = /\S+@\S+\.\S+/
				let email = document.querySelector('#correo_reset_password');

				if (regex.test(email.value)) {
					$.ajax({
						data: {
							'email': email.value
						},
						url: "<?= base_url('/data/exist-email-solicitantes') ?>",
						method: "POST",
						dataType: "json",

					}).done(function(data) {
						if (data.exist !== 1) {
							Swal.fire({
								icon: 'error',
								text: 'El correo no se encuentra registrado en el sistema de constancias.',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							event.target.submit();
						}
					}).fail(function(jqXHR, textStatus) {});
				}
			}
			form.classList.add('was-validated')
		}, false)
	})();
</script>
