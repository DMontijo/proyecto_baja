<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del imputado</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_imputado" class="form-label fw-bold">Nombre(s) imputado</label>
		<input type="text" class="form-control" id="nombre_imputado" name="nombre_imputado" autofocus>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="alias" class="form-label fw-bold">Alias</label>
		<input type="text" class="form-control" id="alias" name="alias">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="primer_apellido" class="form-label fw-bold">Primer apellido</label>
		<input type="text" class="form-control" id="primer_apellido" name="primer_apellido">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="segundo_apellido" class="form-label fw-bold">Segundo apellido</label>
		<input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_imputado" class="form-label fw-bold">Municipio del imputado:</label>
		<select class="form-select" id="municipio_imputado" name="municipio_imputado">
			<option selected disabled value="">Elige el municipio del imputado</option>
			<option value="1">TIJUANA</option>
			<option value="2">PLAYAS DE ROSARITO</option>
			<option value="3">TECATE</option>
			<option value="4">MEXICALI</option>
			<option value="5">ENSENADA</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_imputado" class="form-label fw-bold">Calle o avenida del imputado</label>
		<input type="text" class="form-control" id="calle_imputado" name="calle_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_imputado" class="form-label fw-bold">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_imputado" name="numero_ext_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_imputado" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_imputado" name="numero_int_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tel_imputado" class="form-label fw-bold">Teléfono del imputado</label>
		<input type="text" class="form-control" id="tel_imputado" name="tel_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nac_imputado" class="form-label fw-bold ">Fecha de nacimiento del imputado:</label>
		<input type="date" class="form-control" id="fecha_nac_imputado" name="fecha_nac_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_imputado" class="form-label fw-bold ">Sexo del imputado</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_imputado" id="M">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_imputado" id="F">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_imputado" class="form-label fw-bold">Escolaridad del imputado</label>
		<input type="text" class="form-control" id="escolaridad_imputado" name="escolaridad_imputado">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="description-text" class="form-label fw-bold">Descripcion:</label>
		<textarea class="form-control" id="description" name="description" maxlength="300"></textarea>
		<div class="invalid-feedback">
			Por favor, anexa una breve descripcion del delito
		</div>
		<div id="mensaje_ayuda" class="form-text">300 carácteres restantes</div>
	</div>
</div>
