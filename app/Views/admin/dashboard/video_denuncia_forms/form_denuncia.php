<form id="denuncia_form" action="" method="post" class="row needs-validation" novalidate>
	<div class="col-12 mb-3">
		<h3 class="font-weight-bold mb-4 text-center">INFORMACIÓN DEL HECHO</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito_delito" class="form-label font-weight-bold">Delito:</label>
		<select class="form-control" id="delito_delito" name="delito_delito">
			<option selected disabled value="">Selecciona el delito</option>
			<?php foreach ($body_data->delitosUsuarios as $index => $delitos) { ?>
				<option value="<?= $delitos->DELITO ?>"> <?= $delitos->DELITO ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_delito" class="form-label font-weight-bold">Municipio:</label>
		<select class="form-control" id="municipio_delito" name="municipio_delito" required>
			<option selected disabled value="">Selecciona el municipio</option>
			<?php foreach ($body_data->municipios as $index => $municipio) { ?>
				<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_delito" class="form-label font-weight-bold">Localidad:</label>
		<select class="form-control" id="localidad_delito" name="localidad_delito" required>
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_delito" class="form-label font-weight-bold">Colonia</label>
		<input type="text" class="form-control d-none" id="colonia_delito" name="colonia_delito" maxlength="100" required>
		<select class="form-control" id="colonia_delito_select" name="colonia_delito_select" required>
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_delito" class="form-label font-weight-bold">Calle:</label>
		<input type="text" class="form-control" id="calle_delito" name="calle_delito" maxlength="100" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior_delito" class="form-label font-weight-bold">No. exterior:</label>
		<input type="text" class="form-control" id="exterior_delito" name="exterior_delito" maxlength="10" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_delito" class="form-label font-weight-bold">No. interior:</label>
		<input type="text" class="form-control" id="interior_delito" maxlength="10" name="interior_delito">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar_delito" class="form-label font-weight-bold">Lugar:</label>
		<select class="form-control" id="lugar_delito" name="lugar_delito" required>
			<option selected disabled value="">Selecciona el lugar del delito</option>
			<?php foreach ($body_data->lugares as $index => $lugar) { ?>
				<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_delito" class="form-label font-weight-bold">Fecha:</label>
		<input type="date" class="form-control" id="fecha_delito" name="fecha_delito" required max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hora_delito" class="form-label font-weight-bold">Hora:</label>
		<input type="time" class="form-control" id="hora_delito" name="hora_delito" required>
	</div>
	<div class="col-12 mb-3">
		<label for="narracion_delito" class="form-label font-weight-bold">Narración:</label>
		<textarea type="text" class="form-control" id="narracion_delito" name="narracion_delito" rows="5" maxlength="1000" required></textarea>
	</div>
	<div class="col-12 mb-3 text-center">
		<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR HECHO</button>
	</div>
</form>