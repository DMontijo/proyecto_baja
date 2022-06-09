<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container m-auto">
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
						<li>Abuso de autoridad en contra del personal adacrito</li>
						<li>Homicidio en todas sus modalidades</li>
						<li>Delitos contra la salud modalidad narcomenudeo</li>
						<li>Abuso sexual cuando la victima sea menor de edad</li>
						<li>Tráfico de menores</li>
					</ul>
				</div>
				<div class="col-lg-5 col-12 d-flex flex-column justify-content-between text-center">
					<a class="p-0 my-3" href="tel:911" role="button"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
					<a class="p-0 my-3" href="tel:089" role="button" role="button"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow py-4 px-3 border-0">
		<div class="card-body">
			<h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">DATOS DEL DENUNCIANTE</h1>
			<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

			<div class="progress">
				<div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
			</div>

			<form id="form_register" name="form_register" class="row g-3 needs-validation py-5" action="<?= base_url() ?>/denuncia/denunciante" method="POST" enctype="multipart/form-data" novalidate>
				<div class="col-12 step">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
							<input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" required autofocus>
							<div class="invalid-feedback">
								El nombre es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
							<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="100" required>
							<div class="invalid-feedback">
								El apellido paterno es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
							<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="100">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
							<input type="email" class="form-control" id="correo" name="correo" maxlength="100" required>
							<div class="invalid-feedback">
								El correo esta erroneo
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
							<div class="invalid-feedback">
								La fecha de nacimiento es obligatoria
							</div>
						</div>
						<input class="form-control" id="edad" name="edad" maxlength="3" type="text" hidden required>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" value="HOMBRE" checked required>
								<label class="form-check-label" for="flexRadioDefault1">HOMBRE</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" value="MUJER" required>
								<label class="form-check-label" for="flexRadioDefault2">MUJER</label>
							</div>
						</div>
						<div class="col-12">
							<div class="alert alert-warning text-center fw-bold d-none" id="menor" role="alert">
								Eres menor de edad.<br>
								Para continuar es preferente que estes acompañado por un adulto.
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="cp" class="form-label fw-bold">Código postal</label>
							<input type="number" class="form-control" id="cp" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="cp" autofocus>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="pais_select" class="form-label fw-bold input-required">País del denunciante</label>
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
							<label for="estado_select" class="form-label fw-bold input-required">Estado del denunciante</label>
							<select class="form-select" id="estado_select" name="estado_select" required>
								<option selected disabled value="">Seleccione el estado</option>
								<?php foreach ($body_data->estados as $index => $estado) { ?>
									<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El estado es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="municipio" class="form-label fw-bold input-required">Municipio del denunciante</label>
							<select class="form-select" id="municipio_select" name="municipio_select" required>
								<option selected disabled value="">Seleccione el municipio</option>
							</select>
							<div class="invalid-feedback">
								El municipio es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="localidad" class="form-label fw-bold">Localidad del denunciante</label>
							<select class="form-select" id="localidad_select" name="localidad_select">
								<option selected disabled value="">Seleccione la localidad</option>
							</select>
						</div>


						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="colonia" class="form-label fw-bold input-required">Colonia del denunciante</label>
							<select class="form-select" id="colonia_select" name="colonia_select" required>
								<option selected disabled value="">Seleccione la colonia</option>
							</select>
							<input type="text" class="form-control d-none" id="colonia" name="colonia" maxlength="100" required>
							<div class="invalid-feedback">
								La colonia es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="calle" class="form-label fw-bold input-required">Calle del denunciante</label>
							<input type="text" class="form-control" id="calle" name="calle" maxlength="100" required>
							<div class="invalid-feedback">
								La calle es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="exterior" class="form-label fw-bold input-required">Número exterior</label>
							<input type="text" class="form-control" id="exterior" name="exterior" maxlength="10" required>
							<div class="invalid-feedback">
								El número exterior es obligatorio
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="interior" class="form-label fw-bold">Número interior</label>
							<input type="text" class="form-control" id="interior" name="interior" maxlength="10">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="telefono" class="form-label fw-bold input-required">Número de télefono</label>
							<input type="number" class="form-control" id="telefono" name="telefono" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
							<div class="invalid-feedback">
								El número télefono es obligatorio
							</div>
							<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required hidden>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="telefono2" class="form-label fw-bold">Número de télefono 2 (opcional)</label>
							<input type="number" class="form-control" id="telefono2" name="telefono2" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
							<input type="number" id="codigo_pais_2" name="codigo_pais_2" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" hidden>
						</div>

					</div>
				</div>

				<div class="col-12 d-none step">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="identificacion" class="form-label fw-bold input-required">Identificación</label>
							<select class="form-select" id="identificacion" name="identificacion" required>
								<option selected disabled value="">Seleccione la identificación</option>
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
								<option selected disabled value="">Seleccione su estado civil</option>
								<?php foreach ($body_data->edoCiviles as $index => $edo) { ?>
									<option value="<?= $edo->PERSONAESTADOCIVILID ?>"> <?= $edo->PERSONAESTADOCIVILDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								El estado civil es obligatorio.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="ocupacion" class="form-label fw-bold">Ocupación</label>
							<input type="text" class="form-control" id="ocupacion" name="ocupacion" maxlength="100">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="iden_genero" class="form-label fw-bold">Identidad de género</label>
							<input type="text" class="form-control" id="iden_genero" name="iden_genero" maxlength="50">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="discapacidad" class="form-label fw-bold input-required">¿Padece alguna
								discapacidad?</label>
							<select class="form-select" id="discapacidad" name="discapacidad" required>
								<option selected disabled value="">Seleccione si padece alguna discapacidad</option>
								<option value="VISUAL">VISUAL</option>
								<option value="FISICA">FISICA</option>
								<option value="AUDITIVA">AUDITIVA</option>
								<option vaulue="NINGUNA">NINGUNA</option>
							</select>
							<div class="invalid-feedback">
								El campo discapacidad es obligatorio.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nacionalidad" class="form-label fw-bold input-required">Nacionalidad</label>
							<select class="form-select" id="nacionalidad" name="nacionalidad" required>
								<option selected disabled value="">Seleccione la nacionalidad</option>
								<?php foreach ($body_data->nacionalidades as $index => $nac) { ?>
									<option value="<?= $nac->PERSONANACIONALIDADID ?>"> <?= $nac->PERSONANACIONALIDADDESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								La nacionalidad es obligatoria.
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="escolaridad" class="form-label fw-bold input-required">Escolaridad</label>
							<select class="form-select" id="escolaridad" name="escolaridad" required>
								<option selected disabled value="">Seleccione la escolaridad</option>
								<option value="NINGUNA">NINGUNA</option>
								<option value="PRIMARIA">PRIMARIA</option>
								<option value="SECUNDARIA">SECUNDARIA</option>
								<option value="BACHILLERATO">BACHILLERATO</option>
								<option value="LICENCIATURA">LICENCIATURA</option>
								<option value="MAESTRIA">MAESTRÍA</option>
								<option value="DOCTORADO">DOCTORADO</option>
							</select>
							<div class="invalid-feedback">
								La escolaridad es obligatoria
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="idioma" class="form-label fw-bold input-required">Idioma</label>
							<select class="form-select" id="idioma" name="idioma" required>
								<option selected disabled value="">Seleccione el idioma</option>
								<?php foreach ($body_data->idiomas as $index => $nac) { ?>
									<option value="<?= $nac->PERSONAIDIOMAID ?>"> <?= $nac->PERSONAIDIOMADESCR ?> </option>
								<?php } ?>
							</select>
							<div class="invalid-feedback">
								Debes elegir un idioma
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="documento" class="form-label fw-bold input-required">Foto de identificación</label>
							<img class="img-fluid d-none py-2" src="" id="img_preview">
							<!-- <input class="form-control" type="file" id="documento" name="documento" accept="image/*" capture="user" required> -->
							<input class="form-control" type="file" id="documento" name="documento" accept="image/*" required>
							<textarea id="documento_text" name="documento_text" hidden required></textarea>
							<div class="form-text"><button id="photo-btn" class="btn btn-link p-0 m-0" style="font-size:14px;" type="button">Para tomar foto clic aquí <i class="bi bi-camera-fill"></i></button></div>
						</div>
						<div class="col-12">
							<div class="alert alert-warning text-center fw-bold d-none mt-2" id="idioma_alert" role="alert">
								Si tu idioma no es español se recomienda estar acompañado de un traductor.
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
								Acepto envío de notificaciones por teléfono, correo y a mi domicilio.
							</label>
							<div class="invalid-feedback">
								Debes aceptar el envío de notificaciones para continuar
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
<?php include('take_photo_modal.php'); ?>
<?php include('information_validation_modal.php') ?>

<script>
	const steps = document.querySelectorAll('.step');
	const prevBtn = document.querySelector('#prev-btn');
	const nextBtn = document.querySelector('#next-btn');
	const submitBtn = document.querySelector('#submit-btn');
	const progress = document.querySelector('#progress-bar');
	let stepCount = steps.length - 1;
	let width = 100 / stepCount;
	let currentStep = 0;

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
		switch (step) {
			case 0:
				if (
					document.querySelector('#nombre').value != '' &&
					document.querySelector('#apellido_paterno').value != '' &&
					document.querySelector('#correo').value != '' &&
					document.querySelector('#fecha_nacimiento').value != ''
				) {
					return true
				} else {
					return false;
				}
				break;
			case 1:
				if (
					document.querySelector('#pais_select').value != '' &&
					document.querySelector('#estado_select').value != '' &&
					document.querySelector('#municipio_select').value != '' &&
					document.querySelector('#colonia').value != '' &&
					document.querySelector('#calle').value != '' &&
					document.querySelector('#exterior').value != '' &&
					document.querySelector('#telefono').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 2:
				if (
					document.querySelector('#identificacion').value != '' &&
					document.querySelector('#e_civil').value != '' &&
					document.querySelector('#discapacidad').value != '' &&
					document.querySelector('#idioma').value != '' &&
					document.querySelector('#documento').value != '' &&
					document.querySelector('#nacionalidad').value != '' &&
					document.querySelector('#escolaridad').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 3:
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
		$('#aviso_modal').modal('toggle')
	});

	function clearText(text) {
		text
			.normalize('NFD')
			.replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize();
		return text.replaceAll('´', '');
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

		document.querySelector('#fecha_nacimiento').addEventListener('change', (e) => {
			let fecha = e.target.value;
			let hoy = new Date();
			let cumpleanos = new Date(fecha);
			let edad = hoy.getFullYear() - cumpleanos.getFullYear();
			let m = hoy.getMonth() - cumpleanos.getMonth();

			if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
				edad--;
			}
			document.querySelector('#edad').value = edad;
			if (edad < 18) {
				document.getElementById("menor").classList.remove('d-none');
			} else {
				document.getElementById("menor").classList.add('d-none');
			}
		})

		document.querySelector('#idioma').addEventListener('change', (e) => {
			let alert = document.querySelector('#idioma_alert');
			if (e.target.value !== '22') {
				alert.classList.remove('d-none')
			} else {
				alert.classList.add('d-none')
			}
		})

		document.querySelector('#pais_select').addEventListener('change', (e) => {

			let select_estado = document.querySelector('#estado_select');
			let select_municipio = document.querySelector('#municipio_select');
			let select_localidad = document.querySelector('#localidad_select');
			let select_colonia = document.querySelector('#colonia_select');

			let input_colonia = document.querySelector('#colonia');

			if (e.target.value !== 'MX') {

				select_estado.value = '33';
				select_estado.setAttribute('disabled', true);

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
							option.value = municipio.ID;
							select_municipio.add(option);
						});
						select_municipio.value = '33001';
						select_municipio.setAttribute('disabled', true);
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
							option.value = localidad.ID;
							select_localidad.add(option);
						});
						let option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';

						select_colonia.add(option);
						select_localidad.value = '33001001';
						select_localidad.setAttribute('disabled', true);

						select_colonia.value = '0';
						select_colonia.classList.add('d-none');
						input_colonia.classList.remove('d-none');
						input_colonia.value = 'EXTRANJERO';
						input_colonia.setAttribute('disabled', true);
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});


			} else {
				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_estado.value = '';
				select_estado.removeAttribute('disabled');

				select_municipio.value = '';
				select_municipio.removeAttribute('disabled');

				select_localidad.value = '';
				select_localidad.removeAttribute('disabled');

				select_colonia.value = '';
				select_colonia.removeAttribute('disabled');
				select_colonia.classList.remove('d-none');
				input_colonia.removeAttribute('disabled');
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
						option.value = municipio.ID;
						select_municipio.add(option);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		});

		document.querySelector('#municipio_select').addEventListener('change', (e) => {
			let select_localidad = document.querySelector('#localidad_select');
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			let estado = parseInt(Number(e.target.value) / 1000);
			let municipio = (Number(e.target.value) - estado * 1000);

			clearSelect(select_localidad);
			clearSelect(select_colonia);

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
						option.value = localidad.ID;
						select_localidad.add(option);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

			if (estado === 2) {
				select_colonia.classList.remove('d-none');
				colonia.classList.add('d-none');
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-colonias-by-estado-and-municipio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let colonias = response.data;

						colonias.forEach(colonia => {
							var option = document.createElement("option");
							option.text = colonia.COLONIADESCR;
							option.value = colonia.ID;
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
				select_colonia.classList.add('d-none');
				colonia.classList.remove('d-none');
			}

		});

		document.querySelector('#colonia_select').addEventListener('change', (e) => {
			let select_colonia = document.querySelector('#colonia_select');
			let input_colonia = document.querySelector('#colonia');

			if (e.target.value === '0') {
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
				input_colonia.focus();
			} else {
				input_colonia.value = e.target.value;
			}
		});

		document.querySelector('#documento').addEventListener('change', (e) => {
			console.log('change');
			let documento_identidad = document.querySelector('#documento_text');
			let documento_identidad_modal = document.querySelector('#img_identificacion_modal');
			let preview = document.querySelector('#img_preview');

			if (e.target.files && e.target.files[0]) {
				console.log('change');
				let reader = new FileReader();
				reader.onload = function(e) {
					documento_identidad.value = e.target.result;
					documento_identidad_modal.setAttribute('src', e.target.result);
					preview.classList.remove('d-none');
					preview.setAttribute('src', e.target.result);
					console.log(preview);
				}
				reader.readAsDataURL(e.target.files[0]);
			}

		});

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
							Swal.fire({
								icon: 'error',
								text: 'El correo ya se encuentra registrado, ingresa uno diferente.',
								confirmButtonColor: '#bf9b55',
							}).then(() => {
								e.target.value = '';
							})
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}
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
		let correo = document.querySelector("#correo").value ? document.querySelector("#correo").value : '';
		let fechanac = document.querySelector("#fecha_nacimiento").value ? document.querySelector("#fecha_nacimiento").value : '';
		let edad = document.querySelector("#edad").value ? document.querySelector("#edad").value : '';
		let sexo = document.querySelector('input[name="sexo"]:checked').value ? document.querySelector('input[name="sexo"]:checked').value : '';

		let codigop = document.querySelector("#cp").value ? document.querySelector("#cp").value : '';
		let pais = document.querySelector("#pais_select").value ? document.querySelector("#pais_select").value : '';
		let estado = document.querySelector("#estado_select").value ? document.querySelector("#estado_select").value : '';
		let municipio = document.querySelector("#municipio_select").value ? document.querySelector("#municipio_select").value : '';
		let localidad = document.querySelector("#localidad_select").value ? document.querySelector("#localidad_select").value : '';
		let colonia = document.querySelector("#colonia").value ? document.querySelector("#colonia").value : '';
		let calle = document.querySelector("#calle").value ? document.querySelector("#calle").value : '';
		let nexterior = document.querySelector("#exterior").value ? document.querySelector("#exterior").value : '';
		let ninterior = document.querySelector("#interior").value ? document.querySelector("#interior").value : '';
		let telefono = document.querySelector("#telefono").value ? document.querySelector("#telefono").value : '';
		let telefono2 = document.querySelector("#telefono2").value ? document.querySelector("#telefono2").value : '';
		let codigo_pais = document.querySelector("#codigo_pais").value ? document.querySelector("#codigo_pais").value : '';
		let codigo_pais_2 = document.querySelector("#codigo_pais_2").value ? document.querySelector("#codigo_pais_2").value : '';

		let tipo = document.querySelector("#identificacion").value ? document.querySelector("#identificacion").value : '';
		let numeroid = document.querySelector("#numero_ide").value ? document.querySelector("#numero_ide").value : '';
		let edoc = document.querySelector("#e_civil").value ? document.querySelector("#e_civil").value : '';
		let nacionalidad = document.querySelector("#nacionalidad").value ? document.querySelector("#nacionalidad").value : '';
		let escolaridad = document.querySelector("#escolaridad").value ? document.querySelector("#escolaridad").value : '';
		let ocupacion = document.querySelector("#ocupacion").value ? document.querySelector("#ocupacion").value : '';
		let genero = document.querySelector("#iden_genero").value ? document.querySelector("#iden_genero").value : '';
		let discapacidad = document.querySelector("#discapacidad").value ? document.querySelector("#discapacidad").value : '';
		let idioma = document.querySelector("#idioma").value ? document.querySelector("#idioma").value : '';
		let firma_url = document.querySelector("#firma_url").value ? document.querySelector("#firma_url").value : '';

		document.querySelector('#nombre_modal').value = nombre;
		document.querySelector('#apellido_paterno_modal').value = apellido1;
		document.querySelector('#apellido_materno_modal').value = apellido2;
		document.querySelector('#correo_modal').value = correo;
		document.querySelector('#fecha_nacimiento_modal').value = fechanac;
		document.querySelector('#edad_modal').value = edad;
		document.querySelector('#nacionalidad_modal').value = nacionalidad;
		document.querySelector('#escolaridad_modal').value = escolaridad;
		document.querySelector('#sexo_modal').value = sexo;

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

		document.querySelector('#identificacion_modal').value = tipo;
		document.querySelector('#numero_ide_modal').value = numeroid;
		document.querySelector('#e_civil_modal').value = edoc;
		document.querySelector('#ocupacion_modal').value = ocupacion;
		document.querySelector('#discapacidad_modal').value = discapacidad;
		document.querySelector('#iden_genero_modal').value = genero;
		document.querySelector('#idioma_modal').value = idioma;
		document.querySelector('#img_firma_modal').setAttribute("src", firma_url);
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
		if (!tieneSoporteUserMedia()) {
			alert("Tu navegador no soporta esta característica");
			$estado.innerHTML = "Tu navegador no soporta este funcionamiento. Sube una foto desde tu dispositivo.";
			return;
		}
		let stream;

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

						let foto = $canvas.toDataURL();

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
	};
</script>
<?= $this->endSection() ?>
