<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-12">
					<h1 class="mb-4 text-center font-weight-bold">PERFIL</h1>
					<a href=""></a>
				</div>

				<div class="col-12">
					<div class="card shadow border-0 rounded">
						<div class="card-body">
							<form class="g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
								<div class="row">
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="nombreU" class="form-label font-weight-bold">Nombre(s)</label>
										<input autocomplete="off" type="text" name="nombre" class="form-control" id="nombre" value="<?= session('NOMBRE') ?>">
										<div class="invalid-feedback">
											El nombre es obligatorio
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="apellido_paterno" class="font-weight-bold">Apellido paterno</label>
										<input autocomplete="off" type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" value="<?= session('APELLIDO_PATERNO') ?>">
										<div class="invalid-feedback">
											El apellido paterno es obligatorio
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="apellido_materno" class="font-weight-bold">Apellido materno</label>
										<input autocomplete="off" type="text" name="apellido_materno" class="form-control" id="apellido_materno" value="<?= session('APELLIDO_MATERNO') ?>">
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="correo" class="font-weight-bold">Correo electrónico</label>
										<input type="email" name="correo" class="form-control" id="correo" value="<?= session('CORREO') ?>">
										<div class="invalid-feedback">
											El correo electrónico es obligatorio
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="zona" class="font-weight-bold">Zona</label>
										<select class="form-control" id="zona" name="zona" disabled>
											<option selected value="">Elige la zona</option>
											<?php foreach ($body_data->zonas as $index => $zonas) { ?>
												<option value="<?= $zonas->ID_ZONA ?>" <?= $zonas->ID_ZONA == session('ZONAID') ? 'selected' : '' ?>> <?= $zonas->NOMBRE_ZONA ?> </option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											El zona es obligatoria
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="rol" class="font-weight-bold">ROL de usuario</label>
										<select class="form-control" id="rol" name="rol" disabled>
											<option selected value="">Elige el rol del usuario</option>
											<?php foreach ($body_data->roles as $index => $roles) { ?>
												<option value="<?= $roles->ID ?>" <?= $roles->ID == session('ROLID') ? 'selected' : '' ?>> <?= $roles->NOMBRE_ROL ?> </option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											El rol es obligatorio
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
										<label for="sexo" class="form-label font-weight-bold">Sexo</label>
										<br>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="sexo" value="M" <?= session('SEXO') == 'M' ? 'checked' : '' ?>>
											<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="sexo" value="F" <?= session('SEXO') == 'F' ? 'checked' : '' ?>>
											<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="card shadow border-0 rounded">
						<div class="card-body">
							<form id="form_password" class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/update_password" method="POST" enctype="multipart/form-data" novalidate>
								<div class="row">
									<div class="col-12 col-sm-6 mb-3">
										<label for="password" class="font-weight-bold">Nueva contraseña</label>
										<input autocomplete="off" type="password" name="password" class="form-control" id="password" placeholder="Escribe la contraseña" required>
										<div class="invalid-feedback">
											La contraseña es obligatoria
										</div>
									</div>
									<div class="col-12 col-sm-6 mb-3">
										<label for="password_confirm" class="font-weight-bold">Confirmar nueva contraseña</label>
										<input autocomplete="off" type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Escribe la contraseña" required>
										<div class="invalid-feedback">
											La confirmación de contraseña es obligatoria
										</div>
									</div>
									<div class="col-12 text-center">
										<button type="submit" class="btn btn-primary">ACTUALIZAR CONTRASEÑA</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<script>
	let form = document.querySelector('#form_password');
	let password = document.querySelector('#password');
	let password_confirm = document.querySelector('#password_confirm');

	form.addEventListener('submit', function(event) {
		if (!form.checkValidity()) {
			event.preventDefault();
		} else {
			event.preventDefault();
			if (password.value === password_confirm.value) {
				form.submit();
			} else {
				Swal.fire({
					icon: 'error',
					text: 'Las contraseñas no son iguales',
					confirmButtonColor: '#bf9b55',
				});
			}
		}
		form.classList.add('was-validated')
	}, false)
</script>

<?= $this->endSection() ?>
