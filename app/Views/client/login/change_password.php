<section class="container-fluid bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center" >
                <img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" alt="FGEBC Logo">
            </div>
            <div class="col-12 col-md-5 offset-md-1">
                <div class="card bg-white shadow-lg py-5 px-3">
                    <div class="card-body">
                        <form action="<?= base_url() ?>/denuncia" class="row needs-validation" novalidate>
                            <div class="col-12">
                                <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="contrasena_confirm" class="form-label fw-bold">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="contrasena_confirm" name="contrasena_confirm" required>
                            </div>
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    ACTUALIZAR CONTRASEÑA
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>