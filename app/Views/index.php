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
				<div class="row py-5 px-5">
					<div class="col-lg-7 col-12 fw-bold text-white ">
						<p>Los delitos que se enuncian a continuación deberá ser denunciados de manera personal ante la Unidad de Investigación correspondiente.</p>
						<ul class="ps-5 m-0">
							<li>Violación</li>
							<li>Secuestro</li>
							<li>Tortura</li>
							<li>Trata de personas</li>
							<li>Delitos cometidos por personal adscrito a la Físcalia General del Estado de Baja California</li>
							<li>Homicidio en todas sus modalidades</li>
							<li>Delitos contra la salud modalidad narcomenudeo</li>
							<li>Abuso sexual cuando la víctima sea menor de edad</li>
							<li>Tráfico de menores</li>
						</ul>
					</div>
					<div class="col-lg-5 col-12 d-flex flex-column justify-content-between text-center">
						<a class="p-0 my-3" href="tel:911" role="button"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
						<a class="p-0 my-3"  href="tel:089" role="button" role="button"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-10 offset-lg-1 col-12 text-white">
			<div class="card" style="font-size:13px;background:var(--azul);border-radius:10px;">
				<div class="card-body">
					<div class="row">
						<div class="col-10">
							<p>Para realizar una video denuncia ó solicitar constancia de extravío es importante que aceptes los <a href="<?= base_url() ?>/assets/documentos/Terminos_Y_Condiciones.pdf" target="_blank" class="text-yellow">términos y condiciones</a> y <a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf" target="_blank" class="text-yellow">aviso de privacidad de datos</a>.
								<br>Puedes consultar el aviso de privacidad <a href="<?= base_url() ?>/assets/documentos/Aviso_De_Privacidad_De_Datos.pdf" target="_blank" class="text-yellow">aquí</a>. Puedes consultar los términos y condiciones <a href="<?= base_url() ?>/assets/documentos/Terminos_Y_Condiciones.pdf" target="_blank" class="text-yellow">aquí</a>
							</p>
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

	<section class="row d-none d-lg-block">
		<div class="col-lg-4 offset-lg-4 d-none d-md-block text-center">
			<div class="card text-center bg-transparent border-0" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Para continuar debes aceptar el Aviso de Privacidad y los Términos y Condiciones">
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
