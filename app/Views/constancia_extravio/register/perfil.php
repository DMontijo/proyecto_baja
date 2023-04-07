<?= $this->extend('constancia_extravio/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- <?= var_dump($body_data->user) ?> -->
<div class="row">
	<div class="col-12">
		<h1 class="text-center fw-bold py-5">MI PERFIL</h1>
		<div class="card overflow-auto shadow rounded mb-5">
			<div class="card-body p-3 ">
				<h3 class="text-center fw-bold mt-3 mb-5">DATOS GENERALES</h3>
				<form id="form_datos" name="form_datos" class="row g-3 needs-validation" action="<?= base_url() ?>/constancia_extravio/dashboard/actualizar-perfil" method="POST" enctype="multipart/form-data" novalidate>
					<div class="col-12">
						<div class="row">
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
								<input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" value="<?= $body_data->user->NOMBRE ?>" required>
								<div class="invalid-feedback">
									El nombre es obligatorio
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido
									paterno</label>
								<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="50" value="<?= $body_data->user->APELLIDO_PATERNO ?>" required>
								<div class="invalid-feedback">
									El apellido paterno es obligatorio
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
								<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="50" value="<?= $body_data->user->APELLIDO_MATERNO ?>">
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de
									nacimiento</label>
								<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required value="<?= $body_data->user->FECHANACIMIENTO ?>" max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">
								<div class="invalid-feedback">
									La fecha de nacimiento es obligatoria
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="M" <?= $body_data->user->SEXO == "M" ? ' checked ' : '' ?> required>
									<label class="form-check-label" for="sexo">MASCULINO</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="F" <?= $body_data->user->SEXO == "F" ? ' checked ' : '' ?> required>
									<label class="form-check-label" for="sexo">FEMENINO</label>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="telefono" class="form-label fw-bold input-required">Número de
									teléfono</label>
								<input type="number" class="form-control" id="telefono" name="telefono" required max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);" value="<?= $body_data->user->TELEFONO ?>">
								<small>Mínimo 6 digitos</small>
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
								<label for="telefono2" class="form-label fw-bold">Número de teléfono adicional</label>
								<input type="number" class="form-control" id="telefono2" name="telefono2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);" value="<?= $body_data->user->TELEFONO2 ?>">
								<!-- <small>Mínimo 6 digitos</small> -->
							</div>

							<div class="col-12 text-center">
								<button class="btn btn-primary" type="submit" id="submit-btn-perfil"><i class="bi bi-check-circle-fill"></i> Actualizar datos</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="card overflow-auto shadow rounded mb-5">
			<div class="card-body p-3">
				<h3 class="text-center fw-bold mt-3 mb-5">CONTRASEÑA</h3>
				<form id="form_password" name="form_password" class="row g-3 needs-validation" action="<?= base_url() ?>/constancia_extravio/dashboard/actualizar-password" method="POST" enctype="multipart/form-data" novalidate>

					<div class="col-12">
						<div class="row">
							<div class="col-12 col-sm-6 mb-3 ">
								<!-- <label for="password" class="fw-bold">Nueva contraseña</label> -->
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
									<input type="password" name="password" class="form-control" id="password" placeholder="Nueva contraseña" minlength="6" required>
									<span class="input-group-text"><a id="toggle-password" href="#!" role="button"><i class="bi bi-eye-slash-fill"></i></a></span>
									<div class="invalid-feedback">
										Debe contener mínimo 6 carácteres.
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 mb-3">
								<!-- <label for="password_confirm" class="fw-bold">Confirmar contraseña</label> -->
								<div class="input-group">
									<span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
									<input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirmar la contraseña" minlength="6" required>
									<span class="input-group-text"><a id="toggle-password-confirm" href="#!" role="button"><i class="bi bi-eye-slash-fill"></i></a></span>
									<div class="invalid-feedback">
										Debes confirmar la contraseña y debe ser igual.
									</div>
								</div>
							</div>
							<div class="col-12 text-center">
								<button class="btn btn-primary" type="submit" id="submit-btn-password"><i class="bi bi-check-circle-fill"></i> Actualizar contraseña</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<?php include('otp_validation_modal.php') ?>
