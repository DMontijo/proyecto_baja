<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

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
					<form id="denuncia_form" action="<?= base_url() ?>/denuncia_litigantes/dashboard/create_denuncia_persona_fisica" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>

						<!-- DATOS DELITO -->
						<div id="datos_delito" class="col-12 d-none step">
							<?php include('form_delito.php') ?>
						</div>
						<!-- DATOS OFENDIDO -->
						<div id="datos_ofendido" class="col-12 d-none step">
							<?php include('form_ofendido.php') ?>
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
										<i class="bi bi-exclamation-triangle"> Es muy importante que antes de iniciar tu denuncia aceptes los derechos de víctima u ofendido.</i>
										<br>
										Para consultar la constancia de Derechos, da clic <a target="_blank" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">aquí</a>
										<br><br>
									</p>
									<!-- <div class="row">
										<div class="col-12 col-sm-6 offset-sm-3">
											<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
											<small>Si deseas anexar cualquier documento o imagén para la videodenuncia, hazlo aqui.</small>
											<input type="file" class="form-control" id="documentosArchivo" name="documentosArchivo[]" accept="image/jpeg, image/jpg, image/png, .doc, .pdf" multiple>
											<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
										</div>
									</div> -->
									<br>


									<div class="form-group">
										<input class="form-check-input" type="checkbox" name="derechos_imputado" id="derechos_imputado" required>
										<span class="fw-bold">Confirmo que he leído y conozco los derechos de víctima u ofendido</span>
										<div class="invalid-feedback">
											Debes confirmar de leído los derechos de víctima u ofendido para continuar.
										</div>
									</div>
									<br>
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
							<button class="btn btn-primary mb-3 d-none" type="submit" id="submit-btn"><i class="bi bi-camera-video-fill"></i> Presentar denuncia escrita</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	var steps = document.querySelectorAll('.step');
	const prevBtn = document.querySelector('#prev-btn');
	const nextBtn = document.querySelector('#next-btn');
	const submitBtn = document.querySelector('#submit-btn');
	const progress = document.querySelector('#progress-bar');
	var stepCount = steps.length - 1;
	var width = 100 / stepCount;
	var currentStep = 0;
	var checkML_ofendido = document.getElementById('checkML_ofendido');
	var checkML_imputado = document.getElementById('checkML_imputado');
	var checkML_des = document.getElementById('checkML_des');
	var check_ubi = document.getElementById('check_ubi');

	//Evento para abrir la ubicacion exacta (mapa)
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

	//Evento para cambiar el texto del label cuando seleccionan Manzana y Lote del menor
	checkML_ofendido.addEventListener('click', function() {
		if (checkML_ofendido.checked) {
			document.getElementById('lblExterior_ofendido').innerHTML = "Manzana";
			document.getElementById('lblInterior_ofendido').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_ofendido').innerHTML = "Número exterior";
			document.getElementById('lblInterior_ofendido').innerHTML = "Número interior";
		}
	});
	//Evento para cambiar el texto del label cuando seleccionan Manzana y Lote del imputado

	checkML_imputado.addEventListener('click', function() {
		if (checkML_imputado.checked) {
			document.getElementById('lblExterior_imputado').innerHTML = "Manzana";
			document.getElementById('lblInterior_imputado').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_imputado').innerHTML = "Número exterior";
			document.getElementById('lblInterior_imputado').innerHTML = "Número interior";
		}
	});
	//Evento para cambiar el texto del label cuando seleccionan Manzana y Lote del desaparecido

	checkML_des.addEventListener('click', function() {
		if (checkML_des.checked) {
			document.getElementById('lblExterior_des').innerHTML = "Manzana";
			document.getElementById('lblInterior_des').innerHTML = "Lote";
		} else {
			document.getElementById('lblExterior_des').innerHTML = "Número exterior";
			document.getElementById('lblInterior_des').innerHTML = "Número interior";
		}
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

		//Convierte todos los input text en mayusculas y eliminar caracteres especiales
		inputsText.forEach((input) => {
			input.addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toUpperCase();
			}, false)
		});

		//Convierte todos los input email a minusculas y eliminar caracteres especiales
		inputsEmail.forEach((input) => {
			input.addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toLowerCase();
			}, false)
		});

		//Eventos para convertir a mayusculas y eliminar caracteres especiales
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

		document.querySelector('#carta_poder').addEventListener('change', async (e) => {
		
			let preview = document.querySelector('#img_preview_carta');

			if (e.target.files && e.target.files[0]) {
				if (e.target.files[0].type == "image/jpeg" || e.target.files[0].type == "image/png" || e.target.files[0].type == "image/jpg") {
					if (e.target.files[0].size > 2000000) {
						const blob = await comprimirImagen(e.target.files[0], 50);
						if (blob.size > 2000000) {
							e.target.value = '';
	
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
						
							preview.classList.remove('d-none');
							preview.setAttribute('src', image);
						}
					} else {
						let reader = new FileReader();
						reader.onload = function(e) {
							
							preview.classList.remove('d-none');
							preview.setAttribute('src', e.target.result);
						}
						reader.readAsDataURL(e.target.files[0]);
					}

				} else {
					if (e.target.files[0].size > 2000000) {
						e.target.value = '';
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

	})();

	//Evento para calcular los caracteres restantes
	$('#description').keyup(() => {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	//Steps

	chargeCurrentStep(currentStep);

	nextBtn.addEventListener('click', () => {

		//Agrega steps de acuerdo a las preguntas iniciales
		var vista = document.querySelectorAll('.step');
		document.getElementById('datos_desaparecido').classList.remove('step');
		document.getElementById('datos_robo_vehiculo').classList.remove('step');
		document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');

		if (validarStep(vista[currentStep].id)) {
			if (document.querySelector("#delito").value == "PERSONA DESAPARECIDA") {
				$("input[name=documentos_vehiculo][value='O']").prop("checked", true);
				document.getElementById('datos_robo_vehiculo').classList.remove('step');
				document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
				document.getElementById('datos_desaparecido').classList.add('step');
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
		//Modifica estilos cuando se regresa un step
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

	//Funcion para eliminar los options de un select
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}
	//Funcion para limpiar los guiones
	function clearGuion(e) {
		e.target.value = e.target.value.replace(/-/g, "");
	}


	//Funcion para actualizar las variables con el numero restantes de steps
	function refreshSteps() {
		steps = document.querySelectorAll('.step');
		stepCount = steps.length - 1;
		width = 100 / stepCount;
	}

	//Funcion para eliminar caracteres especiales del texto
	function clearText(text) {
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
	}

	//Funcion mostrar o ocultar los elementos de paso según el número especificado, y también actualiza el ancho del progreso.
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


	//Funcion para validar los elementos requeridos de cada step
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
			case 'datos_ofendido':
				if (
					document.querySelector('#nombre_ofendido').value != ''
					//  &&
					// document.querySelector('#apellido_paterno_menor').value != '' &&
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
					// document.querySelector('input[name="sexo_menor"]:checked')
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
					document.querySelector('#carta_poder').value != '' &&
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