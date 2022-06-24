<div class="row" method="POST">
	<h3 class="fw-bold text-center text-blue pb-3">Datos del vehículo robado</h3>

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
		<label for="color_vehiculo" class="form-label fw-bold">Color:</label>
		<select class="form-select" id="color_vehiculo" name="color_vehiculo" autofocus>
			<option selected disabled value="">Seleccione el color</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 mb-3">
		<label for="description_vehiculo" class="form-label fw-bold">Otras características que permitan identificar el vehículo:</label>
		<textarea class="form-control" id="description_vehiculo" name="description_vehiculo" rows="10" maxlength="300"></textarea>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_vehiculo" class="form-label fw-bold">Fotografía del vehículo:</label>
		<!--<input class="form-control" type="file" id="foto_vehiculo" name="foto_vehiculo" accept="image/*" capture="user">-->
		<input type="file" name="foto_vehiculo" />
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="documento_vehiculo" class="form-label fw-bold">Documento del vehículo:</label>
		<input class="form-control" type="file" id="documento_vehiculo" name="documento_vehiculo" accept="image/*" capture="user">
	</div>
</div>
