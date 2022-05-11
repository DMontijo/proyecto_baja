<?= $this->extend('templates/page_template') ?>

<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container" style="min-height:90vh;">
	<div class=" card d-none d-lg-block" style="font-size: 12px; color:var(--gris1);">
		<div class="row card-body" style="background-color: var(--azul);">
			<div class="col-10">
				<p>Para realizar una video denuncia ó solicitar constancia de extravío acepta términos y condiciones, aviso de privacidad y derechos del ofendido. Puedes consultarlos <a onclick="window.open(); return false;" href="" style="color: azul">aquí</a></p>
			</div>

			<form name="che" action="" enctype="text/plain" class="col-2">
				<div>
					<div class="form-check">
						<input title="Aceptar términos y condiciones, aviso de privacidad, derechos del ofendido." class="form-check-input" type="checkbox" name="miCheck" onclick="handleClick()" id="aceptar_todos">
						<p class="form-check-label" for="AceptarTodos">Aceptar todos</p>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br>

	<!--Versión escritorio-->

	<section class="row align-content-center justify-content-center">
		<div class="col-sm-4 col-md-3 d-none d-lg-block">
			<div class="card text-center bg-transparent border-0">
				<div class="card-body" data-bs-toggle="popover" data-bs-placement="top">
					<a href="<?= base_url() ?>/denuncia" class="text-decoration-none" onclick="handleClickBTN(event)" name="VideoDenuncia" id="VideoDenuncia">
						<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="w-75" alt="Video Denuncia">
						<p class="fw-bold fs-5 mt-2  text-dark ">Video Denuncia</p>
					</a>
				</div>
			</div>
		</div>

		<div class="col-sm-4 col-md-3 d-none d-lg-block" id="Constancia">
			<div class="card text-center bg-transparent border-0">
				<div class="card-body">
					<a href="" class="text-decoration-none" onclick="" name="constancia" id="constancia">
						<img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="w-75" alt="Constancia extravío">
						<p class="fw-bold fs-5 mt-2  text-dark ">Constancia extravío</p>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!--Versión movil-->
	<section class="row d-block d-lg-none">
		<div class="container card rounded" style="font-size: 12px; color:white;">
			<div class="row card-body box-checks" style="background-color: var(--azul)">
				<div class="col-12">
					<p>Para realizar una video denuncia ó solicitar constancia de extravío acepta términos y condiciones, aviso de privacidad y derechos del ofendido. Puedes consultarlos <a href="#" class="text-yellow">aquí</a></p>
				</div>
				<div class="col-12">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="aceptar_todos">
						<a href="#" class="form-check-label" for="AceptarTodos">Aceptar todos</a>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="col-12">
			<a href="" class="text-decoration-none">
				<div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
					<div class="card-body d-flex">
						<div class="w-75 d-flex align-items-center" style="height:100px">
							<p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Video Denuncia</p>
						</div>
						<div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
							<img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="movil-icon" alt="Video Denuncia">
						</div>
					</div>
				</div>
			</a>
			<a href="" class="text-decoration-none">
				<div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
					<div class="card-body d-flex">
						<div class="w-75 d-flex align-items-center" style="height:100px">
							<p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Constancia extravío</p>
						</div>
						<div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
							<img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="movil-icon" alt="Constancia extravío">
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
		//chk ? alert("ok") : (alert("acepta los terminos porfavor"));
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
