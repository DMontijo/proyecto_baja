<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del ofendido</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_ofendido" class="form-label fw-bold  input-required">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_ofendido" name="nombre_ofendido" maxlength="50" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="primer_apellido_ofendido" class="form-label fw-bold">Primer apellido</label>
		<input type="text" class="form-control" id="primer_apellido_ofendido" name="primer_apellido_ofendido" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="segundo_apellido_ofendido" class="form-label fw-bold">Segundo apellido</label>
		<input type="text" class="form-control" id="segundo_apellido_ofendido" name="segundo_apellido_ofendido" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="alias_ofendido" class="form-label fw-bold">Apodo</label>
		<input type="text" class="form-control" id="alias_ofendido" name="alias_ofendido" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_ofendido" class="form-label fw-bold ">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_ofendido" name="fecha_nacimiento_ofendido" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_ofendido" class="form-label fw-bold">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_ofendido" name="edad_ofendido">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_ofendido" class="form-label fw-bold ">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_ofendido" value="M" id="MASCULINO">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_ofendido" value="F" id="FEMENINO">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DATOS DE ORIGEN DEL OFENDIDO</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_ofendido" class="form-label fw-bold">Nacionalidad</label>
		<select class="form-select" id="nacionalidad_ofendido" name="nacionalidad_ofendido">
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
		<label for="estado_origen_ofendido" class="form-label fw-bold">Estado origen</label>
		<select class="form-select" id="estado_origen_ofendido" name="estado_origen_ofendido">
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
		<select class="form-select" id="municipio_origen_ofendido" name="municipio_origen_ofendido">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>
	<div class="col-12">
		<h5 class="text-center mb-3 fw-bold">DOMICILIO DEL OFENDIDO</h5>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_ofendido" class="form-label fw-bold">País</label>
		<select class="form-select" id="pais_ofendido" name="pais_ofendido">
			<option selected disabled value="">Selecciona el país</option>
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>"> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_ofendido" class="form-label fw-bold">Estado</label>
		<select class="form-select" id="estado_ofendido" name="estado_ofendido">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_ofendido" class="form-label fw-bold">Municipio</label>
		<select class="form-select" id="municipio_ofendido" name="municipio_ofendido">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_ofendido" class="form-label fw-bold">Localidad</label>
		<select class="form-select" id="localidad_ofendido" name="localidad_ofendido">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_ofendido_input" class="form-label fw-bold">Colonia</label>
		<select class="form-select" id="colonia_ofendido" name="colonia_ofendido">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_ofendido_input" name="colonia_ofendido_input" maxlength="100">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_ofendido" class="form-label fw-bold">Código Postal</label>
		<input type="number" class="form-control" id="cp_ofendido" name="cp_ofendido" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_ofendido" class="form-label fw-bold">Calle</label>
		<input type="text" class="form-control" id="calle_ofendido" name="calle_ofendido" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_ofendido" class="form-label fw-bold" id="lblExterior_ofendido">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_ofendido" name="numero_ext_ofendido" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_ofendido" class="form-label fw-bold" id="lblInterior_ofendido">Número interior</label>
		<input type="text" class="form-control" id="numero_int_ofendido" name="numero_int_ofendido" maxlength="10">
	</div>

	<div class="col-12 mt-4 mb-4">
		<input class="form-check-input" type="checkbox" id="checkML_ofendido" name="checkML_ofendido">
		<label class="form-check-label fw-bold" for="checkML_ofendido">
			¿La dirección contiene manzana y lote?
		</label>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tel_ofendido" class="form-label fw-bold">Teléfono</label>
		<input type="text" class="form-control" id="tel_ofendido" name="tel_ofendido" maxlength="20">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_ofendido" class="form-label fw-bold">Escolaridad</label>
		<select class="form-select" id="escolaridad_ofendido" name="escolaridad_ofendido">
			<option selected disabled value="">Selecciona la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_ofendido" class="form-label fw-bold">Ocupación</label>
		<select class="form-select" id="ocupacion_ofendido" name="ocupacion_ofendido">
			<option selected disabled value="">Selecciona la ocupacion</option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
				<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<input type="text" class="form-control d-none" id="ocupacion_descr_ofendido" name="ocupacion_descr_ofendido" maxlength="100">
		<small id="ocupacion-ofendido-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>
		<div class="invalid-feedback">
			La ocupación es obligatoria
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_ofendido" class="form-label fw-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_ofendido" id="facebook_ofendido" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_ofendido" class="form-label fw-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_ofendido" id="instagram_ofendido" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_ofendido" class="form-label fw-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_ofendido" id="twitter_ofendido" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<label for="description_fisica_ofendido" class="form-label fw-bold">Descripción física del ofendido</label>
		<textarea class="form-control" id="description_fisica_ofendido" name="description_fisica_ofendido" onkeyup="contarCaracteresImp(this)" rows="10" maxlength="300"></textarea>
		<small id="numCaracterImp">300 caracteres restantes</small>
	</div>
