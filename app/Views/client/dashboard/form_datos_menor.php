<div class="row" method="POST">
	<h3 class="text-center fw-bolder pb-3 text-blue">Registra los datos del menor de edad</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_menor" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_menor" name="nombre_menor" autofocus>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_menor" class="form-label fw-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_menor" name="apellido_paterno_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_menor" class="form-label fw-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_menor" name="apellido_materno_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_menor" class="form-label fw-bold">País</label>
		<select class="form-select" id="pais_menor" name="pais_menor">
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_menor" class="form-label fw-bold">Estado</label>
		<select class="form-select" id="estado_menor" name="estado_menor">
			<option selected disabled value="">Seleccione el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_menor" class="form-label fw-bold">Municipio</label>
		<select class="form-select" id="municipio_menor" name="municipio_menor">
			<option selected disabled value="">Seleccione el municipio</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_menor" class="form-label fw-bold">Calle</label>
		<input type="text" class="form-control" id="calle_menor" name="calle_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_menor" class="form-label fw-bold">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_menor" name="numero_ext_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_menor" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_menor" name="numero_int_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_menor" class="form-label fw-bold">Código Postal</label>
		<input type="number" class="form-control" id="cp_menor" name="cp_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_menor" class="form-label fw-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_menor" name="fecha_nacimiento_menor">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_menor" class="form-label fw-bold">Edad</label>
		<input class="form-control" id="edad_menor" name="edad_menor" type="text" disabled>
	</div>
</div>


<script>
	document.querySelector('#fecha_nacimiento_menor').addEventListener('change', (e) => {
		let fecha = e.target.value;
		let hoy = new Date();
		let cumpleanos = new Date(fecha);
		let edad = hoy.getFullYear() - cumpleanos.getFullYear();
		let m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
			edad--;
		}
		document.querySelector('#edad_menor').value = edad;
	})
</script>
