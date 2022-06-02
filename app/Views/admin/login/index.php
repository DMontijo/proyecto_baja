<?= $this->extend('admin/templates/login_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="d-flex align-items-center justify-content-center bg-primary" style="min-height: 100vh;background:url(<?= base_url() ?>/assets/img/lineas_background.png);background-repeat: no-repeat;background-attachment: fixed;background-size: cover !important;">
	<div class="container">
		<div class="row py-5">
			<div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
				<img src="<?= base_url() ?>/assets/img/LOGO_LOGIN_DESKTOP.png" class="img-fluid logo-login p-md-4 p-lg-0 px-5" alt="FGEBC Logo">
			</div>
			<div class="col-12 col-md-6">
				<div class="row h-100 align-items-center justify-content-center">
					<div class="col-12">
						<div class="row align-items-center justify-content-center">
							<div class="col-12 col-lg-10 offset-lg-1">
								<div class="card shadow-lg py-5 px-3" style="background: rgba(255,255,255,0.8);">
									<h2 class="fw-bolder text-white text-center text-blue mb-2">ENTRAR</h2>
									<div class="card-body">
										<?php if (session()->getFlashdata('message')) : ?>
											<div class="alert alert-warning">
												<?= session()->getFlashdata('message') ?>
											</div>
										<?php endif; ?>
										<form action="<?= base_url() ?>/admin/login" method="POST" class="row g-3 needs-validation" novalidate>
											<div class="col-12">
												<label for="correo" class="form-label fw-bold">Correo electrónico</label>
												<input type="email" class="form-control" id="correo" name="correo" required>
												<div class="invalid-feedback">
													El correo es obligatorio.
												</div>
											</div>
											<div class="col-12">
												<label for="password" class="form-label fw-bold">Contraseña</label>
												<input type="password" class="form-control" id="password" name="password" required>
												<div class="invalid-feedback">
													La contraseña es obligatoria.
												</div>
											</div>

											<div class="col-12 d-flex align-items-center justify-content-center">
												<button type="submit" class="btn btn-primary btn-block">
													Iniciar sesión.
												</button>
											</div>
											<!-- </br></br>
											<p class="text-center"><a class="link-primary" type="button" data-bs-toggle="modal" data-bs-target="#reset_pass">Olvidé mi contraseña</a></p> -->
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

<?= $this->endSection() ?>
