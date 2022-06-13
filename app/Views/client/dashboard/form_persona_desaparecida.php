<div class="row">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos de la persona desaparecida</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_des" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_des" name="nombre_des" autofocus>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_des" class="form-label fw-bold ">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_des" name="apellido_paterno_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_des" class="form-label fw-bold ">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_des" name="apellido_materno_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estatura_des" class="form-label fw-bold ">Estatura (en centímetros)</label>
		<input type="number" class="form-control" id="estatura_des" name="estatura_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_des" class="form-label fw-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_des" name="fecha_nacimiento_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_des" class="form-label fw-bold ">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_des" name="edad_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="peso_des" class="form-label fw-bold ">Peso aproximado (en kg.)</label>
		<input type="number" class="form-control" id="peso_des" name="peso_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="complexion_des" class="form-label fw-bold ">Complexión</label>
		<select class="form-select" id="complexion_des" name="complexion_des">
			<option selected disabled value="">Elige la complexión</option>
			<option value="MEDIANA">MEDIANA</option>
			<option value="ROBUSTA">ROBUSTA</option>
			<option value="DELGADA">DELGADA</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_des" class="form-label fw-bold ">Color de piel o tez</label>
		<input type="text" class="form-control" id="color_des" name="color_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_des" class="form-label fw-bold">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_des" value="M">
			<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_des" value="F">
			<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="señas_des" class="form-label fw-bold ">Señas particulares</label>
		<textarea class="form-control" id="señas_des" name="señas_des" maxlength="300"></textarea>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="identidad_des" class="form-label fw-bold ">Identidad de género</label>
		<input type="text" class="form-control" id="identidad_des" name="identidad_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_cabello_des" class="form-label fw-bold ">Color de cabello</label>
		<input type="text" class="form-control" id="color_cabello_des" name="color_cabello_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tam_cabello_des" class="form-label fw-bold ">Tamaño de cabello</label>
		<select class="form-select" id="tam_cabello_des" name="tam_cabello_des">
			<option selected disabled value="">Elige el tamaño del cabello</option>
			<option value="CORTO">CORTO</option>
			<option value="MEDIANO">MEDIANO</option>
			<option value="LARGO">LARGO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="form_cabello_des" class="form-label fw-bold ">Forma de cabello</label>
		<select class="form-select" id="form_cabello_des" name="form_cabello_des">
			<option selected disabled value="">Elige el tamaño del cabello</option>
			<option value="CHINO">CHINO</option>
			<option value="LACIO">LACIO</option>
			<option value="ONDULADO">ONDULADO</option>
			<option value="QUEBRADIZO">QUEBRADIZO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_ojos_des" class="form-label fw-bold ">Color de ojos</label>
		<input type="text" class="form-control" id="color_ojos_des" name="color_ojos_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="frente_des" class="form-label fw-bold ">Tipo de frente</label>
		<select class="form-select" id="frente_des" name="frente_des">
			<option selected disabled value="">Elige el tipo de frente</option>
			<option value="REGULAR">REGULAR</option>
			<option value="AMPLIA">AMPLIA</option>
			<option value="PEQUEÑA">PEQUEÑA</option>
			<option value="GRANDE">GRANDE</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ceja_des" class="form-label fw-bold ">Tipo de ceja</label>
		<select class="form-select" id="ceja_des" name="ceja_des">
			<option selected disabled value="">Elige el tipo de ceja</option>
			<option value="POBLADAS">POBLADAS</option>
			<option value="NO POBLADAS">NO POBLADAS</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="discapacidad_des" class="form-label fw-bold">¿Padece alguna
			discapacidad?</label>
		<select class="form-select" id="discapacidad_des" name="discapacidad_des">
			<option selected disabled value="">Seleccione si padece alguna discapacidad</option>
			<option value="VISUAL">VISUAL</option>
			<option value="FISICA">FISICA</option>
			<option value="AUDITIVA">AUDITIVA</option>
			<option vaulue="NINGUNA">NINGUNA</option>
		</select>
		<div class="invalid-feedback">
			El campo discapacidad es obligatorio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="origen_des" class="form-label fw-bold ">Lugar de origen</label>
		<input type="text" class="form-control" id="origen_des" name="origen_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dia_des" class="form-label fw-bold ">¿Cuando se le vio por ultima vez?</label>
		<input type="date" class="form-control" id="dia_des" name="dia_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar_des" class="form-label fw-bold ">¿Dónde se le vio por ultima vez?</label>
		<input type="text" class="form-control" id="lugar_des" name="lugar_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="vestimenta_des" class="form-label fw-bold ">Vestimenta que portaba</label>
		<input type="text" class="form-control" id="vestimenta_des" name="vestimenta_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="parentesco_des" class="form-label fw-bold ">Parentesco:</label>
		<input type="text" class="form-control" id="parentesco_des" name="parentesco_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_des" class="form-label fw-bold ">Fotografía:</label>
		<input type="file" class="form-control" id="foto_des" name="foto_des">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<div class="form-check d-inline-block">
			<input id="autorization_photo_des" name="autorization_photo_des" class="form-check-input" type="checkbox">
			<label class="form-check-label" for="autorization_photo_des">
				Doy autorización de publicar la fotografía e información en medios de comunicación.</label>
		</div>
	</div>
</div>
