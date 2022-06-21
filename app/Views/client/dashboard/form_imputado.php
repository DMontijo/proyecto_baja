<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del posible responsable</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_imputado" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_imputado" name="nombre_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="primer_apellido_imputado" class="form-label fw-bold">Primer apellido del posible responsable</label>
		<input type="text" class="form-control" id="primer_apellido_imputado" name="primer_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="segundo_apellido_imputado" class="form-label fw-bold">Segundo apellido del posible responsable</label>
		<input type="text" class="form-control" id="segundo_apellido_imputado" name="segundo_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="alias_imputado" class="form-label fw-bold">Apodo</label>
		<input type="text" class="form-control" id="alias_imputado" name="alias_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_imputado" class="form-label fw-bold">Municipio del posible responsable</label>
		<select class="form-select" id="municipio_imputado" name="municipio_imputado">
			<option selected disabled value="">Elige el municipio del imputado</option>
			<?php foreach ($body_data->municipios as $index => $municipio) { ?>
				<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_imputado" class="form-label fw-bold">Calle del posible responsable</label>
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
		<label for="tel_imputado" class="form-label fw-bold">Teléfono del posible responsable</label>
		<input type="text" class="form-control" id="tel_imputado" name="tel_imputado" maxlength="20">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nac_imputado" class="form-label fw-bold ">Fecha de nacimiento del posible responsable</label>
		<input type="date" class="form-control" id="fecha_nac_imputado" name="fecha_nac_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_imputado" class="form-label fw-bold ">Sexo del posible responsable</label>
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
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_imputado" class="form-label fw-bold">Escolaridad del posible responsable</label>
		<input type="text" class="form-control" id="escolaridad_imputado" name="escolaridad_imputado" maxlength="30">
	</div>
	<div class="col-12">
		<label for="description_fisica_imputado" class="form-label fw-bold">Descripción física del posible responsable</label>
		<textarea class="form-control" id="description_fisica_imputado" name="description_fisica_imputado" row="5" maxlength="300"></textarea>
	</div>
</div>
