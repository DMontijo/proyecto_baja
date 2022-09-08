<form id="persona_fisica_form_insert" action="" method="post" class="row needs-validation" novalidate>
	<div class="col-12 mb-3">
		<h3 class="font-weight-bold mb-4 text-center">DATOS DE LA PERSONA FÍSICA</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_new" class="form-label font-weight-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_new" name="nombre_new" maxlength="100" required>
		<div class="invalid-feedback">
			El nombre es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_new" class="form-label font-weight-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_new" name="apellido_paterno_new" maxlength="50" required>
		<div class="invalid-feedback">
			El apellido paterno es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_new" class="form-label font-weight-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_new" name="apellido_materno_new" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_new" class="form-label font-weight-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_new" name="fecha_nacimiento_new" required max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">
		<div class="invalid-feedback">
			La fecha de nacimiento es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_new" class="form-label font-weight-bold">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_new" name="edad_new">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_new" class="form-label font-weight-bold">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="M" required>
			<label class="form-check-label" for="sexo_new">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="F" required>
			<label class="form-check-label" for="sexo_new">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_new" class="form-label font-weight-bold">Número de télefono</label>
		<input type="number" class="form-control" id="telefono_new" name="telefono_new" required max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<!-- <small>Mínimo 6 digitos</small> -->
		<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_new2" class="form-label font-weight-bold">Número de télefono adicional</label>
		<input type="number" class="form-control" id="telefono_new2" name="telefono_new2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<!-- <small>Mínimo 6 digitos</small> -->
		<input type="number" id="codigo_pais_2" name="codigo_pais_2" maxlength="3" hidden>
	</div>
	<div class="col-12">
		<h3 class="text-center mb-3 fw-bold">DATOS DE ORIGEN</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_new" class="form-label font-weight-bold">Nacionalidad</label>
		<select class="form-control" id="nacionalidad_new" name="nacionalidad_new" required>
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
		<label for="estado_select_origen_new" class="form-label font-weight-bold">Estado origen</label>
		<select class="form-control" id="estado_select_origen_new" name="estado_select_origen_new" required>
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
		<label for="municipio_select_origen_new" class="form-label font-weight-bold">Municipio origen</label>
		<select class="form-control" id="municipio_select_origen_new" name="municipio_select_origen_new" required>
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="idioma_new" class="form-label font-weight-bold">Idioma</label>
		<select class="form-control" id="idioma_new" name="idioma_new" required>
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
		<h3 class="text-center mb-3 fw-bold">DOMICILIO ACTUAL</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_select_new" class="form-label font-weight-bold">País</label>
		<select class="form-control" id="pais_select_new" name="pais_select_new" required>
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El país es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_select_new" class="form-label font-weight-bold">Estado</label>
		<select class="form-control" id="estado_select_new" name="estado_select_new" required>
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
		<label for="municipio_select_new" class="form-label font-weight-bold">Municipio</label>
		<select class="form-control" id="municipio_select_new" name="municipio_select_new" required>
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_select_new" class="form-label font-weight-bold">Localidad</label>
		<select class="form-control" id="localidad_select_new" name="localidad_select_new" required>
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_select_new" class="form-label font-weight-bold">Colonia</label>
		<select class="form-control" id="colonia_select_new" name="colonia_select_new" required>
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_new" name="colonia_new" maxlength="100" required>
		<small id="colonia_new-message" class="text-primary fw-bold d-none">Si no encuentras tu colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_new" class="form-label font-weight-bold">Código postal</label>
		<input type="number" class="form-control" id="cp_new" maxlength="10" oninput="clearInputPhone(event);" name="cp_new">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_new" class="form-label font-weight-bold">Calle</label>
		<input type="text" class="form-control" id="calle_new" name="calle_new" maxlength="100" required>
		<div class="invalid-feedback">
			La calle es obligatoria
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior_new" class="form-label font-weight-bold">Número exterior</label>
		<input type="text" class="form-control" id="exterior_new" name="exterior_new" maxlength="10" required>
		<div class="invalid-feedback">
			El número exterior es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_new" class="form-label font-weight-bold">Número interior</label>
		<input type="text" class="form-control" id="interior_new" name="interior_new" maxlength="10">
	</div>
	<div class="col-12">
		<h3 class="text-center mb-3 fw-bold">DATOS DE IDENTIFICACION</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="identificacion_new" class="form-label font-weight-bold">Identificación</label>
		<select class="form-control" id="identificacion_new" name="identificacion_new" required>
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
		<label for="numero_ide_new" class="form-label font-weight-bold">Número de identificación</label>
		<input type="text" class="form-control" id="numero_ide_new" name="numero_ide_new">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="e_civil_new" class="form-label font-weight-bold">Estado civil</label>
		<select class="form-control" id="e_civil_new" name="e_civil_new" required>
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
		<label for="escolaridad_new" class="form-label font-weight-bold">Escolaridad</label>
		<select class="form-control" id="escolaridad_new" name="escolaridad_new" required>
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
		<label for="ocupacion_new" class="form-label font-weight-bold">Ocupación</label>
		<select class="form-control" id="ocupacion_new" name="ocupacion_new" required>
			<option selected disabled value="">Selecciona la ocupacion</option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
				<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="discapacidad_new" class="form-label font-weight-bold">¿Padece alguna discapacidad?</label>
		<input type="text" class="form-control" id="discapacidad_new" name="discapacidad_new" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="leer_new" class="form-label font-weight-bold">¿Sabe leer?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="S" required>
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="N" required>
			<label class="form-check-label" for="flexRadioDefault2">No</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escribir_new" class="form-label font-weight-bold">¿Sabe escribir?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="S" required>
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="N" required>
			<label class="form-check-label" for="flexRadioDefault2">No</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_new" class="form-label font-weight-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_new" id="facebook_new" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_new" class="form-label font-weight-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_new" id="instagram_new" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_new" class="form-label font-weight-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_new" id="twitter_new" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calidad_juridica_pf" class="form-label font-weight-bold">Calidad Juridica</label>
		<select class="form-control" id="calidad_juridica_new" name="calidad_juridica_new">
			<option selected value=""></option>
			<?php foreach ($body_data->calidadJuridica as $index => $calidadJuridica) { ?>
				<option value="<?= $calidadJuridica->PERSONACALIDADJURIDICAID ?>"> <?= $calidadJuridica->PERSONACALIDADJURIDICADESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertPersonaFisica" name="insertPersonaFisica" class="btn btn-primary font-weight-bold">AGREGAR PERSONA FÍSICA</button>
	</div>
</form>
<script>
	let input = document.querySelector("#telefono_new");
	let input2 = document.querySelector("#telefono_new2");
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
	document.querySelector('#fecha_nacimiento_new').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_new').value = edad;
	})

	document.querySelector('#nacionalidad_new').addEventListener('change', (e) => {
			let select_estado = document.querySelector('#estado_select_origen_new');
			let select_municipio = document.querySelector('#municipio_select_origen_new');

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

		document.querySelector('#estado_select_origen_new').addEventListener('change', (e) => {
			let select_municipio = document.querySelector('#municipio_select_origen_new');

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

		document.querySelector('#pais_select_new').addEventListener('change', (e) => {

			let select_estado = document.querySelector('#estado_select_new');
			let select_municipio = document.querySelector('#municipio_select_new');
			let select_localidad = document.querySelector('#localidad_select_new');
			let select_colonia = document.querySelector('#colonia_select_new');

			let input_colonia = document.querySelector('#colonia_new');
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

		document.querySelector('#estado_select_new').addEventListener('change', (e) => {
			let select_municipio = document.querySelector('#municipio_select_new');
			let select_localidad = document.querySelector('#localidad_select_new');
			let select_colonia = document.querySelector('#colonia_select_new');
			let input_colonia = document.querySelector('#colonia_new');

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
			} else {
				document.querySelector('#colonia-message').classList.remove('d-none');
			}
		});

		document.querySelector('#municipio_select_new').addEventListener('change', (e) => {
			let select_localidad = document.querySelector('#localidad_select_new');
			let select_colonia = document.querySelector('#colonia_select_new');
			let input_colonia = document.querySelector('#colonia_new');

			let estado = document.querySelector('#estado_select_new').value;
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

		document.querySelector('#localidad_select_new').addEventListener('change', (e) => {
			let select_colonia = document.querySelector('#colonia_select_new');
			let input_colonia = document.querySelector('#colonia_new');

			let estado = document.querySelector('#estado_select_new').value;
			let municipio = document.querySelector('#municipio_select_new').value;
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

		document.querySelector('#colonia_select_new').addEventListener('change', (e) => {
			let select_colonia = document.querySelector('#colonia_select_new');
			let input_colonia = document.querySelector('#colonia_new');

			if (e.target.value === '0') {
				select_colonia.classList.add('d-none');
				input_colonia.classList.remove('d-none');
				input_colonia.value = '';
				input_colonia.focus();
			} else {
				input_colonia.value = '-';
			}
		});

</script>