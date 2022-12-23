<div class="modal fade shadow" id="folio_vehiculo_modal_da" tabindex="-1" role="dialog" aria-labelledby="VehiculoModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content">
			<div class="modal-header bg-blue text-white"">
				<h5 class=" modal-title font-weight-bold">VEHICULO</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<form id="form_vehiculo_da" action="" method="post" enctype="multipart/form-data" class="row p-0 m-0 needs-validation" novalidate>

					<div class="col-12">
						<p class="font-weight-bold text-center mt-3">GENERALES</p>
					</div>
					<hr>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tipo_placas_vehiculo_da" class="form-label font-weight-bold">Tipo de placas:</label>
						<select class="form-control" id="tipo_placas_vehiculo_da" name="tipo_placas_vehiculo_da">
							<option selected disabled value="">Selecciona el tipo de placas</option>
							<option value="N">NACIONAL</option>
							<option value="F">FRONTERIZO</option>
							<option value="E">EXTRANJERO</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="placas_vehiculo_da" class="form-label font-weight-bold">Placas:</label>
						<input type="text" class="form-control" id="placas_vehiculo_da" name="placas_vehiculo_da">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estado_vehiculo_da" class="form-label font-weight-bold">Estado:</label>
						<select class="form-control" id="estado_vehiculo_da_ad" name="estado_vehiculo_da_ad">
							<option selected disabled value="">Selecciona el estado</option>
							<?php foreach ($body_data->estados as $index => $estado) { ?>
								<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?></option>
							<?php } ?>
						</select>
						<select class="form-control" id="estado_extranjero_vehiculo_da_ad" name="estado_extranjero_vehiculo_da_ad" style="display: none;">
							<option selected disabled value="">Selecciona el estado</option>
							<?php foreach ($body_data->estadosExtranjeros as $index => $estado_extranjero) { ?>
								<option value="<?= $estado_extranjero->ESTADOEXTRANJEROID ?>"> <?= strtoupper($estado_extranjero->ESTADOEXTRANJERODESCR) ?></option>
							<?php } ?>
							<option value="0" style="font-weight:bold">NACIONAL</option>

						</select>
						<!-- <input type="text" class="form-control" id="estado_vehiculo_da" name="estado_vehiculo_da"> -->
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="serie_vehiculo_da" class="form-label font-weight-bold">No. Serie:</label>
						<input type="text" class="form-control" id="serie_vehiculo_da" name="serie_vehiculo_da">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tipo_vehiculo_da" class="form-label font-weight-bold">Tipo de vehículo:</label>
						<select class="form-control" id="tipo_vehiculo_da" name="tipo_vehiculo_da">
							<option selected disabled>Selecciona el tipo de vehículo</option>
							<?php foreach ($body_data->tipoVehiculo as $index => $tipo_vehiculo_da) { ?>
								<option value="<?= $tipo_vehiculo_da->VEHICULOTIPOID ?>"> <?= $tipo_vehiculo_da->VEHICULOTIPODESCR ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="color_vehiculo_da" class="form-label font-weight-bold">Color:</label>
						<select class="form-control" id="color_vehiculo_da" name="color_vehiculo_da">
							<option selected disabled value="">Selecciona el color</option>
							<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo_da) { ?>
								<option value="<?= $color_vehiculo_da->VEHICULOCOLORID ?>"> <?= $color_vehiculo_da->VEHICULOCOLORDESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="color_tapiceria_vehiculo_da" class="form-label font-weight-bold">Color tapiceria:</label>
						<select class="form-control" id="color_tapiceria_vehiculo_da" name="color_tapiceria_vehiculo_da">
							<option selected disabled value="">Selecciona el color de tapiceria</option>
							<?php foreach ($body_data->colorVehiculo as $index => $color_vehiculo_da) { ?>
								<option value="<?= $color_vehiculo_da->VEHICULOCOLORID ?>"> <?= $color_vehiculo_da->VEHICULOCOLORDESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="num_chasis_vehiculo_da" class="form-label font-weight-bold">No. Chasis:</label>
						<input type="text" class="form-control" id="num_chasis_vehiculo_da" name="num_chasis_vehiculo_da">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="transmision_vehiculo_da" class="form-label font-weight-bold ">Caja / Transmisión:</label>
						<select class="form-control" id="transmision_vehiculo_da" name="transmision_vehiculo_da">
							<option selected value="A">Automática</option>
							<option selected value="M">Manual</option>
							<option selected value="D">Dual</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="traccion_vehiculo_da" class="form-label font-weight-bold ">Tracción:</label>
						<select class="form-control" id="traccion_vehiculo_da" name="traccion_vehiculo_da">
							<option selected value="D">Doble</option>
							<option selected value="S">Sencilla</option>
							<option selected value="O">Dual</option>
						</select>
					</div>
					<div class="col-12 mb-3">
						<label for="description_vehiculo_da" class="form-label font-weight-bold">Otras características que permitan identificar el vehiculo:</label>
						<textarea class="form-control" id="description_vehiculo_da" name="description_vehiculo_da" rows="10" oninput="mayuscTextarea(this)"></textarea>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="foto_vehiculo_da" class="form-label font-weight-bold">Fotografía del vehículo:</label>
						<a class="btn btn-primary btn-block mb-4 font-weight-bold" id="downloadImage" download="">Descargar imagen</a>
						<input class="form-control" type="file" id="subirFotoVDa" name="subirFotoVDa" accept="image/jpeg, image/jpg, image/png, .doc, .pdf"> </input>
						<img class="img-fluid mb-3" id="foto_vehiculo_da" name="foto_vehiculo_da" src="" alt="">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="doc_vehiculo_da" class="form-label font-weight-bold">Documento del vehículo:</label>
						<a class="btn btn-primary btn-block mb-4 font-weight-bold" id="downloadDoc" download="">Descargar documento</a>
						<input class="form-control" type="file" id="subirDocDa" name="subirDocDa" accept="image/jpeg, image/jpg, image/png, .doc, .pdf"></input>
						<img class="img-fluid mb-3" id="doc_vehiculo_da" name="doc_vehiculo_da" src="" alt="">
					</div>

					<div class="col-12">
						<p class="font-weight-bold text-center mt-3">FABRICANTE</p>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="distribuidor_vehiculo_da" class="form-label font-weight-bold">Distribuidor:</label>
						<select class="form-control" id="distribuidor_vehiculo_da_ad" name="distribuidor_vehiculo_da_ad">
							<option selected disabled value="">Selecciona el distribuidor</option>
							<?php foreach ($body_data->distribuidorVehiculo as $index => $distribuidor_vehiculo_da) { ?>
								<option value="<?= $distribuidor_vehiculo_da->VEHICULODISTRIBUIDORID ?>"> <?= $distribuidor_vehiculo_da->VEHICULODISTRIBUIDORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="marca_ad_da" class="form-label font-weight-bold">Marca:</label>
						<select class="form-control" id="marca_ad_da" name="marca_ad_da">
							<option selected disabled value="">Selecciona la marca</option>

						</select>

					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="marca_ad_exacta_da" class="form-label font-weight-bold">Marca exacta:</label>
						<input class="form-control" id="marca_ad_exacta_da" name="marca_ad_exacta_da">

					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="linea_vehiculo_da" class="form-label font-weight-bold">Modelo:</label>
						<select class="form-control" id="linea_vehiculo_da_ad" name="linea_vehiculo_da_ad">
							<option selected disabled value="">Selecciona el modelo</option>


						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="version_vehiculo_da" class="form-label font-weight-bold">Versión:</label>
						<select class="form-control" id="version_vehiculo_da_ad" name="version_vehiculo_da_ad">
							<option selected disabled value="">Selecciona la versión</option>

						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="servicio_vehiculo_da" class="form-label font-weight-bold">Servicio:</label>
						<select class="form-control" id="servicio_vehiculo_da_ad" name="servicio_vehiculo_da_ad">
							<option selected disabled value="">Selecciona el servicio</option>
							<?php foreach ($body_data->servicioVehiculo as $index => $servicio_vehiculo_da) { ?>
								<option value="<?= $servicio_vehiculo_da->VEHICULOSERVICIOID ?>"> <?= $servicio_vehiculo_da->VEHICULOSERVICIODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="modelo_vehiculo_da" class="form-label font-weight-bold">Año:</label>
						<select class="form-control" name="modelo_vehiculo_da" id="modelo_vehiculo_da"></select>

					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-3">
						<label for="seguro_vigente_vehiculo_da" class="form-label font-weight-bold ">¿Cuenta con seguro vigente?</label>
						<select class="form-control" id="seguro_vigente_vehiculo_da" name="seguro_vigente_vehiculo_da">
							<option selected value="S">Si</option>
							<option selected value="N">No</option>
							<option selected value="D">Se desconoce</option>
						</select>

					</div>
					<div class="col-12 mb-3 text-center">
						<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR VEHÍCULO</button>
					</div>
				</form>


			</div>
		</div>
	</div>
</div>
<script>
	
	let startYearU = 1800;
	let endYearU = new Date().getFullYear();
	for (let i = endYearU; i > startYearU; i--) {
		$('#modelo_vehiculo_da').append($('<option />').val(i).html(i));
	}
	document.querySelector('#subirFotoVDa').addEventListener('change', (e) => {
		let preview = document.querySelector('#foto_vehiculo_da');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});

	document.querySelector('#subirDocDa').addEventListener('change', (e) => {
		let preview = document.querySelector('#doc_vehiculo_da');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});
</script>