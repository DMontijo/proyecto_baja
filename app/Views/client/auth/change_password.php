<?= $this->extend('client/templates/login_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;background:url(<?= base_url() ?>/assets/img/lineas_background.png);background-repeat: no-repeat;background-attachment: fixed;background-size: cover !important;">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-12 col-md-5">
				<div class="card bg-white shadow-lg py-3 px-3">
					<div class="card-body">
						<h4 class="fw-bold text-center text-blue mb-5">ACTUALIZAR CONTRASEÑA</h4>
						<form action="<?= base_url('/denuncia/change_password') ?>" method="post" class="row needs-validation" novalidate>
							<input type="text" name="id" value="<?= $body_data->ID_DENUNCIANTE ?>" hidden>
							<div class="col-12 mb-3">
								<label for="password" class="form-label fw-bold">Nueva contraseña</label>
								<input type="password" class="form-control" id="password" name="password" required minlength="6">
								<div class="invalid-feedback">
									Debe tener por lo menos 6 dígitos
								</div>
							</div>
							<div class="col-12 mb-3">
								<label for="password_confirmation" class="form-label fw-bold">Confirmar nueva contraseña</label>
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
								<div class="invalid-feedback">
									Debe tener por lo menos 6 dígitos
								</div>
							</div>

							<div class="col-12 d-flex align-items-center justify-content-center">
								<button type="submit" class="btn btn-primary btn-block">ACTUALIZAR CONTRASEÑA</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<script>
	let password = document.querySelector('#password');
	let password_confirm = document.querySelector('#password_confirmation');
	let password_alert = document.querySelector('#password_alert');

	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (password.value === password_confirm.value) {
						console.log('Es igual');
						if (!form.checkValidity()) {
							event.preventDefault();
							event.stopPropagation();
						} else {

						}
					} else {
						event.preventDefault();
						Swal.fire({
							icon: 'error',
							text: 'Las contraseñas no son iguales',
							confirmButtonColor: '#bf9b55',
						})
					}

					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>


<?= $this->endSection() ?>
