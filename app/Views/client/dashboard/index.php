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
		<h4 id="titulo" class="text-center text-blue fw-bold my-4">BIENVENID@ <?= $session->NOMBRE ?> <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?></h4>
		<div class="card rounded shadow border-0">
			<div class="card-body py-5 p-sm-5">
				<div class="container">
					<h1 class="text-center fw-bolder pb-1 text-blue">DENUNCIA</h1>
					<p class="text-center fw-bold text-blue ">Llene los campos siguientes para continuar su denuncia</p>
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
						<div id="datos_robo_vehiculo_completo" class="col-12 d-none step">
							<?php include('form_robo_vehiculo_sp.php') ?>
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


									<div class="row">
										<div class="col-12 col-sm-6 offset-sm-3">
											<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
											<small>Si deseas anexar cualquier documento o imagén para la videodenuncia, hazlo aqui.</small>
											<input type="file" class="form-control" id="documentosArchivo" name="documentosArchivo[]" accept="image/jpeg, image/jpg, image/png, .doc, .pdf" multiple>
											<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
										</div>
									</div>
									<br>


									<div class="form-group">
										<input class="form-check-input" type="checkbox" name="derechos_imputado" id="derechos_imputado" required>
										<span class="fw-bold">Confirmo que he leído y conozco los derechos de víctima u ofendido</span>
										<div class="invalid-feedback">
											Debes confirmar de leído los derechos de víctima u ofendido para continuar.
										</div>
									</div>
									<div class="form-group">
										<input class="form-check-input" type="checkbox" id="notificaciones_check" name="notificaciones_check" required>
										<label class="fw-bold" for="notificaciones_check">
											Acepto y autorizo como medio de notificaciones: teléfono, correo electrónico y domicilio registrado.
										</label>
										<div class="invalid-feedback">
											Debes aceptar el envío de notificaciones para continuar.
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
<?php include('911_modal.php') ?>
<?php include('800_modal.php') ?>
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
	var checkML_menor = document.getElementById('checkML_menor');
	var checkML_imputado = document.getElementById('checkML_imputado');
	var checkML_des = document.getElementById('checkML_des');
	var check_ubi = document.getElementById('check_ubi');

	check_ubi.addEventListener('click', function() {
		let mapa = document.querySelector('#map');

		if (check_ubi.checked) {
			mapa.classList.remove('d-none');
			mapa.style.width = '100%';
			mapa.style.height = '400px';
			document.querySelector('#check_ubi').value = "on";

		} else {
			mapa.classList.add('d-none');
			document.querySelector('#check_ubi').value = "off";


		}
	});

	checkML_menor.addEventListener('click', function() {
		if (checkML_menor.checked) {
			document.getElementById('lblExterior_menor').innerHTML = "Manzana";
			document.getElementById('lblInterior_menor').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_menor').innerHTML = "Número exterior";
			document.getElementById('lblInterior_menor').innerHTML = "Número interior";
		}
	});

	checkML_imputado.addEventListener('click', function() {
		if (checkML_imputado.checked) {
			document.getElementById('lblExterior_imputado').innerHTML = "Manzana";
			document.getElementById('lblInterior_imputado').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_imputado').innerHTML = "Número exterior";
			document.getElementById('lblInterior_imputado').innerHTML = "Número interior";
		}
	});

	checkML_des.addEventListener('click', function() {
		if (checkML_des.checked) {
			document.getElementById('lblExterior_des').innerHTML = "Manzana";
			document.getElementById('lblInterior_des').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_des').innerHTML = "Número exterior";
			document.getElementById('lblInterior_des').innerHTML = "Número interior";
		}
	});
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

		document.querySelector('#description_vehiculo_sp').addEventListener('input', (event) => {
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
				console.log(response);
				if (response.abiertos.length > 0) {
					document.querySelector('#open_folios_modal #title_span').innerHTML = 'ABIERTO'
					document.querySelector('#open_folios_modal #folio_num_span').innerHTML = response.abiertos[0].FOLIOID;
					document.querySelector('#open_folios_modal #folio_delito_span').innerHTML = response.abiertos[0].HECHODELITO;
					document.querySelector('#open_folios_modal #folio_estatus').innerHTML = 'aún no ha sido atendido.'
					document.querySelector('#open_input_year').value = response.abiertos[0].ANO;
					$('#open_folios_modal').modal('show');
				} else if (response.proceso.length > 0) {
					document.querySelector('#open_folios_modal #title_span').innerHTML = 'EN PROCESO'
					document.querySelector('#open_folios_modal #folio_num_span').innerHTML = response.proceso[0].FOLIOID;
					document.querySelector('#open_folios_modal #folio_delito_span').innerHTML = response.proceso[0].HECHODELITO;
					document.querySelector('#open_folios_modal #folio_estatus').innerHTML = 'esta en proceso de atención. Una vez tenga una resolución te llegará un correo electrónico con la confirmación del expediente generado.'
					document.querySelector('#open_input_year').value = response.proceso[0].ANO;
					document.querySelector('#open_folios_modal #btn-inicia-denuncia').classList.add('d-none');
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
				// console.log('Datos desaparecido');

				document.querySelector('#nombre_menor').removeAttribute('required');
				document.querySelector('#apellido_paterno_menor').removeAttribute('required');
				document.querySelector('#pais_menor').removeAttribute('required');
				document.querySelector('#estado_menor').removeAttribute('required');
				document.querySelector('#municipio_menor').removeAttribute('required');
				document.querySelector('#colonia_menor').removeAttribute('required');
				document.querySelector('#colonia_menor_input').removeAttribute('required');
				document.querySelector('#localidad_menor').removeAttribute('required');
				document.querySelector('#calle_menor').removeAttribute('required');
				document.querySelector('#numero_ext_menor').removeAttribute('required');
				document.querySelector('#fecha_nacimiento_menor').removeAttribute('required');
				document.querySelector('#edad_menor').removeAttribute('required');
				document.querySelector('#nacionalidad_menor').removeAttribute('required');
				document.querySelector('#estado_origen_menor').removeAttribute('required');
				document.querySelector('#municipio_origen_menor').removeAttribute('required');
				document.querySelector('#ocupacion_menor').removeAttribute('required');
				document.querySelector('#ocupacion_descr_menor').removeAttribute('required');


				let radiosSexoMenor = document.querySelectorAll('input[name="sexo_menor"]');
				radiosSexoMenor.forEach((radio) => {
					radio.removeAttribute('required');
				});

			} else if (
				document.querySelector('input[name="es_menor"]:checked').value === 'SI' &&
				document.querySelector('input[name="esta_desaparecido"]:checked').value == "NO"
			) {

				document.getElementById('datos_desaparecido').classList.remove('step');
				document.getElementById('datos_menor').classList.add('step');

				document.querySelector('#nombre_menor').setAttribute('required', true);
				document.querySelector('#apellido_paterno_menor').setAttribute('required', true);
				// document.querySelector('#pais_menor').setAttribute('required', true);
				// document.querySelector('#estado_menor').setAttribute('required', true);
				// document.querySelector('#municipio_menor').setAttribute('required', true);
				// document.querySelector('#colonia_menor').setAttribute('required', true);
				// document.querySelector('#colonia_menor_input').setAttribute('required', true);
				// document.querySelector('#localidad_menor').setAttribute('required', true);
				// document.querySelector('#calle_menor').setAttribute('required', true);
				// document.querySelector('#numero_ext_menor').setAttribute('required', true);
				// document.querySelector('#fecha_nacimiento_menor').setAttribute('required', true);
				// document.querySelector('#edad_menor').setAttribute('required', true);
				// document.querySelector('#nacionalidad_menor').setAttribute('required', true);
				// document.querySelector('#estado_origen_menor').setAttribute('required', true);
				// document.querySelector('#municipio_origen_menor').setAttribute('required', true);


				let radiosSexoMenor = document.querySelectorAll('input[name="sexo_menor"]');
				radiosSexoMenor.forEach((radio) => {
					radio.setAttribute('required', true);
				});

			} else if (document.querySelector('input[name="es_menor"]:checked').value === 'NO') {
				document.getElementById('datos_menor').classList.remove('step');
				document.querySelector('#nombre_menor').removeAttribute('required');
				document.querySelector('#apellido_paterno_menor').removeAttribute('required');
				document.querySelector('#pais_menor').removeAttribute('required');
				document.querySelector('#estado_menor').removeAttribute('required');
				document.querySelector('#municipio_menor').removeAttribute('required');
				document.querySelector('#colonia_menor').removeAttribute('required');
				document.querySelector('#colonia_menor_input').removeAttribute('required');
				document.querySelector('#localidad_menor').removeAttribute('required');
				document.querySelector('#calle_menor').removeAttribute('required');
				document.querySelector('#numero_ext_menor').removeAttribute('required');
				document.querySelector('#fecha_nacimiento_menor').removeAttribute('required');
				document.querySelector('#edad_menor').removeAttribute('required');
				document.querySelector('#nacionalidad_menor').removeAttribute('required');
				document.querySelector('#estado_origen_menor').removeAttribute('required');
				document.querySelector('#municipio_origen_menor').removeAttribute('required');
				document.querySelector('#ocupacion_menor').removeAttribute('required');
				document.querySelector('#ocupacion_descr_menor').removeAttribute('required');
				let radiosSexoMenor = document.querySelectorAll('input[name="sexo_menor"]');
				radiosSexoMenor.forEach((radio) => {
					radio.removeAttribute('required');
				});
			}

			if (document.querySelector('input[name="esta_desaparecido"]:checked').value === 'SI') {
				document.getElementById('datos_desaparecido').classList.add('step');
				document.querySelector('#nombre_des').setAttribute('required', true);
				document.querySelector('#apellido_paterno_des').setAttribute('required', true);
				// document.querySelector('#fecha_nacimiento_des').setAttribute('required', true);
				document.querySelector('#edad_des').setAttribute('required', true);
				document.querySelector('#nacionalidad_des').setAttribute('required', true);
				document.querySelector('#estado_origen_des').setAttribute('required', true);
				document.querySelector('#municipio_origen_des').setAttribute('required', true);



				let radiosSexoDes = document.querySelectorAll('input[name="sexo_des"]');
				radiosSexoDes.forEach((radio) => {
					radio.setAttribute('required', true);
				});

			} else {
				document.getElementById('datos_desaparecido').classList.remove('step');
				document.querySelector('#nombre_des').removeAttribute('required');
				document.querySelector('#apellido_paterno_des').removeAttribute('required');
				document.querySelector('#pais_des').removeAttribute('required');
				document.querySelector('#estado_des').removeAttribute('required');
				document.querySelector('#municipio_des').removeAttribute('required');
				document.querySelector('#colonia_des').removeAttribute('required');
				document.querySelector('#colonia_des_input').removeAttribute('required');
				document.querySelector('#localidad_des').removeAttribute('required');
				document.querySelector('#calle_des').removeAttribute('required');
				document.querySelector('#numero_ext_des').removeAttribute('required');
				document.querySelector('#numero_int_des').removeAttribute('required');
				document.querySelector('#edad_des').removeAttribute('required');
				document.querySelector('#nacionalidad_des').removeAttribute('required');
				document.querySelector('#estado_origen_des').removeAttribute('required');
				document.querySelector('#municipio_origen_des').removeAttribute('required');
				document.querySelector('#fecha_nacimiento_des').removeAttribute('required');
				document.querySelector('#ocupacion_des').removeAttribute('required');
				document.querySelector('#ocupacion_descr_des').removeAttribute('required');

				let radiosSexoDes = document.querySelectorAll('input[name="sexo_des"]');
				radiosSexoDes.forEach((radio) => {
					radio.removeAttribute('required');
				});
			}

			if (document.querySelector("#delito").value == "PERSONA DESAPARECIDA") {
				$("input[name=documentos_vehiculo][value='O']").prop("checked", true);
				document.getElementById('datos_robo_vehiculo').classList.remove('step');
				document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
			}
			$('#delito').change(function() {

				if (document.querySelector("#delito").value == "ROBO DE VEHÍCULO") {
					var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo");
					radio_doc_vehiculo.classList.remove('d-none');
					if (document.getElementById('documentos_vehiculo').value == 'S') {
						document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
						document.getElementById('datos_robo_vehiculo').classList.remove('step');
					} else if (document.getElementById('documentos_vehiculo').value == 'N') {
						document.getElementById('datos_robo_vehiculo').classList.add('step');
						document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
					}
					// document.querySelector('input[name="documentos_vehiculo"]:checked').value = 'N';
					// document.querySelector('#documentos_vehiculo > [value="N"]').checked = true;	
					// $("input[name=documentos_vehiculo][value='N']").prop("checked",true);

					$('input[type=radio][name=documentos_vehiculo]').change(function() {
						if (this.value == 'S') {
							document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
							document.getElementById('datos_robo_vehiculo').classList.remove('step');
						} else if (this.value == 'N') {
							document.getElementById('datos_robo_vehiculo').classList.add('step');
							document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
						}

					});
				} else {
					var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo");

					radio_doc_vehiculo.classList.add('d-none');
					$("input[name=documentos_vehiculo][value='O']").prop("checked", true);
					document.getElementById('datos_robo_vehiculo').classList.remove('step');
					document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');



				}
			})

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
			document.querySelector('#titulo').scrollIntoView();
		} else {
			// console.log('NO SE VALIDO');
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
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
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
					document.querySelector('input[name="lesiones"]:checked') &&
					document.querySelector('input[name="esta_desaparecido"]:checked') &&
					document.querySelector('input[name="es_tercera_edad"]:checked') &&
					document.querySelector('input[name="es_ofendido"]:checked')
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
					// document.querySelector('#pais_menor').value != '' &&
					// document.querySelector('#estado_menor').value != '' &&
					// document.querySelector('#municipio_menor').value != '' &&
					// document.querySelector('#localidad_menor').value != '' &&
					// document.querySelector('#colonia_menor').value != '' &&
					// document.querySelector('#colonia_menor_input').value != '' &&
					// document.querySelector('#calle_menor').value != '' &&
					// document.querySelector('#numero_ext_menor').value != '' &&
					// document.querySelector('#fecha_nacimiento_menor').value != '' &&
					// document.querySelector('#edad_menor').value != '' &&
					document.querySelector('input[name="sexo_menor"]:checked')
					// document.querySelector('#nacionalidad_menor').value != '' &&
					// document.querySelector('#estado_origen_menor').value != '' &&
					// document.querySelector('#municipio_origen_menor').value != ''
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
					// document.querySelector('#fecha_nacimiento_des').value != '' &&
					document.querySelector('#edad_des').value != '' &&
					document.querySelector('input[name="sexo_des"]:checked') &&
					document.querySelector('#nacionalidad_des').value != '' &&
					document.querySelector('#estado_origen_des').value != '' &&
					document.querySelector('#municipio_origen_des').value != ''
				) {
					return true
				} else {
					return false
				}
				break;
			case 'datos_delito':
				let date1 = new Date(document.querySelector('#fecha').value);
				let date2 = new Date("<?= date("Y-m-d") ?>");
				if (date1 > date2) {
					document.querySelector('#fecha').value = '';
				}
				if (
					document.querySelector('#delito').value != '' &&
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
					return false;
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
