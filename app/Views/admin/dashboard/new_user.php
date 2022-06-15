<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<h2 class="text-center font-weight-bold mb-3">NUEVO USUARIO</h2>
	<div class="card shadow border-0 rounded">
		<div class="card-body">
			<form class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/nuevo_usuario" method="POST" enctype="multipart/form-data" novalidate>
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nombreU" class="form-label fw-bold input-required">Nombre(s)</label>
						<input autocomplete="off" type="text" name="nombre" class="form-control" id="nombre" placeholder="Escribe el nombre" required>
						<div class="invalid-feedback">
							El nombre es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_paterno">Apellido paterno</label>
						<input autocomplete="off" type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" placeholder="Escribe el apellido paterno" required>
						<div class="invalid-feedback">
							El apellido paterno es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_materno">Apellido materno</label>
						<input autocomplete="off" type="text" name="apellido_materno" class="form-control" id="apellido_materno" placeholder="Escribe el apellido materno">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="correo">Correo electrónico</label>
						<input autocomplete="off" type="email" name="correo" class="form-control" id="correo" placeholder="Escribe el correo electrónico" required>
						<div class="invalid-feedback">
							El correo electrónico es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="password">Contraseña</label>
						<input autocomplete="off" type="password" name="password" class="form-control" id="password" placeholder="Escribe la contraseña" required>
						<div class="invalid-feedback">
							La contraseña es obligatoria
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="zona">Zona</label>
						<select class="form-control" id="zona" name="zona" required>
							<option selected disabled value="">Elige la zona</option>
							<?php foreach ($body_data->zonas as $index => $zonas) { ?>
								<option value="<?= $zonas->ID_ZONA ?>"> <?= $zonas->NOMBRE_ZONA ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El zona es obligatoria
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="rol">ROL de usuario</label>
						<select class="form-control" id="rol" name="rol" required>
							<option selected disabled value="">Elige el rol del usuario</option>
							<?php foreach ($body_data->roles as $index => $roles) { ?>
								<option value="<?= $roles->ID ?>"> <?= $roles->NOMBRE_ROL ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El rol es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo" value="M" checked required>
							<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo" value="F" required>
							<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
						</div>
					</div>
					<div class="col-12">
						<h4 class="text-center pt-5">FIRMA ELECTRÓNICA</h4>
						<hr>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cer">ARCHIVO .CER</label>
						<input autocomplete="off" class="form-control" type="file" id="cer" name="cer">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="key">ARCHIVO .KEY</label>
						<input autocomplete="off" class="form-control" type="file" id="key" name="key">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="frase">CLAVE FIEL</label>
						<input autocomplete="off" class="form-control" type="text" id="frase" name="frase">
					</div>
					<div class="col-12 py-5 text-center">
						<button type="submit" class="btn btn-primary">CREAR USUARIO</button>
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
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						} else {

						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();

		function clearText(text) {
			text
				.normalize('NFD')
				.replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize();
			return text.replaceAll('´', '');
		};

		document.querySelector('#correo').addEventListener('blur', (e) => {
			let regex = /\S+@\S+\.\S+/
			console.log('correo verificar')
			if (regex.test(e.target.value)) {
				$.ajax({
					data: {
						'email': e.target.value
					},
					url: "<?= base_url('/data/exist-email-admin') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.exist === 1) {
							Swal.fire({
								icon: 'error',
								text: 'El correo ya se encuentra registrado, ingresa uno diferente.',
								confirmButtonColor: '#bf9b55',
							}).then(() => {
								e.target.value = '';
							})
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}
		})
	</script>
	<?= $this->endSection() ?>
