<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<?php include 'modals_denuncia_anonima/insert_persona_victima_modal.php' ?>
<?php include 'modals_denuncia_anonima/insert_persona_imputado_modal.php' ?>
<?php include 'modals_denuncia_anonima/form_asignar_fisfis_insert.php' ?>
<?php include 'modals_denuncia_anonima/insert_objetos_involucrados_modal.php' ?>
<?php include 'modals_denuncia_anonima/salida_modal_denuncia_anonima.php' ?>
<?php include 'modals_denuncia_anonima/insert_vehiculo_modal.php' ?>
<?php include 'modals_denuncia_anonima/form_denuncia.php' ?>


<div class="row">
	<div class="col-12">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<h1 class="text-center font-weight-bold">DENUNCIA ANÓNIMA</h1>
				<input type="text" class="form-control" id="folio" name="folio" disabled hidden>
				<br>

				<input type="text" class="form-control" id="year" name="year" disabled hidden>

				<div class="row" id="foliodiv" name="foliodiv">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">INFORMACIÓN DEL HECHO</h3>
					</div>
					<form id="form_folio" action="" method="post" class="row p-0 m-0 needs-validation">

						<div class="col-12 col-sm-6 mb-3">
							<label for="fecha" class="form-label font-weight-bold">Fecha del delito:</label>
							<input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" required>
						</div>
						<div class="col-12 col-sm-6 mb-3">
							<label for="hora" class="form-label font-weight-bold">Hora del delito:</label>
							<input type="time" class="form-control" id="hora" name="hora" required>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<div class="form-group">
								<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
								<select class="form-control" id="municipio" name="municipio" required>
									<option selected disabled value="">Elige el municipio</option>
									<?php foreach ($body_data->municipios as $index => $municipio) { ?>
										<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<div class="form-group">
								<label for="localidad" class="form-label font-weight-bold">Localidad:</label>
								<select class="form-control" id="localidad" name="localidad" required>
									<option selected disabled value="">Selecciona la localidad</option>

								</select>
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<div class="form-group">
								<label for="colonia" class="form-label font-weight-bold">Colonia:</label>
								<select class="form-control" id="colonia_select" name="colonia_select" required>
									<option selected disabled value="">Selecciona la colonia</option>
								</select>
								<input type="text" class="form-control d-none" id="colonia" name="colonia" maxlength="100">
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="calle" class="form-label font-weight-bold">Calle o avenida:</label>
							<input type="text" class="form-control" id="calle" name="calle" required>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="exterior" class="form-label font-weight-bold">No. exterior:</label>
							<input type="text" class="form-control" id="exterior" name="exterior" required>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="interior" class="form-label font-weight-bold">No. interior:</label>
							<input type="text" class="form-control" id="interior" name="interior">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="referencias" class="form-label font-weight-bold">Referencias</label>
							<input type="text" class="form-control" id="referencias" name="referencias">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="narracion" class="form-label font-weight-bold">Narración del delito</label>
							<input type="text" class="form-control" id="narracion" name="narracion">
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<div class="form-group">
								<label for="lugar" class="form-label font-weight-bold">Lugar:</label>
								<select class="form-control" id="lugar" name="lugar" required>
									<option selected disabled value="">Elige el lugar del delito</option>
									<?php foreach ($body_data->lugares as $index => $lugar) { ?>
										<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>

						<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="armas" class="form-label font-weight-bold">Armas:</label>
							<textarea class="form-control" id="armas" name="armas" row="10" oninput="mayuscTextarea(this)"></textarea>
						</div> -->

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="notas_denuncia" class="form-label font-weight-bold">Notas:</label>
							<textarea class="form-control" id="notas_denuncia" name="notas_denuncia" row="10" oninput="mayuscTextarea(this)"></textarea>
						</div>


						<div class="col-12 mb-3 text-center">
							<button type="submit" id="insertFolio" name="insertFolio" class="btn btn-primary font-weight-bold btn-lg">AGREGAR FOLIO</button>
						</div>
					</form>
				</div>
				<div class="row" id="roboVehiculo" name="roboVehiculo" style="display: none;">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">VEHÍCULOS INVOLUCRADOS</h3>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary font-weight-bold btn-lg" id="habilitar-vehiculos" name="habilitar-vehiculos">Agregar vehículo</button>
						</div>
					</div>
					<div class="table-responsive">
						<table id="table-vehiculos" class="table table-bordered table-hover table-striped table-light">
							<tr>
								<th class="text-center bg-primary text-white">PLACAS</th>
								<th class="text-center bg-primary text-white">SERIE</th>
							</tr>
						</table>
					</div>
				</div>

				<div class="row " id="personasInvolucradas" name="personasInvolucradas" style="display: none;">
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button type="button" class="btn btn-primary font-weight-bold btn-lg" id="btn_update_folio">
								Actualizar hecho
							</button>
						</div>
					</div>
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">PERSONAS INVOLUCRADAS</h3>
					</div>
					<div class="row p-0 m-0">
						<div class="col-12 col-sm-6 mb-3">
							<div class="form-group">
								<label for="victima_conocido" class="form-label font-weight-bold">¿Se conoce a la victima?</label>
								<select class="form-control" id="victima_conocido" name="victima_conocido" required>
									<option selected disabled value=""></option>
									<option value="1">Si </option>
									<option value="2">No </option>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-6 mb-3">
							<div class="form-group">
								<label for="imputado_conocido" class="form-label font-weight-bold">¿Se conoce al imputado?</label>
								<select class="form-control" id="imputado_conocido" name="imputado_conocido" required>
									<option selected disabled value=""></option>
									<option value="1">Si </option>
									<option value="2">No </option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary font-weight-bold btn-lg" id="habilitar-victima" name="habilitar-victima" disabled>Agregar personas</button>
						</div>
					</div>

					<div class="table-responsive">
						<table id="table-personas" class="table table-bordered table-hover table-striped table-light">
							<tr>
								<th class="text-center bg-primary text-white" id="nombreP" name="nombreP">NOMBRE</th>
								<th class="text-center bg-primary text-white" id="calidadP" name="calidadP">CALIDAD JURÍDICA</th>
							</tr>
						</table>
					</div>
				</div>

				<div class="row" id="objetosInvolucrados" name="objetosInvolucrados" style="display: none;">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">OBJETOS INVOLUCRADOS</h3>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary font-weight-bold btn-lg" id="habilitar-objetos-involucrados" name="habilitar-objetos-involucrados" disabled>Agregar objetos involucrados</button>
						</div>
					</div>
					<div class="table-responsive">
						<table id="table-objetos-involucrados" class="table table-bordered table-hover table-striped table-light">
							<tr>
								<th class="text-center bg-primary text-white" id="objeto" name="objeto">CLASIFICACIÓN</th>
								<th class="text-center bg-primary text-white" id="clasificacion" name="clasificacion">SUBCLASIFICACIÓN</th>

							</tr>
						</table>
					</div>
				</div>

				<div class="row" id="delitosInvolucrados" name="delitosInvolucrados" style="display: none;">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">DELITOS COMETIDOS</h3>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary font-weight-bold btn-lg" id="habilitar-delito" name="habilitar-delito" disabled>Agregar arbol delictual</button>
						</div>
					</div>
					<div class="table-responsive">
						<table id="table-delitos" class="table table-bordered table-hover table-striped table-light">
							<tr>
								<th class="text-center bg-primary text-white" id="nombreImputado" name="nombreImputado">IMPUTADO</th>
								<th class="text-center bg-primary text-white" id="delitoCometido" name="delitoCometido">DELITO COMETIDO</th>
							</tr>
						</table>
					</div>
				</div>

				<div class="row" id="salida" name="salida" style="display: none;">
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary font-weight-bold btn-lg" id="habilitar-salida" name="habilitar-salida" disabled>Dar salida</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
<script>
	var inputsText = document.querySelectorAll('input[type="text"]');
	var inputsEmail = document.querySelectorAll('input[type="email"]');
	var btn_agregar_victima = document.getElementById('habilitar-victima');
	var btn_agregar_objetos = document.getElementById('habilitar-objetos-involucrados');
	var btn_salida = document.getElementById('habilitar-salida');
	var btn_update_folio = document.getElementById('btn_update_folio');

	var btn_vehiculo = document.getElementById('habilitar-vehiculos');
	var notas_caso_mp = document.getElementById('notas_denuncia');

	var btn_arbol = document.getElementById('habilitar-delito');
	var form_folio = document.getElementById('form_folio');
	var div_personasInvolucradas = document.getElementById('personasInvolucradas');
	var form_persona_fisica = document.getElementById('persona_fisica_form_insert_denunciaA');
	var form_objetosinvolucrados = document.querySelector('#form_objetos_involucrados');
	var form_fis_fis = document.querySelector('#form_fisfis_insert');
	var form_vehiculo = document.querySelector('#form_vehiculo');
	var form_update_folio = document.querySelector('#update_denuncia_form_da');

	var inputFolio = document.querySelector('#folio');
	var year_select = document.querySelector('#year');


	var select_victima = document.getElementById('victima_conocido');
	var select_imputado = document.getElementById('imputado_conocido');

	document.querySelector('#victima_conocido').addEventListener('change', (e) => {
		if (e.target.value == 1) {
			$('#insert_persona_victima_modal_denuncia').modal('show');
			document.querySelector('#calidad_juridica_new').value = 1;
			select_victima.disabled = true;
			btn_agregar_victima.disabled = false;
			btn_agregar_objetos.disabled = false;
			btn_salida.disabled = false;
			btn_arbol.disabled = false;
			$("#insert_persona_victima_modal_denuncia").one("hidden.bs.modal", function() {
				agregarPersonaFisica();
			});

		} else {
			// btn_agregar_victima.disabled = true;
			select_victima.disabled = true;
			btn_agregar_victima.disabled = false;
			btn_agregar_objetos.disabled = false;
			btn_salida.disabled = false;
			btn_arbol.disabled = false;

			document.querySelector('#calidad_juridica_new').value = 1;
			agregarPersonaFisica();


		}
	});

	document.querySelector('#imputado_conocido').addEventListener('change', (e) => {
		if (e.target.value == 1) {
			$('#insert_persona_victima_modal_denuncia').modal('show');
			document.querySelector('#calidad_juridica_new').value = 2;
			select_imputado.disabled = true;
			btn_agregar_victima.disabled = false;
			btn_agregar_objetos.disabled = false;
			btn_salida.disabled = false;
			btn_arbol.disabled = false;
			$("#insert_persona_victima_modal_denuncia").one("hidden.bs.modal", function() {
				agregarPersonaFisica();
			});

		} else {
			select_imputado.disabled = true;
			btn_agregar_victima.disabled = false;
			btn_agregar_objetos.disabled = false;
			btn_salida.disabled = false;
			btn_arbol.disabled = false;

			document.querySelector('#calidad_juridica_new').value = 2;
			agregarPersonaFisica();
		}
	});
	document.querySelector('#distribuidor_vehiculo_ad').addEventListener('change', (e) => {

		let select_marca = document.querySelector('#marca_ad');
		let select_linea = document.querySelector('#linea_vehiculo_ad');
		let select_version = document.querySelector('#version_vehiculo_ad');

		clearSelect(select_marca);
		clearSelect(select_linea);
		clearSelect(select_version);


		let data = {
			'distribuidor_vehiculo': e.target.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-marca-by-dist') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let marcaVehiculo = response.data;
				marcaVehiculo.forEach(marca_vehiculo => {
					let option = document.createElement("option");
					option.text = marca_vehiculo.VEHICULOMARCADESCR;
					option.value = marca_vehiculo.VEHICULOMARCAID;
					select_marca.add(option);
				});
				select_marca.value = '1';
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});


	document.querySelector('#marca_ad').addEventListener('change', (e) => {
		let select_linea = document.querySelector('#linea_vehiculo_ad');
		let select_version = document.querySelector('#version_vehiculo_ad');
		let select_distribuidor = document.querySelector('#distribuidor_vehiculo_ad');

		clearSelect(select_linea);
		clearSelect(select_version);

		// select_linea.value = '';
		// select_version.value = '';

		// select_version.classList.remove('d-none');

		let data = {
			'marca': e.target.value,
			'dist': select_distribuidor.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-modelo-by-marca') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let lineaVehiculo = response.data;

				lineaVehiculo.forEach(linea_vehiculo => {
					var option = document.createElement("option");
					option.text = linea_vehiculo.VEHICULOMODELODESCR;
					option.value = linea_vehiculo.VEHICULOMODELOID;
					select_linea.add(option);
				});

			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});

	document.querySelector('#linea_vehiculo_ad').addEventListener('change', (e) => {
		let select_version = document.querySelector('#version_vehiculo_ad');
		let select_distribuidor = document.querySelector('#distribuidor_vehiculo_ad');
		let select_marca = document.querySelector('#marca_ad');

		clearSelect(select_version);

		let data = {
			'linea_vehiculo': e.target.value,
			'dist': select_distribuidor.value,
			'marca': select_marca.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-version-by-modelo') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let versionVehiculo = response.data;

				versionVehiculo.forEach(version_vehiculo => {
					var option = document.createElement("option");
					option.text = version_vehiculo.VEHICULOVERSIONDESCR;
					option.value = version_vehiculo.VEHICULOVERSIONID;
					select_version.add(option);
				});

			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});
	btn_agregar_victima.addEventListener('click', (event) => {
		$('#insert_persona_victima_modal_denuncia').modal('show');
	}, false);
	btn_salida.addEventListener('click', (event) => {
		$('#salida_modal_denuncia_anonima').modal('show');
	}, false);
	btn_update_folio.addEventListener('click', (event) => {
		$.ajax({
			data: {
				'folio': document.querySelector('#folio').value,
				'year': document.querySelector('#year').value,
			},
			url: "<?= base_url('/data/get-folio-information-denuncia') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				//DENUNCIA
				const folio = response.folio;
				document.querySelector('#municipio_delito_da').value = folio.HECHOMUNICIPIOID;
				if (folio.HECHOLOCALIDADID) {
					let data = {
						'estado_id': 2,
						'municipio_id': folio.HECHOMUNICIPIOID
					};

					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							let localidades = response.data;
							let select_localidad = document.querySelector('#localidad_delito_da');

							localidades.forEach(localidad => {
								var option = document.createElement("option");
								option.text = localidad.LOCALIDADDESCR;
								option.value = localidad.LOCALIDADID;
								select_localidad.add(option);
							});

							select_localidad.value = folio.HECHOLOCALIDADID;
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});
				} else {
					document.querySelector('#localidad_delito_da').value = '';
				}

				if (folio.HECHOCOLONIAID) {
					document.querySelector('#colonia_delito_da').classList.add('d-none');
					document.querySelector('#colonia_delito_select_da').classList.remove('d-none');
					let data = {
						'estado_id': 2,
						'municipio_id': folio.HECHOMUNICIPIOID,
						'localidad_id': folio.HECHOLOCALIDADID
					};
					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							let select_colonia = document.querySelector('#colonia_delito_select_da');
							let input_colonia = document.querySelector('#colonia_delito_da');
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

							select_colonia.value = folio.HECHOCOLONIAID;
							input_colonia.value = '-';
						},
						error: function(jqXHR, textStatus, errorThrown) {

						}
					});
				} else {
					document.querySelector('#colonia_delito_da').classList.remove('d-none');
					document.querySelector('#colonia_delito_select_da').classList.add('d-none');
					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					document.querySelector('#colonia_delito_select_da').add(option);
					document.querySelector('#colonia_delito_select_da').value = '0';
					document.querySelector('#colonia_delito_da').value = folio.HECHOCOLONIADESCR;
				}
				document.querySelector('#calle_delito_da').value = folio.HECHOCALLE;
				document.querySelector('#exterior_delito_da').value = folio.HECHONUMEROCASA;
				document.querySelector('#interior_delito_da').value = folio.HECHONUMEROCASAINT;
				document.querySelector('#lugar_delito_da').value = folio.HECHOLUGARID;
				document.querySelector('#hora_delito_da').value = folio.HECHOHORA;
				document.querySelector('#fecha_delito_da').value = folio.HECHOFECHA;
				document.querySelector('#narracion_delito_da').value = folio.HECHONARRACION;

			}
		});
		$('#update_denuncia').modal('show');
	}, false);
	btn_agregar_objetos.addEventListener('click', (event) => {
		$('#insert_objetos_modal_denuncia').modal('show');
	}, false);

	btn_vehiculo.addEventListener('click', (event) => {
		$('#insert_vehiculo_modal_denuncia').modal('show');
	}, false);
	btn_arbol.addEventListener('click', (event) => {
		$('#insert_fisfis_modal_denuncia').modal('show');
	}, false);

	form_folio.addEventListener('submit', (event) => {
		if (!form_folio.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_folio.classList.remove('was-validated')
			agregarFolio();
		}
	}, false);
	form_persona_fisica.addEventListener('submit', (event) => {
		if (!form_persona_fisica.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_persona_fisica.classList.remove('was-validated')
			agregarPersonaFisica();
		}
	}, false);

	form_update_folio.addEventListener('submit', (event) => {
		if (!form_update_folio.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_update_folio.classList.remove('was-validated')
			updateFolio();
		}
	}, false);
	form_fis_fis.addEventListener('submit', (event) => {
		if (!form_fis_fis.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_fis_fis.classList.remove('was-validated')
			insertarRelacionIDO();
			insertar_impdelito();
		}
	}, false);
	form_objetosinvolucrados.addEventListener('submit', (event) => {
		if (!form_objetosinvolucrados.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_objetosinvolucrados.classList.remove('was-validated')
			agregarObjetosInvolucrados();
		}
	}, false);
	form_vehiculo.addEventListener('submit', (event) => {
		if (!form_vehiculo.checkValidity()) {
			event.preventDefault();
			event.stopPropagation();
		} else {
			event.preventDefault();
			event.stopPropagation();
			form_vehiculo.classList.remove('was-validated')
			agregarVehiculosInvolucrados();
		}
	}, false);
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

	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
	}

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	function pulsar(e) {
		if (e.which === 13 && !e.shiftKey) {
			e.preventDefault();
			return false;
		}
	}

	function clearText(text) {
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
	}


	document.querySelector('#municipio').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad');

		let estado = 2;
		let municipio = e.target.value;

		clearSelect(select_localidad);

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
				clearSelect(select_localidad);
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
	document.querySelector('#localidad').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select');
		let input_colonia = document.querySelector('#colonia');

		let estado = 2;
		let municipio = document.querySelector('#municipio').value;
		let localidad = e.target.value;
		clearSelect(select_colonia);
		select_colonia.value = '';
		input_colonia.value = '';
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
				clearSelect(select_colonia);
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
	document.querySelector('#municipio_delito_da').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_delito_da');

		let estado = 2;
		let municipio = e.target.value;

		clearSelect(select_localidad);

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
				clearSelect(select_localidad);
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
	document.querySelector('#localidad_delito_da').addEventListener('change', (e) => {
		document.querySelector('#colonia_delito_da').classList.add('d-none');
		document.querySelector('#colonia_delito_select_da').classList.remove('d-none');
		let select_colonia = document.querySelector('#colonia_delito_select_da');
		let input_colonia = document.querySelector('#colonia_delito_da');

		let estado = 2;
		let municipio = document.querySelector('#municipio_delito_da').value;
		let localidad = e.target.value;
		clearSelect(select_colonia);
		select_colonia.value = '';
		input_colonia.value = '';
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
				clearSelect(select_colonia);
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

	});
	document.querySelector('#colonia_delito_select_da').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_delito_select_da');
		let input_colonia = document.querySelector('#colonia_delito_da');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});

	function agregarFolio() {
		const data = {
			// 'delito_cometido': document.querySelector('#delito_cometido_folio').value,
			'municipio_delito': document.querySelector('#municipio').value,
			'localidad_delito': document.querySelector('#localidad').value,
			'colonia_delito': document.querySelector('#colonia').value,
			'colonia_delito_select': document.querySelector('#colonia_select').value,
			'calle_delito': document.querySelector('#calle').value,
			'exterior_delito': document.querySelector('#exterior').value,
			'interior_delito': document.querySelector('#interior').value,
			'lugar_delito': document.querySelector('#lugar').value,
			'fecha_delito': document.querySelector('#fecha').value,
			'hora_delito': document.querySelector('#hora').value,
			'narracion_delito': document.querySelector('#narracion').value,
			'referencia_delito': document.querySelector('#referencias').value,
			'notas': document.querySelector('#notas').value,
		};

		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-folio-denuncia-anonima') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					// if (document.querySelector('#delito_cometido_folio').value == "ROBO DE VEHÍCULO") {
					// 	document.getElementById("roboVehiculo").style.display = "block";
					// }
					document.getElementById("personasInvolucradas").style.display = "block";

					document.getElementById("foliodiv").style.display = "none";
					document.getElementById('folio').value = response.folio;
					document.getElementById('folio').disabled = true;

					document.getElementById('year').value = response.year;
					document.getElementById('year').disabled = true;
					document.getElementById("objetosInvolucrados").style.display = "block";
					document.getElementById("delitosInvolucrados").style.display = "block";
					document.getElementById("salida").style.display = "block";
					Swal.fire({
						icon: 'success',
						text: 'Denuncia agregada correctamente',
						confirmButtonColor: '#bf9b55',
					});

				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó la denuncia',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire({
					icon: 'error',
					text: 'No se agregó la denuncia',
					confirmButtonColor: '#bf9b55',
				});
			}
		});
	}

	function agregarPersonaFisica() {
		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'nombre': document.querySelector('#nombre_new').value,
			'primer_apellido': document.querySelector('#apellido_paterno_new').value,
			'segundo_apellido': document.querySelector('#apellido_materno_new').value,
			'fecha_nacimiento': document.querySelector('#fecha_nacimiento_new').value,
			'edad': document.querySelector('#edad_new').value,
			'sexo': document.querySelector('#sexo_new').checked ? document.querySelector('#sexo_new').value : null,
			'codigo_pais_pfc': document.querySelector('#codigo_pais_new').value,
			'codigo_pais_pfc_2': document.querySelector('#codigo_pais_2_new').value,
			'calidad_juridica': document.querySelector('#calidad_juridica_new').value,
			'municipio_origen': document.querySelector('#municipio_select_origen_new').value,
			'telefono': document.querySelector('#telefono_new').value,
			'telefono_adicional': document.querySelector('#telefono_new2').value,
			'nacionalidad_origen': document.querySelector('#nacionalidad_new').value,
			'estado_origen': document.querySelector('#estado_select_origen_new').value,
			'idioma': document.querySelector('#idioma_new').value,
			'pais_actual': document.querySelector('#pais_select_new').value,
			'estado_actual': document.querySelector('#estado_select_new').value,
			'municipio_actual': document.querySelector('#municipio_select_new').value,
			'localidad_actual': document.querySelector('#localidad_select_new').value,
			'colonia_actual': document.querySelector('#colonia_select_new').value,
			'colonia_actual_descr': document.querySelector('#colonia_new').value,
			'codigo_postal': document.querySelector('#cp_new').value,
			'calle': document.querySelector('#calle_new').value,
			'num_exterior': document.querySelector('#exterior_new').value,
			'num_interior': document.querySelector('#interior_new').value,
			'identificacion': document.querySelector('#identificacion_new').value,
			'numero_identificacion': document.querySelector('#numero_ide_new').value,
			'estado_civil': document.querySelector('#e_civil_new').value,
			'escolaridad': document.querySelector('#escolaridad_new').value,
			'ocupacion': document.querySelector('#ocupacion_new').value,
			'discapacidad': document.querySelector('#discapacidad_new').value,
			'leer': document.querySelector('#leer_new').value,
			'escribir': document.querySelector('#escribir_new').value,
			'facebook': document.querySelector('#facebook_new').value,
			'twitter': document.querySelector('#twitter_new').value,
			'instagram': document.querySelector('#instagram_new').value,
			'correo': document.querySelector('#correo_new').value,
			'desaparecida': document.querySelector('#desaparecida_new').value,
			'victima_conocido': document.querySelector('#victima_conocido').value,
			'imputado_conocido': document.querySelector('#imputado_conocido').value,

			'ocupacion_mf': document.querySelector('#ocupacion_mf1').value,
			'estatura_mf': document.querySelector('#estatura_mf1').value,
			'peso_mf': document.querySelector('#peso_mf1').value,
			'senas_mf': document.querySelector('#senas_mf1').value,
			'colortez_mf': document.querySelector('#colortez_mf1').value,
			'complexion_mf': document.querySelector('#complexion_mf1').value,
			'contextura_ceja_mf': document.querySelector('#contextura_ceja_mf1').value,
			'cara_forma_mf': document.querySelector('#cara_forma_mf1').value,
			'cara_tamano_mf': document.querySelector('#cara_tamano_mf1').value,
			'caratez_mf': document.querySelector('#caratez_mf1').value,
			'lobulo_mf': document.querySelector('#lobulo_mf1').value,
			'forma_oreja_mf': document.querySelector('#forma_oreja_mf1').value,
			'tamano_oreja_mf': document.querySelector('#tamano_oreja_mf1').value,
			'colorC_mf': document.querySelector('#colorC_mf1').value,
			'formaC_mf': document.querySelector('#formaC_mf1').value,
			'tamanoC_mf': document.querySelector('#tamanoC_mf1').value,
			'peculiarC_mf': document.querySelector('#peculiarC_mf1').value,
			'cabello_descr_mf': document.querySelector('#cabello_descr_mf1').value,
			'frente_altura_mf': document.querySelector('#frente_altura_mf1').value,
			'frente_anchura_ms': document.querySelector('#frente_anchura_mf1').value,
			'tipoF_mf': document.querySelector('#tipoF_mf1').value,
			'frente_peculiar_mf': document.querySelector('#frente_peculiar_mf1').value,
			'colocacion_ceja_mf': document.querySelector('#colocacion_ceja_mf1').value,
			'ceja_mf': document.querySelector('#ceja_mf1').value,
			'tamano_ceja_mf': document.querySelector('#tamano_ceja_mf1').value,
			'grosor_ceja_mf': document.querySelector('#grosor_ceja_mf1').value,
			'colocacion_ojos_mf': document.querySelector('#colocacion_ojos_mf1').value,
			'forma_ojos_mf': document.querySelector('#forma_ojos_mf1').value,
			'tamano_ojos_mf': document.querySelector('#tamano_ojos_mf1').value,
			'colorO_mf': document.querySelector('#colorO_mf1').value,
			'peculiaridad_ojos_mf': document.querySelector('#peculiaridad_ojos_mf1').value,
			'nariz_tipo_mf': document.querySelector('#nariz_tipo_mf1').value,
			'nariz_tamano_mf': document.querySelector('#nariz_tamano_mf1').value,
			'nariz_base_mf': document.querySelector('#nariz_base_mf1').value,
			'nariz_peculiar_mf': document.querySelector('#nariz_peculiar_mf1').value,
			'nariz_descr_mf': document.querySelector('#nariz_descr_mf1').value,
			'bigote_forma_mf': document.querySelector('#bigote_forma_mf1').value,
			'bigote_tamaño_mf': document.querySelector('#bigote_tamaño_mf1').value,
			'bigote_grosor_mf': document.querySelector('#bigote_grosor_mf1').value,
			'bigote_peculiar_mf': document.querySelector('#bigote_peculiar_mf1').value,
			'bigote_descr_mf': document.querySelector('#bigote_descr_mf1').value,
			'boca_tamano_mf': document.querySelector('#boca_tamano_mf1').value,
			'boca_peculiar_mf': document.querySelector('#boca_peculiar_mf1').value,
			'labio_longitud_mf': document.querySelector('#labio_longitud_mf1').value,
			'labio_posicion_mf': document.querySelector('#labio_posicion_mf1').value,
			'labio_peculiar_mf': document.querySelector('#labio_peculiar_mf1').value,
			'labio_grosor_mf': document.querySelector('#labio_grosor_mf1').value,
			'dientes_tamano_mf': document.querySelector('#dientes_tamano_mf1').value,
			'dientes_tipo_mf': document.querySelector('#dientes_tipo_mf1').value,
			'dientes_peculiar_mf': document.querySelector('#dientes_peculiar_mf1').value,
			'dientes_descr_mf': document.querySelector('#dientes_descr_mf1').value,
			'barbilla_forma_mf': document.querySelector('#barbilla_forma_mf1').value,
			'barbilla_tamano_mf': document.querySelector('#barbilla_tamano_mf1').value,
			'barbilla_inclinacion_mf': document.querySelector('#barbilla_inclinacion_mf1').value,
			'barbilla_peculiar_mf': document.querySelector('#barbilla_peculiar_mf1').value,
			'barbilla_descr_mf': document.querySelector('#barbilla_descr_mf1').value,
			'barba_tamano_mf': document.querySelector('#barba_tamano_mf1').value,
			'barba_peculiar_mf': document.querySelector('#barba_peculiar_mf1').value,
			'barba_descr_mf': document.querySelector('#barba_descr_mf1').value,
			'cuello_tamano_mf': document.querySelector('#cuello_tamano_mf1').value,
			'cuello_grosor_mf': document.querySelector('#cuello_grosor_mf1').value,
			'cuello_peculiar_mf': document.querySelector('#cuello_peculiar_mf1').value,
			'cuello_descr_mf': document.querySelector('#cuello_descr_mf1').value,
			'hombro_posicion_mf': document.querySelector('#hombro_posicion_mf1').value,
			'hombro_tamano_mf': document.querySelector('#hombro_tamano_mf1').value,
			'hombro_grosor_mf': document.querySelector('#hombro_grosor_mf1').value,
			'estomago_mf': document.querySelector('#estomago_mf1').value,
			'escolaridad_mf': document.querySelector('#escolaridad_mf1').value,
			'etnia_mf': document.querySelector('#etnia_mf1').value,
			'estomago_descr_mf': document.querySelector('#estomago_descr_mf1').value,
			'discapacidad_mf': document.querySelector('#discapacidad_mf1').value,
			'diaDesaparicion': document.querySelector('#diaDesaparicion1').value,
			'lugarDesaparicion': document.querySelector('#lugarDesaparicion1').value,
			'vestimenta_mf': document.querySelector('#vestimenta_mf1').value,


		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-persona_fisica-by-denuncia-anonima') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Persona fisica agregada correctamente',
						confirmButtonColor: '#bf9b55',
					});
					const delitosModalidadFiltro = response.delitosModalidadFiltro;
					const imputados = response.imputados;
					const victimas = response.victimas;
					const personas = response.personas;
					$('#victima_ofendido').empty();
					let select_victima_ofendido = document.querySelector("#victima_ofendido")
					victimas.forEach(victima => {
						const option = document.createElement('option');
						option.value = victima.PERSONAFISICAID;
						option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO;
						select_victima_ofendido.add(option, null);
					});

					$('#imputado_arbol').empty();
					let select_imputado_mputado = document.querySelector("#imputado_arbol")
					imputados.forEach(imputado => {
						const option = document.createElement('option');
						option.value = imputado.PERSONAFISICAID;
						option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
						select_imputado_mputado.add(option, null);

					});
					let tabla_personas = document.querySelectorAll('#table-personas tr');
					tabla_personas.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});

					llenarTablaPersonas(response.personas);
					// $('#personaFisica1_I').empty();
					// let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
					// const option_vacio = document.createElement('option');
					// option_vacio.value = '';
					// option_vacio.text = '';
					// option_vacio.disabled = true;
					// option_vacio.selected = true;
					// select_personaFisica1_I.add(option_vacio, null);
					// personas.forEach(persona => {
					// 	const option = document.createElement('option');
					// 	option.value = persona.PERSONAFISICAID;
					// 	option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
					// 	select_personaFisica1_I.add(option, null);
					// });
					$('#propietario').empty();
					let select_propietario = document.querySelector("#propietario");
					const option_vacio_pro = document.createElement('option');
					option_vacio_pro.value = '';
					option_vacio_pro.text = '';
					option_vacio_pro.disabled = true;
					option_vacio_pro.selected = true;
					select_propietario.add(option_vacio_pro, null);

					personas.forEach(persona => {
						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
						select_propietario.add(option, null);
					});
					$('#insert_persona_victima_modal_denuncia').modal('hide');
					document.getElementById("persona_fisica_form_insert_denunciaA").reset();

				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó la información de la persona fisica',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	function agregarObjetosInvolucrados() {

		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'situacion': document.querySelector('#situacion_objeto').value,
			'clasificacionid': document.querySelector('#objeto_clasificacion').value,
			'subclasificacionid': document.querySelector('#objeto_subclasificacion').value,
			'marca': document.querySelector('#marca_objeto').value,
			'numserie': document.querySelector('#serie_objeto').value,
			'cantidad': document.querySelector('#cantidad_objeto').value,
			'valor': document.querySelector('#valor_objeto').value,
			'moneda': document.querySelector('#tipo_moneda').value,
			'descripciondetallada': document.querySelector('#descripcion_detallada').value,
			'propietario': document.querySelector('#propietario').value,
			'participaestado': document.querySelector('#participa_estado_objeto').value,
		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-objeto-involucrado-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				const objetos = response.objetos;
				const personas = response.personas;
				if (response.status == 1) {


					Swal.fire({
						icon: 'success',
						text: 'Objeto añadido correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_objetos_involucrados = document.querySelectorAll('#table-objetos-involucrados tr');
					tabla_objetos_involucrados.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaObjetosInvolucrados(response.objetos);
					$('#insert_objetos_modal_denuncia').modal('hide');
					document.getElementById("form_objetos_involucrados").reset();
					$('#objeto_subclasificacion').empty();
					$('#propietario').empty();
					let select_propietario = document.querySelector("#propietario");
					const option_vacio = document.createElement('option');
					option_vacio.value = "";
					option_vacio.text = "";
					option_vacio.disabled = true;
					option_vacio.selected = true;
					select_propietario.add(option_vacio, null);
					personas.forEach(persona => {
						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
						select_propietario.add(option, null);
					});

				} else if (response.status == 0) {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó el objeto involucrado',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function insertarRelacionIDO() {
		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'victima': document.querySelector('#victima_ofendido').value,
			'delito': document.querySelector('#delito_cometido').value,
			'imputado': document.querySelector('#imputado_arbol').value,
		};
		// console.log(data);
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-relacion_ido-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.status == 3) {
					Swal.fire({
						icon: 'error',
						text: 'Esta relación de delito ya existe',
						confirmButtonColor: '#bf9b55',
					});
				} else if (response.status == 1) {

					Swal.fire({
						icon: 'success',
						text: 'Delito agregado correctamente',
						confirmButtonColor: '#bf9b55',
					});

				} else if (response.status == 0) {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó el delito.',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function insertar_impdelito() {
		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'delito': document.querySelector('#delito_cometido').value,
			'imputado': document.querySelector('#imputado_arbol').value,
		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-fisimpdelito-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {

				if (response.status == 3) {
					Swal.fire({
						icon: 'error',
						text: 'Este delito ya existe en este folio',
						confirmButtonColor: '#bf9b55',
					});
				}
				if (response.status == 1) {
					let tabla_fisimpdelito = document.querySelectorAll('#table-delitos tr');
					tabla_fisimpdelito.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});

					llenarTablaImpDel(response.fisicaImpDelito);
					Swal.fire({
						icon: 'success',
						text: 'Relacion IMPUTADO-DELITO ingresado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					$('#insert_fisfis_modal_denuncia').modal('hide');
					document.getElementById("form_fisfis_insert").reset();

					// document.getElementById("form_delitos_cometidos_insert").reset();
					// const delitosModalidadFiltro = response.delitosModalidadFiltro;
					// $('#delito_cometido').empty();
					// let select_delitos_imputado = document.querySelector("#delito_cometido")
					// delitosModalidadFiltro.forEach(modalidad => {
					// 	const option = document.createElement('option');
					// 	option.value = modalidad.DELITOMODALIDADID;
					// 	option.text = modalidad.DELITOMODALIDADDESCR;
					// 	select_delitos_imputado.add(option, null);

					// });

				} else if (response.status == 0) {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó la información de la relacion',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function agregarVehiculosInvolucrados() {
		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'tipo_vehiculo': document.querySelector('#tipo_vehiculo').value,
			'color_vehiculo': document.querySelector('#color_vehiculo').value,
			'tipo_placas_vehiculo': document.querySelector('#tipo_placas_vehiculo').value,
			'placas_vehiculo': document.querySelector('#placas_vehiculo').value,
			'estado_vehiculo_ad': document.querySelector('#estado_vehiculo_ad').value,
			'estado_extranjero_vehiculo_ad': document.querySelector('#estado_extranjero_vehiculo_ad').value,
			'serie_vehiculo': document.querySelector('#serie_vehiculo').value,
			'num_chasis_vehiculo': document.querySelector('#num_chasis_vehiculo').value,
			'distribuidor_vehiculo_ad': document.querySelector('#distribuidor_vehiculo_ad').value,
			'marca_ad': document.querySelector('#marca_ad').value,
			'linea_vehiculo_ad': document.querySelector('#linea_vehiculo_ad').value,
			'version_vehiculo_ad': document.querySelector('#version_vehiculo_ad').value,
			'transmision_vehiculo': document.querySelector('#transmision_vehiculo').value,
			'traccion_vehiculo': document.querySelector('#traccion_vehiculo').value,
			'seguro_vigente_vehiculo': document.querySelector('#seguro_vigente_vehiculo').value,
			'servicio_vehiculo_ad': document.querySelector('#servicio_vehiculo_ad').value,
			'description_vehiculo': document.querySelector('#description_vehiculo').value,
			'modelo_vehiculo': document.querySelector('#modelo_vehiculo').value,
			'color_tapiceria_vehiculo': document.querySelector('#color_tapiceria_vehiculo').value,
		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/create-vehiculo-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				// console.log(respobse.idcalidad);
				if (response.status == 1) {
					const vehiculos = response.vehiculos;
					Swal.fire({
						icon: 'success',
						text: 'Vehículo agregado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_vehiculo = document.querySelectorAll('#table-vehiculos tr');
					tabla_vehiculo.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaVehiculos(vehiculos);
					$('#insert_vehiculo_modal_denuncia').modal('hide');
					document.getElementById("form_vehiculo").reset();
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se agregó la información del vehículo',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function llenarTablaPersonas(personas) {
		for (let i = 0; i < personas.length; i++) {

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${personas[i].NOMBRE}</td>` +
				`<td class="text-center">${personas[i].PERSONACALIDADJURIDICADESCR}</td>` +
				`</tr>`;

			$('#table-personas tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#personas tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function llenarTablaObjetosInvolucrados(objetos) {
		for (let i = 0; i < objetos.length; i++) {

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${objetos[i].CLASIFICACIONID}">${objetos[i].OBJETOCLASIFICACIONDESCR}</td>` +
				`<td class="text-center" value="${objetos[i].SUBCLASIFICACIONID}">${objetos[i].OBJETOSUBCLASIFICACIONDESCR}</td>` +
				`</tr>`;

			$('#table-objetos-involucrados tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#objetos-involucrados tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function llenarTablaImpDel(impDelito) {
		for (let i = 0; i < impDelito.length; i++) {
			// var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarImputadoDelito(${impDelito[i].PERSONAFISICAID},${impDelito[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${impDelito[i].PERSONAFISICAID}">${impDelito[i].NOMBRE}</td>` +
				`<td class="text-center" value="${impDelito[i].DELITOMODALIDADID}">${impDelito[i].DELITOMODALIDADDESCR}</td>` +
				// `<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-delitos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#delito-cometidos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function llenarTablaVehiculos(vehiculos) {
		for (let i = 0; i < vehiculos.length; i++) {
			var fila3 =
				`<tr id="row${i}">` +
				`<td class="text-center">${vehiculos[i].PLACAS?vehiculos[i].PLACAS:'DESCONOCIDO'}</td>` +
				`<td class="text-center">${vehiculos[i].NUMEROSERIE?vehiculos[i].NUMEROSERIE:'DESCONOCIDO'}</td>` +
				`</tr>`;

			$('#table-vehiculos tr:first').after(fila3);
			$("#adicionados").text("");
			var nFilas = $("#vehiculos tr").length;
			$("#vehiculos").append(nFilas - 1);
		}
	}

	function updateFolio() {
		const data = {
			'folio': document.querySelector('#folio').value,
			'year': document.querySelector('#year').value,
			'municipio_delito': document.querySelector('#municipio_delito_da').value,
			'localidad_delito': document.querySelector('#localidad_delito_da').value,
			'colonia_delito': document.querySelector('#colonia_delito_da').value,
			'colonia_delito_select': document.querySelector('#colonia_delito_select_da').value,
			'calle_delito': document.querySelector('#calle_delito_da').value,
			'exterior_delito': document.querySelector('#exterior_delito_da').value,
			'interior_delito': document.querySelector('#interior_delito_da').value,
			'lugar_delito': document.querySelector('#lugar_delito_da').value,
			'fecha_delito': document.querySelector('#fecha_delito_da').value,
			'hora_delito': document.querySelector('#hora_delito_da').value,
			'narracion_delito': document.querySelector('#narracion_delito_da').value,
		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/update-denuncia-by-id-anonima') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Denuncia actualizada correctamente',
						confirmButtonColor: '#bf9b55',
					});
					$('#update_denuncia').modal('hide');

				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se actualizó la denuncia',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire({
					icon: 'error',
					text: 'No se actualizó la denuncia',
					confirmButtonColor: '#bf9b55',
				});
			}
		});
	}
</script>


<?php $this->endSection() ?>