</div>
<script>
	//Mayusculas descripcion de ofendido
	document.querySelector('#description_fisica_ofendido').addEventListener('input', (event) => {
		event.target.value = clearText(event.target.value).toUpperCase();
	}, false)
		//Funcion para eliminar caracteres especiales del texto
		function clearText(text) {
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
	}
	//Funcion para contar caracteres de la descripcion
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
	//Evento change para modificar estilos de la ocupacion
	document.querySelector('#ocupacion_ofendido').addEventListener('change', (e) => {
		let select_ocupacion = document.querySelector('#ocupacion_ofendido');
		let input_ocupacion = document.querySelector('#ocupacion_descr_ofendido');

		if (e.target.value === '999') {
			select_ocupacion.classList.add('d-none');
			input_ocupacion.classList.remove('d-none');
			input_ocupacion.value = "";
			input_ocupacion.focus();
		} else {
			input_ocupacion.value = "";
		}
	});
	//Evento para calcular la edad de acuerdo a la fecha de nacimiento
	document.querySelector('#fecha_nacimiento_ofendido').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_ofendido').value = edad;
	})

	//Funcion para eliminar los options de un select
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}
	//Evento para traer los municipios de acuerdo a un estado. Se limpian los select para que no acumulen
	document.querySelector('#nacionalidad_ofendido').addEventListener('change', (e) => {
		let select_estado = document.querySelector('#estado_origen_ofendido');
		let select_municipio = document.querySelector('#municipio_origen_ofendido');

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
	//Evento para traer los municipios de acuerdo a un estado. Se limpian los select para que no acumulen

	document.querySelector('#estado_origen_ofendido').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_origen_ofendido');

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
	//Evento para traer los municipios de acuerdo a un estado. Se limpian los select para que no acumulen

	document.querySelector('#pais_ofendido').addEventListener('change', (e) => {

		let select_estado = document.querySelector('#estado_ofendido');
		let select_municipio = document.querySelector('#municipio_ofendido');
		let select_localidad = document.querySelector('#localidad_ofendido');
		let select_colonia = document.querySelector('#colonia_ofendido');
		let input_colonia = document.querySelector('#colonia_ofendido_input');

		clearSelect(select_municipio);
		clearSelect(select_localidad);
		clearSelect(select_colonia);

		select_estado.value = '';
		select_municipio.value = '';
		select_localidad.value = '';
		select_colonia.value = '';

		if (e.target.value !== 'MX') {

			//Se llena todo automaticamente
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
	//Evento para traer los municipios de acuerdo a un estado. Se limpian los select para que no acumulen

	document.querySelector('#estado_ofendido').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_ofendido');
		let select_localidad = document.querySelector('#localidad_ofendido');
		let select_colonia = document.querySelector('#colonia_ofendido');
		let input_colonia = document.querySelector('#colonia_ofendido_input');

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
	//Evento para traer las localidades de acuerdo a un municipio. Se limpian los select para que no acumulen

	document.querySelector('#municipio_ofendido').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_ofendido');
		let select_colonia = document.querySelector('#colonia_ofendido');
		let input_colonia = document.querySelector('#colonia_ofendido_input');

		let estado = document.querySelector('#estado_ofendido').value;
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
	//Evento para traer las colonias de acuerdo a un municipio,estado y localidad. Se limpian los select para que no acumulen

	document.querySelector('#localidad_ofendido').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_ofendido');
		let input_colonia = document.querySelector('#colonia_ofendido_input');

		let estado = document.querySelector('#estado_ofendido').value;
		let municipio = document.querySelector('#municipio_ofendido').value;
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

	//Evento para modificar los estilos en colonia
	document.querySelector('#colonia_ofendido').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_ofendido');
		let input_colonia = document.querySelector('#colonia_ofendido_input');

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