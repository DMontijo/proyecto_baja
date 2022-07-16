<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del imputado (posible responsable)</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_imputado" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_imputado" name="nombre_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="primer_apellido_imputado" class="form-label fw-bold">Primer apellido del imputado</label>
		<input type="text" class="form-control" id="primer_apellido_imputado" name="primer_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="segundo_apellido_imputado" class="form-label fw-bold">Segundo apellido del imputado</label>
		<input type="text" class="form-control" id="segundo_apellido_imputado" name="segundo_apellido_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="alias_imputado" class="form-label fw-bold">Apodo</label>
		<input type="text" class="form-control" id="alias_imputado" name="alias_imputado" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_imputado" class="form-label fw-bold">Municipio del imputado</label>
		<select class="form-select" id="municipio_imputado" name="municipio_imputado">
			<option selected disabled value="">Elige el municipio del imputado</option>
			<?php foreach ($body_data->municipios as $index => $municipio) { ?>
				<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_imputado" class="form-label fw-bold">Calle del imputado</label>
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
		<label for="tel_imputado" class="form-label fw-bold">Teléfono del imputado</label>
		<input type="text" class="form-control" id="tel_imputado" name="tel_imputado" maxlength="20">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nac_imputado" class="form-label fw-bold ">Fecha de nacimiento del imputado</label>
		<input type="date" class="form-control" id="fecha_nac_imputado" name="fecha_nac_imputado" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_imputado" class="form-label fw-bold">Escolaridad del imputado</label>
		<select class="form-select" id="escolaridad_imputado" name="escolaridad_imputado">
			<option selected disabled value="">Seleccione la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			La escolaridad es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_imputado" class="form-label fw-bold ">Sexo del imputado</label>
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
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_imputado" class="form-label fw-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class="bi bi-facebook"></i></span>
			<input type="text" class="form-control" name="facebook_imputado" id="facebook_imputado" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_imputado" class="form-label fw-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class="bi bi-instagram"></i></span>
			<input type="text" class="form-control" name="instagram_imputado" id="instagram_imputado" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_imputado" class="form-label fw-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class="bi bi-twitter"></i></span>
			<input type="text" class="form-control" name="twitter_imputado" id="twitter_imputado" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12">
		<label for="description_fisica_imputado" class="form-label fw-bold">Descripción física del imputado</label>
		<textarea class="form-control" id="description_fisica_imputado" name="description_fisica_imputado" onkeyup="contarCaracteresImp(this)" rows="10" maxlength="300"></textarea>
		<small id="numCaracterImp">300 caracteres restantes</small>
	</div>
</div>
<script>
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
</script>
