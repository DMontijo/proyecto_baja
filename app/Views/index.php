<?= $this->extend('templates/page_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
	<!--Versión escritorio-->
	<div class="row mb-5">
		<div class="col-12">
			<div class="card bg-primary shadow mb-4" style="font-size:14px;background:url(<?= base_url('/assets/img/banner/LINEAS_BANNER.png') ?>);background-repeat: no-repeat;background-size: cover !important;background-position-y: top;border-radius:10px;">
				<div class="row p-4">
					<div class="col-12">
						<div class="row">
							<div class="col-12 col-md-6">
								<a class="p-0 my-3" href="tel:911" role="button"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
							</div>
							<div class="col-12 col-md-6 mt-4 mt-md-0">
								<a class="p-0 my-3" href="tel:8003432220" role="button" role="button"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-12 text-white">
			<div class="card" style="font-size:13px;background:var(--azul);border-radius:10px;">
				<div class="card-body">
					<div class="row m-0 p-0">
						<div class="col-12 col-lg-9">
							<p class="" style="font-size:16px;text-align:justify;">Para realizar una video denuncia ó solicitar constancia de extravío es importante que aceptes los términos y condiciones y aviso de privacidad de datos.
								<br><br>Puedes consultar los términos y condiciones <a href="<?= base_url() ?>/assets/documentos/Terminos_Y_Condiciones.pdf" target="_blank" class="text-yellow">aquí</a>. Puedes consultar el aviso de privacidad <a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf" target="_blank" class="text-yellow">aquí</a>.
							</p>
						</div>
						<div class="col-12 col-lg-3 d-flex align-items-center justify-content-lg-end justify-content-center text-center py-4">
							<div class="form-check d-inline-block m-0 p-0" style="min-height: 0px!important;">
								<input title="Aceptar términos y condiciones y aviso de privacidad." class="form-check-input" type="checkbox" name="aceptar_todos" id="aceptar_todos">
								<label class="form-check-label" for="aceptar_todos" style="font-size:16px;text-align:justify;">Aceptar todos</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="row d-none d-lg-block">
		<div class="col-lg-4 offset-lg-4 d-none d-md-block text-center">
			<div class="card text-center bg-transparent border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Para continuar debes aceptar el aviso de privacidad de datos y los términos y condiciones">
				<div class="card-body">
					<a href="<?= base_url() ?>/denuncia" class="text-decoration-none" onclick="handleClickBTN(event)" name="VideoDenuncia" id="VideoDenuncia">
						<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="w-75" alt="Video Denuncia">
						<p class="fw-bold fs-5 mt-2  text-dark ">Video Denuncia</p>
					</a>
				</div>
			</div>
		</div>
	</section>
	<section class="row d-block d-lg-none">
		<div class="col-12 mt-4">
			<a href="<?= base_url() ?>/denuncia" class="text-decoration-none" name="VideoDenuncia" id="VideoDenuncia">
				<div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
					<div class="card-body d-flex">
						<div class="w-75 d-flex align-items-center" style="height:100px">
							<p class="fw-bold d-fle p-0 m-0 fs-4 text-blue">Video Denuncia</p>
						</div>
						<div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
							<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="movil-icon" alt="Video Denuncia">
						</div>
					</div>
				</div>
			</a>
		</div>
	</section>
	<section>
		<div class="row">
			<div class="col-12 text-center">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutorial_modal">
					<i class="bi bi-play-btn-fill"></i> Ver video tutorial
				</button>
			</div>
		</div>
	</section>
</div>
<?php include('tutorial_modal.php') ?>

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

	document.querySelector('#tutorial_modal').addEventListener('shown.bs.modal', () => {
		document.querySelector('#tutorial_video').play();
		console.log('Dando play');
	});

	document.querySelector('#tutorial_modal').addEventListener('hidden.bs.modal', () => {
		document.querySelector('#tutorial_video').pause();
	});
</script>


<?= $this->endSection() ?>
