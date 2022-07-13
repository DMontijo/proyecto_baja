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
	<div class="col-12">
		<hr>
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
			<option selected disabled value="">Seleccione el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_menor" class="form-label fw-bold input-required">Municipio</label>
		<select class="form-select" id="municipio_menor" name="municipio_menor">
			<option selected disabled value="">Seleccione el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_menor_input" class="form-label fw-bold input-required">Colonia</label>
		<select class="form-select" id="colonia_menor" name="colonia_menor">
			<option selected disabled value="">Seleccione la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_menor_input" name="colonia_menor_input" maxlength="100">
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
		<label for="fecha_nacimiento_menor" class="form-label fw-bold input-required">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_menor" name="fecha_nacimiento_menor" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_menor" class="form-label fw-bold input-required">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_menor" value="M" checked id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_menor" value="F" id="FEMENINO">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3" hidden>
		<label for="edad_menor" class="form-label fw-bold">Edad</label>
		<input class="form-control" id="edad_menor" name="edad_menor" type="text">
	</div>
</div>

<script>
	document.querySelector('#fecha_nacimiento_menor').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_menor').value = edad;
	})

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#pais_menor').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_menor');
		let select_municipio = document.querySelector('#municipio_menor');
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		clearSelect(select_municipio);
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
			clearSelect(select_colonia);

			select_estado.value = '';
			select_municipio.value = '';
			select_colonia.value = '';
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
		}
	});

	document.querySelector('#estado_menor').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_menor');
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		clearSelect(select_municipio);
		clearSelect(select_colonia);

		select_municipio.value = '';
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
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		let estado = document.querySelector('#estado_menor').value;
		let municipio = e.target.value;

		clearSelect(select_colonia);

		let data = {
			'estado_id': estado,
			'municipio_id': municipio
		};

		if (estado == 2) {
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
			input_colonia.value = '';
			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-colonias-by-estado-and-municipio') ?>",
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
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = '';
		}

	});

	document.querySelector('#colonia_menor').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_menor');
		let input_colonia = document.querySelector('#colonia_menor_input');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = '';
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});
</script>
