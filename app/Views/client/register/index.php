<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$request = \Config\Services::request();
$agent = $request->getUserAgent();
$currentAgent = '';

if ($agent->isMobile()) {
	$currentAgent = strtolower($agent->getMobile());
}
?>
<div class="container m-auto">
	<div class="col-12">
		<div class="card bg-primary shadow mb-4" style="font-size:14px;background:url(<?= base_url('/assets/img/banner/LINEAS_BANNER.png') ?>);background-repeat: no-repeat;background-size: cover !important;background-position-y: top;border-radius:10px;">
			<div class="row p-4">
				<div class="col-12">
					<div class="row">
						<div class="col-12 col-md-6">
							<a class="p-0 my-3" role="button" data-bs-toggle="modal" data-bs-target="#emergency_modal"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
						</div>
						<div class="col-12 col-md-6 mt-4 mt-md-0">
							<a class="p-0 my-3" role="button" data-bs-toggle="modal" data-bs-target="#anonima_modal"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow py-4 px-3 border-0">
		<div class="card-body">
			<h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">DATOS DEL USUARIO</h1>
			<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

			<div class="progress">
				<div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
			</div>

			<form id="form_register" name="form_register" class="row g-3 needs-validation py-5" action="<?= base_url() ?>/denuncia/denunciante" method="POST" enctype="multipart/form-data" novalidate>
				<div class="col-12 step">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
							<input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" required>
							<div class="invalid-feedback">
								El nombre es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
							<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="50" required>
							<div class="invalid-feedback">
								El apellido paterno es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
							<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="50">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">
							<div class="invalid-feedback">
								La fecha de nacimiento es obligatoria
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" required>
								<label class="form-check-label" for="sexo">MASCULINO</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" id="sexo" value="F" required>
								<label class="form-check-label" for="sexo">FEMENINO</label>
							</div>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
							<div class="input-group">
								<span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
								<input type="email" class="form-control" name="correo" id="correo" aria-describedby="correo_vanity" maxlength="100" required>
							</div>
							<div class="invalid-feedback">
								El correo esta erroneo
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="telefono" class="form-label fw-bold input-required">Número de teléfono</label>
							<input type="number" class="form-control" id="telefono" name="telefono" required max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
							<!-- <small>Mínimo 6 digitos</small> -->
							<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="telefono2" class="form-label fw-bold">Número de teléfono adicional</label>
							<input type="number" class="form-control" id="telefono2" name="telefono2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
							<!-- <small>Mínimo 6 digitos</small> -->
							<input type="number" id="codigo_pais_2" name="codigo_pais_2" maxlength="3" hidden>
						</div>
					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center mb-3 fw-bold">DATOS DE ORIGEN DEL DENUNCIANTE</h3>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nacionalidad" class="form-label fw-bold input-required">Nacionalidad</label>
							<select class="form-select" id="nacionalidad" name="nacionalidad" required>
								<option selected disabled value="">Selecciona la nacionalidad</option>
								<?php foreach ($body_data->nacionalidades as $index => $nac) { ?>
									<option value="<?= $nac->PERSONANACIONALIDADID ?>" <?= $nac->PERSONANACIONALIDADDESCR == 'MEXICANA' ? 'selected' : '' ?>> <?= $nac->PERSONANACIONALIDADDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								La nacionalidad es obligatoria.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="estado_select_origen" class="form-label fw-bold input-required">Estado origen</label>
							<select class="form-select" id="estado_select_origen" name="estado_select_origen" required>
								<option selected disabled value="">Selecciona el estado</option>
								<?php foreach ($body_data->estados as $index => $estado) { ?>
									<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El estado es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="municipio" class="form-label fw-bold input-required">Municipio origen</label>
							<select class="form-select" id="municipio_select_origen" name="municipio_select_origen" required>
								<option selected disabled value="">Selecciona el municipio</option>
							</select>
							<div class="invalid-feedback">
								El municipio es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="idioma" class="form-label fw-bold input-required">Idioma</label>
							<select class="form-select" id="idioma" name="idioma" required>
								<option selected disabled value="">Selecciona el idioma</option>
								<?php foreach ($body_data->idiomas as $index => $nac) { ?>
									<option value="<?= $nac->PERSONAIDIOMAID ?>" <?= $nac->PERSONAIDIOMADESCR == 'ESPAÑOL' ? 'selected' : '' ?>> <?= $nac->PERSONAIDIOMADESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								Debes elegir un idioma
							</div>
						</div>

						<div class="col-12">
							<div class="alert alert-warning text-center fw-bold d-none mt-2" id="idioma_alert" role="alert">
								Si tu idioma es diverso español se recomienda estar acompañado de un traductor.
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center mb-3 fw-bold">DOMICILIO ACTUAL DEL DENUNCIANTE</h3>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="pais_select" class="form-label fw-bold input-required">País</label>
							<select class="form-select" id="pais_select" name="pais_select" required>
								<?php foreach ($body_data->paises as $index => $pais) { ?>
									<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El país es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="estado_select" class="form-label fw-bold input-required">Estado</label>
							<select class="form-select" id="estado_select" name="estado_select" required>
								<option selected disabled value="">Selecciona el estado</option>
								<?php foreach ($body_data->estados as $index => $estado) { ?>
									<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El estado es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="municipio" class="form-label fw-bold input-required">Municipio</label>
							<select class="form-select" id="municipio_select" name="municipio_select" required>
								<option selected disabled value="">Selecciona el municipio</option>
							</select>
							<div class="invalid-feedback">
								El municipio es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="calle" class="form-label fw-bold input-required">Calle</label>
							<input type="text" class="form-control" id="calle" name="calle" maxlength="100" required>
							<div class="invalid-feedback">
								La calle es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="exterior" class="form-label fw-bold input-required" id="lblExterior">Número exterior</label>
							<input type="text" class="form-control" id="exterior" name="exterior" maxlength="10" required>
							<div class="invalid-feedback">
								El número exterior es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="interior" class="form-label fw-bold" id="lblInterior">Número interior</label>
							<input type="text" class="form-control" id="interior" name="interior" maxlength="10">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="localidad" class="form-label fw-bold input-required">Localidad</label>
							<select class="form-select" id="localidad_select" name="localidad_select" required>
								<option selected disabled value="">Selecciona la localidad</option>
							</select>
							<div class="invalid-feedback">
								La localidad es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="colonia" class="form-label fw-bold input-required">Colonia</label>
							<select class="form-select" id="colonia_select" name="colonia_select" required>
								<option selected disabled value="">Selecciona la colonia</option>
							</select>
							<input type="text" class="form-control d-none" id="colonia" name="colonia" maxlength="100" required>
							<small id="colonia-message" class="text-primary fw-bold d-none">Si no encuentras tu colonia selecciona otro</small>
							<div class="invalid-feedback">
								La colonia es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="cp" class="form-label fw-bold">Código postal</label>
							<input type="number" class="form-control" id="cp" maxlength="10" oninput="clearInputPhone(event);" name="cp">
						</div>

						<div class="col-12 mt-4 mb-4">
							<input class="form-check-input" type="checkbox" id="checkML" name="checkML">
							<label class="form-check-label fw-bold" for="checkML">
								¿Tu dirección contiene manzana y lote?
							</label>
						</div>

					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center mb-3 fw-bold">DATOS DE IDENTIFICACIÓN DEL DENUNCIANTE</h3>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="identificacion" class="form-label fw-bold input-required">Identificación</label>
							<select class="form-select" id="identificacion" name="identificacion" required>
								<option selected disabled value="">Selecciona la identificación</option>
								<?php foreach ($body_data->tiposIdentificaciones as $index => $identificacion) { ?>
									<option value="<?= $identificacion->PERSONATIPOIDENTIFICACIONID ?>"> <?= $identificacion->PERSONATIPOIDENTIFICACIONDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El tipo de identificación es obligatorio.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="numero_ide" class="form-label fw-bold">Número de identificación</label>
							<input type="text" class="form-control" id="numero_ide" name="numero_ide">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="e_civil" class="form-label fw-bold input-required">Estado civil</label>
							<select class="form-select" id="e_civil" name="e_civil" required>
								<option selected disabled value="">Selecciona su estado civil</option>
								<?php foreach ($body_data->edoCiviles as $index => $edo) { ?>
									<option value="<?= $edo->PERSONAESTADOCIVILID ?>"> <?= $edo->PERSONAESTADOCIVILDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El estado civil es obligatorio.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="escolaridad" class="form-label fw-bold input-required">Escolaridad</label>
							<select class="form-select" id="escolaridad" name="escolaridad" required>
								<option selected disabled value="">Selecciona la escolaridad</option>
								<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
									<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								La escolaridad es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="ocupacion" class="form-label fw-bold input-required">Ocupación</label>
							<select class="form-select" id="ocupacion" name="ocupacion" required>
								<option selected disabled value="">Selecciona la ocupacion</option>
								<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
									<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
								<?php } ?>
							</select>
							<input type="text" class="form-control d-none" id="ocupacion_descr" name="ocupacion_descr" maxlength="100">
							<small id="ocupacion-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>
							<div class="invalid-feedback">
								La ocupación es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="discapacidad" class="form-label fw-bold">¿Padece alguna discapacidad?</label>
							<input type="text" class="form-control" id="discapacidad" name="discapacidad" maxlength="100">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="documento" class="form-label fw-bold input-required">Foto de identificación</label>
							<img class="img-fluid d-none py-2" src="" id="img_preview" name="img_preview">
							<input class="form-control" type="file" id="documento" name="documento" accept="image/jpeg, image/jpg, image/png, application/pdf" required>
							<textarea id="documento_text" name="documento_text" hidden></textarea>
							<textarea id="img_text" name="img_text" hidden></textarea>
							<?php if (strpos($currentAgent, 'iphone') || strpos($currentAgent, 'apple') || strpos($currentAgent, 'ipad')) { ?>
							<?php } else { ?>
								<div class="form-text"><button id="photo-btn" class="btn btn-link p-0 m-0" style="font-size:14px;" type="button">Para tomar foto clic aquí <i class="bi bi-camera-fill"></i></button></div>
							<?php } ?>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="leer" class="form-label fw-bold input-required">¿Sabe leer?</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="leer" id="leer" value="S" required>
								<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="leer" id="leer" value="N" required>
								<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="escribir" class="form-label fw-bold input-required">¿Sabe escribir?</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="escribir" id="escribir" value="S" required>
								<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="escribir" id="escribir" value="N" required>
								<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</div>


						<div class="col-12">
							<hr>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="facebook" class="form-label fw-bold">Facebook</label>
							<div class="input-group">
								<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
								<input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="facebook_vanity" maxlength="200">
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="instagram" class="form-label fw-bold">Instagram</label>
							<div class="input-group">
								<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
								<input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="instagram_vanity" maxlength="200">
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="twitter" class="form-label fw-bold">Twitter</label>
							<div class="input-group">
								<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
								<input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="twitter_vanity" maxlength="200">
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12">
							<?php include('e_firma_canva.php') ?>
						</div>
						<div class="col-12 text-center items-center mt-2">
							<input class="form-check-input" type="checkbox" id="notificaciones_check" name="notificaciones_check" required>
							<label class="form-check-label fw-bold" for="notificaciones_check">
								Acepto y autorizo como medio de notificaciones: teléfono, correo electrónico y domicilio registrado.
							</label>
							<div class="invalid-feedback">
								Debes aceptar el envío de notificaciones para continuar.
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12 text-center">
							<p class="fw-bold">Haz completado la información, ahora da clic en "Validar mi información" para corroborarla y terminar tu registro.</p>
						</div>
					</div>
				</div>

				<div class="col-12 mt-5 text-center">
					<button class="btn btn-primary mb-3 d-none" id="prev-btn" type="button"> <i class="bi bi-caret-left-fill"></i> Anterior</button>
					<button class="btn btn-primary mb-3" id="next-btn" type="button"> Siguiente <i class="bi bi-caret-right-fill"></i> </button>
					<button class="btn btn-primary mb-3 d-none" type="submit" id="submit-btn"><i class="bi bi-check-circle-fill"></i> Validar mi información</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include('aviso_modal.php') ?>
<?php include('911_modal.php') ?>
<?php include('800_modal.php') ?>
<?php include('correo_obligatorio_modal.php') ?>
<?php include('take_photo_modal.php'); ?>
<?php include('information_validation_modal.php') ?>

<script>
	const steps = document.querySelectorAll('.step');
	const prevBtn = document.querySelector('#prev-btn');
	const nextBtn = document.querySelector('#next-btn');
	const submitBtn = document.querySelector('#submit-btn');
	const progress = document.querySelector('#progress-bar');
	var checkML = document.getElementById('checkML');

	let stepCount = steps.length - 1;
	let width = 100 / stepCount;
	let currentStep = 0;

	checkML.addEventListener('click', function() {
		if (checkML.checked) {
			document.getElementById('lblExterior').innerHTML = "Manzana";
			document.getElementById('lblInterior').innerHTML = "Lote";
			// document.getElementById('exterior').value = 'M.' + document.getElementById('exterior').value;
			// document.getElementById('interior').value = 'L.' + document.getElementById('interior').value;
		} else {
			document.getElementById('lblExterior').innerHTML = "Número exterior";
			document.getElementById('lblInterior').innerHTML = "Número interior";
			// document.getElementById('exterior').value = '';
			// document.getElementById('interior').value = '';
		}
	});



	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	chargeCurrentStep(currentStep);

	document.querySelector('#photo-btn').addEventListener('click', () => {
		initPhoto();
		$('#take_photo_modal').modal('show');
	});

	nextBtn.addEventListener('click', () => {
		if (validarStep(currentStep)) {
			currentStep++;
			let previousStep = currentStep - 1;
			if ((currentStep > 0) && (currentStep <= stepCount)) {
				prevBtn.classList.remove('d-none');
				prevBtn.classList.add('d-inline-block');
				steps[currentStep].classList.remove('d-none');
				steps[currentStep].classList.add('d-block');
				steps[previousStep].classList.remove('d-block');
				steps[previousStep].classList.add('d-none');
				if (currentStep === stepCount) {
					submitBtn.classList.remove('d-none');
					submitBtn.classList.add('d-inline-block');
					nextBtn.classList.remove('d-inline-block');
					nextBtn.classList.add('d-none');
				}
			}
			progress.style.width = `${currentStep*width}%`
			document.querySelector('#titulo').scrollIntoView();
		} else {
			submitBtn.click();
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'Debes llenar todos los campos requeridos para avanzar',
				confirmButtonColor: '#bf9b55',
			});
		}
	});

	prevBtn.addEventListener('click', () => {
		if (currentStep > 0) {
			currentStep--;
			let previousStep = currentStep + 1;
			prevBtn.classList.add('d-none');
			prevBtn.classList.add('d-inline-block');
			steps[currentStep].classList.remove('d-none');
			steps[currentStep].classList.add('d-block')
			steps[previousStep].classList.remove('d-block');
			steps[previousStep].classList.add('d-none');
			if (currentStep < stepCount) {
				submitBtn.classList.remove('d-inline-block');
				submitBtn.classList.add('d-none');
				nextBtn.classList.remove('d-none');
				nextBtn.classList.add('d-inline-block');
				prevBtn.classList.remove('d-none');
				prevBtn.classList.add('d-inline-block');
			}
		}

		if (currentStep === 0) {
			prevBtn.classList.remove('d-inline-block');
			prevBtn.classList.add('d-none');
		}
		progress.style.width = `${currentStep*width}%`
	});

	function chargeCurrentStep(num) {
		steps.forEach((step, index) => {
			if (num === index) {
				step.classList.remove('d-none');
			} else {
				step.classList.remove('d-block');
				step.classList.add('d-none');
			}
		})
		progress.style.width = `${currentStep*width}%`
	}

	function validarStep(step) {
		let regex = /\S+@\S+\.\S+/

		switch (step) {
			case 0:
				document.querySelector('#correo').blur();
				if (
					document.querySelector('#nombre').value != '' &&
					document.querySelector('#apellido_paterno').value != '' &&
					document.querySelector('#correo').value != '' &&
					regex.test(document.querySelector('#correo').value) &&
					document.querySelector('#fecha_nacimiento').value != '' &&
					document.querySelector('input[name="sexo"]:checked') &&
					document.querySelector('#telefono').value != ''
				) {
					return true;
				} else {
					return false;
				}
				break;
			case 1:
				if (
					document.querySelector('#estado_select_origen').value != '' &&
					document.querySelector('#municipio_select_origen').value != '' &&
					document.querySelector('#nacionalidad').value != '' &&
					document.querySelector('#idioma').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 2:
				if (
					document.querySelector('#pais_select').value != '' &&
					document.querySelector('#estado_select').value != '' &&
					document.querySelector('#municipio_select').value != '' &&
					document.querySelector('#localidad_select').value != '' &&
					document.querySelector('#colonia').value != '' &&
					document.querySelector('#calle').value != '' &&
					document.querySelector('#exterior').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 3:
				if (
					document.querySelector('#identificacion').value != '' &&
					document.querySelector('#e_civil').value != '' &&
					document.querySelector('#idioma').value != '' &&
					document.querySelector('#documento_text').value != '' &&
					document.querySelector('#escolaridad').value != '' &&
					document.querySelector('input[name="leer"]:checked') &&
					document.querySelector('input[name="escribir"]:checked')
				) {
					return true
				} else {
					return false
				}
				break;
			case 4:
				if (
					document.querySelector('#firma_url').value != '' &&
					document.querySelector('#notificaciones_check').checked
				) {
					return true
				} else {
					return false
				}
				break;
			default:
				return true;
				break;
		}
	}
</script>
<script>
	let input = document.querySelector("#telefono");
	let input2 = document.querySelector("#telefono2");
	let inputPais = document.querySelector("#codigo_pais");
	let inputPais2 = document.querySelector("#codigo_pais_2");

	let iti = window.intlTelInput(input, {
		separateDialCode: true,
		initialCountry: "MX",
	});
	let iti2 = window.intlTelInput(input2, {
		separateDialCode: true,
		initialCountry: "MX",
	});

	const getData = () => {
		inputPais.value = parseInt(iti.getSelectedCountryData().dialCode);
		inputPais2.value = parseInt(iti2.getSelectedCountryData().dialCode);
	};

	input.addEventListener('change', getData);
	input.addEventListener('keyup', getData);
	input.addEventListener('blur', getData);

	input2.addEventListener('change', getData);
	input2.addEventListener('keyup', getData);
	input2.addEventListener('blur', getData);
</script>
<script>
	$(document).ready(function() {
		$('#aviso_modal').modal('show');
	});

	document.querySelector('#aviso_modal').addEventListener('hidden.bs.modal', (event) => {
		$('#correo_obligatorio').modal('show');
	})

	function clearText(text) {
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
	}


	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		let form = document.querySelector('#form_register');

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			} else {
				event.preventDefault();
				enviar_datos();
				$('#information_validation').modal('show');
			}
			form.classList.add('was-validated')
		}, false)

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

		document.querySelector('#fecha_nacimiento').addEventListener('blur', (e) => {
			let fecha = e.target.value;
			let hoy = new Date();
			let cumpleanos = new Date(fecha);
			let edad = hoy.getFullYear() - cumpleanos.getFullYear();
			let m = hoy.getMonth() - cumpleanos.getMonth();

			if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
				edad--;
			}
			if (edad < 18) {
				Swal.fire({
					icon: 'warning',
					title: 'No podemos procesar tu solicitud',
					text: 'Para poder procesar tu solicitud debes ser mayor de edad.',
					confirmButtonColor: '#bf9b55',
				});

				e.target.value = '';
			}
		});


		document.querySelector('#ocupacion').addEventListener('change', (e) => {
			let select_ocupacion = document.querySelector('#ocupacion');
			let input_ocupacion = document.querySelector('#ocupacion_descr');

			if (e.target.value === '999') {
				select_ocupacion.classList.add('d-none');
				input_ocupacion.classList.remove('d-none');
				input_ocupacion.value = "";
				input_ocupacion.focus();
			} else {
				input_ocupacion.value = "";
			}
		});
		document.querySelector('#idioma').addEventListener('change', (e) => {
			let alert = document.querySelector('#idioma_alert');
			if (e.target.value !== '22') {
				alert.classList.remove('d-none')
			} else {
				alert.classList.add('d-none')
			}
		})

		document.querySelector('#nacionalidad').addEventListener('change', (e) => {
			let select_estado = document.querySelector('#estado_select_origen');
			let select_municipio = document.querySelector('#municipio_select_origen');

			clearSelect(select_municipio);

			if (e.target.value !== '82') {
				select_estado.value = '33';
				let data = {
					'estado_id': 33,
					'municipio_id': 1,
				}
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;
						municipios.forEach(municipio => {
							let option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
						select_municipio.value = '1';
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});

			} else {
				clearSelect(select_municipio);
				select_estado.value = '';
				select_municipio.value = '';
			}
		});

		document.querySelector('#estado_select_origen').addEventListener('change', (e) => {
			let select_municipio = document.querySelector('#municipio_select_origen');

			clearSelect(select_municipio);

			select_municipio.value = '';

			let data = {
				'estado_id': e.target.value,
			}

			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-municipios-by-estado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					let municipios = response.data;

					municipios.forEach(municipio => {
						var option = document.createElement("option");
						option.text = municipio.MUNICIPIODESCR;
						option.value = municipio.MUNICIPIOID;
						select_municipio.add(option);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		});

		document.querySelector('#pais_select').addEventListener('change', (e) => {

			let select_estado = document.querySelector('#estado_select');
			let select_municipio = document.querySelector('#municipio_select');
			let select_localidad = document.querySelector('#localidad_select');
			let select_colonia = document.querySelector('#colonia_select');

			let input_colonia = document.querySelector('#colonia');
			clearSelect(select_municipio);
			clearSelect(select_localidad);
			clearSelect(select_colonia);

			if (e.target.value !== 'MX') {

				select_estado.value = '33';

				let data = {
					'estado_id': 33,
					'municipio_id': 1,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;
						municipios.forEach(municipio => {
							let option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
						select_municipio.value = '1';
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let localidades = response.data;
						localidades.forEach(localidad => {
							let option = document.createElement("option");
							option.text = localidad.LOCALIDADDESCR;
							option.value = localidad.LOCALIDADID;
							select_localidad.add(option);
						});
						let option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';

						select_colonia.add(option);
						select_localidad.value = '1';

						select_colonia.value = '0';
						select_colonia.classList.add('d-none');
						input_colonia.classList.remove('d-none');
						input_colonia.value = 'EXTRANJERO';
						document.querySelector('#calle').focus();
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});

				let option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';

				select_colonia.add(option);

				select_colonia.value = '0';
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
				input_colonia.value = 'EXTRANJERO';


			} else {
				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_estado.value = '';
				select_municipio.value = '';
				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');
			}
		});

		document.querySelector('#estado_select').addEventListener('change', (e) => {
			let select_municipio = document.querySelector('#municipio_select');
			let select_localidad = document.querySelector('#localidad_select');
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			clearSelect(select_municipio);
			clearSelect(select_localidad);
			clearSelect(select_colonia);

			select_municipio.value = '';
			select_localidad.value = '';
			select_colonia.value = '';
			input_colonia.value = '';

			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');

			let data = {
				'estado_id': e.target.value,
			}

			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-municipios-by-estado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					let municipios = response.data;

					municipios.forEach(municipio => {
						var option = document.createElement("option");
						option.text = municipio.MUNICIPIODESCR;
						option.value = municipio.MUNICIPIOID;
						select_municipio.add(option);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
			if (e.target.value != 2) {
				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				select_colonia.add(option);
				select_colonia.value = '0';
				input_colonia.value = '';
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
				document.querySelector('#colonia-message').classList.add('d-none');
			} else {
				document.querySelector('#colonia-message').classList.remove('d-none');
			}
		});

		document.querySelector('#municipio_select').addEventListener('change', (e) => {
			let select_localidad = document.querySelector('#localidad_select');
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			let estado = document.querySelector('#estado_select').value;
			let municipio = e.target.value;

			clearSelect(select_localidad);
			clearSelect(select_colonia);

			select_localidad.value = '';

			let data = {
				'estado_id': estado,
				'municipio_id': municipio
			};

			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					let localidades = response.data;

					localidades.forEach(localidad => {
						var option = document.createElement("option");
						option.text = localidad.LOCALIDADDESCR;
						option.value = localidad.LOCALIDADID;
						select_localidad.add(option);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		});

		document.querySelector('#localidad_select').addEventListener('change', (e) => {
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			let estado = document.querySelector('#estado_select').value;
			let municipio = document.querySelector('#municipio_select').value;
			let localidad = e.target.value;

			clearSelect(select_colonia);
			select_colonia.value = '';

			let data = {
				'estado_id': estado,
				'municipio_id': municipio,
				'localidad_id': localidad
			};

			console.log(data);

			if (estado == 2) {
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');
				input_colonia.value = '';
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let colonias = response.data;

						colonias.forEach(colonia => {
							var option = document.createElement("option");
							option.text = colonia.COLONIADESCR;
							option.value = colonia.COLONIAID;
							select_colonia.add(option);
						});

						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						select_colonia.add(option);
					},
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});

			} else {
				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				select_colonia.add(option);
				select_colonia.value = '0';
				input_colonia.value = '';
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
			}
		});

		document.querySelector('#colonia_select').addEventListener('change', (e) => {
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			if (e.target.value === '0') {
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
				input_colonia.value = '';
				input_colonia.focus();
			} else {
				input_colonia.value = '-';
			}
		});

		document.querySelector('#documento').addEventListener('change', async (e) => {
			let documento_identidad = document.querySelector('#documento_text');

			let documento_identidad_modal = document.querySelector('#img_identificacion_modal');
			let preview = document.querySelector('#img_preview');

			if (e.target.files && e.target.files[0]) {
				if (e.target.files[0].type == "image/jpeg" || e.target.files[0].type == "image/png" || e.target.files[0].type == "image/jpg") {
					if (e.target.files[0].size > 2000000) {
						const blob = await comprimirImagen(e.target.files[0], 50);
						if (blob.size > 2000000) {
							e.target.value = '';
							documento_identidad.value = '';
							documento_identidad_modal.setAttribute('src', '');
							preview.classList.add('d-none');
							preview.setAttribute('src', '');
							Swal.fire({
								icon: 'error',
								text: 'No puedes subir un archivo mayor a 2 mb.',
								confirmButtonColor: '#bf9b55',
							});
							return;
						} else {
							const image = await blobToBase64(blob);
							console.log(image);
							documento_identidad.value = image;
							documento_identidad_modal.setAttribute('src', image);
							preview.classList.remove('d-none');
							preview.setAttribute('src', image);
						}
					} else {
						let reader = new FileReader();
						reader.onload = function(e) {
							documento_identidad.value = e.target.result;
							documento_identidad_modal.setAttribute('src', e.target.result);
							preview.classList.remove('d-none');
							preview.setAttribute('src', e.target.result);
						}
						reader.readAsDataURL(e.target.files[0]);
					}

				} else {
					if (e.target.files[0].size > 2000000) {
						e.target.value = '';
						documento_identidad.value = '';
						documento_identidad_modal.setAttribute('src', '');
						preview.classList.add('d-none');
						preview.setAttribute('src', '');
						Swal.fire({
							icon: 'error',
							text: 'No puedes subir un archivo mayor a 2 MB.',
							confirmButtonColor: '#bf9b55',
						});
						return;
					} else {
						let reader = new FileReader();
						reader.onload = function(e) {
							documento_identidad.value = e.target.result;
							documento_identidad_modal.setAttribute('src', e.target.result);
							preview.classList.remove('d-none');
							preview.setAttribute('src', e.target.result);
						}
						reader.readAsDataURL(e.target.files[0]);
					}
				}
			}
		});

		function blobToBase64(blob) {
			return new Promise((resolve, _) => {
				const reader = new FileReader();
				reader.onloadend = () => resolve(reader.result);
				reader.readAsDataURL(blob);
			});
		}

		function comprimirImagen(imagenComoArchivo, porcentajeCalidad) {
			return new Promise((resolve, reject) => {
				const $canvas = document.createElement("canvas");
				const imagen = new Image();
				imagen.onload = () => {
					$canvas.width = imagen.width;
					$canvas.height = imagen.height;
					$canvas.getContext("2d").drawImage(imagen, 0, 0);
					$canvas.toBlob(
						(blob) => {
							if (blob === null) {
								return reject(blob);
							} else {
								resolve(blob);
							}
						},
						"image/jpeg", porcentajeCalidad / 100
					);
				};
				imagen.src = URL.createObjectURL(imagenComoArchivo);
			});
		};

		document.querySelector('#correo').addEventListener('blur', (e) => {
			let regex = /\S+@\S+\.\S+/

			if (regex.test(e.target.value)) {
				$.ajax({
					data: {
						'email': e.target.value
					},
					url: "<?= base_url('/data/exist-email') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.exist === 1) {
							e.target.value = '';
							prevBtn.click();
							Swal.fire({
								icon: 'error',
								text: 'El correo ya se encuentra registrado, ingresa uno diferente.',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			};
		})

	})()

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});
</script>
<script>
	function enviar_datos() {
		let nombre = document.querySelector("#nombre").value ? document.querySelector("#nombre").value : '';
		let apellido1 = document.querySelector("#apellido_paterno").value ? document.querySelector("#apellido_paterno").value : '';
		let apellido2 = document.querySelector("#apellido_materno").value ? document.querySelector("#apellido_materno").value : '';
		let fechanac = document.querySelector("#fecha_nacimiento").value ? document.querySelector("#fecha_nacimiento").value : '';
		let sexo = document.querySelector('input[name="sexo"]:checked').value ? document.querySelector('input[name="sexo"]:checked').value : '';

		let correo = document.querySelector("#correo").value ? document.querySelector("#correo").value : '';
		let telefono = document.querySelector("#telefono").value ? document.querySelector("#telefono").value : '';
		let telefono2 = document.querySelector("#telefono2").value ? document.querySelector("#telefono2").value : '';
		let codigo_pais = document.querySelector("#codigo_pais").value ? document.querySelector("#codigo_pais").value : '';
		let codigo_pais_2 = document.querySelector("#codigo_pais_2").value ? document.querySelector("#codigo_pais_2").value : '';

		let nacionalidad = document.querySelector("#nacionalidad").value ? document.querySelector("#nacionalidad").options[document.querySelector("#nacionalidad").selectedIndex].text : '';
		let idioma = document.querySelector("#idioma").value ? document.querySelector("#idioma").options[document.querySelector("#idioma").selectedIndex].text : '';
		let estado_origen = document.querySelector("#estado_select_origen").value ? document.querySelector("#estado_select_origen").options[document.querySelector("#estado_select_origen").selectedIndex].text : '';
		let municipio_origen = document.querySelector("#municipio_select_origen").value ? document.querySelector("#municipio_select_origen").options[document.querySelector("#municipio_select_origen").selectedIndex].text : '';

		let codigop = document.querySelector("#cp").value ? document.querySelector("#cp").value : '';
		let pais = document.querySelector("#pais_select").value ? document.querySelector("#pais_select").value : '';
		let estado = document.querySelector("#estado_select").value ? document.querySelector("#estado_select").options[document.querySelector("#estado_select").selectedIndex].text : '';
		let municipio = document.querySelector("#municipio_select").value ? document.querySelector("#municipio_select").options[document.querySelector("#municipio_select").selectedIndex].text : '';
		let localidad = document.querySelector("#localidad_select").value ? document.querySelector("#localidad_select").options[document.querySelector("#localidad_select").selectedIndex].text : '';
		let colonia = document.querySelector("#colonia_select").value == 0 || document.querySelector("#colonia_select").value == '' ? document.querySelector("#colonia").value : document.querySelector("#colonia_select").options[document.querySelector("#colonia_select").selectedIndex].text;
		let calle = document.querySelector("#calle").value ? document.querySelector("#calle").value : '';
		let nexterior = document.querySelector("#exterior").value ? document.querySelector("#exterior").value : '';
		let ninterior = document.querySelector("#interior").value ? document.querySelector("#interior").value : '';

		let tipo = document.querySelector("#identificacion").value ? document.querySelector("#identificacion").value : '';
		let numeroid = document.querySelector("#numero_ide").value ? document.querySelector("#numero_ide").value : '';
		let edoc = document.querySelector("#e_civil").value ? document.querySelector("#e_civil").value : '';
		let ocupacion = document.querySelector("#ocupacion").value ? document.querySelector("#ocupacion").options[document.querySelector("#ocupacion").selectedIndex].text : '';
		let ocupacion_descr = document.querySelector("#ocupacion_descr").value ? document.querySelector("#ocupacion_descr").value : '';
		let escolaridad = document.querySelector("#escolaridad").value ? document.querySelector("#escolaridad").options[document.querySelector("#escolaridad").selectedIndex].text : '';
		let discapacidad = document.querySelector("#discapacidad").value ? document.querySelector("#discapacidad").value : '';
		let firma_url = document.querySelector("#firma_url").value ? document.querySelector("#firma_url").value : '';

		let leer = document.querySelector('input[name="leer"]:checked').value ? document.querySelector('input[name="leer"]:checked').value : '';
		let escribir = document.querySelector('input[name="escribir"]:checked').value ? document.querySelector('input[name="escribir"]:checked').value : '';

		let facebook = document.querySelector("#facebook").value ? document.querySelector("#facebook").value : '';
		let instagram = document.querySelector("#instagram").value ? document.querySelector("#instagram").value : '';
		let twitter = document.querySelector("#twitter").value ? document.querySelector("#twitter").value : '';

		document.querySelector('#nombre_modal').value = nombre;
		document.querySelector('#apellido_paterno_modal').value = apellido1;
		document.querySelector('#apellido_materno_modal').value = apellido2;
		document.querySelector('#correo_modal').value = correo;
		document.querySelector('#fecha_nacimiento_modal').value = dateToString(fechanac);
		document.querySelector('#nacionalidad_modal').value = nacionalidad;
		document.querySelector('#escolaridad_modal').value = escolaridad;
		document.querySelector('#sexo_modal').value = sexo == 'F' ? 'FEMENINO' : 'MASCULINO';

		document.querySelector('#estado_origen_modal').value = estado_origen;
		document.querySelector('#municipio_origen_modal').value = municipio_origen;

		document.querySelector('#cp_modal').value = codigop;
		document.querySelector('#pais_modal').value = pais;
		document.querySelector('#estado_modal').value = estado;
		document.querySelector('#municipio_modal').value = municipio;
		document.querySelector('#localidad_modal').value = localidad;
		document.querySelector('#colonia_modal').value = colonia;
		document.querySelector('#calle_modal').value = calle;
		document.querySelector('#exterior_modal').value = nexterior;
		document.querySelector('#interior_modal').value = ninterior;
		document.querySelector('#telefono_modal').value = telefono;
		document.querySelector('#telefono2_modal').value = telefono2;

		document.querySelector('#facebook_modal').value = facebook;
		document.querySelector('#instagram_modal').value = instagram;
		document.querySelector('#twitter_modal').value = twitter;

		document.querySelector('#leer_modal').value = leer == 'S' ? 'SI' : 'NO';
		document.querySelector('#escribir_modal').value = escribir == 'S' ? 'SI' : 'NO';

		document.querySelector('#identificacion_modal').value = tipo;
		document.querySelector('#numero_ide_modal').value = numeroid;
		document.querySelector('#e_civil_modal').value = edoc;
		document.querySelector('#ocupacion_modal').value = ocupacion == 'OTRA' ? ocupacion_descr : ocupacion;
		document.querySelector('#discapacidad_modal').value = discapacidad;
		document.querySelector('#idioma_modal').value = idioma;
		document.querySelector('#img_firma_modal').setAttribute("src", firma_url);
	}

	function dateToString(fecha) {
		let date = new Date(fecha);
		let dateToTijuanaString = date.toLocaleString('en-US', {
			timeZone: 'America/Tijuana'
		});
		let dateTijuana = new Date(dateToTijuanaString);
		dateTijuana.setDate(dateTijuana.getDate() + 1);
		var options = {
			year: 'numeric',
			month: 'long',
			day: 'numeric'
		};

		return (dateTijuana.toLocaleDateString("es-ES", options)).toUpperCase();
	}
</script>

<script>
	const $video = document.querySelector("#video");
	const $canvas = document.querySelector("#canvas");
	const $btn_take_photo = document.querySelector("#btn-photo");
	const $estado = document.querySelector("#estado");
	const $listaDeDispositivos = document.querySelector("#listaDeDispositivos");
	const take_photo_modal = document.getElementById('take_photo_modal');

	function tieneSoporteUserMedia() {
		return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
	}

	function _getUserMedia() {
		return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
	}

	function stopVideoOnly(stream) {
		stream.getTracks().forEach(function(track) {
			if (track.readyState == 'live' && track.kind === 'video') {
				track.stop();
			}
		});
	}

	const llenarSelectConDispositivosDisponibles = () => {
		navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
			const dispositivosDeVideo = [];
			dispositivos.forEach(function(dispositivo) {
				const tipo = dispositivo.kind;
				if (tipo === "videoinput") {
					dispositivosDeVideo.push(dispositivo);
				}
			});

			if (dispositivosDeVideo.length > 0) {
				dispositivosDeVideo.forEach(dispositivo => {
					const option = document.createElement('option');
					option.value = dispositivo.deviceId;
					option.text = dispositivo.label;
					$listaDeDispositivos.appendChild(option);
				});
			}
		});
	}

	function initPhoto() {
		var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
			navigator.userAgent &&
			navigator.userAgent.indexOf('CriOS') == -1 &&
			navigator.userAgent.indexOf('FxiOS') == -1;


		if (!tieneSoporteUserMedia()) {
			alert("Tu navegador no soporta esta característica");
			$estado.innerHTML = "Tu navegador no soporta este funcionamiento. Sube una foto desde tu dispositivo.";
			return;
		}
		let stream;

		if (!isSafari) {
			navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
				const dispositivosDeVideo = [];

				dispositivos.forEach(function(dispositivo) {
					const tipo = dispositivo.kind;
					if (tipo === "videoinput") {
						dispositivosDeVideo.push(dispositivo);
					}
				});

				if (dispositivosDeVideo.length > 0) {
					mostrarStream(dispositivosDeVideo[0].deviceId);
				}
			});

			const mostrarStream = idDeDispositivo => {
				_getUserMedia({
						video: {
							deviceId: idDeDispositivo,
						}
					},
					function(streamObtenido) {
						$estado.classList.add('d-none');
						llenarSelectConDispositivosDisponibles();

						$listaDeDispositivos.onchange = () => {
							if (stream) {
								stream.getTracks().forEach(function(track) {
									track.stop();
								});
							}
							mostrarStream($listaDeDispositivos.value);
						}

						stream = streamObtenido;

						$video.srcObject = stream;
						$video.play();

						$btn_take_photo.addEventListener("click", function(e) {

							$video.pause();

							let contexto = $canvas.getContext("2d");
							$canvas.width = $video.videoWidth;
							$canvas.height = $video.videoHeight;
							contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

							let foto = $canvas.toDataURL('image/jpeg', 1.0);

							let documento = document.querySelector('#documento');
							let documento_identidad = document.querySelector('#documento_text');
							let documento_identidad_modal = document.querySelector('#img_identificacion_modal');
							let preview = document.querySelector('#img_preview');

							documento.removeAttribute('required');
							documento.value = '';
							documento_identidad.value = foto;
							documento_identidad_modal.setAttribute('src', foto);
							preview.classList.remove('d-none');
							preview.setAttribute('src', foto);

							$video.play();

							let modal = bootstrap.Modal.getInstance(document.querySelector('#take_photo_modal'));

							stopVideoOnly(stream);
							modal.hide();
						});

						take_photo_modal.addEventListener('hidden.bs.modal', function(event) {
							stopVideoOnly(stream);
						})
					},
					function(error) {
						console.log("Permiso denegado o error: ", error);
						$estado.classList.remove('d-none');
					});
			}
		} else {
			const mostrarStream = (idDeDispositivo = null) => {
				let options = {
					video: true,
					deviceId: idDeDispositivo
				}
				idDeDispositivo = null ? delete options.deviceId : idDeDispositivo;
				navigator.mediaDevices.getUserMedia(options).then(function(streamObtenido) {

					navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
						const dispositivosDeVideo = [];
						dispositivos.forEach(function(dispositivo) {
							const tipo = dispositivo.kind;
							if (tipo === "videoinput") {
								dispositivosDeVideo.push(dispositivo);
							}
						});
						llenarSelectConDispositivosDisponibles();

						$listaDeDispositivos.onchange = () => {
							console.log('Cambiando dispositivo');
							if (stream) {
								stream.getTracks().forEach(function(track) {
									track.stop();
								});
							}
							mostrarStream($listaDeDispositivos.value);
						}

						if (dispositivosDeVideo.length > 0) {
							$estado.classList.add('d-none');

							stream = streamObtenido;

							$video.srcObject = stream;
							$video.play();

							$btn_take_photo.addEventListener("click", function(e) {

								$video.pause();

								let contexto = $canvas.getContext("2d");
								$canvas.width = $video.videoWidth;
								$canvas.height = $video.videoHeight;
								contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

								let foto = $canvas.toDataURL('image/jpeg', 1.0);

								let documento = document.querySelector('#documento');
								let documento_identidad = document.querySelector('#documento_text');
								let documento_identidad_modal = document.querySelector('#img_identificacion_modal');
								let preview = document.querySelector('#img_preview');

								documento.removeAttribute('required');
								documento.value = '';
								documento_identidad.value = foto;
								documento_identidad_modal.setAttribute('src', foto);
								preview.classList.remove('d-none');
								preview.setAttribute('src', foto);

								$video.play();

								let modal = bootstrap.Modal.getInstance(document.querySelector('#take_photo_modal'));

								stopVideoOnly(stream);
								modal.hide();
							});

							take_photo_modal.addEventListener('hidden.bs.modal', function(event) {
								stopVideoOnly(stream);
							})
						}
					});
				}).catch(function(err) {
					console.log("Permiso denegado o error: ", error);
					$estado.classList.remove('d-none');
				});
			}

			mostrarStream();
		}
	};
</script>
<!-- <script>
	let texto_imagen = document.querySelector('#img_text');
	let preview = document.querySelector('#img_preview');

	fetch(preview.src)
		.then((res) => res.blob())
		.then((blob) => {
			const reader = new FileReader();
			reader.onloadend = () => {
				const base64 = getBase64StringFromDataURL(reader.result);
				texto_imagen.value = base64;
			};
			reader.readAsDataURL(blob);
		});
</script> -->
<?= $this->endSection() ?>
