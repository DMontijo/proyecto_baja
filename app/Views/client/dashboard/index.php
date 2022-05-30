<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-12">
		<div class="card rounded bg-yellow shadow text-center mb-4">
			<img src="<?= base_url() ?>/assets/img/banner.png" width="100%" height="100%" alt="" />
		</div>
		<div class="card rounded shadow">
			<div class="card-body p-0 py-3 p-sm-5">
				<div class="container">
					<h1 class="text-center fw-bolder pb-1 text-blue">DENUNCIA</h1>
					<p class="text-center fw-bold text-blue ">Llena los campos siguientes para continuar tu denuncia</p>
					<p class="text-center pb-3">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

					<div class="progress mb-4">
						<div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
					</div>

					<form action="<?= base_url() ?>/denuncia/dashboard/video-denuncia" class="row needs-validation" novalidate>

						<!-- PREGUNTAS INICIALES -->
						<div id="datos_iniciales" class="col-12 step">
							<?php include('form_preguntas_iniciales.php') ?>
						</div>

						<!-- DATOS DELITO -->
						<div id="datos_delito" class="col-12 d-none step">
							<?php include('form_delito.php') ?>
						</div>

						<!-- DATOS POSIBLE RESPONSABLE -->
						<div id="datos_imputado" class="col-12 d-none step">
							<?php include('form_imputado.php') ?>
						</div>

						<!-- DATOS DEL ADULTO -->
						<div id="datos_adulto" class="col-12 d-none step">
							<?php include('form_datos_adulto.php') ?>
						</div>

						<!-- DATOS MENOR -->
						<div id="datos_menor" class="col-12 d-none step">
							<?php include('form_datos_menor.php') ?>
						</div>

						<!-- DATOS DESAPARECIDO -->
						<div id="datos_desaparecido" class="col-12 d-none step">
							<?php include('form_persona_desaparecida.php') ?>
						</div>

						<!-- DATOS VEHICULO ROBADO -->
						<div id="datos_robo_vehiculo" class="col-12 d-none step">
							<?php include('form_robo_vehiculo.php') ?>
						</div>

						<!-- PASO FINAL -->
						<div id="paso_final" class="col-12 step d-none step">
							<div class="row">
								<div class="col-12 text-center">
									<p class="fw-bold">Haz completado la información</p>
									<p class="text-center">
										<i class="bi bi-exclamation-triangle"> Es muy importante que antes de iniciar tu video denuncia aceptes los derechos de víctima u ofendido.</i>
										<br>
										Para consultar la constancia de Derechos, da clic <a target="_blank" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">aquí</a>
										<br><br>
									</p>
									<div class="form-group">
										<input class="form-check-input" type="checkbox" name="derechos_imputado" id="derechos_imputado" required>
										<span class="fw-bold">Aceptar derechos de víctima u ofendido</span>
										<div class="invalid-feedback">
											Debes aceptar los derechos de víctima u ofendido para continuar.
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 mt-5 text-center">
							<button class="btn btn-primary mb-3 d-none" id="prev-btn" type="button"> <i class="bi bi-caret-left-fill"></i> Anterior</button>
							<button class="btn btn-primary mb-3" id="next-btn" type="button"> Siguiente <i class="bi bi-caret-right-fill"></i> </button>
							<button class="btn btn-primary mb-3 d-none" type="submit" id="submit-btn"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('aviso_modal.php') ?>
<?php include('derechos_ofendido_modal.php') ?>

