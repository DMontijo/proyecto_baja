<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Registra los datos del menor de edad</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_menor" class="form-label fw-bold input-required">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_menor" name="nombre_menor" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_menor" class="form-label fw-bold input-required">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_menor" name="apellido_paterno_menor" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_menor" class="form-label fw-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_menor" name="apellido_materno_menor" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_menor" class="form-label fw-bold input-required">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_menor" name="fecha_nacimiento_menor" min="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3" hidden>
		<label for="edad_menor" class="form-label fw-bold">Edad</label>
		<input class="form-control" id="edad_menor" name="edad_menor" type="text">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_menor" class="form-label fw-bold input-required">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_menor" value="M" id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_menor" value="F" id="FEMENINO">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DATOS DE ORIGEN DEL MENOR</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_menor" class="form-label fw-bold input-required">Nacionalidad</label>
		<select class="form-select" id="nacionalidad_menor" name="nacionalidad_menor">
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
		<label for="estado_origen_menor" class="form-label fw-bold input-required">Estado origen</label>
		<select class="form-select" id="estado_origen_menor" name="estado_origen_menor">
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
		<select class="form-select" id="municipio_origen_menor" name="municipio_origen_menor">
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
		<h5 class="text-center mb-3 fw-bold">DOMICILIO ACTUAL DEL MENOR</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_menor" class="form-label fw-bold input-required">País</label>
		<select class="form-select" id="pais_menor" name="pais_menor">
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_menor" class="form-label fw-bold input-required">Estado</label>
		<select class="form-select" id="estado_menor" name="estado_menor">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_menor" class="form-label fw-bold input-required">Municipio</label>
		<select class="form-select" id="municipio_menor" name="municipio_menor">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_menor" class="form-label fw-bold input-required">Localidad</label>
		<select class="form-select" id="localidad_menor" name="localidad_menor">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_menor_input" class="form-label fw-bold input-required">Colonia</label>
		<select class="form-select" id="colonia_menor" name="colonia_menor">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_menor_input" name="colonia_menor_input" maxlength="100">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_menor" class="form-label fw-bold">Código Postal</label>
		<input type="number" class="form-control" id="cp_menor" name="cp_menor" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_menor" class="form-label fw-bold input-required">Calle</label>
		<input type="text" class="form-control" id="calle_menor" name="calle_menor" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_menor" class="form-label fw-bold input-required">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_menor" name="numero_ext_menor" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_menor" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_menor" name="numero_int_menor" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="manzana_menor" class="form-label fw-bold">Manzana</label>
		<input type="text" class="form-control" id="manzana_menor" name="manzana_menor" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lote_menor" class="form-label fw-bold">Lote</label>
		<input type="text" class="form-control" id="lote_menor" name="lote_menor" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_menor" class="form-label fw-bold">Escolaridad</label>
		<select class="form-select" id="escolaridad_menor" name="escolaridad_menor">
			<option selected disabled value="">Selecciona la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_menor" class="form-label fw-bold">Ocupación</label>
		<select class="form-select" id="ocupacion_menor" name="ocupacion_menor">
			<option selected disabled value="">Selecciona la ocupacion</option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
				<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<input type="text" class="form-control d-none" id="ocupacion_descr_menor" name="ocupacion_descr_menor" maxlength="100" required>
		<small id="ocupacion-menor-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>
		<div class="invalid-feedback">
			La ocupación es obligatoria
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_menor" class="form-label fw-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_menor" id="facebook_menor" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_menor" class="form-label fw-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_menor" id="instagram_menor" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_menor" class="form-label fw-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_menor" id="twitter_menor" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>
</div>

<script>
		document.querySelector('#ocupacion_menor').addEventListener('change', (e) => {
		let select_ocupacion = document.querySelector('#ocupacion_menor');
		let input_ocupacion = document.querySelector('#ocupacion_descr_menor');

		if (e.target.value === '999') {
			select_ocupacion.classList.add('d-none');
			input_ocupacion.classList.remove('d-none');
			input_ocupacion.value = "";
			input_ocupacion.focus();
		} else {
			input_ocupacion.value = "";
		}
	});
	document.querySelector('#fecha_nacimiento_menor').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_menor').value = edad;
	})

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#nacionalidad_menor').addEventListener('change', (e) => {
		let select_estado = document.querySelector('#estado_origen_menor');
		let select_municipio = document.querySelector('#municipio_origen_menor');

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

	document.querySelector('#estado_origen_menor').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_origen_menor');

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

	document.querySelector('#pais_menor').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_menor');
		let select_municipio = document.querySelector('#municipio_menor');
		let select_localidad = document.querySelector('#localidad_menor');
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

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

	document.querySelector('#estado_menor').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_menor');
		let select_localidad = document.querySelector('#localidad_menor');
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

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

	document.querySelector('#municipio_menor').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_menor');
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		let estado = document.querySelector('#estado_menor').value;
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

	document.querySelector('#localidad_menor').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		let estado = document.querySelector('#estado_menor').value;
		let municipio = document.querySelector('#municipio_menor').value;
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

	document.querySelector('#colonia_menor').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = "";
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});
</script>