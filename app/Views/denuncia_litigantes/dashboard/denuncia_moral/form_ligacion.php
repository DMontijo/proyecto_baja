<div class="row">
	<h3 class="fw-bold text-center text-blue pb-3">Validación de persona moral</h3>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_volumen" class="form-label fw-bold">Poder volumen:</label>
		<input type="text" class="form-control" id="poder_volumen" name="poder_volumen">
		<div class="invalid-feedback">
			Por favor, ingresa el volumen.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_notario" class="form-label fw-bold">Número notario:</label>
		<input type="text" class="form-control" id="poder_notario" name="poder_notario">
		<div class="invalid-feedback">
			Por favor, ingresa el número notario.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_no_poder" class="form-label fw-bold">Número de poder:</label>
		<input type="text" class="form-control" id="poder_no_poder" name="poder_no_poder">
		<div class="invalid-feedback">
			Por favor, ingresa el número poder.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label class="form-label fw-bold" for="fecha_inicio_poder">Fecha de expedición de poder</label>
		<input type="date" name="fecha_inicio_poder" class="form-control" id="fecha_inicio_poder">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label class="form-label fw-bold" for="fecha_fin_poder">Fecha de vigencia del poder</label>
		<input type="date" name="fecha_fin_poder" class="form-control" id="fecha_fin_poder">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_archivo" class="form-label fw-bold input-required">Archivo del poder notarial:</label>
		<input type="file" class="form-control" id="poder_archivo" name="poder_archivo" required>
		<img id="poder_foto" class="img-fluid" src="" style="max-width:300px;">
		<button id="solicitar-cambio" name="solicitar-cambio" type="button" class="btn btn-primary d-none">Solicitar cambio</button>


	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cargo" class="form-label fw-bold input-required">¿Cúal es tu cargo en la persona moral?</label>
		<select class="form-select" id="cargo" name="cargo" required>
			<option selected disabled value="">Selecciona su cargo en la persona moral</option>
			<option value="APODERADO">APODERADO</option>
			<option value="LITIGANTE">LITIGANTE</option>

		</select>
		<div class="invalid-feedback">
			El tipo de identificación es obligatorio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="descr_cargo" class="form-label fw-bold">Descripcion del cargo:</label>
		<input type="text" class="form-control" id="descr_cargo" name="descr_cargo">
	</div>
	<div class="col-12">
		<hr>
	</div>

</div>