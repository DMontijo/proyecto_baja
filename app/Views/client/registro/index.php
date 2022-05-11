<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container m-auto">
	<h1 class="text-center fw-bolder pb-1 text-blue">DATOS DEL DENUNCIANTE</h1>

	<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
	<form class="row g-3 needs-validation" novalidate>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
			<input type="text" class="form-control" id="nombres" name="nombre" required>
			<div class="invalid-feedback">
				El nombre es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
			<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
			<div class="invalid-feedback">
				El apellido paterno es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
			<input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
			<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
			<div class="invalid-feedback">
				La fecha de nacimiento es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="municipio" class="form-label fw-bold input-required">Municipio del denunciante</label>
			<select class="form-select" id="municipio" name="municipio" required>
				<option selected disabled value="">Seleccione el municipio</option>
				<option value="1">ENSENADA</option>
				<option value="2">MEXICALI</option>
				<option value="2">PLAYAS DE ROSARITO</option>
				<option value="3">TECATE</option>
				<option value="4">TIJUANA</option>
			</select>
			<div class="invalid-feedback">
				El municipio es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="localidad" class="form-label fw-bold input-required">Localidad del denunciante</label>
			<select class="form-select" id="localidad" name="localidad" required>
				<option selected disabled value="">Seleccione la localidad</option>
				<option value="1">LOCALIDAD</option>
				<option value="2">LOCALIDAD</option>
				<option value="2">LOCALIDAD</option>
				<option value="3">LOCALIDAD</option>
				<option value="4">LOCALIDAD</option>
			</select>
			<div class="invalid-feedback">
				La localidad es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="colonia_select" class="form-label fw-bold input-required">Colonia del denunciante</label>
			<select class="form-select" id="colonia_select" name="colonia_select" onchange="activateColoniaInput(event)" required>
				<option selected disabled value="">Seleccione la colonia</option>
				<option value="1">COLONIA</option>
				<option value="2">COLONIA</option>
				<option value="2">COLONIA</option>
				<option value="3">COLONIA</option>
				<option value="4">COLONIA</option>
				<option value="0">[NO APARECE MI COLONIA]</option>
			</select>
			<input type="text" class="form-control d-none" id="colonia_input" name="colonia_input" required>
			<div class="invalid-feedback">
				La colonia es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="calle" class="form-label fw-bold input-required">Calle o Avenida del denunciante</label>
			<input type="text" class="form-control" id="calle" name="calle" required>
			<div class="invalid-feedback">
				La calle o avenida es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="exterior" class="form-label fw-bold input-required">Número exterior</label>
			<input type="text" class="form-control" id="exterior" name="exterior" required>
			<div class="invalid-feedback">
				El número exterior es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="interior" class="form-label fw-bold">Número interior</label>
			<input type="text" class="form-control" id="interior" name="interior">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
			<input type="email" class="form-control" id="correo" name="correo" required>
			<div class="invalid-feedback">
				El correo esta erroneo
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="identificacion" class="form-label fw-bold input-required">Identificación</label>
			<select class="form-select" id="identificacion" name="identificacion" onchange="" required>
				<option selected disabled value="">Seleccione la identificación</option>
				<option value="INE">INE</option>
				<option value="PASAPORTE">PASAPORTE</option>
				<option value="LICENCIA DE CONDUCIR">LICENCIA DE CONDUCIR</option>
				<option value="ACTA DE NACIMIENTO">ACTA DE NACIMIENTO</option>
			</select>
			<div class="invalid-feedback">
				El tipo de identificación es obligatorio.
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="documento" class="form-label fw-bold input-required">Foto de identificación</label>
			<input class="form-control" type="file" id="documento" name="documento" accept="image/*" capture="user" required multiple>
			<div class="form-text">Para tomar foto <a class="link-yellow" type="button" data-bs-toggle="modal" data-bs-target="#take_photo_modal">clic aquí <i class="bi bi-camera-fill"></i></a></div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<label for="sexo" class="form-label fw-bold input-required">Sexo biológico</label>
			<br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" id="M" checked required>
				<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" id="F" required>
				<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
			</div>
		</div>
		<div class="col-12">
			<?php include('e_firma_canva.php') ?>
		</div>
		<div class="col-12 text-center">
			<button class="btn btn-primary " type="submit">Guardar</button>
			<!-- <button type="submit" class="btn btn-primary">Registrarme</button> -->
		</div>
	</form>
</div>

<?php include('otp_validation_modal.php') ?>
<?php include('take_photo_modal.php') ?>

<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');

		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					event.preventDefault();

					if (!form.checkValidity()) {
						event.stopPropagation();
					} else {
						$('#otp_validation_modal').modal('show');
					}

					form.classList.add('was-validated')
				}, false)
			})

		inputsText.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = event.target.value.toUpperCase();
			}, false)
		})

		inputsEmail.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = event.target.value.toLowerCase();
			}, false)
		})
	})()

	const activateColoniaInput = (e) => {
		let select = document.getElementById('colonia_select');
		let input = document.getElementById('colonia_input');

		console.log(e.target.value, typeof(e.target.value));

		if (e.target.value === '0') {
			select.classList.add('d-none');
			input.value = '';
			input.classList.remove('d-none');
		} else {
			input.value = e.target.value;
		}
	};
</script>

<?= $this->endSection() ?>
