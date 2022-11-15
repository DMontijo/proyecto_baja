<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<h2 class="text-center font-weight-bold mb-3">EDITAR USUARIO</h2>
	<div class="card shadow border-0 rounded">
		<div class="card-body">
			<form class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/editar_usuario" method="POST" enctype="multipart/form-data" novalidate>
				<div class="row">
					<input type="text" name="id" value="<?= $body_data->usuario->ID ?>" hidden>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="nombre_usuario">Nombre(s)</label>
						<input autocomplete="off" type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" placeholder="Escribe el nombre" value="<?= $body_data->usuario->NOMBRE ?>" required>
						<div class="invalid-feedback">
							El nombre es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="apellido_paterno_usuario">Apellido paterno</label>
						<input autocomplete="off" type="text" name="apellido_paterno_usuario" class="form-control" id="apellido_paterno_usuario" placeholder="Escribe el apellido paterno" value="<?= $body_data->usuario->APELLIDO_PATERNO ?>" required>
						<div class="invalid-feedback">
							El apellido paterno es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="apellido_materno_usuario">Apellido materno</label>
						<input autocomplete="off" type="text" name="apellido_materno_usuario" class="form-control" id="apellido_materno_usuario" placeholder="Escribe el apellido materno" value="<?= $body_data->usuario->APELLIDO_MATERNO ?>">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="correo_usuario">Correo electrónico</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
							</div>
							<input autocomplete="off" type="email" name="correo_usuario" class="form-control" id="correo_usuario" placeholder="Correo electrónico" value="<?= $body_data->usuario->CORREO ?>">
						</div>

						<div class="invalid-feedback">
							El correo electrónico es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="zona_usuario">Zona</label>
						<select class="form-control" id="zona_usuario" name="zona_usuario" required>
							<option selected disabled value="">Elige la zona</option>
							<?php foreach ($body_data->zonas as $index => $zonas) { ?>
								<option value="<?= $zonas->ID_ZONA ?>" <?= $zonas->ID_ZONA == $body_data->usuario->ZONAID ? 'selected' : '' ?>> <?= $zonas->NOMBRE_ZONA ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El zona es obligatoria
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="rol_usuario">ROL de usuario</label>
						<select class="form-control" id="rol_usuario" name="rol_usuario" required>
							<option selected disabled value="">Elige el rol del usuario</option>
							<?php foreach ($body_data->roles as $index => $roles) { ?>
								<option value="<?= $roles->ID ?>" <?= $roles->ID == $body_data->usuario->ROLID ? 'selected' : '' ?>> <?= $roles->NOMBRE_ROL ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El rol es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="sexo_usuario" class="form-label font-weight-bold">Sexo</label>
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo_usuario" value="M" <?= $body_data->usuario->SEXO == 'M' ? 'checked' : '' ?>>
							<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo_usuario" value="F" <?= $body_data->usuario->SEXO == 'F' ? 'checked' : '' ?>>
							<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
						</div>
					</div>
					<div class="col-12 pt-5 text-center">
						<button type="submit" id="btn-submit" class="btn btn-primary font-weight-bold">
							ACTUALIZAR USUARIO
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		(function() {
			'use strict';
			var inputsText = document.querySelectorAll('input[type="text"]');
			var inputsEmail = document.querySelectorAll('input[type="email"]');

			inputsText.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toUpperCase();
				}, false)
			});

			inputsEmail.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toLowerCase();
				}, false)
			})

			window.addEventListener('load', function() {
				// Get the forms we want to add validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						document.querySelector('#btn-submit').setAttribute('disabled', true);
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
							document.querySelector('#btn-submit').removeAttribute('disabled');
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();

		function clearText(text) {
			return text
				.normalize('NFD')
				.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize()
				.replaceAll('´', '');
		}
	</script>
	<?= $this->endSection() ?>