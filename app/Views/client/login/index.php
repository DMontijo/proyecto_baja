<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row">
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
            <div class="col-12 col-md-6 py-5">
                <div class="row align-items-center justify-content-center mb-5">
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="card bg-blue shadow-lg">
                            <div class="card-body text-center">
                                <h2 class="fw-bolder text-white">¿Quieres denunciar?</h2>
                                <a href="<?=base_url()?>/denuncia/registro" class="btn btn-light">
                                    REGISTRATE
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="card bg-white shadow-lg py-5 px-3">
                            <h2 class="fw-bolder text-white text-center text-blue mb-2">Ingresa y denuncia</h2>
                            <div class="card-body">
                                
                                <form action="<?=base_url()?>/denuncia/dashboard" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="correo" class="form-label fw-bold">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            required>
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
</section>
<?php include('reset_password_modal.php') ?>