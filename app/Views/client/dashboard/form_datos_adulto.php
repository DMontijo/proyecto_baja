<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del adulto acompañante</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_adulto" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_adulto" name="nombre_adulto" autofocus>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ape_paterno_adulto" class="form-label fw-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="ape_paterno_adulto" name="ape_paterno_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ape_materno_adulto" class="form-label fw-bold">Apellido materno</label>
		<input type="text" class="form-control" id="ape_materno_adulto" name="ape_materno_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_adulto" class="form-label fw-bold">País</label>
		<select class="form-select" id="pais_adulto" name="pais_adulto">
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_adulto" class="form-label fw-bold">Estado</label>
		<select class="form-select" id="estado_adulto" name="estado_adulto">
			<option selected disabled value="">Seleccione el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_adulto" class="form-label fw-bold">Municipio</label>
		<select class="form-select" id="municipio_adulto" name="municipio_adulto">
			<option selected disabled value="">Seleccione el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_input" class="form-label fw-bold">Colonia</label>
		<select class="form-select" id="colonia_adulto" name="colonia_adulto">
			<option selected disabled value="">Seleccione la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_input" name="colonia_input" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_adulto" class="form-label fw-bold">Calle</label>
		<input type="text" class="form-control" id="calle_adulto" name="calle_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_adulto" class="form-label fw-bold">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_adulto" name="numero_ext_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_adulto" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_adulto" name="numero_int_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_adulto" class="form-label fw-bold">Código Postal</label>
		<input type="text" class="form-control" id="cp_adulto" name="cp_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nac_adulto" class="form-label fw-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nac_adulto" name="fecha_nac_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_adulto" class="form-label fw-bold ">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_adulto" value="M" id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_adulto" value="F" id="FEMENINO">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3" hidden>
		<label for="edad_adulto" class="form-label fw-bold">Edad</label>
		<input class="form-control" id="edad_adulto" name="edad_adulto" type="text" disabled>
	</div>

</div>


<script>
	document.querySelector('#fecha_nac_adulto').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();
		if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_adulto').value = edad;
	})


	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#pais_adulto').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_adulto');
		let select_municipio = document.querySelector('#municipio_adulto');
		let select_colonia = document.querySelector('#colonia_adulto');
		let input_colonia = document.querySelector('#colonia_input');

		clearSelect(select_municipio);
		clearSelect(select_colonia);

		if (e.target.value !== 'MX') {

			select_estado.value = '33';


			// let col = document.createElement("option");
			// col.text = "EXTRANJERO";
			// col.value = 1;
			// select_municipio.add(col);
			// select_municipio.value = '1'


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
			clearSelect(select_colonia);

			select_estado.value = '';

			select_municipio.value = '';

			select_colonia.value = '';
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
		}
	});

	document.querySelector('#estado_adulto').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_adulto');
		let select_colonia = document.querySelector('#colonia_adulto');
		let input_colonia = document.querySelector('#colonia_input');

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

	document.querySelector('#municipio_adulto').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_adulto');
		let input_colonia = document.querySelector('#colonia_input');

		let estado = document.querySelector('#estado_adulto').value;
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

	document.querySelector('#colonia_adulto').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_adulto');
		let input_colonia = document.querySelector('#colonia_input');

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
