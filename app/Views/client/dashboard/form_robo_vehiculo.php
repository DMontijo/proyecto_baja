<div class="row" method="POST">
	<h3 class="fw-bold text-center text-blue pb-3">Datos del vehículo robado</h3>
	<p class="fw-bold text-center">PLACAS</p>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_placas_vehiculo" class="form-label fw-bold">Tipo de placas:</label>
		<select class="form-select" id="tipo_placas_vehiculo" name="tipo_placas_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el tipo de placas</option>
			<option value="N">NACIONAL</option>
			<option value="F">FRONTERIZO</option>
			<option value="E">EXTRANJERO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="placas_vehiculo" class="form-label fw-bold">Placas:</label>
		<input type="text" class="form-control" id="placas_vehiculo" name="placas_vehiculo">
		<input class="form-check-input" type="checkbox" name="placas_vehiculo_desconocidas" id="placas_vehiculo_desconocidas"> Se desconoce
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="confirm_placas_vehiculo" class="form-label fw-bold">Confirma las placas:</label>
		<input type="text" class="form-control" id="confirm_placas_vehiculo" name="confirm_placas_vehiculo">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_vehiculo" class="form-label fw-bold">Estado de origen:</label>
		<select class="form-select" id="estado_vehiculo" name="estado_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el estado</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="serie_vehiculo" class="form-label fw-bold">No. Serie:</label>
		<input type="text" class="form-control" id="serie_vehiculo" name="serie_vehiculo">
		<input class="form-check-input" type="checkbox" name="serie_vehiculo_desconocida" id="serie_vehiculo_desconocida"> Se desconoce
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="confirm_serie_vehiculo" class="form-label fw-bold">Confirmar serie</label>
		<input type="text" class="form-control" id="confirm_serie_vehiculo" name="confirm_serie_vehiculo">
	</div>

	<p class="fw-bold text-center mt-3">FABRICANTE</p>
	<hr>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="distribuidor_vehiculo" class="form-label fw-bold">Distribuidor:</label>
		<select class="form-select" id="distribuidor_vehiculo" name="distribuidor_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el distribuidor</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca" class="form-label fw-bold">Marca:</label>
		<select class="form-select" id="marca" name="marca" autofocus>
			<option selected disabled value="">Seleccione la marca</option>
			<?php foreach ($body_data->marcaVehiculo as $index => $marca) { ?>
				<option value="<?= $marca->VEHICULODISTRIBUIDORID ?> <?= $marca->VEHICULOMARCAID ?> "> <?= $marca->VEHICULOMARCADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="linea_vehiculo" class="form-label fw-bold">Modelo:</label>
		<select class="form-select" id="linea_vehiculo" name="linea_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el modelo</option>
			<?php foreach ($body_data->lineaVehiculo as $index => $linea_vehiculo) { ?>
				<option value="<?= $linea_vehiculo->VEHICULODISTRIBUIDORID ?> <?= $linea_vehiculo->VEHICULOMARCAID ?> <?= $linea_vehiculo->VEHICULOMODELOID ?> "> <?= $linea_vehiculo->VEHICULOMODELODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="version_vehiculo" class="form-label fw-bold">Versión:</label>
		<select class="form-select" id="version_vehiculo" name="version_vehiculo" autofocus>
			<option selected disabled value="">Seleccione la versión</option>
			<?php foreach ($body_data->marcaVehiculo as $index => $version_vehiculo) { ?>
				<option value="<?= $version_vehiculo->VEHICULODISTRIBUIDORID ?> <?= $version_vehiculo->VEHICULOMARCAID ?> "> <?= $version_vehiculo->VEHICULOMARCADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_vehiculo" class="form-label fw-bold">Tipo de vehículo:</label>
		<select class="form-select" id="tipo_vehiculo" name="tipo_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el tipo de vehículo</option>
			<?php foreach ($body_data->tipoVehiculo as $index => $tipo_vehiculo) { ?>
				<option value="<?= $tipo_vehiculo->VEHICULOTIPOID ?>"> <?= $tipo_vehiculo->VEHICULOTIPODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="servicio_vehiculo" class="form-label fw-bold">Servicio:</label>
		<select class="form-select" id="servicio_vehiculo" name="servicio_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el servicio</option>
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
		<select class="form-select" id="color_vehiculo" name="color_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el color</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_tapiceria_vehiculo" class="form-label fw-bold">Color tapiceria:</label>
		<select class="form-select" id="color_tapiceria_vehiculo" name="color_tapiceria_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el color de tapiceria</option>
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
		<input class="form-control" type="file" id="foto_vehiculo" name="foto_vehiculo" accept="image/*" capture="user">
	</div>
	<div class="col-12 mb-3">
		<label for="description_vehiculo" class="form-label fw-bold">Otras carcterísticas que permitan identificar el vehiculo:</label>
		<textarea class="form-control" id="description_vehiculo" name="description_vehiculo" rows="10"></textarea>
	</div>
</div>

<script>
	let startYear = 1800;
	let endYear = new Date().getFullYear();
	for (i = endYear; i > startYear; i--) {
		$('#modelo_vehiculo').append($('<option />').val(i).html(i));
	}
</script>
