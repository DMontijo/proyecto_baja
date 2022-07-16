<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<?= $session ?>
<div class="row">
	<div class="col-12">
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
		<h4 class="text-center text-blue fw-bold my-4">BIENVENID@ <?= $session->NOMBRE ?> <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?></h4>
		<div class="card rounded shadow border-0">
			<div class="card-body py-5 p-sm-5">
				<div class="container">
					<h1 class="text-center fw-bolder pb-1 text-blue">DENUNCIA</h1>
					<p class="text-center fw-bold text-blue ">Llena los campos siguientes para continuar tu denuncia</p>
					<p class="text-center pb-3">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
					<div class="progress mb-4">
						<div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
					</div>
					<form id="denuncia_form" action="<?= base_url() ?>/denuncia/dashboard/create" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>

						<!-- PREGUNTAS INICIALES -->
						<div id="datos_iniciales" class="col-12 step">
							<?php include('form_preguntas_iniciales.php') ?>
						</div>

						<!-- DATOS DELITO -->
						<div id="datos_delito" class="col-12 d-none step">
							<?php include('form_delito.php') ?>
						</div>

						<!-- DATOS MENOR -->
						<div id="datos_menor" class="col-12 d-none step">
							<?php include('form_datos_menor.php') ?>
						</div>

						<!-- DATOS DESAPARECIDO -->
						<div id="datos_desaparecido" class="col-12 d-none step">
							<?php include('form_persona_desaparecida.php') ?>
						</div>

						<!-- DATOS POSIBLE RESPONSABLE -->
						<div id="datos_imputado" class="col-12 d-none step">
							<?php include('form_imputado.php') ?>
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
										<span class="fw-bold">Confirmo que he leído y conozco los derechos de víctima u ofendido</span>
										<div class="invalid-feedback">
											Debes confirmar de leído los derechos de víctima u ofendido para continuar.
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
<?php include('open_folios_modal.php') ?>
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

	$(document).ready(() => {
		$('#aviso_modal').modal('show');
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
						submitBtn.removeAttribute('disabled');
					} else {
						event.preventDefault();
						submitBtn.setAttribute('disabled', true);
						document.querySelector('#denuncia_form').submit();
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

		document.querySelector('#description_fisica_imputado').addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#señas_des').addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#descripcion_breve').addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#description_vehiculo').addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#aviso_modal').addEventListener('hidden.bs.modal', (event) => {
			$.ajax({
				data: {
					'id': '<?= $session->DENUNCIANTEID ?>'
				},
				url: "<?= base_url('/data/get-folios-user-unattended') ?>",
				method: "POST",
				dataType: "json",
			}).done((response) => {
				if (response.length > 0) {
					document.querySelector('#open_folios_modal #folio_num_span').innerHTML = response[0].FOLIOID;
					document.querySelector('#open_folios_modal #folio_delito_span').innerHTML = response[0].HECHODELITO;
					$('#open_folios_modal').modal('show');
				}
			}).fail(function(jqXHR, textStatus) {});
		})

	})();

	$('#description').keyup(() => {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	//Steps

	chargeCurrentStep(currentStep);

	nextBtn.addEventListener('click', () => {

		var vista = document.querySelectorAll('.step');

		if (validarStep(vista[currentStep].id)) {

			if (
				document.querySelector('input[name="es_menor"]:checked').value === 'SI' &&
				document.querySelector('input[name="esta_desaparecido"]:checked').value == "SI"
			) {

				document.getElementById('datos_desaparecido').classList.add('step');
				document.getElementById('datos_menor').classList.remove('step');
				console.log('Datos desaparecido');

				document.querySelector('#nombre_menor').removeAttribute('required');
				document.querySelector('#apellido_paterno_menor').removeAttribute('required');
				document.querySelector('#pais_menor').removeAttribute('required');
				document.querySelector('#estado_menor').removeAttribute('required');
				document.querySelector('#municipio_menor').removeAttribute('required');
				document.querySelector('#colonia_menor').removeAttribute('required');
				document.querySelector('#colonia_menor_input').removeAttribute('required');
				document.querySelector('#calle_menor').removeAttribute('required');
				document.querySelector('#numero_ext_menor').removeAttribute('required');
				document.querySelector('#fecha_nacimiento_menor').removeAttribute('required');
				document.querySelector('#edad_menor').removeAttribute('required');
			} else if (
				document.querySelector('input[name="es_menor"]:checked').value === 'SI' &&
				document.querySelector('input[name="esta_desaparecido"]:checked').value == "NO"
			) {

				document.getElementById('datos_desaparecido').classList.remove('step');
				document.getElementById('datos_menor').classList.add('step');

				document.querySelector('#nombre_menor').setAttribute('required', true);
				document.querySelector('#apellido_paterno_menor').setAttribute('required', true);
				document.querySelector('#pais_menor').setAttribute('required', true);
				document.querySelector('#estado_menor').setAttribute('required', true);
				document.querySelector('#municipio_menor').setAttribute('required', true);
				document.querySelector('#colonia_menor').setAttribute('required', true);
				document.querySelector('#colonia_menor_input').setAttribute('required', true);
				document.querySelector('#calle_menor').setAttribute('required', true);
				document.querySelector('#numero_ext_menor').setAttribute('required', true);
				document.querySelector('#fecha_nacimiento_menor').setAttribute('required', true);
				document.querySelector('#edad_menor').setAttribute('required', true);

			} else if (document.querySelector('input[name="es_menor"]:checked').value === 'NO') {
				document.getElementById('datos_menor').classList.remove('step');
				document.querySelector('#nombre_menor').removeAttribute('required');
				document.querySelector('#apellido_paterno_menor').removeAttribute('required');
				document.querySelector('#pais_menor').removeAttribute('required');
				document.querySelector('#estado_menor').removeAttribute('required');
				document.querySelector('#municipio_menor').removeAttribute('required');
				document.querySelector('#colonia_menor').removeAttribute('required');
				document.querySelector('#colonia_menor_input').removeAttribute('required');
				document.querySelector('#calle_menor').removeAttribute('required');
				document.querySelector('#numero_ext_menor').removeAttribute('required');
				document.querySelector('#fecha_nacimiento_menor').removeAttribute('required');
				document.querySelector('#edad_menor').removeAttribute('required');
			}

			if (document.querySelector('input[name="esta_desaparecido"]:checked').value === 'SI') {
				document.getElementById('datos_desaparecido').classList.add('step');

				document.querySelector('#nombre_des').setAttribute('required', true);
				document.querySelector('#apellido_paterno_des').setAttribute('required', true);
				document.querySelector('#pais_des').setAttribute('required', true);
				document.querySelector('#estado_des').setAttribute('required', true);
				document.querySelector('#municipio_des').setAttribute('required', true);
				document.querySelector('#colonia_des').setAttribute('required', true);
				document.querySelector('#colonia_des_input').setAttribute('required', true);
				document.querySelector('#calle_des').setAttribute('required', true);
				document.querySelector('#numero_ext_des').setAttribute('required', true);
				document.querySelector('#edad_des').setAttribute('required', true);

			} else {
				document.getElementById('datos_desaparecido').classList.remove('step');

				document.querySelector('#nombre_des').removeAttribute('required');
				document.querySelector('#apellido_paterno_des').removeAttribute('required');
				document.querySelector('#pais_des').removeAttribute('required');
				document.querySelector('#estado_des').removeAttribute('required');
				document.querySelector('#municipio_des').removeAttribute('required');
				document.querySelector('#colonia_des').removeAttribute('required');
				document.querySelector('#colonia_des_input').removeAttribute('required');
				document.querySelector('#calle_des').removeAttribute('required');
				document.querySelector('#numero_ext_des').removeAttribute('required');
				document.querySelector('#numero_int_des').removeAttribute('required');
				document.querySelector('#edad_des').removeAttribute('required');
			}

			if (document.querySelector("#delito").value == "ROBO DE VEHÍCULO") {
				document.getElementById('datos_robo_vehiculo').classList.add('step');
			} else {
				document.getElementById('datos_robo_vehiculo').classList.remove('step');
			}

			if (document.querySelector('input[name="responsable"]:checked').value == "NO") {
				document.getElementById('datos_imputado').classList.remove('step');
			} else {
				document.getElementById('datos_imputado').classList.add('step');
			}


			steps = document.querySelectorAll('.step');
			var stepCount = steps.length - 1;
			var width = 100 / stepCount;

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
		return false;
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

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}


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
			case 'datos_iniciales':
				if (
					document.querySelector('input[name="es_menor"]:checked') &&
					document.querySelector('input[name="tiene_discapacidad"]:checked') &&
					document.querySelector('input[name="es_vulnerable"]:checked') &&
					document.querySelector('input[name="fue_con_arma"]:checked') &&
					document.querySelector('input[name="esta_desaparecido"]:checked')
				) {
					return true;
				} else {
					return false;
				}
				break;
			case 'datos_menor':
				if (
					document.querySelector('#nombre_menor').value != '' &&
					document.querySelector('#apellido_paterno_menor').value != '' &&
					document.querySelector('#pais_menor').value != '' &&
					document.querySelector('#estado_menor').value != '' &&
					document.querySelector('#municipio_menor').value != '' &&
					document.querySelector('#calle_menor').value != '' &&
					document.querySelector('#numero_ext_menor').value != '' &&
					document.querySelector('#fecha_nacimiento_menor').value != '' &&
					document.querySelector('#edad_menor').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 'datos_desaparecido':
				if (
					document.querySelector('#nombre_des').value != '' &&
					document.querySelector('#apellido_paterno_des').value != '' &&
					document.querySelector('#pais_des').value != '' &&
					document.querySelector('#estado_des').value != '' &&
					document.querySelector('#municipio_des').value != '' &&
					document.querySelector('#calle_des').value != '' &&
					document.querySelector('#numero_ext_des').value != '' &&
					document.querySelector('#edad_des').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 'datos_delito':
				if (
					document.querySelector('#delito').value != '' &&
					document.querySelector('#municipio').value != '' &&
					document.querySelector('#calle').value != '' &&
					document.querySelector('#exterior').value != '' &&
					document.querySelector('#colonia').value != '' &&
					document.querySelector('#lugar').value != '' &&
					document.querySelector('#fecha').value != '' &&
					document.querySelector('#hora').value != '' &&
					document.querySelector('input[name="responsable"]:checked') &&
					document.querySelector('#descripcion_breve').value != ''
				) {
					return true;
				} else {
					return false;
				}
				break;
			case 'datos_robo_vehiculo':
				if (true) {
					return true;
				} else {
					return false;
				}
				break;
			case 'datos_imputado':
				if (true) {
					return true
				} else {
					return true;
				}
				break;
			default:
				return true;
				break;
		}
		return true;
	}
</script>
<?= $this->endSection() ?>
