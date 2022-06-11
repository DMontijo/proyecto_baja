<form>
	<div class="row">
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
			<input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" required autofocus>
			<div class="invalid-feedback">
				El nombre es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
			<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="100" required>
			<div class="invalid-feedback">
				El apellido paterno es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
			<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="100">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
			<input type="email" class="form-control" id="correo" name="correo" maxlength="100" required>
			<div class="invalid-feedback">
				El correo esta erroneo
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
			<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
			<div class="invalid-feedback">
				La fecha de nacimiento es obligatoria
			</div>
		</div>
		<input class="form-control" id="edad" name="edad" maxlength="3" type="text" hidden required>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
			<br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" value="HOMBRE" checked required>
				<label class="form-check-label" for="flexRadioDefault1">HOMBRE</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" value="MUJER" required>
				<label class="form-check-label" for="flexRadioDefault2">MUJER</label>
			</div>
		</div>

	</div>
</form>
