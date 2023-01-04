<?= $this->extend('constancia_extravio/templates/dashboard_template') ?>

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
                    <h1 class="text-center fw-bolder pb-1 text-blue">CONSTANCIA DE EXTRAVÍO</h1>
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
                                    data-bs-target="#documentos_modal">
                                    <img src="<?= base_url() ?>/assets/img/icons/documento.png" class="w-75"
                                        alt="Constancia de Extravío">
                                    <!-- <p class="fw-bold fs-5 mt-2  text-dark ">Constancia de Extravío</p> -->
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="" class="text-decoration-none" data-bs-toggle="modal"
                                    data-bs-target="#vehiculo_modal">
                                    <img src="<?= base_url() ?>/assets/img/icons/placa.png" class="w-75"
                                        alt="Constancia de Extravío">
                                    <!-- <p class="fw-bold fs-5 mt-2  text-dark ">Constancia de Extravío</p> -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('peticion')) : ?>
<script>
Swal.fire({
    icon: 'success',
    text: '<?= session()->getFlashdata('peticion') ?>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php include('modal_form_documentos.php') ?>
<?php include('modal_form_vehiculo.php') ?>
<script>
(function() {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    var inputsText = document.querySelectorAll('input[type="text"]');
    var inputsEmail = document.querySelectorAll('input[type="email"]');

    inputsText.forEach((input) => {
        input.addEventListener('input', function(event) {
            event.target.value = clearText(event.target.value).toUpperCase();
        }, false)
    })

    inputsEmail.forEach((input) => {
        input.addEventListener('input', function(event) {
            event.target.value = clearText(event.target.value).toLowerCase();
        }, false)
    })

    function clearText(text) {
        return text
            .normalize('NFD')
            .replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
            .normalize()
            .replaceAll('´', '');
    }


    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})();
</script>
<?= $this->endSection() ?>