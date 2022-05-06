<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row rounded d-flex justify-content-center">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <div class="row mb-3">
                    <div class="col-6 d-flex align-items-center justify-content-center p-3">
                        <img src="<?= base_url() ?>/assets/img/FGEBC.png" class="logo-login" alt="FGEBC Logo">
                    </div>
                    <div class="col-6 border-start border-white d-flex align-items-center justify-content-center p-3">
                        <img src="<?= base_url() ?>/assets/img/SEJAP.png" class="logo-login" alt="SEJAP Logo">
                    </div>
                </div>
            </div>
                <div class="row align-items-center rounded d-flex justify-content-center" >
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="card bg-white shadow-lg p-5 bg-light">
                            <div class="card-body">
							<div class="text-center">
                            <h3 class="text-primary">Panel de administración</h3>
                        </div>
                                <form action="<?=base_url()?>/denuncia/dashboard" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="correo" class="form-label fw-bold">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
										<div class="invalid-feedback">
											El correo es obligatorio.
										</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            required>
											<div class="invalid-feedback">
												La contraseña es obligatoria.
											</div>
                                    </div>

                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Iniciar sesión.
                                        </button>
                                    </div>
									</br></br>
									<p class="text-center"><a class="link-primary" type="button" data-bs-toggle="modal" data-bs-target="#reset_pass">Olvidé mi contraseña</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>