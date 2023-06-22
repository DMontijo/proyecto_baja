<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" style="min-height:83vh;">
    <div class="col-12">
        <h4 class="text-center text-blue fw-bold my-5">BIENVENID@ <?= $session->NOMBRE ?>
            <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?></h4>
        <div class="card rounded shadow border-0">
        <div class="card-body py-5">
                <div class="container">
                    <h1 class="text-center fw-bolder pb-1 text-blue">MODULO LITIGANTES</h1>
                </div>
            </div>
            <section class="p-3">
                <div class="row justify-content-center">
                    <!-- <div class="col-12 col-md-6 col-lg-4 text-center">
						<div class="card text-center bg-transparent border-0">
							<div class="card-body">
								<a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#boletos_modal">
									<img src="<?= base_url() ?>/assets/img/icons/boleto.png" class="w-75" alt="Video Denuncia">
									<p class="fw-bold fs-5 mt-2  text-dark ">Boleto de sorteo</p>
								</a>
							</div>
						</div>
					</div> -->
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="" class="text-decoration-none" data-bs-toggle="modal"
                                    data-bs-target="#crearEmpresaModal"> 
                                    <img src="<?= base_url() ?>/assets/img/icons/crearempresa_btn.png" class="w-75"
                                        alt="Crear empresa">
                                    <p class="fw-bold fs-5 mt-2  text-dark ">Registrar empresa</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="" class="text-decoration-none" data-bs-toggle="modal"
                                    data-bs-target="#ligarEmpresaModal">
                                    <img src="<?= base_url() ?>/assets/img/icons/ligarempresa_btn.png" class="w-75"
                                        alt="Ligar a una empresa">
                                    <p class="fw-bold fs-5 mt-2  text-dark ">Ligar a una empresa</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="<?= base_url() ?>/denuncia_litigantes/dashboard/denuncia_persona_fisica" class="text-decoration-none" >
                                    <img src="<?= base_url() ?>/assets/img/icons/personafisica_btn.png" class="w-75"
                                        alt="Denuncia persona física">
                                    <p class="fw-bold fs-5 mt-2  text-dark ">Persona Física</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="<?= base_url() ?>/denuncia_litigantes/dashboard/denuncia_persona_moral" class="text-decoration-none">
                                    <img src="<?= base_url() ?>/assets/img/icons/personamoral_btn.png" class="w-75"
                                        alt="Denuncia persona moral">
                                    <p class="fw-bold fs-5 mt-2  text-dark ">Persona Moral</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include('modal_form_persona_moral.php') ?>
<?php include('modal_form_ligar_empresa.php') ?>
<script>
(function() {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    var inputsText = document.querySelectorAll('input[type="text"]');
    var inputsEmail = document.querySelectorAll('input[type="email"]');

    //Convierte todos los input text a mayusculas
    inputsText.forEach((input) => {
        input.addEventListener('input', function(event) {
            event.target.value = clearText(event.target.value).toUpperCase();
        }, false)
    })

    //Convierte todos los inout email a minusculas
    inputsEmail.forEach((input) => {
        input.addEventListener('input', function(event) {
            event.target.value = clearText(event.target.value).toLowerCase();
        }, false)
    })

    //Elimina los caracteres especiales del texto
    function clearText(text) {
        return text
            .normalize('NFD')
            .replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
            .normalize()
            .replaceAll('´', '');
    }
})();
</script>
<?= $this->endSection() ?>