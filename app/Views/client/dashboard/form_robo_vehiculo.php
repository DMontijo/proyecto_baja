<div class="row" method="POST">
	<h3 class="fw-bold text-center text-blue pb-3">Datos del vehículo robado</h3>

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
		<label for="color_vehiculo" class="form-label fw-bold">Color:</label>
		<select class="form-select" id="color_vehiculo" name="color_vehiculo">
			<option selected disabled value="">Selecciona el color</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 mb-3">
		<label for="description_vehiculo" class="form-label fw-bold">Otras características que permitan identificar el vehículo:</label>
		<textarea class="form-control" id="description_vehiculo" name="description_vehiculo" rows="10" maxlength="300" onkeyup="contarCaracteresVehiculo(this)"></textarea>
		<small id="numCaracterVehiculo">300 caracteres restantes</small>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_vehiculo_nc" class="form-label fw-bold">Fotografía del vehículo:</label>
		<input class="form-control" type="file" id="foto_vehiculo_nc" name="foto_vehiculo_nc" accept="image/jpeg, image/jpg, image/png">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="documento_vehiculo_nc" class="form-label fw-bold">Documento del vehículo:</label>
		<input class="form-control" type="file" id="documento_vehiculo_nc" name="documento_vehiculo_nc" accept="image/jpeg, image/jpg, image/png, .doc, .pdf">
	</div>
</div>
<script>
	function contarCaracteresVehiculo(obj) {
		var maxLength = 300;
		var strLength = obj.value.length;
		var charRemain = (maxLength - strLength);

		if (charRemain < 0) {
			document.getElementById("numCaracterVehiculo").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracterVehiculo").innerHTML = charRemain + ' caracteres restantes';
		}
	}

	document.querySelector('#foto_vehiculo_nc').addEventListener("change", function() {
		// Si no hay archivos, regresamos
		if (this.files.length <= 0) return;

		// Validamos el primer archivo únicamente
		const archivo = this.files[0];
		if (archivo.size > 3000000) {
			// Limpiar
			document.querySelector('#foto_vehiculo_nc').value = "";
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'El tamaño máximo de los documentos debe ser de 3MB.',
				confirmButtonColor: '#bf9b55',
			})
		}
	});

	document.querySelector('#documento_vehiculo_nc').addEventListener("change", function() {
		// Si no hay archivos, regresamos
		if (this.files.length <= 0) return;

		// Validamos el primer archivo únicamente
		const archivo = this.files[0];
		if (archivo.size > 3000000) {
			// Limpiar
			document.querySelector('#documento_vehiculo_nc').value = "";
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'El tamaño máximo de los documentos debe ser de 3MB.',
				confirmButtonColor: '#bf9b55',
			})
		}
	});
</script>
