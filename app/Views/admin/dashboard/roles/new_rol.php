<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<h2 class="text-center font-weight-bold mb-3">NUEVO ROL</h2>
	<div class="card shadow border-0 rounded">
		<div class="card-body">
			<form class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/create_rol" method="POST" enctype="multipart/form-data" novalidate>
				<div class="row">
					
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label class="font-weight-bold" for="rol_usuario">ROL de usuario</label>
						<select class="form-control" id="rol_usuario" name="rol_usuario" required>
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
						<label class="font-weight-bold" for="permiso_rol">Permiso del rol</label>
						<select class="form-control" id="permiso_rol" name="permiso_rol" required>
							<option selected disabled value="">Elige el permiso del rol</option>
							<?php foreach ($body_data->permisos as $index => $permiso) { ?>
								<option value="<?= $permiso->PERMISOID ?>"> <?= $permiso->PERMISODESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El rol es obligatorio
						</div>
					</div>
					<div class="col-12 pt-5 text-center">
						<button type="submit" id="btn-submit" class="btn btn-primary font-weight-bold">
							<div id="spinner" class="spinner-border text-primary d-none" role="status">
								<span class="sr-only">Loading...</span>
							</div>
							CREAR ROL
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?= $this->endSection() ?>