<script>
	var steps = document.querySelectorAll('.step');
	const prevBtn = document.querySelector('#prev-btn');
	const nextBtn = document.querySelector('#next-btn');
	const submitBtn = document.querySelector('#submit-btn');
	const progress = document.querySelector('#progress-bar');
	var stepCount = steps.length - 1;
	var width = 100 / stepCount;
	var currentStep = 0;

	$(document).ready(function() {
		$('#aviso_modal').modal('toggle')
	});

	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		var radiosDesaparecido = document.getElementsByName('esta_desaparecido');

		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', (event) => {
					if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
					} else {

					}
					form.classList.add('was-validated')
				}, false)
			})

		inputsText.forEach((input) => {
			input.addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toUpperCase();
			}, false)
		});

		inputsEmail.forEach((input) => {
			input.addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toLowerCase();
			}, false)
		});

		// radiosDesaparecido.forEach((radio) => {
		// 	radio.addEventListener('change', (e) => {
		// 		if (e.target.value === 'SI') {
		// 			document.querySelector('#datos_desaparecido').classList.add('step');
		// 			refreshSteps()
		// 			console.log('stepCount');
		// 		} else {
		// 			document.querySelector('#datos_desaparecido').classList.remove('step');
		// 			refreshSteps()
		// 			console.log('stepCount');
		// 		}
		// 	})
		// });

	})()

	$('#description').keyup(() => {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	//Steps

	chargeCurrentStep(currentStep);

	nextBtn.addEventListener('click', () => {
		if (validarStep(currentStep)) {
			currentStep++;
			console.log(currentStep);
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
		} else {
			console.log('NO SE VALIDO');
			submitBtn.click();
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'Debes llenar todos los campos requeridos para avanzar',
				confirmButtonColor: '#bf9b55',
			})
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



	//FUNCTIONS *************************************************
	function refreshSteps() {
		steps = document.querySelectorAll('.step');
		stepCount = steps.length - 1;
		width = 100 / stepCount;
	}

	function clearText(text) {
		text
			.normalize('NFD')
			.replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize();
		return text.replaceAll('´', '');
	}

	function enviar_datos() {
		let delito = document.querySelector("#delito").value ? document.querySelector("#delito").value : '';
		let municipio = document.querySelector("#municipio").value ? document.querySelector("#municipio").value : '';
		let calle = document.querySelector("#calle").value ? document.querySelector("#calle").value : '';
		let exterior = document.querySelector("#exterior").value ? document.querySelector("#exterior").value : '';
		let interior = document.querySelector("#interior").value ? document.querySelector("#interior").value : '';
		let colonia = document.querySelector("#colonia").value ? document.querySelector("#colonia").value : '';
		let lugar = document.querySelector("#lugar").value ? document.querySelector("#lugar").value : '';
		let clasificacion = document.querySelector("#clasificacion").value ? document.querySelector("#clasificacion").value : '';
		let fecha = document.querySelector("#fecha").value ? document.querySelector("#fecha").value : '';

		let nombre_imputado = document.querySelector("#nombre_imputado").value ? document.querySelector("#nombre_imputado").value : '';
		let alias = document.querySelector("#alias").value ? document.querySelector("#alias").value : '';
		let primer_apellido = document.querySelector("#primer_apellido").value ? document.querySelector("#primer_apellido").value : '';
		let segundo_apellido = document.querySelector("#segundo_apellido").value ? document.querySelector("#segundo_apellido").value : '';
		let municipio_imputado = document.querySelector("#municipio_imputado").value ? document.querySelector("#municipio_imputado").value : '';
		let calle_imputado = document.querySelector("#calle_imputado").value ? document.querySelector("#calle_imputado").value : '';
		let numero_ext_imputado = document.querySelector("#numero_ext_imputado").value ? document.querySelector("#numero_ext_imputado").value : '';
		let numero_int_imputado = document.querySelector("#numero_int_imputado").value ? document.querySelector("#numero_int_imputado").value : '';
		let tel_imputado = document.querySelector("#tel_imputado").value ? document.querySelector("#tel_imputado").value : '';
		let fecha_nac_imputado = document.querySelector("#fecha_nac_imputado").value ? document.querySelector("#fecha_nac_imputado").value : '';
		let sexo = document.querySelector('input[name="sexo_imputado"]:checked').value ? document.querySelector('input[name="sexo_imputado"]:checked').value : '';
		let escolaridad_imputado = document.querySelector("#escolaridad_imputado").value ? document.querySelector("#escolaridad_imputado").value : '';
		let description = document.querySelector("#description").value ? document.querySelector("#description").value : '';

		document.querySelector('#delito_modal').value = delito;
		document.querySelector('#municipio_modal').value = municipio;
		document.querySelector('#calle_modal').value = calle;
		document.querySelector('#exterior_modal').value = exterior;
		document.querySelector('#interior_modal').value = interior;
		document.querySelector('#colonia_modal').value = colonia;
		document.querySelector('#lugar_modal').value = lugar;
		document.querySelector('#clasificacion_modal').value = clasificacion;
		document.querySelector('#fechadel_modal').value = fecha;

		document.querySelector('#nombre_modal').value = nombre_imputado;
		document.querySelector('#alias_modal').value = alias;
		document.querySelector('#primer_modal').value = primer_apellido;
		document.querySelector('#segundo_modal').value = segundo_apellido;
		document.querySelector('#municipioimp_modal').value = municipio_imputado;
		document.querySelector('#calleimp_modal').value = calle_imputado;
		document.querySelector('#numext_modal').value = calle;
		document.querySelector('#numinterior_modal').value = numero_int_imputado;
		document.querySelector('#telimp_modal').value = tel_imputado;
		document.querySelector('#fechaimp_modal').value = fecha_nac_imputado;
		document.querySelector('#escolaridadimp_modal').value = escolaridad_imputado;
		document.querySelector('#descrimp_modal').value = description;
	}

	function enviar_datosT() {
		let delito = document.querySelector("#delito").value ? document.querySelector("#delito").value : '';
		let municipio = document.querySelector("#municipio").value ? document.querySelector("#municipio").value : '';
		let calle = document.querySelector("#calle").value ? document.querySelector("#calle").value : '';
		let exterior = document.querySelector("#exterior").value ? document.querySelector("#exterior").value : '';
		let interior = document.querySelector("#interior").value ? document.querySelector("#interior").value : '';
		let colonia = document.querySelector("#colonia").value ? document.querySelector("#colonia").value : '';
		let lugar = document.querySelector("#lugar").value ? document.querySelector("#lugar").value : '';
		let clasificacion = document.querySelector("#clasificacion").value ? document.querySelector("#clasificacion").value : '';
		let fecha = document.querySelector("#fecha").value ? document.querySelector("#fecha").value : '';

		document.querySelector('#delito_modalT').value = delito;
		document.querySelector('#municipio_modalT').value = municipio;
		document.querySelector('#calle_modalT').value = calle;
		document.querySelector('#exterior_modalT').value = exterior;
		document.querySelector('#interior_modalT').value = interior;
		document.querySelector('#colonia_modalT').value = colonia;
		document.querySelector('#lugar_modalT').value = lugar;
		document.querySelector('#clasificacion_modalT').value = clasificacion;
		document.querySelector('#fechadel_modalT').value = fecha;
	}

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
		// switch (step) {
		// 	case 0:
		// 		if (
		// 			document.querySelector('input[name="tiene_discapacidad"]:checked') &&
		// 			document.querySelector('input[name="fue_con_arma"]:checked') &&
		// 			document.querySelector('input[name="esta_desaparecido"]:checked')
		// 		) {
		// 			return true
		// 		} else {
		// 			return false;
		// 		}
		// 		break;
		// 	case 1:
		// 		if (
		// 			document.querySelector('#delito').value != '' &&
		// 			document.querySelector('#municipio').value != '' &&
		// 			document.querySelector('#calle').value != '' &&
		// 			document.querySelector('#exterior').value != '' &&
		// 			document.querySelector('#colonia').value != '' &&
		// 			document.querySelector('#lugar').value != '' &&
		// 			document.querySelector('#fecha').value != ''
		// 		) {
		// 			return true
		// 		} else {
		// 			return false
		// 		}
		// 		break;
		// 	case 2:
		// 		if (
		// 			document.querySelector('#identificacion').value != '' &&
		// 			document.querySelector('#e_civil').value != '' &&
		// 			document.querySelector('#discapacidad').value != '' &&
		// 			document.querySelector('#idioma').value != '' &&
		// 			document.querySelector('#documento').value != ''
		// 		) {
		// 			return true
		// 		} else {
		// 			return false
		// 		}
		// 		break;
		// 	case 3:
		// 		if (
		// 			document.querySelector('#firma_url').value != '' &&
		// 			document.querySelector('#notificaciones_check').checked
		// 		) {
		// 			return true
		// 		} else {
		// 			return false
		// 		}
		// 		break;
		// 	default:
		// 		return true;
		// 		break;
		// }
		return true;
	}
</script>
<?= $this->endSection() ?>
