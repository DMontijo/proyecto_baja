<?= $this->extend('client/templates/login_template') ?>

<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;background:url(<?= base_url() ?>/assets/img/lineas_background.png);background-repeat: no-repeat;background-attachment: fixed;background-size: cover !important;">
    <div class="container">
        <div class="row py-5">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-login" alt="FGEBC Logo">
            </div>
            <div class="col-12 col-md-6 py-5">
                <div class="row align-items-center justify-content-center mb-5">
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="card bg-blue shadow-lg">
                            <div class="card-body text-center">
                                <h2 class="fw-bolder text-white">¿Quieres denunciar?</h2>
                                <a href="<?= base_url() ?>/denuncia/denunciante/new" class="btn btn-light">
                                    REGISTRATE
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="card bg-white shadow-lg py-3 px-3">
                            <h2 class="fw-bolder text-white text-center text-blue mb-2">Ingresa y denuncia</h2>
                            <div class="card-body">
								
                                <form action="<?= route_to("ciudadano_login_post") ?>" method="post" class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="correo" class="form-label fw-bold">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required autofocus>
                                    </div>

                                    <div class="col-12">
                                        <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
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

<?= $this->endSection() ?>
