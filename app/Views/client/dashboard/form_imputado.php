<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del imputado (posible responsable)</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_imputado" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_imputado" name="nombre_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="primer_apellido_imputado" class="form-label fw-bold">Primer apellido</label>
		<input type="text" class="form-control" id="primer_apellido_imputado" name="primer_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="segundo_apellido_imputado" class="form-label fw-bold">Segundo apellido</label>
		<input type="text" class="form-control" id="segundo_apellido_imputado" name="segundo_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="alias_imputado" class="form-label fw-bold">Apodo</label>
		<input type="text" class="form-control" id="alias_imputado" name="alias_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_imputado" class="form-label fw-bold ">Fecha de nacimiento </label>
		<input type="date" class="form-control" id="fecha_nacimiento_imputado" name="fecha_nacimiento_imputado" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_imputado" class="form-label fw-bold">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_imputado" name="edad_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_imputado" class="form-label fw-bold ">Sexo </label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_imputado" value="M" id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_imputado" value="F" id="FEMENINO">
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
		<label for="nacionalidad_imputado" class="form-label fw-bold">Nacionalidad</label>
		<select class="form-select" id="nacionalidad_imputado" name="nacionalidad_imputado">
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
		<label for="estado_origen_imputado" class="form-label fw-bold">Estado origen</label>
		<select class="form-select" id="estado_origen_imputado" name="estado_origen_imputado">
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
		<label for="municipio" class="form-label fw-bold">Municipio origen</label>
		<select class="form-select" id="municipio_origen_imputado" name="municipio_origen_imputado">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DOMICILIO DEL IMPUTADO</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_imputado" class="form-label fw-bold">País</label>
		<select class="form-select" id="pais_imputado" name="pais_imputado">
			<option selected disabled value="">Selecciona el país</option>
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>"> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_imputado" class="form-label fw-bold">Estado</label>
		<select class="form-select" id="estado_imputado" name="estado_imputado">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_imputado" class="form-label fw-bold">Municipio</label>
		<select class="form-select" id="municipio_imputado" name="municipio_imputado">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_imputado_input" class="form-label fw-bold">Colonia</label>
		<select class="form-select" id="colonia_imputado" name="colonia_imputado">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_imputado_input" name="colonia_imputado_input" maxlength="100">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_imputado" class="form-label fw-bold">Código Postal</label>
		<input type="number" class="form-control" id="cp_imputado" name="cp_imputado" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_imputado" class="form-label fw-bold">Calle </label>
		<input type="text" class="form-control" id="calle_imputado" name="calle_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_imputado" class="form-label fw-bold">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_imputado" name="numero_ext_imputado" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_imputado" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_imputado" name="numero_int_imputado" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tel_imputado" class="form-label fw-bold">Teléfono </label>
		<input type="text" class="form-control" id="tel_imputado" name="tel_imputado" maxlength="20">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_imputado" class="form-label fw-bold">Escolaridad </label>
		<select class="form-select" id="escolaridad_imputado" name="escolaridad_imputado">
			<option selected disabled value="">Selecciona la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_imputado" class="form-label fw-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_imputado" id="facebook_imputado" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_imputado" class="form-label fw-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_imputado" id="instagram_imputado" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_imputado" class="form-label fw-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_imputado" id="twitter_imputado" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<label for="description_fisica_imputado" class="form-label fw-bold">Descripción física del imputado</label>
		<textarea class="form-control" id="description_fisica_imputado" name="description_fisica_imputado" onkeyup="contarCaracteresImp(this)" rows="10" maxlength="300"></textarea>
		<small id="numCaracterImp">300 caracteres restantes</small>
	</div>
</div>
<script>
	function contarCaracteresImp(obj) {
		var maxLength = 300;
		var strLength = obj.value.length;
		var charRemain = (maxLength - strLength);

		if (charRemain < 0) {
			document.getElementById("numCaracterImp").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracterImp").innerHTML = charRemain + ' caracteres restantes';
		}
	}

	document.querySelector('#fecha_nacimiento_imputado').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_imputado').value = edad;
	})

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#nacionalidad_imputado').addEventListener('change', (e) => {
		let select_estado = document.querySelector('#estado_origen_imputado');
		let select_municipio = document.querySelector('#municipio_origen_imputado');

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

	document.querySelector('#estado_origen_imputado').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_origen_imputado');

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

	document.querySelector('#pais_imputado').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_imputado');
		let select_municipio = document.querySelector('#municipio_imputado');
		let select_colonia = document.querySelector('#colonia_imputado');
		let input_colonia = document.querySelector('#colonia_imputado_input');

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

	document.querySelector('#estado_imputado').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_imputado');
		let select_colonia = document.querySelector('#colonia_imputado');
		let input_colonia = document.querySelector('#colonia_imputado_input');

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

	document.querySelector('#municipio_imputado').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_imputado');
		let input_colonia = document.querySelector('#colonia_imputado_input');

		let estado = document.querySelector('#estado_imputado').value;
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

	document.querySelector('#colonia_imputado').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_imputado');
		let input_colonia = document.querySelector('#colonia_imputado_input');

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
