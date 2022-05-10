<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row rounded d-flex justify-content-center">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-5">
                <img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-login" alt="FGEBC Logo">
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-content-center">
                    <div class="card rounded bg-white shadow-lg px-3 py-5" style="max-width:500px;">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="text-primary fw-bolder mb-3">Panel de administración</h3>
                            </div>
                            <form action="<?= base_url() ?>/justicia/dashboard" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <label for="correo" class="form-label fw-bold">Correo electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                    <div class="invalid-feedback">
                                        El correo es obligatorio.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
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