<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos de la persona desaparecida</h3>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_des" class="form-label fw-bold input-required">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_des" name="nombre_des" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_des" class="form-label fw-bold input-required">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_des" name="apellido_paterno_des" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_des" class="form-label fw-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_des" name="apellido_materno_des" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_des" class="form-label fw-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_des" name="fecha_nacimiento_des" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_des" class="form-label fw-bold input-required">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_des" name="edad_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_des" class="form-label fw-bold input-required">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_des" value="M" id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_des" value="F" id="FEMENINO">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DATOS DE ORIGEN DE LA PERSONA DESAPARECIDA</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_des" class="form-label fw-bold input-required">Nacionalidad</label>
		<select class="form-select" id="nacionalidad_des" name="nacionalidad_des">
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
		<label for="estado_origen_des" class="form-label fw-bold input-required">Estado origen</label>
		<select class="form-select" id="estado_origen_des" name="estado_origen_des">
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
		<label for="municipio" class="form-label fw-bold input-required">Municipio origen</label>
		<select class="form-select" id="municipio_origen_des" name="municipio_origen_des">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DOMICILIO ACTUAL DE LA PERSONA DESAPARECIDA</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_des" class="form-label fw-bold">País</label>
		<select class="form-select" id="pais_des" name="pais_des">
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_des" class="form-label fw-bold">Estado</label>
		<select class="form-select" id="estado_des" name="estado_des">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_des" class="form-label fw-bold">Municipio</label>
		<select class="form-select" id="municipio_des" name="municipio_des">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_des" class="form-label fw-bold">Localidad</label>
		<select class="form-select" id="localidad_des" name="localidad_des">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_des_input" class="form-label fw-bold">Colonia</label>
		<select class="form-select" id="colonia_des" name="colonia_des">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_des_input" name="colonia_des_input" maxlength="100">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_des" class="form-label fw-bold">Código Postal</label>
		<input type="number" class="form-control" id="cp_des" name="cp_des" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_des" class="form-label fw-bold">Calle</label>
		<input type="text" class="form-control" id="calle_des" name="calle_des" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_des" class="form-label fw-bold" id="lblExterior_des">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_des" name="numero_ext_des" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_des" class="form-label fw-bold" id="lblInterior_des">Número interior</label>
		<input type="text" class="form-control" id="numero_int_des" name="numero_int_des" maxlength="10">
	</div>
	<div class="col-12 mt-4 mb-4">
		<input class="form-check-input" type="checkbox" id="checkML_des" name="checkML_des">
		<label class="form-check-label fw-bold" for="checkML_des">
			¿La dirección contiene manzana y lote?
		</label>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estatura_des" class="form-label fw-bold ">Estatura (en centímetros)</label>
		<input type="number" class="form-control" id="estatura_des" name="estatura_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="peso_des" class="form-label fw-bold ">Peso aproximado (en kg.)</label>
		<input type="number" class="form-control" id="peso_des" name="peso_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="complexion_des" class="form-label fw-bold ">Complexión</label>
		<select class="form-select" id="complexion_des" name="complexion_des">
			<option selected disabled value="">Elige la complexión</option>
			<?php
			foreach ($body_data->figura as $index => $figura) { ?>
				<option value="<?= $figura->FIGURAID ?>"> <?= $figura->FIGURADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_des" class="form-label fw-bold ">Color de piel o tez</label>
		<select class="form-select" id="color_des" name="color_des">
			<option selected disabled value="">Elige el color de piel</option>
			<?php
			foreach ($body_data->pielColor as $index => $pielColor) { ?>
				<option value="<?= $pielColor->PIELCOLORID  ?>"> <?= $pielColor->PIELCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="señas_des" class="form-label fw-bold ">Señas particulares
			<a href="#!" data-bs-toggle="tooltip" data-toggle="tooltip" data-bs-placement="right" title="Cicatrices, lunares, tatuajes, etc."><i class="bi bi-info-circle-fill"></i></a>
		</label>
		<textarea class="form-control" id="señas_des" name="señas_des" maxlength="200"></textarea>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_cabello_des" class="form-label fw-bold ">Color de cabello</label>
		<select class="form-select" id="color_cabello_des" name="color_cabello_des">
			<option selected disabled value="">Elige el color del cabello</option>
			<?php
			foreach ($body_data->cabelloColor as $index => $cabelloColor) { ?>
				<option value="<?= $cabelloColor->CABELLOCOLORID ?>"> <?= $cabelloColor->CABELLOCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tam_cabello_des" class="form-label fw-bold ">Tamaño de cabello</label>
		<select class="form-select" id="tam_cabello_des" name="tam_cabello_des">
			<option selected disabled value="">Elige el tamaño del cabello</option>
			<?php
			foreach ($body_data->cabelloTamano as $index => $cabelloTamano) { ?>
				<option value="<?= $cabelloTamano->CABELLOTAMANOID ?>"> <?= $cabelloTamano->CABELLOTAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div> -->
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="form_cabello_des" class="form-label fw-bold ">Forma de cabello</label>
		<select class="form-select" id="form_cabello_des" name="form_cabello_des">
			<option selected disabled value="">Elige la forma del cabello</option>
			<?php
			foreach ($body_data->cabelloEstilo as $index => $cabelloEstilo) { ?>
				<option value="<?= $cabelloEstilo->CABELLOESTILOID  ?>"> <?= $cabelloEstilo->CABELLOESTILODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_ojos_des" class="form-label fw-bold ">Color de ojos</label>
		<select class="form-select" id="color_ojos_des" name="color_ojos_des">
			<option selected disabled value="">Elige el color de ojos</option>
			<?php
			foreach ($body_data->ojoColor as $index => $ojoColor) { ?>
				<option value="<?= $ojoColor->OJOCOLORID ?>"> <?= $ojoColor->OJOCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="frente_des" class="form-label fw-bold ">Tipo de frente</label>
		<select class="form-select" id="frente_des" name="frente_des">
			<option selected disabled value="">Elige la forma de la frente</option>
			<?php
			foreach ($body_data->frenteForma as $index => $frenteForma) { ?>
				<option value="<?= $frenteForma->FRENTEFORMAID ?>"> <?= $frenteForma->FRENTEFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="forma_ceja_des" class="form-label fw-bold ">Tipo de ceja</label>
		<select class="form-select" id="forma_ceja_des" name="forma_ceja_des">
			<option selected disabled value="">Elige el forma de ceja</option>
			<?php
			foreach ($body_data->cejaForma as $index => $cejaForma) { ?>
				<option value="<?= $cejaForma->CEJAFORMAID ?>"> <?= $cejaForma->CEJAFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="discapacidad_des" class="form-label fw-bold">¿Padece alguna
			discapacidad?</label>
		<input type="text" class="form-control" id="discapacidad_des" name="discapacidad_des" maxlength="200">
		<div class="invalid-feedback">
			El campo discapacidad es obligatorio.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dia_des" class="form-label fw-bold ">¿Cuando se le vio por ultima vez?</label>
		<input type="date" class="form-control" id="dia_des" name="dia_des" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar_des" class="form-label fw-bold ">¿Dónde se le vio por ultima vez?</label>
		<input type="text" class="form-control" id="lugar_des" name="lugar_des" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="vestimenta_des" class="form-label fw-bold ">Vestimenta que portaba</label>
		<input type="text" class="form-control" id="vestimenta_des" name="vestimenta_des" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="parentesco_des" class="form-label fw-bold ">Parentesco:</label>
		<select class="form-select" id="parentesco_des" name="parentesco_des">
			<option selected disabled value="">Elige el parentesco</option>
			<?php
			foreach ($body_data->parentesco as $index => $parentesco) { ?>
				<option value="<?= $parentesco->PERSONAPARENTESCOID ?>"> <?= $parentesco->PERSONAPARENTESCODESCR ?></option>
			<?php } ?>
		</select>
	</div>

	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_des" class="form-label fw-bold">Escolaridad</label>
		<select class="form-select" id="escolaridad_des" name="escolaridad_des">
			<option selected disabled value="">Selecciona la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			La escolaridad es obligatoria
		</div>
	</div> -->

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_des" class="form-label fw-bold">Ocupación</label>
		<select class="form-select" id="ocupacion_des" name="ocupacion_des">
			<option selected disabled value="">Selecciona la ocupacion</option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
				<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<input type="text" class="form-control d-none" id="ocupacion_descr_des" name="ocupacion_descr_des" maxlength="100">
		<small id="ocupacion-des-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>

	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_des" class="form-label fw-bold ">Fotografía:
			<a href="#!" data-bs-toggle="tooltip" data-toggle="tooltip" data-bs-placement="right" title="Verificar que sea una fotografía actual"><i class="bi bi-info-circle-fill"></i></a>
		</label>
		<input type="file" class="form-control" id="foto_des" name="foto_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fotografia_actual" class="form-label fw-bold">¿La fotografía es actual?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fotografia_actual" id="fotografia_actual" value="S">
			<label class="form-check-label" for="fotografia_actual">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fotografia_actual" id="fotografia_actual" value="N">
			<label class="form-check-label" for="fotografia_actual">NO</label>
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_des" class="form-label fw-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_des" id="facebook_des" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_des" class="form-label fw-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_des" id="instagram_des" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_des" class="form-label fw-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_des" id="twitter_des" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12">
		<hr>
	</div>

	<div class="col-12 text-center my-5">
		<div class="form-check d-inline-block">
			<input id="autorization_photo_des" name="autorization_photo_des" class="form-check-input" type="checkbox">
			<label class="form-check-label" for="autorization_photo_des">
				Doy autorización de publicar la fotografía e información en medios de comunicación.
			</label>
		</div>
	</div>
</div>

<script>
	document.querySelector('#ocupacion_des').addEventListener('change', (e) => {
		let select_ocupacion = document.querySelector('#ocupacion_des');
		let input_ocupacion = document.querySelector('#ocupacion_descr_des');

		if (e.target.value === '999') {
			select_ocupacion.classList.add('d-none');
			input_ocupacion.classList.remove('d-none');
			input_ocupacion.value = "";
			input_ocupacion.focus();
		} else {
			input_ocupacion.value = "";
		}
	});
	document.querySelector('#fecha_nacimiento_des').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_des').value = edad;
	})

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#nacionalidad_des').addEventListener('change', (e) => {
		let select_estado = document.querySelector('#estado_origen_des');
		let select_municipio = document.querySelector('#municipio_origen_des');

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

	document.querySelector('#estado_origen_des').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_origen_des');

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

	document.querySelector('#pais_des').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_des');
		let select_municipio = document.querySelector('#municipio_des');
		let select_localidad = document.querySelector('#localidad_des');
		let select_colonia = document.querySelector('#colonia_des');
		let input_colonia = document.querySelector('#colonia_des_input');

		clearSelect(select_municipio);
		clearSelect(select_localidad);
		clearSelect(select_colonia);

		select_estado.value = '';
		select_municipio.value = '';
		select_localidad.value = '';
		select_colonia.value = '';

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
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
		}
	});

	document.querySelector('#estado_des').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_des');
		let select_localidad = document.querySelector('#localidad_des');
		let select_colonia = document.querySelector('#colonia_des');
		let input_colonia = document.querySelector('#colonia_des_input');

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
	});

	document.querySelector('#municipio_des').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_des');
		let select_colonia = document.querySelector('#colonia_des');
		let input_colonia = document.querySelector('#colonia_des_input');

		let estado = document.querySelector('#estado_des').value;
		let municipio = e.target.value;

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
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});

	document.querySelector('#localidad_des').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_des');
		let input_colonia = document.querySelector('#colonia_des_input');

		let estado = document.querySelector('#estado_des').value;
		let municipio = document.querySelector('#municipio_des').value;
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
				select_colonia.add(option);
			},
			error: function(jqXHR, textStatus, errorThrown) {

			}
		});
	});

	document.querySelector('#colonia_des').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_des');
		let input_colonia = document.querySelector('#colonia_des_input');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = "";
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});

	document.querySelector('#foto_des').addEventListener("change", function() {
		// Si no hay archivos, regresamos
		if (this.files.length <= 0) return;

		// Validamos el primer archivo únicamente
		const archivo = this.files[0];
		if (archivo.size > 3000000) {
			// Limpiar
			document.querySelector('#foto_des').value = "";
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'El tamaño máximo de los documentos debe ser de 3MB.',
				confirmButtonColor: '#bf9b55',
			})
		}
	});
</script>
