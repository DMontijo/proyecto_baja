<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-12">
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
					<form id="denuncia_moral_form" action="<?= base_url() ?>/denuncia_litigantes/dashboard/create_denuncia_persona_moral" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
						<div class="alert alert-danger d-none" role="alert" id="alerta_empresas">
							No estas ligado a esta empresa, por favor regresa al <a href="<?= base_url() ?>/denuncia_litigantes/dashboard">menú de inicio </a> y ligate a ella.
						</div>
						<!-- DATOS EMPRESA -->
						<div id="datos_moral" class="col-12 d-none step">
							<?php include('form_moral.php') ?>
						</div>
						<!-- DATOS DELITO -->
						<div id="datos_delito" class="col-12 d-none step">
							<?php include('form_delito.php') ?>
						</div>

						<!-- DATOS POSIBLE RESPONSABLE -->
						<div id="datos_imputado" class="col-12 d-none step">
							<?php include('form_imputado.php') ?>
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
							<button class="btn btn-primary mb-3 d-none" type="submit" id="submit-btn"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('modal_agregar_direccion.php') ?>
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
	var checkML_imputado = document.getElementById('checkML_imputado');
	var check_ubi = document.getElementById('check_ubi');
	//Evento para abrir la ubicacion exacta (mapa)
	check_ubi.addEventListener('click', function() {
		let mapa = document.querySelector('#map_moral');

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
	let marca_comercial = document.querySelector('#marca_comercial_d');
	let direccion = document.querySelector('#direccion');
	let empresa = document.querySelector('#empresa');

	let correo_empresa = document.querySelector('#correo_empresa');
	let estado_empresa = document.querySelector('#estado_empresa');
	let municipio_empresa = document.querySelector('#municipio_empresa');
	let localidad_empresa = document.querySelector('#localidad_empresa');
	let colonia_select_empresa = document.querySelector('#colonia_select_empresa');
	let colonia_input_empresa = document.querySelector('#colonia_input_empresa');
	let calle_empresa = document.querySelector('#calle_empresa');
	let n_empresa = document.querySelector('#n_empresa');
	let ninterior_empresa = document.querySelector('#ninterior_empresa');
	let referencia_empresa = document.querySelector('#referencia_empresa');
	let telefono_empresa = document.querySelector('#telefono_empresa');
	let zona_empresa = document.querySelector('#zona_empresa');
	let razon_social = document.querySelector('#razon_social');
	let rfc_empresa = document.querySelector('#rfc_empresa');
	let poder_volumen = document.querySelector('#poder_volumen');
	let poder_no_poder = document.querySelector('#poder_no_poder');
	let poder_no_notario = document.querySelector('#poder_no_notario');

	correo_empresa.readOnly = true;
	estado_empresa.readOnly = true;
	municipio_empresa.readOnly = true;
	localidad_empresa.readOnly = true;
	zona_empresa.readOnly = true;
	colonia_input_empresa.readOnly = true;
	colonia_select_empresa.readOnly = true;
	calle_empresa.readOnly = true;
	n_empresa.readOnly = true;
	ninterior_empresa.readOnly = true;
	referencia_empresa.readOnly = true;
	telefono_empresa.readOnly = true;
	marca_comercial.readOnly = true;
	razon_social.readOnly = true;
	rfc_empresa.readOnly = true;
	poder_no_notario.readOnly = true;
	poder_no_poder.readOnly = true;
	poder_volumen.readOnly = true;
	document.getElementById("estado_empresa").addEventListener("mousedown", function(event) {
		event.preventDefault();
	});
	document.getElementById("municipio_empresa").addEventListener("mousedown", function(event) {
		event.preventDefault();
	});
	document.getElementById("localidad_empresa").addEventListener("mousedown", function(event) {
		event.preventDefault();
	});
	document.getElementById("colonia_select_empresa").addEventListener("mousedown", function(event) {
		event.preventDefault();
	});
	document.querySelector('#empresa').addEventListener('change', (e) => {
		clearSelect(direccion)
		marca_comercial.value = "";
		razon_social.value = "";
		rfc_empresa.value = "";
		poder_volumen.value = "";
		poder_no_notario.value = "";
		poder_no_poder.value = "";
		document.getElementById('alerta_empresas').classList.add('d-none');

		let data = {
			'personamoralid': e.target.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-marcacomercial-by-empresa') ?>",
			method: "POST",
			dataType: "json",
			success: function(responsemaster) {
				if (responsemaster.data.empresas == null) {

					clearSelect(direccion)
					marca_comercial.value = "";
					razon_social.value = "";
					rfc_empresa.value = "";
					poder_volumen.value = "";
					poder_no_notario.value = "";
					poder_no_poder.value = "";
					document.getElementById('alerta_empresas').classList.remove('d-none');

				} else {
					document.getElementById('alerta_empresas').classList.add('d-none');

					clearSelect(direccion)
					let direcciones = responsemaster.data.notificaciones;
					direcciones.forEach(direccion => {
						let option = document.createElement("option");
						option.text = direccion.CALLE + ',' + direccion.COLONIADESCR;
						option.value = direccion.NOTIFICACIONID;
						document.querySelector('#direccion').add(option);
					});
					marca_comercial.value = responsemaster.data.empresas.MARCACOMERCIAL;
					razon_social.value = responsemaster.data.empresas.RAZONSOCIAL;
					rfc_empresa.value = responsemaster.data.empresas.RFC;
					poder_volumen.value = responsemaster.data.empresas.PODERVOLUMEN;
					poder_no_notario.value = responsemaster.data.empresas.PODERNONOTARIO;
					poder_no_poder.value = responsemaster.data.empresas.PODERNOPODER;
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});

	document.querySelector('#direccion').addEventListener('change', (e) => {
		let data = {
			'personamoralid': empresa.value,
			'notificacionid': e.target.value,

		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-notificacion-by-empresa') ?>",
			method: "POST",
			dataType: "json",
			success: function(responsemaster) {
				correo_empresa.value = responsemaster.data.CORREO;
				estado_empresa.value = responsemaster.data.ESTADOID;
				zona_empresa.value = responsemaster.data.ZONA == 'U' ? "URBANA" : "RURAL";
				calle_empresa.value = responsemaster.data.CALLE;
				n_empresa.value = responsemaster.data.NUMERO;
				ninterior_empresa.value = responsemaster.data.NUMEROINTERIOR != "" || responsemaster.data.NUMEROINTERIOR != null ? responsemaster.data.NUMEROINTERIOR : '';
				referencia_empresa.value = responsemaster.data.REFERENCIA != "" || responsemaster.data.REFERENCIA != null ? responsemaster.data.REFERENCIA : '';
				telefono_empresa.value = responsemaster.data.TELEFONO;


				if (responsemaster.data.ESTADOID) {
					let data = {
						'estado_id': responsemaster.data.ESTADOID
					};
					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-municipios-by-estado') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							let municipios = response.data;
							clearSelect(municipio_empresa)

							municipios.forEach(municipio => {
								let option = document.createElement("option");
								option.text = municipio.MUNICIPIODESCR;
								option.value = municipio.MUNICIPIOID;
								document.querySelector('#municipio_empresa').add(option);
							});
							municipio_empresa.value = responsemaster.data.MUNICIPIOID;

						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});
				} else {
					document.querySelector('#municipio_empresa').value = '';
				}
				if (responsemaster.data.ESTADOID && responsemaster.data.MUNICIPIOID && responsemaster.data.LOCALIDADID) {
					let data = {
						'estado_id': responsemaster.data.ESTADOID,
						'municipio_id': responsemaster.data.MUNICIPIOID
					};

					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							clearSelect(localidad_empresa)

							let localidades = response.data;
							localidades.forEach(localidad => {
								var option = document.createElement("option");
								option.text = localidad.LOCALIDADDESCR;
								option.value = localidad.LOCALIDADID;
								localidad_empresa.add(option);
							});

							localidad_empresa.value = responsemaster.data.LOCALIDADID;
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});
				} else {
					document.querySelector('#localidad_empresa').value = '';
				}
				if (responsemaster.data.ESTADOID && responsemaster.data.MUNICIPIOID && responsemaster.data.LOCALIDADID && responsemaster.data.COLONIAID) {
					colonia_input_empresa.classList.add('d-none');
					colonia_select_empresa.classList.remove('d-none');
					let data = {
						'estado_id': responsemaster.data.ESTADOID,
						'municipio_id': responsemaster.data.MUNICIPIOID,
						'localidad_id': responsemaster.data.LOCALIDADID
					};
					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							clearSelect(colonia_select_empresa)

							let colonias = response.data;
							colonias.forEach(colonia => {
								var option = document.createElement("option");
								option.text = colonia.COLONIADESCR;
								option.value = colonia.COLONIAID;
								colonia_select_empresa.add(option);
							});

							var option = document.createElement("option");
							option.text = 'OTRO';
							option.value = '0';
							colonia_select_empresa.add(option);
							colonia_select_empresa.value = responsemaster.data.COLONIAID;
							colonia_input_empresa.value = '-';
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});
				} else {
					colonia_input_empresa.classList.remove('d-none');
					colonia_select_empresa.classList.add('d-none');
					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					colonia_select_empresa.add(option);
					colonia_select_empresa.value = '0';
					colonia_input_empresa.value = responsemaster.data.COLONIADESCR ? responsemaster.data
						.COLONIADESCR : '';
				}


			}
		});
	});
	var originalValueEstado = estado_empresa.value;

	estado_empresa.addEventListener("change", function() {
		estado_empresa.value = originalValueEstado;
	});
	var originalValueMunicipio = municipio_empresa.value;

	municipio_empresa.addEventListener("change", function() {
		municipio_empresa.value = originalValueMunicipio;
	});
	var originalValueLocalidad = localidad_empresa.value;

	localidad_empresa.addEventListener("change", function() {
		localidad_empresa.value = originalValueLocalidad;
	});
	var originalValueColonia = colonia_select_empresa.value;

	colonia_select_empresa.addEventListener("change", function() {
		colonia_select_empresa.value = originalValueColonia;
	});


	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		var radiosDesaparecido = document.getElementsByName('esta_desaparecido');
		const denuncia_moral_form = document.querySelector('#denuncia_moral_form');
		const form_agregar_direccion = document.querySelector('#form_agregar_direccion');
		const form_direccion_btn = document.querySelector('#form_direccion_btn');
		const documentos_close_btn = document.querySelector('#direccion_close_btn');
		const spinner_documentos = document.querySelector('#form_direccion_btn #spinner');
		const btn_text_documentos = document.querySelector('#form_direccion_btn #text');
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
						document.querySelector('#denuncia_moral_form').submit();
					}
					form.classList.add('was-validated')
				}, false)
			})

		//Form denuncia moral
		// form_denuncia_moral.addEventListener('submit', (event) => {
		// 	if (!form_denuncia_moral.checkValidity()) {
		// 		event.preventDefault();
		// 		event.stopPropagation();
		// 		submitBtn.removeAttribute('disabled');
		// 		form_denuncia_moral.classList.add('was-validated')

		// 	} else {
		// 		event.preventDefault();
		// 		submitBtn.setAttribute('disabled', true);
		// 		form_denuncia_moral.classList.remove('was-validated')
		// 		document.querySelector('#denuncia_moral_form').submit();
		// 	}
		// }, false);
		//From add notificacion
		form_agregar_direccion.addEventListener('submit', (event) => {
			if (!form_agregar_direccion.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
				documentos_close_btn.classList.add('d-none')
				form_direccion_btn.disabled = false;
				spinner_documentos.classList.add('d-none');
				btn_text_documentos.classList.remove('d-none');
				form_agregar_direccion.classList.add('was-validated')
			} else {
				event.preventDefault();
				event.stopPropagation();
				form_direccion_btn.disabled = true;
				documentos_close_btn.classList.remove('d-none')
				spinner_documentos.classList.remove('d-none');
				btn_text_documentos.classList.remove('d-none');
				form_agregar_direccion.classList.remove('was-validated')
				agregarDireccionNotificion();
			}
		}, false);

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

		document.querySelector('#carta_poder_moral').addEventListener('change', async (e) => {

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

	})();

	//Evento para calcular los caracteres restantes
	$('#description').keyup(() => {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	//Evento para traer las localidades de acuerdo a un municipio. Se limpian los select para que no acumulen
	document.querySelector('#municipio_moral').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_moral');
		let select_colonia = document.querySelector('#colonia_select_moral');
		let input_colonia = document.querySelector('#colonia_moral');

		let estado = 2;
		let municipio = e.target.value;

		select_localidad.disabled = true;
		select_colonia.disabled = true;

		clearSelect(select_localidad);
		clearSelect(select_colonia);

		select_localidad.value = '';
		select_colonia.value = '';
		input_colonia.value = '';

		select_colonia.classList.remove('d-none');
		input_colonia.classList.add('d-none');

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
				select_localidad.disabled = false;
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});
	//Evento para traer las colonias de acuerdo a un municipio, estado y localidad. Se limpian los select para que no acumulen

	document.querySelector('#localidad_moral').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select_moral');
		let input_colonia = document.querySelector('#colonia_moral');

		select_colonia.disabled = true;

		let estado = 2;
		let municipio = document.querySelector('#municipio_moral').value;
		let localidad = e.target.value;

		clearSelect(select_colonia);
		select_colonia.value = '';
		input_colonia.value = '';
		select_colonia.classList.remove('d-none');
		input_colonia.classList.add('d-none');

		let data = {
			'estado_id': estado,
			'municipio_id': municipio,
			'localidad_id': localidad
		};

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let colonias = response.data;
				// console.log(colonias);
				colonias.forEach(colonia => {
					var option = document.createElement("option");
					option.text = colonia.COLONIADESCR;
					option.value = colonia.COLONIAID;
					select_colonia.add(option);
				});

				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				option.style = 'font-weight: bold;';
				select_colonia.add(option);
				select_colonia.disabled = false;
			},
			error: function(jqXHR, textStatus, errorThrown) {

			}
		});
	});

	//Evento change para modificar estilos de una colonia
	document.querySelector('#colonia_select_moral').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select_moral');
		let input_colonia = document.querySelector('#colonia_moral');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = "";
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});

	//Steps

	chargeCurrentStep(currentStep);

	nextBtn.addEventListener('click', () => {

		//Agrega steps de acuerdo a las preguntas iniciales
		var vista = document.querySelectorAll('.step');

		if (validarStep(vista[currentStep].id)) {


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

	//Convierte todo el elemento a mayusculas
	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
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

	//Funcion para agregar direcciones
	function agregarDireccionNotificion() {
		const data = {
			'personamoralid': document.querySelector('#empresa').value,
			'estado_empresa_extra': document.querySelector('#estado_empresa_extra').value,
			'municipio_empresa_extra': document.querySelector('#municipio_empresa_extra').value,
			'localidad_empresa_extra': document.querySelector('#localidad_empresa_extra').value,
			'colonia_select_empresa_extra': document.querySelector('#colonia_select_empresa_extra').value,
			'colonia_input_empresa_extra': document.querySelector('#colonia_input_empresa_extra').value,
			'calle_empresa_extra': document.querySelector('#calle_empresa_extra').value,
			'n_empresa_extra': document.querySelector('#n_empresa_extra').value,
			'ninterior_empresa_extra': document.querySelector('#ninterior_empresa_extra').value,
			'referencia_empresa_extra': document.querySelector('#referencia_empresa_extra').value,
			'telefono_empresa_extra': document.querySelector('#telefono_empresa_extra').value,
			'correo_empresa_extra': document.querySelector('#correo_empresa_extra').value
		};
		// console.log(data);
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-direccion-notificacion') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					document.getElementById("form_agregar_direccion").reset();
					clearSelect(direccion)
					let direcciones = response.notificaciones;
					direcciones.forEach(direccion => {
						let option = document.createElement("option");
						option.text = direccion.CALLE + ',' + direccion.COLONIADESCR;
						option.value = direccion.NOTIFICACIONID;
						document.querySelector('#direccion').add(option);
					});
					Swal.fire({
						icon: 'success',
						text: 'Dirección de notificación ingresado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					$('#agregarDireccionModal').modal('hide');

				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó la información del parentesco',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	//Funcion para validar los elementos requeridos de cada step
	function validarStep(step) {
		switch (step) {
			case 'datos_moral':
				if (
					document.querySelector('#empresa').value != '' &&
					document.querySelector('#marca_comercial_d').value != '' &&
					document.querySelector('#correo_empresa').value != '' &&
					document.querySelector('#estado_empresa').value != '' &&
					document.querySelector('#municipio_empresa').value != '' &&
					document.querySelector('#localidad_empresa').value != '' &&
					document.querySelector('#calle_empresa').value != '' &&
					document.querySelector('#n_empresa').value != '' &&
					document.querySelector('#telefono_empresa').value != ''
				) {
					return true;
				} else {
					return false;
				}
				break;


			case 'datos_delito':
				let date1 = new Date(document.querySelector('#fecha_moral').value);
				let date2 = new Date("<?= date("Y-m-d") ?>");
				if (date1 > date2) {
					document.querySelector('#fecha_moral').value = '';
				}
				if (
					document.querySelector('#delito_moral').value != '' &&
					document.querySelector('#lugar_moral').value != '' &&
					document.querySelector('#fecha_moral').value != '' &&
					document.querySelector('#hora_moral').value != '' &&
					document.querySelector('#carta_poder_moral').value != '' &&
					document.querySelector('input[name="responsable"]:checked') &&
					document.querySelector('#descripcion_breve_moral').value != ''
				) {
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