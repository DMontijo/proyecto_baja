<div class="row">
	<h3 class="fw-bold text-center text-blue pb-3">Lugar del hecho</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito" class="form-label fw-bold input-required">Delito a denunciar:</label>
		<select class="form-select" id="delito" name="delito" required>
			<option selected disabled value="">Elige el delito</option>
			<?php foreach ($body_data->delitosUsuarios as $index => $delitos) { ?>
				<option value="<?= $delitos->DELITO ?>"> <?= $delitos->DELITO ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Selecciona el delito
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none" id="radio_documentos_vehiculo">
		<label for="documentos_vehiculo" class="form-label font-weight-bold input-required">¿Cuentas con algún documento en ese momento para verificar la serie y las placas del auto?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="documentos_vehiculo" id="documentos_vehiculo" value="N" required checked>
			<label class="form-check-label" for="documentos_vehiculo">NO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="documentos_vehiculo" id="documentos_vehiculo" value="S" required>
			<label class="form-check-label" for="documentos_vehiculo">SÍ</label>
		</div>
	

		<div class="form-check form-check-inline d-none">
			<input class="form-check-input" type="radio" name="documentos_vehiculo" id="documentos_vehiculo" value="O">
			<label class="form-check-label" for="documentos_vehiculo">OTRO</label>
		</div>
		<div class="invalid-feedback">
			Por favor, anexa una calle o avenida.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio" class="form-label fw-bold">Municipio del delito:</label>
		<select class="form-select" id="municipio" name="municipio">
			<option selected disabled value="">Elige el municipio</option>
			<?php foreach ($body_data->municipios as $index => $municipio) { ?>
				<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un municipio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad" class="form-label fw-bold">Localidad del delito</label>
		<select class="form-select" id="localidad" name="localidad">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
		<div class="invalid-feedback">
			La localidad es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label fw-bold">Colonia del delito</label>
		<select class="form-select" id="colonia_select" name="colonia_select">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia" name="colonia" maxlength="50">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle" class="form-label fw-bold ">Calle o avenida del delito:</label>
		<input type="text" class="form-control" id="calle" name="calle" maxlength="50">
		<div class="invalid-feedback">
			Por favor, anexa una calle o avenida.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior" class="form-label fw-bold">No. exterior del delito:</label>
		<input type="text" class="form-control" id="exterior" name="exterior" maxlength="10">
		<div class="invalid-feedback">
			Por favor, anexa un número exterior del delito.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior" class="form-label fw-bold">No. interior del delito:</label>
		<input type="text" class="form-control" id="interior" maxlength="10" name="interior">
		<div class="invalid-feedback">
			Por favor, anexa un número interior del delito.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar" class="form-label fw-bold input-required">Lugar del delito:</label>
		<select class="form-select" id="lugar" name="lugar" required>
			<option selected disabled value="">Elige el lugar del delito</option>
			<?php foreach ($body_data->lugares as $index => $lugar) { ?>
				<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un lugar.
		</div>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="clasificacion" class="form-label fw-bold">Clasificación del lugar</label>
		<select class="form-select" id="clasificacion" name="clasificacion">
			<option selected disabled value="">Elige la clasificacion</option>
		</select>
	</div> -->
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha" class="form-label fw-bold input-required">Fecha del delito:</label>
		<input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" required>
		<div class="invalid-feedback">
			La fecha del delito es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hora" class="form-label fw-bold input-required">Hora del delito:</label>
		<input type="time" class="form-control" id="hora" name="hora" required>
		<small>Debe estar en formato de 24 horas.</small>
		<div class="invalid-feedback">
			La hora del delito es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="responsable" class="form-label fw-bold input-required">¿Identifica al responsable del delito?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="responsable" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="responsable" value="NO" required checked>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12">
		<label for="descripcion_breve" class="form-label fw-bold input-required">Descripción breve del delito</label>
		<textarea class="form-control" id="descripcion_breve" name="descripcion_breve" rows="10" maxlength="1000" onkeyup="contarCaracteres(this)" required></textarea>
		<small id="numCaracter">1000 caracteres restantes</small>
	</div>
</div>
<script>
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	document.querySelector('#municipio').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad');
		let select_colonia = document.querySelector('#colonia_select');
		let input_colonia = document.querySelector('#colonia');

		let estado = 2;
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

	document.querySelector('#localidad').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select');
		let input_colonia = document.querySelector('#colonia');

		let estado = 2;
		let municipio = document.querySelector('#municipio').value;
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
			input_colonia.value = "";
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});

	// document.querySelector('#lugar').addEventListener('change', (e) => {
	// 	let select_clasificacion = document.querySelector('#clasificacion');

	// 	clearSelect(select_clasificacion);

	// 	data = {
	// 		'lugar_id': e.target.value,
	// 	}

	// 	$.ajax({
	// 		data: data,
	// 		url: "<?= base_url('/data/get-clasificacion-by-lugar') ?>",
	// 		method: "POST",
	// 		dataType: "json",
	// 		success: function(response) {
	// 			let clasificaciones = response.data;

	// 			clasificaciones.forEach(clasificacion => {
	// 				var option = document.createElement("option");
	// 				option.text = clasificacion.HECHOCLASIFICACIONLUGARDESCR;
	// 				option.value = clasificacion.HECHOCLASIFICACIONLUGARID;
	// 				select_clasificacion.add(option);
	// 			});
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {}
	// 	});
	// });

	function contarCaracteres(obj) {
		var maxLength = 1000;
		var strLength = obj.value.length;
		var charRemain = (maxLength - strLength);

		if (charRemain < 0) {
			document.getElementById("numCaracter").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracter").innerHTML = charRemain + ' caracteres restantes';
		}
	}
</script>
