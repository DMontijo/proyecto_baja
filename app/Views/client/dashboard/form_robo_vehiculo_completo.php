<div class="row" method="POST">
	<h3 class="fw-bold text-center text-blue pb-3">Datos del vehículo robado</h3>
	<p class="fw-bold text-center">PLACAS</p>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_placas_vehiculo" class="form-label fw-bold">Tipo de placas:</label>
		<select class="form-select" id="tipo_placas_vehiculo" name="tipo_placas_vehiculo">
			<option selected disabled value="">Selecciona el tipo de placas</option>
			<option value="N">NACIONAL</option>
			<option value="F">FRONTERIZO</option>
			<option value="E">EXTRANJERO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="placas_vehiculo" class="form-label fw-bold">Placas:</label>
		<input type="text" class="form-control" id="placas_vehiculo" name="placas_vehiculo" onkeyup="verificarPlacas()">
		<!-- <input class="form-check-input" type="checkbox" name="placas_vehiculo_desconocidas" id="placas_vehiculo_desconocidas"> Se desconoce -->
		<!-- <label for="mensajeok" id="mensajeok" name="mensajeok" class="form-label fw-bold d-none" style="color: #009130; font-size: 12px; text-align:center;">Las placas coinciden </label>
		 <label for="mensaje" id="mensaje" name="mensaje" class="form-label fw-bold d-none" style="color: #D52600; font-size: 12px; text-align:center;">Las placas no coinciden!</label> -->

	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="confirm_placas_vehiculo" class="form-label fw-bold">Confirma las placas:</label>
		<input type="text" class="form-control" id="confirm_placas_vehiculo" name="confirm_placas_vehiculo" onkeyup="verificarPlacas()">
		<label for="mensajeok" id="mensajeok" name="mensajeok" class="form-label fw-bold d-none" style="color: #009130; font-size: 12px; text-align:center;">Las placas coinciden </label>
		<label for="mensaje" id="mensaje" name="mensaje" class="form-label fw-bold d-none" style="color: #D52600; font-size: 12px; text-align:center;">Las placas no coinciden</label>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_vehiculo" class="form-label fw-bold">Estado de origen:</label>
		<!-- <select class="form-select" id="estado_vehiculo" name="estado_vehiculo">
			<option selected disabled value="">Selecciona el estado</option>
		</select> -->
		<input type="text" class="form-control" id="estado_vehiculo" name="estado_vehiculo">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="serie_vehiculo" class="form-label fw-bold">No. Serie:</label>
		<input type="text" class="form-control" id="serie_vehiculo" name="serie_vehiculo">
		<!-- <input class="form-check-input" type="checkbox" name="serie_vehiculo_desconocida" id="serie_vehiculo_desconocida"> Se desconoce -->
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="confirm_serie_vehiculo" class="form-label fw-bold">Confirmar serie</label>
		<input type="text" class="form-control" id="confirm_serie_vehiculo" name="confirm_serie_vehiculo" onkeyup="verificarSerie()">
		<label for="coinciden" id="coinciden" name="coinciden" class="form-label fw-bold d-none" style="color: #009130; font-size: 12px; text-align:center;">La serie coincide </label>
		<label for="nocoinciden" id="nocoinciden" name="nocoinciden" class="form-label fw-bold d-none" style="color: #D52600; font-size: 12px; text-align:center;">La serie no coincide</label>
	</div>

	<p class="fw-bold text-center mt-3">FABRICANTE</p>
	<hr>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="distribuidor_vehiculo" class="form-label fw-bold">Distribuidor:</label>
		<select class="form-select" id="distribuidor_vehiculo" name="distribuidor_vehiculo">
			<option selected disabled value="">Selecciona el distribuidor</option>
			<?php foreach ($body_data->distribuidorVehiculo as $index => $distribuidor_vehiculo) { ?>
				<option value="<?= $distribuidor_vehiculo->VEHICULODISTRIBUIDORID ?> "> <?= $distribuidor_vehiculo->VEHICULODISTRIBUIDORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca" class="form-label fw-bold">Marca:</label>
		<select class="form-select" id="marca" name="marca">
			<option selected disabled value="">Selecciona la marca</option>
			<?php foreach ($body_data->marcaVehiculo as $index => $marca) { ?>
				<option value="<?= $marca->VEHICULODISTRIBUIDORID ?> <?= $marca->VEHICULOMARCAID ?> "> <?= $marca->VEHICULOMARCADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="linea_vehiculo" class="form-label fw-bold">Modelo:</label>
		<select class="form-select" id="linea_vehiculo" name="linea_vehiculo">
			<option selected disabled value="">Selecciona el modelo</option>
			<?php foreach ($body_data->lineaVehiculo as $index => $linea_vehiculo) { ?>
				<option value="<?= $linea_vehiculo->VEHICULODISTRIBUIDORID ?> <?= $linea_vehiculo->VEHICULOMARCAID ?> <?= $linea_vehiculo->VEHICULOMODELOID ?> "> <?= $linea_vehiculo->VEHICULOMODELODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="version_vehiculo" class="form-label fw-bold">Versión:</label>
		<select class="form-select" id="version_vehiculo" name="version_vehiculo">
			<option selected disabled value="">Selecciona la versión</option>
			<?php foreach ($body_data->versionVehiculo as $index => $version_vehiculo) { ?>
				<option value="<?= $version_vehiculo->VEHICULODISTRIBUIDORID ?> <?= $version_vehiculo->VEHICULOMARCAID ?> <?= $version_vehiculo->VEHICULOMODELOID ?> <?= $version_vehiculo->VEHICULOVERSIONID ?>"> <?= $version_vehiculo->VEHICULOVERSIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_vehiculo" class="form-label fw-bold">Tipo de vehículo:</label>
		<select class="form-select" id="tipo_vehiculo" name="tipo_vehiculo">
			<option selected disabled value="">Selecciona el tipo de vehículo</option>
			<?php foreach ($body_data->tipoVehiculo as $index => $tipo_vehiculo) { ?>
				<option value="<?= $tipo_vehiculo->VEHICULOTIPOID ?>"> <?= $tipo_vehiculo->VEHICULOTIPODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="servicio_vehiculo" class="form-label fw-bold">Servicio:</label>
		<select class="form-select" id="servicio_vehiculo" name="servicio_vehiculo">
			<option selected disabled value="">Selecciona el servicio</option>
			<?php foreach ($body_data->servicioVehiculo as $index => $servicio_vehiculo) { ?>
				<option value="<?= $servicio_vehiculo->VEHICULOSERVICIOID ?> "> <?= $servicio_vehiculo->VEHICULOSERVICIODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="modelo_vehiculo" class="form-label fw-bold">Año:</label>
		<select class="form-select" name="modelo_vehiculo" id="modelo_vehiculo"></select>

	</div>
	<div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3">
		<label for="seguro_vigente_vehiculo" class="form-label fw-bold ">¿Cuenta con seguro vigente?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="seguro_vigente_vehiculo" id="SI">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="seguro_vigente_vehiculo" id="NO">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="seguro_vigente_vehiculo" id="DESCONOCIDO">
			<label class="form-check-label" for="flexRadioDefault2">Se desconoce</label>
		</div>
	</div>

	<p class="fw-bold text-center mt-3">GENERALES</p>
	<hr>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_vehiculo" class="form-label fw-bold">Color:</label>
		<select class="form-select" id="color_vehiculo" name="color_vehiculo">
			<option selected disabled value="">Selecciona el color</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_tapiceria_vehiculo" class="form-label fw-bold">Color tapiceria:</label>
		<select class="form-select" id="color_tapiceria_vehiculo" name="color_tapiceria_vehiculo">
			<option selected disabled value="">Selecciona el color de tapiceria</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="num_chasis_vehiculo" class="form-label fw-bold">No. Chasis:</label>
		<input type="text" class="form-control" id="num_chasis_vehiculo" name="num_chasis_vehiculo">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="transmision_vehiculo" class="form-label fw-bold ">Caja / Transmisión:</label>
		<br>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="transmision_vehiculo" id="AUTOMATICA">
			<label class="form-check-label" for="flexRadioDefault1">Automática</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="transmision_vehiculo" id="MANUAL">
			<label class="form-check-label" for="flexRadioDefault2">Manual</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="transmision_vehiculo" id="DUAL">
			<label class="form-check-label" for="flexRadioDefault2">Dual</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="traccion_vehiculo" class="form-label fw-bold ">Tracción:</label>
		<br>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="traccion_vehiculo" id="DOBLE">
			<label class="form-check-label" for="flexRadioDefault1">Doble</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="traccion_vehiculo" id="SENCILLA">
			<label class="form-check-label" for="flexRadioDefault2">Sencilla</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="traccion_vehiculo" id="DUAL">
			<label class="form-check-label" for="flexRadioDefault2">Dual</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_vehiculo" class="form-label fw-bold">Fotografía del vehículo:</label>
		<input class="form-control" type="file" id="foto_vehiculo" name="foto_vehiculo" accept="image/jpeg, image/jpg, image/png" capture="user">
	</div>
	<div class="col-12 mb-3">
		<label for="description_vehiculo" class="form-label fw-bold">Otras características que permitan identificar el vehículo:</label>
		<textarea class="form-control" id="description_vehiculo" name="description_vehiculo" rows="10"></textarea>
	</div>
</div>

<script>
	let startYear = 1800;
	let endYear = new Date().getFullYear();
	for (i = endYear; i > startYear; i--) {
		$('#modelo_vehiculo').append($('<option />').val(i).html(i));
	}

	function verificarPlacas() {

		placas = document.getElementById('placas_vehiculo');
		confirm_placas = document.getElementById('confirm_placas_vehiculo');

		if (placas.value != confirm_placas.value) {

			document.getElementById("mensaje").classList.remove("d-none")
			document.getElementById("mensajeok").classList.add("d-none")


		} else {
			document.getElementById("mensaje").classList.add("d-none")
			document.getElementById("mensajeok").classList.remove("d-none")
		}

	}

	function verificarSerie() {

		serie = document.getElementById('serie_vehiculo');
		confirm_serie = document.getElementById('confirm_serie_vehiculo');

		if (serie.value != confirm_serie.value) {

			document.getElementById("nocoinciden").classList.remove("d-none")
			document.getElementById("coinciden").classList.add("d-none")


		} else {
			document.getElementById("nocoinciden").classList.add("d-none")
			document.getElementById("coinciden").classList.remove("d-none")
		}

	}


	document.querySelector('#distribuidor_vehiculo').addEventListener('change', (e) => {

		let select_marca = document.querySelector('#marca');
		let select_linea = document.querySelector('#linea_vehiculo');
		let select_version = document.querySelector('#version_vehiculo');

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

	document.querySelector('#marca').addEventListener('change', (e) => {
		let select_linea = document.querySelector('#linea_vehiculo');
		let select_version = document.querySelector('#version_vehiculo');
		let select_distribuidor = document.querySelector('#distribuidor_vehiculo');

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

	document.querySelector('#linea_vehiculo').addEventListener('change', (e) => {
		let select_version = document.querySelector('#version_vehiculo');
		let select_distribuidor = document.querySelector('#distribuidor_vehiculo');
		let select_marca = document.querySelector('#marca');

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
</script>
