<?= $this->extend('templates/page_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">

	<!--Versión escritorio-->

	<div class="row mb-5 d-none d-md-block">
		<div class="col-12">
			<div class="card rounded bg-yellow shadow text-center mb-4">
				<img src="<?= base_url() ?>/assets/img/banner.png" width="100%" height="100%" alt="" />
			</div>
		</div>
		<div class="col-10 offset-1 text-white">
			<div class="card" style="font-size:13px;background:var(--azul);">
				<div class="card-body">
					<div class="row">
						<div class="col-10">
							<p class="m-0">Para realizar una video denuncia ó solicitar constancia de extravío acepta aviso de
								privacidad y términos y condiciones. Puedes consultarlos <a style="color: var(--amarillo);" onclick="window.open(); return false;" href="">aquí</a></p>
						</div>
						<div class="col-2 d-flex align-content-center justify-content-end">
							<div class="form-check d-inline-block m-0 p-0" style="min-height: 0px!important;">
								<input title="Aceptar términos y condiciones y aviso de privacidad." class="form-check-input" type="checkbox" name="miCheck" id="aceptar_todos">
								<label class="form-check-label" for="AceptarTodos">Aceptar todos</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="row align-content-center justify-content-center">
		<div class="col-4 d-none d-md-block">
			<div class="card text-center bg-transparent border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Para continuar debes aceptar: Aviso de privacidad y Términos y condiciones">
				<div class="card-body">
					<a href="<?= base_url() ?>/denuncia" class="text-decoration-none" onclick="handleClickBTN(event)" name="VideoDenuncia" id="VideoDenuncia">
						<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="w-75" alt="Video Denuncia">
						<p class="fw-bold fs-5 mt-2  text-dark ">Video Denuncia</p>
					</a>
				</div>
			</div>
		</div>

		<!-- <div class="col-sm-4 col-md-3 d-none d-md-block" id="Constancia">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none" onclick="" name="constancia" id="constancia">
                        <img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="w-75"
                            alt="Constancia extravío">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Constancia extravío</p>
                    </a>
                </div>
            </div>
        </div> -->
	</section>

	<!--Versión movil-->

	<section class="row d-block d-md-none">
		<div class="col-12">
			<div class="card rounded bg-yellow shadow text-center mb-4">
				<img src="<?= base_url() ?>/assets/img/banner_movil.png" width="100%" height="100%" alt="" />
			</div>
		</div>
		<div class="col-12">
			<div class="card rounded text-white" style="font-size: 13px;" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Para continuar debes aceptar: Aviso de privacidad y Términos y condiciones">
				<div class="card-body box-checks" style="background-color: var(--azul)">
					<div class="row">
						<div class="col-12">
							<p>Para realizar una video denuncia ó solicitar constancia de extravío acepta términos y condiciones, aviso de privacidad y derechos del ofendido. Puedes consultarlos <a href="#" class="text-yellow">aquí</a></p>
						</div>
						<div class="col-12">
							<div class="form-check">
								<input title="Aceptar términos y condiciones y aviso de privacidad." class="form-check-input" type="checkbox" name="miCheck" id="aceptar_todos">
								<label class="form-check-label" for="AceptarTodos">Aceptar todos</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 mt-4">
			<a href="<?= base_url() ?>/denuncia" class="text-decoration-none" name="VideoDenuncia" id="VideoDenuncia">
				<div class="card text-white bg-yellow border-0 shadow rounded-3 mb-4">
					<div class="card-body d-flex">
						<div class="w-75 d-flex align-items-center" style="height:100px">
							<p class="fw-bold d-fle p-0 m-0 fs-4 text-white">Video Denuncia</p>
						</div>
						<div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
							<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="movil-icon" alt="Video Denuncia">
						</div>
					</div>
				</div>
			</a>
			<!-- <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Constancia extravío</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="movil-icon"
                                alt="Constancia extravío">
                        </div>
                    </div>
                </div>
            </a> -->
		</div>
	</section>

</div>

<script>
	function handleClickBTN(e) {
		var chk = document.getElementById("aceptar_todos").checked;
		if (!chk) {
			e.preventDefault();
			var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
			var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
				return new bootstrap.Popover(popoverTriggerEl)

			})
		}
	}
</script>

<?= $this->endSection() ?>
