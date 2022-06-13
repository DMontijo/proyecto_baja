<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-12">
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

					<form action="<?= base_url() ?>/denuncia/dashboard/create" method="post" class="row needs-validation" novalidate>

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

						<!-- DATOS MENOR -->
						<div id="datos_menor" class="col-12 d-none step">
							<?php include('form_datos_menor.php') ?>
						</div>

						<!-- DATOS DEL ADULTO -->
						<div id="datos_adulto" class="col-12 d-none step">
							<?php include('form_datos_adulto.php') ?>
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

		document.querySelector('#description_fisica_imputado').addEventListener('input', (event) => {
			console.log('DESCRIPCION FISICA');
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#señas_des').addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)

		document.querySelector('#aviso_modal').addEventListener('hidden.bs.modal', (event) => {
			$.ajax({
				data: {
					'id': '<?= $session->ID_DENUNCIANTE ?>'
				},
				url: "<?= base_url('/data/get-folios-user-unattended') ?>",
				method: "POST",
				dataType: "json",
			}).done((response) => {
				if (response.length > 0) {
					document.querySelector('#open_folios_modal #folio_num_span').innerHTML = response[0].FOLIOID;
					document.querySelector('#open_folios_modal #folio_delito_span').innerHTML = response[0].DELITODENUNCIA;
					$('#open_folios_modal').modal('show');
				}
			}).fail(function(jqXHR, textStatus) {});

		})

	})()

	$('#description').keyup(() => {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	//Steps

	chargeCurrentStep(currentStep);

	nextBtn.addEventListener('click', () => {

		var vista = document.querySelectorAll('.step');

		if (validarStep(vista[currentStep].id)) {

			if (document.querySelector('input[name="es_menor"]:checked').value == "NO") {
				document.getElementById('datos_menor').classList.remove('step');
				document.getElementById('datos_adulto').classList.remove('step');
			} else {
				if (document.querySelector('input[name="eres_tu"]:checked').value == "NO") {
					document.getElementById('datos_adulto').classList.remove('step');
					document.getElementById('datos_menor').classList.add('step');
				} else {
					document.getElementById('datos_menor').classList.remove('step');
					document.getElementById('datos_adulto').classList.add('step');
				}
			}

			if (document.querySelector('input[name="esta_desaparecido"]:checked').value == "NO") {
				document.getElementById('datos_desaparecido').classList.remove('step');
			} else {
				document.getElementById('datos_desaparecido').classList.add('step');
			}

			if (document.querySelector("#delito").value == "ROBO DE VEHÍCULO" || document.querySelector("#delito").value == "ROBO DE VEHÍCULO CON VIOLENCIA") {
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
					document.querySelector('input[name="eres_tu"]:checked') &&
					document.querySelector('input[name="tiene_discapacidad"]:checked') &&
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
					document.querySelector('#apellido_materno_menor').value != '' &&
					document.querySelector('#pais_menor').value != '' &&
					document.querySelector('#estado_menor').value != '' &&
					document.querySelector('#municipio_menor').value != '' &&
					document.querySelector('#calle_menor').value != '' &&
					document.querySelector('#numero_ext_menor').value != '' &&
					document.querySelector('#numero_int_menor').value != '' &&
					document.querySelector('#cp_menor').value != '' &&
					document.querySelector('#fecha_nacimiento_menor').value != '' &&
					document.querySelector('#edad_menor').value != ''
				) {
					return true
				} else {
					return true
				}
				break;
			case 'datos_adulto':
				if (
					document.querySelector('#nombre_adulto').value != '' &&
					document.querySelector('#ape_paterno_adulto').value != '' &&
					document.querySelector('#ape_materno_adulto').value != '' &&
					document.querySelector('#pais_adulto').value != '' &&
					document.querySelector('#estado_adulto').value != '' &&
					document.querySelector('#municipio_adulto').value != '' &&
					document.querySelector('#colonia_adulto').value != '' &&
					document.querySelector('#calle_adulto').value != '' &&
					document.querySelector('#numero_ext_adulto').value != '' &&
					document.querySelector('#numero_int_adulto').value != '' &&
					document.querySelector('#cp_adulto').value != '' &&
					document.querySelector('#fecha_nac_adulto').value != '' &&
					document.querySelector('#edad_adulto').value != ''
				) {
					return true
				} else {
					return true
				}
				break;
			case 'datos_desaparecido':
				if (
					document.querySelector('#nombre_des').value != '' &&
					document.querySelector('#apellido_paterno_des').value != '' &&
					document.querySelector('#apellido_materno_des').value != '' &&
					document.querySelector('#estatura_des').value != '' &&
					document.querySelector('#fecha_nacimiento_des').value != '' &&
					document.querySelector('#edad_des').value != '' &&
					document.querySelector('#peso_des').value != '' &&
					document.querySelector('#complexion_des').value != '' &&
					document.querySelector('#color_des').value != '' &&
					document.querySelector('input[name="sexo_des"]:checked') &&
					document.querySelector('#señas_des').value != '' &&
					document.querySelector('#identidad_des').value != '' &&
					document.querySelector('#color_cabello_des').value != '' &&
					document.querySelector('#tam_cabello_des').value != '' &&
					document.querySelector('#form_cabello_des').value != '' &&
					document.querySelector('#color_ojos_des').value != '' &&
					document.querySelector('#frente_des').value != '' &&
					document.querySelector('#ceja_des').value != '' &&
					document.querySelector('#discapacidad_des').value != '' &&
					document.querySelector('#origen_des').value != '' &&
					document.querySelector('#dia_des').value != '' &&
					document.querySelector('#lugar_des').value != '' &&
					document.querySelector('#vestimenta_des').value != '' &&
					document.querySelector('#parentesco_des').value != '' &&
					document.querySelector('#foto_des').value != '' &&
					document.querySelector('#autorization_photo_des').value != ''
				) {
					return true
				} else {
					return true
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
				if (
					document.querySelector('#tipo_placas_vehiculo').value != '' &&
					document.querySelector('#placas_vehiculo').value != '' &&
					document.querySelector('#confirm_placas_vehiculo').value != '' &&
					document.querySelector('#estado_vehiculo').value != '' &&
					document.querySelector('#serie_vehiculo').value != '' &&
					document.querySelector('#confirm_serie_vehiculo').value != '' &&
					document.querySelector('#distribuidor_vehiculo').value != '' &&
					document.querySelector('#marca').value != '' &&
					document.querySelector('#linea_vehiculo').value != '' &&
					document.querySelector('#version_vehiculo').value != '' &&
					document.querySelector('#tipo_vehiculo').value != '' &&
					document.querySelector('#servicio_vehiculo').value != '' &&
					document.querySelector('#modelo_vehiculo').value != '' &&
					document.querySelector('input[name="seguro_vigente_vehiculo"]:checked') &&
					document.querySelector('#color_vehiculo').value != '' &&
					document.querySelector('#color_tapiceria_vehiculo').value != '' &&
					document.querySelector('#num_chasis_vehiculo').value != '' &&
					document.querySelector('input[name="transmision_vehiculo"]:checked') &&
					document.querySelector('input[name="traccion_vehiculo"]:checked') &&
					document.querySelector('#foto_vehiculo').value != '' &&
					document.querySelector('#description_vehiculo').value != ''
				) {
					return true;
				} else {
					return true;
				}
				break;
			case 'datos_imputado':
				if (
					document.querySelector('#nombre_imputado').value != '' &&
					document.querySelector('#alias_imputado').value != '' &&
					document.querySelector('#primer_apellido_imputado').value != '' &&
					document.querySelector('#segundo_apellido_imputado').value != '' &&
					document.querySelector('#municipio_imputado').value != '' &&
					document.querySelector('#calle_imputado').value != '' &&
					document.querySelector('#numero_ext_imputado').value != '' &&
					document.querySelector('#numero_int_imputado').value != '' &&
					document.querySelector('#tel_imputado').value != '' &&
					document.querySelector('#fecha_nac_imputado').value != '' &&
					document.querySelector('#escolaridad_imputado').value != '' &&
					document.querySelector('#description_fisica_imputado').value != ''

				) {
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
