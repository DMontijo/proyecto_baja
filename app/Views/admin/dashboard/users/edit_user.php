<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="row">
		<div class="col-12 text-center mb-4">
			<h2 class="font-weight-bold mb-3">EDITAR USUARIO</h2>
			<a class="link link-primary" href="<?= base_url('admin/dashboard/usuarios') ?>" role="button"><i class="fas fa-reply"></i> Regresar a usuarios</a>
		</div>
		<div class="col-12">
			<div class="card shadow border-0 rounded">
				<div class="card-body">
					<form id="form-datos" class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/editar_usuario" method="POST" enctype="multipart/form-data" novalidate>
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
								<label for="sexo_usuario" class="form-label font-weight-bold">Sexo</label>
								<br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo_usuario" value="M" <?= $body_data->usuario->SEXO == 'M' ? 'checked' : '' ?> required>
									<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="sexo_usuario" value="F" <?= $body_data->usuario->SEXO == 'F' ? 'checked' : '' ?> required>
									<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
								</div>
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
									<option selected disabled value="">Selecciona la zona</option>
									<?php foreach ($body_data->zonas as $index => $zonas) { ?>
										<option value="<?= $zonas->ID_ZONA ?>" <?= $zonas->ID_ZONA == $body_data->usuario->ZONAID ? 'selected' : '' ?>>
											<?= $zonas->NOMBRE_ZONA ?> </option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									El zona es obligatoria
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="rol_usuario">ROL de usuario</label>
								<select class="form-control" id="rol_usuario" name="rol_usuario" required>
									<option selected disabled value="">Selecciona el rol del usuario</option>
									<?php foreach ($body_data->roles as $index => $roles) { ?>
										<option value="<?= $roles->ID ?>" <?= $roles->ID == $body_data->usuario->ROLID ? 'selected' : '' ?>>
											<?= $roles->NOMBRE_ROL ?> </option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									El rol es obligatorio
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label for="municipio" class="form-label font-weight-bold">Municipio</label>
								<select class="form-control" name="municipio" id="municipio" required>
									<option selected value="" disabled>Selecciona el municipio</option>
									<option value="1" <?= $body_data->usuario->MUNICIPIOID == 1 ? 'selected' : '' ?>>ENSENADA
									</option>
									<option value="2" <?= $body_data->usuario->MUNICIPIOID == 2 ? 'selected' : '' ?>>MEXICALI
									</option>
									<option value="3" <?= $body_data->usuario->MUNICIPIOID == 3 ? 'selected' : '' ?>>TECATE
									</option>
									<option value="4" <?= $body_data->usuario->MUNICIPIOID == 4 ? 'selected' : '' ?>>TIJUANA
									</option>
									<option value="5" <?= $body_data->usuario->MUNICIPIOID == 5 ? 'selected' : '' ?>>PLAYAS DE
										ROSARITO</option>
								</select>
								<div class="invalid-feedback">
									El municipio es obligatorio
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label for="oficina" class="font-weight-bold">Oficina</label>
								<select class="form-control" name="oficina" id="oficina" required>
									<option selected disabled value="">Selecciona la oficina</option>
									<?php foreach ($body_data->oficinas as $index => $oficina) { ?>
										<option value="<?= $oficina->OFICINAID ?>" <?= $oficina->OFICINAID == $body_data->usuario->OFICINAID ? 'selected' : '' ?>>
											<?= $oficina->OFICINADESCR ?> </option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									La oficina es obligatoria
								</div>
							</div>
							<div class="col-12 pt-5 text-center">
								<button type="submit" id="btn-submit-datos" class="btn btn-primary font-weight-bold">
									ACTUALIZAR USUARIO
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card shadow border-0 rounded">
				<div class="card-body">
					<form id="form-password" class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/editar_password" method="POST" enctype="multipart/form-data" novalidate>
						<div class="row">
							<input type="text" name="id" value="<?= $body_data->usuario->ID ?>" hidden>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-lock"></i></div>
									</div>
									<input autocomplete="off" type="password" name="password" class="form-control" id="password" placeholder="Nueva contraseña" minlength="6" required>
									<div class="input-group-prepend">
										<div class="input-group-text">
											<a id="toggle-password" href="#!" role="button"><i class="fa fa-eye-slash"></i></a>
										</div>
									</div>
									<div class="invalid-feedback">
										Debe tener mínimo 6 carácteres.
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-lock"></i></div>
									</div>
									<input autocomplete="off" type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirmación de contraseña" minlength="6" required>
									<div class="input-group-prepend">
										<div class="input-group-text">
											<a id="toggle-password-confirm" href="#!" role="button"><i class="fa fa-eye-slash"></i></a>
										</div>
									</div>
									<div class="invalid-feedback">
										Debe ser igual.
									</div>
								</div>
							</div>
							<div class="col-12 text-center">
								<button type="submit" id="btn-submit-password" class="btn btn-primary font-weight-bold">
									ACTUALIZAR CONTRASEÑA
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function() {
			'use strict';
			//Declaracion de elementos
			const inputsText = document.querySelectorAll('input[type="text"]');
			const inputsEmail = document.querySelectorAll('input[type="email"]');
			const municipio = document.querySelector('#municipio');
			const oficina_select = document.querySelector('#oficina');
			const form_datos = document.querySelector('#form-datos');
			const form_password = document.querySelector('#form-password');
			const password = document.querySelector('#password');
			const password_confirm = document.querySelector('#password_confirm');
			const toggle_password = document.querySelector('#toggle-password');
			const toggle_password_confirm = document.querySelector('#toggle-password-confirm');

			//Convierte todos los input text a mayusculas
			inputsText.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toUpperCase();
				}, false)
			});
			//Convierte todos los input email a minusculas

			inputsEmail.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toLowerCase();
				}, false)
			});

			//Evento para mostrar contraseña
			toggle_password.addEventListener('click', (event) => {
				const type = password.getAttribute("type") === "password" ? "text" : "password";
				password.setAttribute("type", type);

				if (event.target.classList.contains('fa-eye-slash')) {
					event.target.classList.remove('fa-eye-slash');
					event.target.classList.add('fa-eye');
				} else {
					event.target.classList.remove('fa-eye');
					event.target.classList.add('fa-eye-slash');
				}

			}, false);
			//Evento para mostrar contraseña de confirmacion
			toggle_password_confirm.addEventListener('click', (event) => {
				const type = password_confirm.getAttribute("type") === "password" ? "text" : "password";
				password_confirm.setAttribute("type", type);

				if (event.target.classList.contains('fa-eye-slash')) {
					event.target.classList.remove('fa-eye-slash');
					event.target.classList.add('fa-eye');
				} else {
					event.target.classList.remove('fa-eye');
					event.target.classList.add('fa-eye-slash');
				}
			}, false);

			//Evento para obtener las oficinas de acuerdo al municipio, se limpia el select para que no se acumule
			municipio.addEventListener('change', function(event) {
				$.ajax({
					data: {
						'municipio': event.target.value,
					},
					url: "<?= base_url('/data/get-oficinas-by-municipio') ?>",
					method: "POST",
					dataType: "json",
				}).done(function(data) {
					clearSelect(oficina_select);
					data.forEach(oficina => {
						let option = document.createElement("option");
						option.text = oficina.OFICINADESCR;
						option.value = oficina.OFICINAID;
						oficina_select.add(option);
					});
					oficina_select.value = '';
				}).fail(function(jqXHR, textStatus) {
					clearSelect(oficina_select);
				});
			}, false);

			//VAlidacion de formularios submit
			form_datos.addEventListener('submit', function(event) {
				document.querySelector('#btn-submit-datos').setAttribute('disabled', true);
				if (!form_datos.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					document.querySelector('#btn-submit-datos').removeAttribute('disabled');
				}
				form_datos.classList.add('was-validated');
			}, false);

			form_password.addEventListener('submit', function(event) {
				document.querySelector('#btn-submit-password').setAttribute('disabled', true);
				if (!form_password.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					document.querySelector('#btn-submit-password').removeAttribute('disabled');
				} else {
					event.preventDefault();
					event.stopPropagation();
					if (password.value === password_confirm.value) {
						form_password.submit();
					} else {
						document.querySelector('#btn-submit-password').removeAttribute('disabled');
						Swal.fire({
							icon: 'error',
							text: 'Las contraseñas no son iguales',
							confirmButtonColor: '#bf9b55',
						});
					}
				}
				form_password.classList.add('was-validated');
			}, false);
		})();
		//Elimina todos los caracteres especiales del texto

		function clearText(text) {
			return text
				.normalize('NFD')
				.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize()
				.replaceAll('´', '');
		}
		//Elimina todos los options de un select

		function clearSelect(select_element) {
			for (let i = select_element.options.length; i >= 1; i--) {
				select_element.remove(i);
			}
		}
	</script>
	<?= $this->endSection() ?>