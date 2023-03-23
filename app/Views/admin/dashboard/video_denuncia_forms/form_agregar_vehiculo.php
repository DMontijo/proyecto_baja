<form id="form_vehiculo_agregar" action="" method="post"  enctype="multipart/form-data" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">GENERALES</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="situacion_vehiculo" class="form-label font-weight-bold">Situación:</label>
		<select class="form-control" id="situacion_vehiculo_add" name="situacion_vehiculo_add" required>
			<option selected disabled value="">Selecciona la situación</option>
			<?php foreach ($body_data->situacionVehiculo as $index => $situacionVehiculo) { ?>
				<option value="<?= $situacionVehiculo->VEHICULOSITUACIONID ?>"> <?= $situacionVehiculo->VEHICULOSITUACIONDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_placas_vehiculo_add" class="form-label font-weight-bold">Tipo de placas:</label>
		<select class="form-control" id="tipo_placas_vehiculo_add" name="tipo_placas_vehiculo_add">
			<option selected disabled value="">Selecciona el tipo de placas</option>
			<option value="N">NACIONAL</option>
			<option value="F">FRONTERIZO</option>
			<option value="E">EXTRANJERO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="placas_vehiculo_add" class="form-label font-weight-bold">Placas:</label>
		<input type="text" class="form-control" id="placas_vehiculo_add" name="placas_vehiculo_add">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_vehiculo_add" class="form-label font-weight-bold">Estado:</label>
		<select class="form-control" id="estado_vehiculo_add_ad" name="estado_vehiculo_add_ad" required>
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?></option>
			<?php } ?>
		</select>
		<select class="form-control" id="estado_extranjero_vehiculo_add_ad" name="estado_extranjero_vehiculo_add_ad" style="display: none;">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estadosExtranjeros as $index => $estado_extranjero) { ?>
				<option value="<?= $estado_extranjero->ESTADOEXTRANJEROID ?>"> <?= strtoupper($estado_extranjero->ESTADOEXTRANJERODESCR) ?></option>
			<?php } ?>
			<option value="0" style="font-weight:bold">NACIONAL</option>

		</select>
		<!-- <input type="text" class="form-control" id="estado_vehiculo" name="estado_vehiculo"> -->
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="serie_vehiculo_add" class="form-label font-weight-bold">No. Serie:</label>
		<input type="text" class="form-control" id="serie_vehiculo_add" name="serie_vehiculo_add">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_vehiculo_add" class="form-label font-weight-bold">Tipo de vehículo:</label>
		<select class="form-control" id="tipo_vehiculo_add" name="tipo_vehiculo_add">
			<option selected disabled value="">Selecciona el tipo de vehículo</option>
			<?php foreach ($body_data->tipoVehiculo as $index => $tipo_vehiculo) { ?>
				<option value="<?= $tipo_vehiculo->VEHICULOTIPOID ?>"> <?= $tipo_vehiculo->VEHICULOTIPODESCR ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_vehiculo_add" class="form-label font-weight-bold">Color:</label>
		<select class="form-control" id="color_vehiculo_add" name="color_vehiculo_add">
			<option selected disabled value="">Selecciona el color</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_tapiceria_vehiculo_add" class="form-label font-weight-bold">Color tapiceria:</label>
		<select class="form-control" id="color_tapiceria_vehiculo_add" name="color_tapiceria_vehiculo_add">
			<option selected disabled value="">Selecciona el color de tapiceria</option>
			<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo) { ?>
				<option value="<?= $color_vehiculo->VEHICULOCOLORID ?>"> <?= $color_vehiculo->VEHICULOCOLORDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="num_chasis_vehiculo_add" class="form-label font-weight-bold">No. Chasis:</label>
		<input type="text" class="form-control" id="num_chasis_vehiculo_add" name="num_chasis_vehiculo_add">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="transmision_vehiculo_add" class="form-label font-weight-bold ">Caja / Transmisión:</label>
		<select class="form-control" id="transmision_vehiculo_add" name="transmision_vehiculo_add">
		<option selected  value="A">Automática</option>
		<option selected  value="M">Manual</option>
		<option selected  value="D">Dual</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="traccion_vehiculo_add" class="form-label font-weight-bold ">Tracción:</label>
		<select class="form-control" id="traccion_vehiculo_add" name="traccion_vehiculo_add">
		<option selected  value="D">Doble</option>
		<option selected  value="S">Sencilla</option>
		<option selected  value="O">Dual</option>
		</select>
	</div>
	<div class="col-12 mb-3">
		<label for="description_vehiculo_add" class="form-label font-weight-bold">Otras características que permitan identificar el vehiculo:</label>
		<textarea class="form-control" id="description_vehiculo_add" name="description_vehiculo_add" rows="10" oninput="mayuscTextarea(this)"></textarea>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_vehiculo_add" class="form-label font-weight-bold">Fotografía del vehículo:</label>
		<input class="form-control" type="file" id="subirFotoVAdd" name="subirFotoVAdd" accept="image/jpeg, image/jpg, image/png, .doc, .pdf"> </input>
		<img class="img-fluid mb-3" id="foto_vehiculo_add" name="foto_vehiculo_add" src="" alt="">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="doc_vehiculo_add" class="form-label font-weight-bold">Documento del vehículo:</label>
		<input class="form-control" type="file" id="subirDocAdd" name="subirDocAdd" accept="image/jpeg, image/jpg, image/png, .doc, .pdf"></input>
		<img class="img-fluid mb-3" id="doc_vehiculo_add" name="doc_vehiculo_add" src="" alt="">
	</div>
	
	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">FABRICANTE</p>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="distribuidor_vehiculo_add" class="form-label font-weight-bold">Distribuidor:</label>
		<select class="form-control" id="distribuidor_vehiculo_add_ad" name="distribuidor_vehiculo_add_ad" required>
			<option selected disabled value="">Selecciona el distribuidor</option>
			<?php foreach ($body_data->distribuidorVehiculo as $index => $distribuidor_vehiculo) { ?>
				<option value="<?= $distribuidor_vehiculo->VEHICULODISTRIBUIDORID?>"> <?= $distribuidor_vehiculo->VEHICULODISTRIBUIDORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca_ad" class="form-label font-weight-bold">Marca:</label>
		<select class="form-control" id="marca_add_ad" name="marca_add_ad" required>
			<option selected disabled value="">Selecciona la marca</option>
	
		</select>

	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca_ad_exacta_add" class="form-label font-weight-bold">Marca exacta:</label>
		<input type="text" class="form-control" id="marca_ad_exacta_add" name="marca_ad_exacta_add">

	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="linea_vehiculo_add" class="form-label font-weight-bold">Modelo:</label>
		<select class="form-control" id="linea_vehiculo_add_ad" name="linea_vehiculo_add_ad" required>
			<option selected disabled value="">Selecciona el modelo</option>

			
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="version_vehiculo_add" class="form-label font-weight-bold">Versión:</label>
		<select class="form-control" id="version_vehiculo_add_ad" name="version_vehiculo_add_ad">
			<option selected disabled value="">Selecciona la versión</option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="servicio_vehiculo_add" class="form-label font-weight-bold">Servicio:</label>
		<select class="form-control" id="servicio_vehiculo_add_ad" name="servicio_vehiculo_add_ad">
			<option selected disabled value="">Selecciona el servicio</option>
			<?php foreach ($body_data->servicioVehiculo as $index => $servicio_vehiculo) { ?>
				<option value="<?= $servicio_vehiculo->VEHICULOSERVICIOID ?>"> <?= $servicio_vehiculo->VEHICULOSERVICIODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="modelo_vehiculo_add" class="form-label font-weight-bold">Año:</label>
		<select class="form-control" name="modelo_vehiculo_add" id="modelo_vehiculo_add" required></select>

	</div>
	<div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3">
		<label for="seguro_vigente_vehiculo_add" class="form-label font-weight-bold ">¿Cuenta con seguro vigente?</label>
		<select class="form-control" id="seguro_vigente_vehiculo_add" name="seguro_vigente_vehiculo_add">
		<option selected  value="S">Si</option>
		<option selected  value="N">No</option>
		<option selected  value="D">Se desconoce</option>
		</select>
		
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="propietario_vehiculo_add" class="form-label font-weight-bold">Propietario:</label>
		<select class="form-control" id="propietario_vehiculo_add" name="propietario_vehiculo_add" required>
			<option selected disabled value="">Selecciona el propietario</option>
	
		</select>

	</div>
	<div class="col-12 mb-3 text-center">
		<button type="submit" class="btn btn-primary font-weight-bold">AGREGAR VEHÍCULO</button>
	</div>
</form>

<script>
		document.querySelector('#subirFotoVAdd').addEventListener('change', (e) => {
		let preview = document.querySelector('#foto_vehiculo_add');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});
	
	document.querySelector('#subirDocAdd').addEventListener('change', (e) => {
		let preview = document.querySelector('#doc_vehiculo_add');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});
</script>