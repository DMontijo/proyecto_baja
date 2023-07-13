<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="row">
		<div class="col-12 text-center mb-4">
			<h2 class="font-weight-bold mb-3">EDITAR PERSONA MORAL</h2>
			<a class="link link-primary" href="<?= base_url('admin/dashboard/lista_moral') ?>" role="button"><i class="fas fa-reply"></i> Regresar a lista de personas morales</a>
		</div>
		<div class="col-12">
			<div class="card shadow border-0 rounded">
				<div class="card-body">
					<form id="form-actualizar-moral" class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/editar_persona_moral" method="POST" enctype="multipart/form-data" novalidate>
						<div class="row">
							<input type="text" name="id" value="<?= $body_data->personasmorales->PERSONAMORALID ?>" hidden readonly>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="marca_comercial">Marca comercial</label>
								<input type="text" name="marca_comercial" class="form-control" id="marca_comercial" value="<?= $body_data->personasmorales->MARCACOMERCIAL ?>">
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="razon_social">Razón social</label>
								<input type="text" name="razon_social" class="form-control" id="razon_social" value="<?= $body_data->personasmorales->RAZONSOCIAL ?>" required>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="rfc">RFC</label>
								<input type="text" name="rfc" class="form-control" id="rfc" value="<?= $body_data->personasmorales->RFC ?>">
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="estado_empresa">Estado</label>
								<select class="form-control" id="estado_empresa" name="estado_empresa" required>
									<option selected disabled value="">Selecciona el estado</option>
									<?php foreach ($body_data->estados as $index => $estado) { ?>
										<option value="<?= $estado->ESTADOID ?>" <?= $estado->ESTADOID == $body_data->personasmorales->ESTADOID ? 'selected' : '' ?>>
											<?= $estado->ESTADODESCR ?> </option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="municipio_empresa">Municipio</label>
								<select class="form-control" id="municipio_empresa" name="municipio_empresa" required>
									<option selected disabled value="">Selecciona el municipio</option>
									<?php foreach ($body_data->municipios as $index => $municipio) { ?>
										<option value="<?= $municipio->MUNICIPIOID ?>" <?= $municipio->MUNICIPIOID == $body_data->personasmorales->MUNICIPIOID ? 'selected' : '' ?>>
											<?= $municipio->MUNICIPIODESCR ?> </option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="localidad_empresa">Localidad</label>
								<input type="text" name="localidad_empresa_extra" class="form-control d-none" id="localidad_empresa_extra" value="<?= $body_data->personasmorales->LOCALIDADID ?>" disabled>

								<select class="form-control" id="localidad_empresa" name="localidad_empresa" required>
									<option selected disabled value="">Selecciona la localidad</option>
									<?php foreach ($body_data->localidades as $index => $localidad) { ?>
										<option value="<?= $localidad->LOCALIDADID ?>" <?= $localidad->LOCALIDADID == $body_data->personasmorales->LOCALIDADID ? 'selected' : '' ?>>
											<?= $localidad->LOCALIDADDESCR ?> </option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="colonia_empresa">Colonia</label>
								<input type="text" name="colonia_empresa_extra" class="form-control d-none" id="colonia_empresa_extra" value="<?= $body_data->personasmorales->COLONIAID ?>" disabled>

								<select class="form-control" id="colonia_empresa" name="colonia_empresa">
									<option selected disabled value="">Selecciona la colonia</option>
									<?php foreach ($body_data->colonias as $index => $colonia) { ?>
										<option value="<?= $colonia->COLONIAID ?>" <?= $colonia->COLONIAID == $body_data->personasmorales->COLONIAID ? 'selected' : '' ?>>
											<?= $colonia->COLONIADESCR ?> </option>
									<?php } ?>
								</select>
								<input type="text" class="form-control" id="colonia_input_empresa" name="colonia_input_empresa" maxlength="100" required value="<?= $body_data->personasmorales->COLONIADESCR ?>">

							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="rfc">Calle</label>
								<input type="text" name="calle_empresa" class="form-control" id="calle_empresa" value="<?= $body_data->personasmorales->CALLE ?>">
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="numero_empresa">Número exterior</label>
								<input type="text" name="numero_empresa" class="form-control" id="numero_empresa" value="<?= $body_data->personasmorales->NUMERO ?>">
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="numeroi_empresa">Número interior</label>
								<input type="text" name="numeroi_empresa" class="form-control" id="numeroi_empresa" value="<?= $body_data->personasmorales->NUMEROINTERIOR ?>">
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="referencias_empresa">Referencias</label>
								<input type="text" name="referencias_empresa" class="form-control" id="referencias_empresa" value="<?= $body_data->personasmorales->REFERENCIA ?>">
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="telefono_empresa">Telefono</label>
								<input type="number" name="telefono_empresa" class="form-control" id="telefono_empresa" value="<?= $body_data->personasmorales->TELEFONO ?>" minlenght="10" maxlength="10" oninput="clearInputPhone(event);">
							</div>


							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="correo_empresa">Correo eléctronico</label>
								<input type="email" name="correo_empresa" class="form-control" id="correo_empresa" value="<?= $body_data->personasmorales->CORREO ?>">
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="giro_empresa">Giro</label>
								<select class="form-control" id="giro_empresa" name="giro_empresa" required>
									<option selected disabled value="">Selecciona el giro</option>
									<?php foreach ($body_data->giros as $index => $giro) { ?>
										<option value="<?= $giro->PERSONAMORALGIROID ?>" <?= $giro->PERSONAMORALGIROID == $body_data->personasmorales->PERSONAMORALGIROID ? 'selected' : '' ?>>
											<?= $giro->PERSONAMORALGIRODESCR ?> </option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 pt-5 text-center">
								<button type="submit" id="btn-submit-moral" class="btn btn-primary font-weight-bold">
									ACTUALIZAR PERSONA MORAL
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function() {
			'use strict';
			//Declaracion de elementos
			const inputsText = document.querySelectorAll('input[type="text"]');
			const inputsEmail = document.querySelectorAll('input[type="email"]');
			const municipio = document.querySelector('#municipio');
			const oficina_select = document.querySelector('#oficina');
			const form_actualizar_moral = document.querySelector('#form-actualizar-moral');

			const colonia_empresa_extra = document.querySelector('#colonia_empresa_extra');
			const localidad_empresa_extra = document.querySelector('#localidad_empresa_extra');
			if (colonia_empresa_extra.value && colonia_empresa_extra.value != '0') {
				let select_municipio = document.querySelector('#municipio_empresa');
				let select_estado = document.querySelector('#estado_empresa');
				let select_localidad = document.querySelector('#localidad_empresa');

				document.querySelector('#colonia_input_empresa').classList.add('d-none');
				document.querySelector('#colonia_empresa').classList.remove('d-none');
				let data = {
					'estado_id': select_estado.value,
					'municipio_id': select_municipio.value,
					'localidad_id': select_localidad.value
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let select_colonia = document.querySelector(
							'#colonia_empresa');
						let input_colonia = document.querySelector(
							'#colonia_input_empresa');
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

						select_colonia.value = <?= json_encode($body_data->personasmorales->COLONIAID) ?>;
						input_colonia.value = '-';
					},
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});
			} else if (colonia_empresa_extra.value == '0') {
				document.querySelector('#colonia_input_empresa').classList.remove('d-none');
				document.querySelector('#colonia_empresa').classList.add('d-none');
				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				document.querySelector('#colonia_empresa').add(option);
				document.querySelector('#colonia_empresa').value = '0';
				document.querySelector('#colonia_input_empresa').value = <?= json_encode($body_data->personasmorales->COLONIADESCR) ?>;
			} else {
				document.querySelector('#colonia_input_empresa').classList.remove('d-none');
				document.querySelector('#colonia_empresa').classList.add('d-none');
				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				document.querySelector('#colonia_empresa').add(option);
				document.querySelector('#colonia_empresa').value = '0';
				document.querySelector('#colonia_input_empresa').value = <?= json_encode($body_data->personasmorales->COLONIADESCR) ?>;
			}

			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

			document.querySelector('#estado_empresa').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_empresa');
				let select_localidad = document.querySelector('#localidad_empresa');
				let select_colonia = document.querySelector('#colonia_empresa');
				let input_colonia = document.querySelector('#colonia_input_empresa')

				select_municipio.disabled = true;
				select_localidad.disabled = true;
				select_colonia.disabled = true;

				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

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
						select_municipio.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			//Evento change para obtener la localidad de acuerdo al municipio. Limpia los select para que no se acumulen

			document.querySelector('#municipio_empresa').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_empresa');
				let select_colonia = document.querySelector('#colonia_empresa');
				let input_colonia = document.querySelector('#colonia_input_empresa')
				//deshabilita los select de localidad y colonia en caso de que cambien de municipio

				select_localidad.disabled = true;
				select_colonia.disabled = true;

				let estado = document.querySelector('#estado_empresa').value;
				let municipio = e.target.value;

				clearSelect(select_localidad);
				clearSelect(select_colonia);
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

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
						console.log('Localidades');
						clearSelect(select_localidad);
						clearSelect(select_colonia);
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
			//Evento change para obtener la colonia de acuerdo al municipio, localidad y estado. Limpia los select para que no se acumulen

			document.querySelector('#localidad_empresa').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_empresa');
				let input_colonia = document.querySelector('#colonia_input_empresa');

				select_colonia.disabled = true;

				let estado = document.querySelector('#estado_empresa').value;
				let municipio = document.querySelector('#municipio_empresa').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

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
						console.log(response);
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
						select_colonia.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});
			});

			//Evento change de colonias para modifica estilos 
			document.querySelector('#colonia_empresa').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_empresa');
				let input_colonia = document.querySelector('#colonia_input_empresa');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
				} else {
					input_colonia.value = '-';
				}
			});



			//Convierte todos los input text a mayusculas
			inputsText.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toUpperCase();
				}, false)
			});
			//Convierte todos los input email a minusculas

			inputsEmail.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toLowerCase();
				}, false)
			});




			//VAlidacion de formularios submit
			form_actualizar_moral.addEventListener('submit', function(event) {
				document.querySelector('#btn-submit-moral').setAttribute('disabled', true);
				if (!form_actualizar_moral.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					document.querySelector('#btn-submit-moral').removeAttribute('disabled');
					form_actualizar_moral.classList.add('was-validated')

				}
				form_actualizar_moral.classList.add('was-validated');
			}, false);
		})();
		//Elimina todos los caracteres especiales del texto

		function clearText(text) {
			return text
				.normalize('NFD')
				.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize()
				.replaceAll('´', '');
		}
		//Elimina todos los options de un select

		function clearSelect(select_element) {
			for (let i = select_element.options.length; i >= 1; i--) {
				select_element.remove(i);
			}
		}
		// Funcion para eliminar los guiones del valor del campo y limita la longitud del valor al maxLength especificado.
		function clearInputPhone(e) {
			e.target.value = e.target.value.replace(/-/g, "");
			if (e.target.value.length > e.target.maxLength) {
				e.target.value = e.target.value.slice(0, e.target.maxLength);
			};
		}
	</script>
	<?= $this->endSection() ?>