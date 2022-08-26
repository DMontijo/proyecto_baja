<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title; ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php
$user_id = session('ID');
$directory = FCPATH . 'uploads/FIEL/' . $user_id;
$file_key = $user_id . '_key.key';
$file_cer = $user_id . '_cer.cer';
?>
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
							<h3 class="text-center font-weight-bold mb-3">SUBIR FIEL</h3>
							<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) : ?>
								<p class="text-center font-weight-bold">YA EXISTE UNA FIEL CARGADA</p>
							<?php endif; ?>
							<form id="form_fiel" class="row needs-validation" action="<?= base_url() ?>/admin/dashboard/charge_fiel" method="POST" enctype="multipart/form-data" novalidate>
								<div class="col-12 col-md-6 mb-3">
									<label class="form-label font-weight-bold" for="key">Archivo .key</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="key" name="key" accept=".key" required>
										<label class="custom-file-label" for="key" id="key_label">Seleccionar archivo key</label>
										<div class="invalid-feedback">
											El archivo .key es obligatorio
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 mb-3">
									<label class="form-label font-weight-bold" for="cer">Archivo .cer</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="cer" name="cer" accept=".cer" required>
										<label class="custom-file-label" for="cer" id="cer_label">Seleccionar archivo cer</label>
										<div class="invalid-feedback">
											El archivo .cer es obligatorio
										</div>
									</div>
								</div>
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt mr-2"></i>
										<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) : ?>
											ACTUALIZAR FIEL
										<?php else : ?>
											SUBIR FIEL
										<?php endif; ?>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="card shadow border-0 rounded">
						<div class="card-body">
							<h3 class="text-center font-weight-bold mb-3">ACTUALIZAR CONTRASEÑA</h3>
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
										<button type="submit" class="btn btn-primary"><i class="fas fa-lock mr-2"></i> ACTUALIZAR CONTRASEÑA</button>
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
	let form_password = document.querySelector('#form_password');
	let form_fiel = document.querySelector('#form_fiel');
	let password = document.querySelector('#password');
	let password_confirm = document.querySelector('#password_confirm');

	form_password.addEventListener('submit', function(event) {
		if (!form_password.checkValidity()) {
			event.preventDefault();
		} else {
			event.preventDefault();
			if (password.value === password_confirm.value) {
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

	form_fiel.addEventListener('submit', function(event) {
		if (!form_fiel.checkValidity()) {
			event.preventDefault();
		}
		form_fiel.classList.add('was-validated')
	}, false)

	document.getElementById('key').addEventListener('change', (e) => {
		document.getElementById('key_label').innerHTML = e.target.files[0].name;
	});
	document.getElementById('cer').addEventListener('change', (e) => {
		document.getElementById('cer_label').innerHTML = e.target.files[0].name;
	});
</script>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
	<script>
		Swal.fire({
			icon: 'warning',
			html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>

<?= $this->endSection() ?>
