<?= $this->extend('constancia_extravio/templates/login_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="container-fluid bg-blue d-flex align-items-center justify-content-center" style="min-height: 100vh;background:url(<?= base_url() ?>/assets/img/lineas_background.png);background-repeat: no-repeat;background-attachment: fixed;background-size: cover !important;">
	<div class="container">
		<div class="row py-5">
			<div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
				<img src="<?= base_url() ?>/assets/img/LOGO_LOGIN_DESKTOP.png" class="img-fluid logo-login p-md-4 p-lg-0 px-5" alt="FGEBC Logo">
			</div>
			<div class="col-12 col-md-6">
				<div class="row h-100 align-items-center justify-content-center">
					<div class="col-12">
						<div class="row align-items-center justify-content-center mb-3">
							<div class="col-12 col-lg-10 offset-lg-1">
								<div class="card bg-yellow shadow-lg">
									<div class="card-body text-center">
										<h2 class="fw-bolder text-white">¿Necesitas una constancia de extravío?</h2>
										<a href="<?= base_url() ?>/constancia_extravio/register" class="btn btn-light">
											REGISTRATE
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="row align-items-center justify-content-center">
							<div class="col-12 col-lg-10 offset-lg-1">
								<div class="card shadow-lg py-3 px-3" style="background: rgba(255,255,255,0.8);">
									<h2 class="fw-bolder text-white text-center text-blue mb-2">Si ya tienes una cuenta para constancias ingresa</h2>
									<div class="card-body">
										<?php if (session()->getFlashdata('message')) : ?>
											<div class="alert alert-warning">
												<?= session()->getFlashdata('message') ?>
											</div>
										<?php endif; ?>
										<form id="client_login_form" action="<?= base_url("constancia_extravio/login_auth") ?>" method="post" class="row g-3 needs-validation" novalidate>
											<div class="col-12">
												<label for="correo" class="form-label fw-bold">Correo electrónico</label>
												<input type="email" class="form-control" id="correo" name="correo" required autofocus>
											</div>

											<div class="col-12">
												<label for="password" class="form-label fw-bold">Contraseña</label>
												<input type="password" class="form-control" id="password" name="password" required>
											</div>
											<p class="text-center"><a class="link-primary" type="button" data-bs-toggle="modal" data-bs-target="#reset_pass">Olvidé mi contraseña</a></p>

											<div class="col-12 d-flex align-items-center justify-content-center">
												<button type="submit" class="btn btn-primary btn-block">
													ENTRAR
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('reset_password_modal.php') ?>
<script>
	(function() {
		'use strict'

		let form = document.querySelector('#client_login_form');

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated')
		}, false)
	})();
</script>
<?= $this->endSection() ?>