<script>
	const input = document.querySelector("#telefono");
	const input2 = document.querySelector("#telefono2");

	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	(function() {
		'use strict'
		const inputsText = document.querySelectorAll('input[type="text"]');
		const inputsEmail = document.querySelectorAll('input[type="email"]');
		const form_datos = document.querySelector('#form_datos');
		const form_password = document.querySelector('#form_password');
		const password = document.querySelector('#password');
		const password_confirm = document.querySelector('#password_confirm');
		const toggle_password = document.querySelector('#toggle-password');
		const toggle_password_confirm = document.querySelector('#toggle-password-confirm');

		inputsText.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = clearText(event.target.value).toUpperCase();
			}, false)
		})

		inputsEmail.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = clearText(event.target.value).toLowerCase();
			}, false)
		})

		toggle_password.addEventListener('click', (event) => {
			const type = password.getAttribute("type") === "password" ? "text" : "password";
			password.setAttribute("type", type);

			if (event.target.classList.contains('bi-eye-slash-fill')) {
				event.target.classList.remove('bi-eye-slash-fill');
				event.target.classList.add('bi-eye-fill');
			} else {
				event.target.classList.remove('bi-eye-fill');
				event.target.classList.add('bi-eye-slash-fill');
			}

		}, false);

		toggle_password_confirm.addEventListener('click', (event) => {
			const type = password_confirm.getAttribute("type") === "password" ? "text" : "password";
			password_confirm.setAttribute("type", type);

			if (event.target.classList.contains('bi-eye-slash-fill')) {
				event.target.classList.remove('bi-eye-slash-fill');
				event.target.classList.add('bi-eye-fill');
			} else {
				event.target.classList.remove('bi-eye-fill');
				event.target.classList.add('bi-eye-slash-fill');
			}
		}, false);

		form_datos.addEventListener('submit', function(event) {
			if (!form_datos.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			} else {
				event.preventDefault();
				event.stopPropagation();
				document.querySelector('#submit-btn-perfil').setAttribute('disabled', true);

				var data = {
					'email': '<?= $body_data->user->CORREO ?>'
				}

				$.ajax({
					data: data,
					method: "post",
					url: "<?php echo base_url('/data/sendOTP'); ?>",
					dataType: "json",
					success: function(data) {
						if (data.status = 200) {
							$('#otp_validation_modal').modal('show');
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						document.querySelector('#submit-btn').removeAttribute('disabled');
						console.log(jqXHR);
					}
				});
			}
			form_datos.classList.add('was-validated')
		}, false)

		form_password.addEventListener('submit', function(event) {
			if (!form_password.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			} else {
				event.preventDefault();
				event.stopPropagation();
				if (password.value === password_confirm.value) {
					document.querySelector('#submit-btn-password').setAttribute('disabled', true);
					form_password.submit();
				} else {
					Swal.fire({
						icon: 'error',
						text: 'Las contraseñas no son iguales',
						confirmButtonColor: '#bf9b55',
					});
				}
			}
			form_password.classList.add('was-validated')
		}, false)

		document.querySelector('#fecha_nacimiento').addEventListener('blur', (e) => {
			let fecha = e.target.value;
			let hoy = new Date();
			let cumpleanos = new Date(fecha);
			let edad = hoy.getFullYear() - cumpleanos.getFullYear();
			let m = hoy.getMonth() - cumpleanos.getMonth();

			if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
				edad--;
			}
			if (edad < 18) {
				Swal.fire({
					icon: 'warning',
					title: 'No podemos procesar tu solicitud',
					text: 'Para poder procesar tu solicitud debes ser mayor de edad.',
					confirmButtonColor: '#bf9b55',
				});

				e.target.value = '';
			}
		});

		function clearText(text) {
			return text
				.normalize('NFD')
				.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize()
				.replaceAll('´', '');
		}

	})()
</script>

<?= $this->endSection() ?>
